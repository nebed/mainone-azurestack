<template>
<div>
  <section class="hero is-hero-bar">
    <div class="hero-body">
      <div class="level">
        <div class="level-left">
          <div class="level-item">
            <h1 class="title">
              Rates
            </h1>
          </div>
        </div>
        <div class="level-right"
             style="display: none;">
          <div class="level-item">
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section is-main-section">
    <div class="pricing-table is-horizontal">
      <div class="pricing-plan" v-for="rates,key in groupedrates">
        <div class="plan-header">{{key}}</div>
        <div class="plan-items">
          <div class="">
            <div class="columns" v-for="rate,index in rates">
              <div class="column is-4"><p><strong>{{rate.name}}</strong></p></div>
              <div class="column is-4"><div class="field has-addons">
                <div class="control has-icons-left">
                  <input class="input" type="number" v-model="groupedrates[key][index].rate" placeholder="Enter Rate">
                  <span class="icon is-small is-left">
                    <i class="fas fa-dollar-sign"></i>
                  </span>
                </div>
                <div class="control">
                  <a class="button is-success" :class="{'is-loading':groupedrates[key][index].created_at}" @click="saveRate(key,index,rate)">
                    Save
                  </a>
                </div>
              </div></div>
              <div class="column is-4">{{rate.unit}}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
</template>

<script>
import randomMixins from '../mixins/random';
export default {
  data: function() {
    return {
      groupedrates:[],
      setrate: {
        'Network':[],
        'Storage':[],
        'Compute':[],
        'AppService':[],
        'CustomWorkerTiers':[],
        'Database':[],
        'KeyVault':[],
      },
      placeborates:[],
    }
  },
  mixins: [
    randomMixins
  ],
  directives: {
    randomColor: {
      bind(el, binding, vnode) {
        var colorPicker = [
          '#353535',
          '#00d1b2',
          '#209cef',
          '#ff3860'
        ]
        el.style.backgroundColor = colorPicker[binding.value]
        el.style.color = '#fff'
      }
    }
  },
  created() {
    this.$http({
            method: 'get',
            url: 'stack/rates',
          }).then((res) => {
            this.groupedrates = res.data;
          }).catch((error) => {
  
          });
  },
  methods: {
    saveRate(key,index,rate)
    {
      this.groupedrates[key][index].created_at = true;
      this.$http({
        method: 'post',
        url: 'stack/rates',
        data: { 'id': rate.id,
                'rate': rate.rate,
              }
      }).then((res) => {
        this.$notify({
          group: 'foo',
          type: 'success',
          title: 'Success',
          text: 'The '+rate.name+' rate has been saved successfuly'
        });
        this.groupedrates[key][index].created_at = false;
      }).catch((error) => {

      });

    }
  }
}

</script>

<style scoped="">

.pricing-table.is-horizontal .pricing-plan .plan-items {
  margin:auto;
  columns: 1;
  -webkit-columns: 1;
}

section.section.is-title-bar {
  padding: 1.5rem;
  border-bottom: 1px solid rgba(24, 28, 33, 0.06);
}

section.hero.is-hero-bar {
  background-color: white;
  border-bottom: 1px solid rgba(24, 28, 33, 0.06);
  padding: 1rem;
}

section > .hero-body {
  padding:1rem;
}

section.section.is-title-bar ul li:last-child {
  padding-right: 0;
  font-weight: 900;
  color: #242424;
}

section.section.is-title-bar ul li {
  display: inline-block;
  padding: 0 0 0 0.75rem;
  font-size: 1.5rem;
  color: #7a7a7a;
}

section.section.is-main-section {
  padding-top: 1.5rem;
}

</style>
