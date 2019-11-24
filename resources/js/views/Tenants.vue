<template>

<section class="section">
  <div class="tile is-ancestor">
    <div class="tile is-parent is-8">
      <article class="tile is-child panel is-link">
        <p class="panel-heading">
          Customers
        </p>
        <div class="panel-block">
          <p class="control has-icons-left">
            <input class="input is-link" type="text" placeholder="Search">
            <span class="icon is-left">
              <i class="fas fa-search" aria-hidden="true"></i>
            </span>
          </p>
        </div>
        <div class="table-container">
        <table class="table is-hoverable is-fullwidth">
          <thead>
            <tr>
              <th width="40%">Name</th>
              <th width="30%">Tenant ID</th>
              <th>Non-Compliant</th>
              <th><abbr title="Won">W</abbr></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="tenant in tenants" class="" :class="{'has-background-danger': tenant.resources_count != 0, 'has-background-primary' : tenant.resources_count == 0 }" @click="redirectTo('tenants/'+tenant.tenantid)">
              <td>{{tenant.name}}</td>
              <td>{{tenant.tenantid}}</td>
              <td>{{tenant.resources_count}}</td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      </article>
    </div>
    <div class="tile is-parent">
      <article class="tile is-child notification is-primary">
        <div class="content">
          <p class="title">Tall tile</p>
          <p class="subtitle">With even more content</p>
          <div class="content">
            <!-- Content -->
          </div>
        </div>
      </article>
    </div>
  </div>
</section>

</template>

<script>

export default {
  name: 'Tenants',
  props: [],
  data () {
    return {
      tenants: {},
      errors : {
        'tenants' : null
      }  
    }
  },

  methods: {

    redirectTo(path) {
      return this.$router.push(path)
    }

  },

  created () {
      this.$http({
            method: 'get',
            url: 'tenants',
          }).then((res) => {
            this.tenants = res.data.data;
          }).catch((error) => {
            this.errors.tenants = "an error has occured, check your input";
          });
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>