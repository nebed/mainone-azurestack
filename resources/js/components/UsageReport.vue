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
	  name: 'UsageReport',
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
	        'dynamicip': '9E2739BA86744796B465F64674B822BA',
	        'pageblobcap': 'B5C15376-6C94-4FDD-B655-1A69D138ACA3'
	      },
	      rate: {
	        'vmsize': [],
	        'basevm': [],
	        'windowsvm': [],
	        'staticip': [],
	        'dynamicip': [],
	        'pageblobcap': []
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

<style>
	
</style>