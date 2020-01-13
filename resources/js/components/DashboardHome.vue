<template>
  <div>

  <section class="hero is-hero-bar">
    <div class="hero-body">
      <div class="level">
        <div class="level-left">
          <div class="level-item">
            <h1 class="title">
                Dashboard
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

    <div class="columns is-multiline">
      <div v-for="(info, index) in stackData" class="column is-6">
        <div v-randomColor="index" class="box is-primary">
          <div class="media">
            <div class="media-left">
              <figure class="image is-64x64">
                <i v-bind:class="info.icon"></i>
              </figure>
            </div>
            <div class="media-content">
              <div class="content">
                <article class="level">
                  <div class="level-left">
                  </div>
                  <div class="level-right">
                    <div class="level-item ">
                      <div>
                        <p class="heading">{{ info.title1 }}</p>
                        <p class="title is-3 salesnumbers">
                          {{ info.data1}}</p>
                      </div>
                    </div>
                    <div class="level-item ">
                      <div>
                        <p class="heading">{{ info.title2 }}</p>
                        <p class="title is-3 salesnumbers">
                          {{ info.data2 }}</p>
                      </div>
                    </div>
                  </div>
                </article>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="columns">
      <div v-for="data in tenantdata" class="column is-6">
        <div class="box">
          <div class="media">
            <div class="media-left">
              <figure class="image is-64x64">
                <i v-bind:class="data.icon"></i>
              </figure>
            </div>
            <div class="media-content">
              <div class="content">
                <article class="level">
                  <div class="level-left">
                  </div>
                  <div class="level-right">
                    <div class="level-item ">
                      <div>
                        <p class="heading is-2">{{ data.name }}</p>
                        <p class="title is-2 tenantnumbers">
                          {{ data.value }}</p>
                      </div>
                    </div>
                  </div>
                </article>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

  </div>
</template>

<script>

  import randomMixins from '../mixins/random'
  export default {
    data: function(){
        return {
          stackData: null,
          tenantdata: null

        }
    },
    mixins: [
      randomMixins
    ],
    directives: {
      randomColor: {
        bind(el, binding, vnode) {
          var colorPicker = ['#353535', '#00d1b2', '#209cef', '#ff3860']
          el.style.backgroundColor = colorPicker[binding.value];
          el.style.color = "#fff";
        }
      }
    },
    created () {
      this.$http({
            method: 'get',
            url: 'stack/summary',
          }).then((res) => {
            this.stackData = res.data[0];
            this.tenantdata = res.data[1];
          }).catch((error) => {
  
          });
    }
  }

</script>

<style scoped>

  table {
    width: 100%
  }

  table > thead > tr, table > tbody > tr {
    font-size: 11px;
    letter-spacing: 1px;
    margin-bottom: 5px;
    text-transform: uppercase;
  }

  section.hero.is-hero-bar {
  background-color: white;
  border-bottom: 1px solid rgba(24, 28, 33, 0.06);
}

section > .hero-body {
  padding:1rem;
}


  .tenantnumbers{
    float:right;
  }

  .salesnumbers {
    float: right;
    color: #fff;
  }


</style>
