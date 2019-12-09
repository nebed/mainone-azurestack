<template>
	
  <div class="panel is-link">
    <p class="panel-heading">
      Usage Data
    </p>
    <div class="container is-fluid">

        <div class="columns is-mobile">
          <div class="column is-half">
            <!---Start Date -->
            <div class="field is-fullwidth">
              <label class="label">Start Date</label>
              <div class="control is-fullwidth">
                <datetime v-model="start_date" input-class="control input" auto></datetime>
              </div>
            </div>
          </div>

          <div class="column is-half">
            <!--End Date -->
              <div class="field is-fullwidth">
                <label class="label">End Date</label>
                <div class="control is-fullwidth">
                  <datetime v-model="end_date" input-class="control input" auto></datetime>
                </div>
              </div>
          </div>
        </div>

          <div class="columns">
            <div class="column is-full">
              <button @click="fetchUsage" class="button is-fullwidth is-success" :class="{'is-loading':loading}" v-if="start_date && end_date">Fetch Data</button>
              
              <!--VM Size-->
              <br>

              <div v-if="usage_data" class="card">
                <header class="card-header has-background-link has-text-white">
                  <p class="card-header-title has-text-white">
                    VM Size Hours
                  </p>
                </header>
                <div class="card-content">
                  <table class="table is-fullwidth">
                      <thead>
                      <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>VM Size</th>
                        <th>Usage (VM hours)</th>
                        <th>Rate</th>
                        <th>Cost</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(usage, location) in usage_data[meterid.vmsize.toLowerCase()]">
                          <th>{{location+1}}</th>
                          <td>{{usage.name}}</td>
                          <td>{{JSON.parse(usage.info).ServiceType}}</td>
                          <td>{{usage.usage}}</td>
                          <td><input class="input" v-model="rate.vmsize[location]" type="number" placeholder="Enter Cost"></td>
                          <td>{{(rate.vmsize[location]*usage.usage).toFixed(2)}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <footer class="card-footer">
                  <a href="#" class="card-footer-item">Export</a>
                </footer>
              </div>

              <br>
              <!--Base VM Size Hours -->

              <div v-if="usage_data" class="card">
                <header class="card-header has-background-link has-text-white">
                  <p class="card-header-title has-text-white">
                    Base VM Size Hours
                  </p>
                </header>
                <div class="card-content">
                  <table class="table is-fullwidth">
                      <thead>
                      <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>VM Size</th>
                        <th>Usage (Virtual core hours)</th>
                        <th>Rate</th>
                        <th>Cost</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(usage, location) in usage_data[meterid.basevm.toLowerCase()]">
                          <th>{{location+1}}</th>
                          <td>{{usage.name}}</td>
                          <td>{{JSON.parse(usage.info).ServiceType}}</td>
                          <td>{{usage.usage}}</td>
                          <td><input class="input" v-model="rate.basevm[location]" type="number" placeholder="Enter Cost"></td>
                          <td>{{(rate.basevm[location]*usage.usage).toFixed(2)}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <footer class="card-footer">
                  <a href="#" class="card-footer-item">Export</a>
                </footer>
              </div>

              <br>

              <!--Windows VM Size Hours -->

              <div v-if="usage_data" class="card">
                <header class="card-header has-background-link has-text-white">
                  <p class="card-header-title has-text-white">
                    Windows VM Size Hours
                  </p>
                </header>
                <div class="card-content">
                  <table class="table is-fullwidth">
                      <thead>
                      <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>VM Size</th>
                        <th>Usage (Virtual core hours)</th>
                        <th>Rate</th>
                        <th>Cost</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(usage, location) in usage_data[meterid.windowsvm.toLowerCase()]">
                          <th>{{location+1}}</th>
                          <td>{{usage.name}}</td>
                          <td>{{JSON.parse(usage.info).ServiceType}}</td>
                          <td>{{usage.usage}}</td>
                          <td><input class="input" v-model="rate.windowsvm[location]" type="number" placeholder="Enter Cost"></td>
                          <td>{{(rate.windowsvm[location]*usage.usage).toFixed(2)}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <footer class="card-footer">
                  <a href="#" class="card-footer-item">Export</a>
                </footer>
              </div>

              <br>

              <!-- Static IP Address Usage -->
              <div v-if="usage_data" class="card">
                <header class="card-header has-background-link">
                  <p class="card-header-title has-text-white">
                    Static IP Address Usage
                  </p>
                </header>
                <div class="card-content">
                  <table class="table is-fullwidth">
                      <thead>
                      <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Current State</th>
                        <th>Usage (IP hours)</th>
                        <th>Rate</th>
                        <th>Cost</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(usage, location) in usage_data[meterid.staticip]">
                          <th>{{location+1}}</th>
                          <td>{{usage.name}}</td>
                          <td>{{usage.info}}</td>
                          <td>{{usage.usage}}</td>
                          <td><input class="input" v-model="rate.staticip[location]" type="number" placeholder="Enter Cost"></td>
                          <td>{{(rate.staticip[location]*usage.usage).toFixed(2)}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <footer class="card-footer">
                  <a href="#" class="card-footer-item">Export</a>
                </footer>
              </div>

              <br>

              <!-- Dynamic IP Address Usage -->
              <div v-if="usage_data" class="card">
                <header class="card-header has-background-link">
                  <p class="card-header-title has-text-white">
                    Dynamic IP Address Usage
                  </p>
                </header>
                <div class="card-content">
                  <table class="table is-fullwidth">
                      <thead>
                      <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Current State</th>
                        <th>Usage (IP hours)</th>
                        <th>Rate</th>
                        <th>Cost</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(usage, location) in usage_data[meterid.dynamicip]">
                          <th>{{location+1}}</th>
                          <td>{{usage.name}}</td>
                          <td>{{usage.info}}</td>
                          <td>{{usage.usage}}</td>
                          <td><input class="input" v-model="rate.dynamicip[location]" type="number" placeholder="Enter Cost"></td>
                          <td>{{(rate.dynamicip[location]*usage.usage).toFixed(2)}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <footer class="card-footer">
                  <a href="#" class="card-footer-item">Export</a>
                </footer>
              </div>



            </div>
          </div>
        
      </div>
    </div>



</template>

<script>
  import Vue from 'vue'
  import { Datetime } from 'vue-datetime'
  // You need a specific loader for CSS files
  import 'vue-datetime/dist/vue-datetime.css'
  Vue.use(Datetime);
  Vue.component('datetime', Datetime);

export default {
  name: 'Report',
  props: ['report'],
  data () {
    return {
      start_date: null,
      end_date: null,
      usage_data: null,
      loading: false,
      meterid: {
        'vmsize': '6DAB500F-A4FD-49C4-956D-229BB9C8C793',
        'basevm': 'FAB6EB84-500B-4A09-A8CA-7358F8BBAEA5',
        'windowsvm': '9CD92D4C-BAFD-4492-B278-BEDC2DE8232A',
        'staticip': 'F271A8A388C44D93956A063E1D2FA80B',
        'dynamicip': '9E2739BA86744796B465F64674B822BA'
      },
      rate: {
        'vmsize': [],
        'basevm': [],
        'windowsvm': [],
        'staticip': [],
        'dynamicip': []
      },
      errors : {
        
      }  
    }
  },

  methods: {
    redirectTo(path) {
      return this.$router.push(path)
    },

    fetchUsage(){
      this.loading = true;
      this.$http({
            method: 'get',
            url: 'usage/get/'+this.$route.params.tenantid,
            params: {
              'start_date' : this.start_date,
              'end_date' : this.end_date
            }
          }).then((res) => {
            this.usage_data = res.data.data;
            this.loading = false;
            console.log(this.usage_data);
          }).catch((error) => {
            
          });
    }
  },

  created () {

  }
}
</script>

<style scoped>
  .display-block {
    display: block !important
  }
</style>