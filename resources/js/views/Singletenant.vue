<template>

<section class="main-content columns is-fullheight">
  
  <aside class="menu">
    <p class="menu-label">
      General
    </p>
    <ul class="menu-list">
      <li><a>Dashboard</a></li>
    </ul>
    <p class="menu-label">
      Tenant Environment
    </p>
    <ul class="menu-list">
      <li @click="resourceActive=true; reportActive=false">
        <a :class="{'is-active':resourceActive}">Resources</a>
      </li>
    </ul>
    <p class="menu-label">
      Resource Usage
    </p>
    <ul class="menu-list">
      <li @click="resourceActive=false; reportActive=true;"><a :class="{'is-active':reportActive}">Usage Report</a></li>
    </ul>
</aside>

  <div class="container column is-10">
    <div class="section">

      <div class="card" v-if="resourceActive">
        <div class="card-header"><p class="card-header-title">Resources</p></div>
        <div class="card-content">
          <VirtualMachines :resources="resources.virtualmachines"></VirtualMachines>
          <!--<div class="table-container">
            <table class="table table-striped is-narrow table-responsive">
              <thead>
                <th>Resource Name</th>
                <th>Type</th>
                <th>Compliant</th>
                <th>Last Updated</th>
                <th></th>
              </thead>

              <tbody>
                <template v-for="resource in resources">
                  <resource @changed="reloadData" :resource="resource" @clicked="showDetail(resource.details)"></resource>
                </template>
              </tbody>

            </table>
          </div>-->
        </div>
      </div>
      <br />

      <div class="card" v-if="reportActive">
        <div class="card-header"><p class="card-header-title">Usage Report</p></div>
        <div class="card-content">
          <Report></Report>
        </div>
      </div>
      <br />
      
    </div>
  </div>

  <div class="modal" :class="{'is-active':detailActive}">
  <div class="modal-background"></div>
  <div class="modal-content">
    <div class="box">
      <article>
          <div class="content">
            <p>
              {{detailContent}}
            </p>
          </div>
      </article>
    </div>
  </div>
  <button @click="detailActive=false; detailContent=null;" class="modal-close is-large" aria-label="close"></button>
</div>
  
</section>

</template>

<script>

  //import Resource from '../components/Resource.vue';
  import Report from '../components/Report.vue';
  import VirtualMachines from '../components/VirtualMachines.vue';

export default {
  components : {VirtualMachines,Report},
  name: 'Singletenant',
  props: [],
  data () {
    return {
      resources: {},
      resourceActive: false,
      detailActive: false,
      detailContent: null,
      reportActive: false,
      subscriptions: {},
      errors : {
        'resources' : null,
        'subscriptions' : null,
      }  
    }
  },

  methods: {
    redirectTo(path) {
      return this.$router.push(path)
    },
    showDetail(detail) {
      this.detailContent = detail;
      this.detailActive=true;
    },
    reloadData(){
      this.$http({
            method: 'get',
            url: 'resources/get/'+this.$route.params.tenantid,
          }).then((res) => {
            this.resources = res.data.data;
          }).catch((error) => {
            this.errors.resources = "an error has occured";
          });
    },
    groupBy(array, key){
      // Return the end result
      return array.reduce((result, currentValue) => {
        // If an array already present for key, push it to the array. Else create an array and push the object
        (result[currentValue[key]] = result[currentValue[key]] || []).push(
          currentValue
        );
        // Return the current iteration `result` value, this will be taken as next iteration `result` value and accumulate
        return result;
      }, {}); // empty object is the initial value for result object
    },
  },

  created () {
      this.$http({
            method: 'get',
            url: 'resources/get/'+this.$route.params.tenantid,
          }).then((res) => {
            this.resources = res.data.data;
          }).catch((error) => {
            this.errors.resources = "an error has occured";
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