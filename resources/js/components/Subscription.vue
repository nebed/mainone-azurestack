<template>

			<div class="tile is-ancestor">
                <div class="columns is-multiline">
                  <div class="column is-marginless">
                    <div class="buttons">
                  <button class="button column is-warning title is-5">current Cost: <b> USD {{ totalcost.toLocaleString() }}</b></button><button class="button column is-primary title is-5">current Bill: <b> USD {{ totalusage.toLocaleString() }}</b></button>
                </div>
                  </div>
                  <div class="column is-full is-marginless">
                    <div class="card is-shadowless">
                      <div class="">
                        <div class="content">
                          <table class="table-profile">
                            <tbody>
                              <tr>
                                <td>Name:</td>
                                <td>{{subscription.name}}</td>
                              </tr>
                              <tr>
                                <td>Subscription ID:</td>
                                <td>{{subscription.subscriptionid}}</td>
                              </tr>
                              <tr>
                                <td>Owner:</td>
                                <td>{{subscription.owner}}</td>
                              </tr>
                              <tr>
                                <td>State:</td>
                                <td>{{subscription.state}}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="column is-full">
                    <div class="panel">
                      <p class="panel-heading">
                        Quotas
                      </p>
                      <div class="panel-block is-active">
                          <div class="column is-one-quarter">
                            Compute
                          </div>
                          <div class="column is-three-quarters">
                            <table class="table-profile table is-narrow is-bordered is-fullwidth">
                              <thead class="has-background-link has-text-white">
                                <tr>
                                  <th class="has-text-white">VM Count</th>
                                  <th class="has-text-white">Core Limit</th>
                                  <th class="has-text-white">Avaialabilty Set</th>
                                  <th class="has-text-white">VM ScaleSet</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><b>{{subscription.computequotas[0].vmcount}}</b></td>
                                  <td><b>{{subscription.computequotas[0].corelimit}}</b></td>
                                  <td><b>{{subscription.computequotas[0].availabilityset}}</b></td>
                                  <td><b>{{subscription.computequotas[0].vmscaleset}}</b></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        
                      </div>
                      <div class="panel-block">
                        <div class="column is-one-quarter">Network</div>
                          <div class="column is-three-quarters"><table class="table-profile is-fullwidth table is-narrow is-bordered">
                            <thead class="has-background-link has-text-white">
                              <tr class="has-text-white">
                                <th class="has-text-white">Public IPs</th>
                                <th class="has-text-white">V.Networks</th>
                                <th class="has-text-white">V.Gateways</th>
                                <th class="has-text-white">Tunnels</th>
                                <th class="has-text-white">L.Balancer</th>
                                <th class="has-text-white">NICs</th>
                                <th class="has-text-white">NSGs</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><b>{{subscription.networkquotas[0].publicip}}</b></td>
                                <td><b>{{subscription.networkquotas[0].vnets}}</b></td>
                                <td><b>{{subscription.networkquotas[0].virtual_gateway}}</b></td>
                                <td><b>{{subscription.networkquotas[0].tunnels}}</b></td>
                                <td><b>{{subscription.networkquotas[0].loadbalancers}}</b></td>
                                <td><b>{{subscription.networkquotas[0].nics}}</b></td>
                                <td><b>{{subscription.networkquotas[0].nsgs}}</b></td>
                              </tr>
                            </tbody>
                          </table></div>
                      </div>
                      <div class="panel-block">
                          <div class="column is-one-quarter">
                            Storage
                          </div>
                          <div class="column is-three-quarters">
                            <table class="table-profile table is-fullwidth is-narrow is-bordered">
                            <thead class="has-background-link has-text-white">
                              <tr class="has-text-white">
                                <th class="has-text-white">StorageAccounts</th>
                                <th class="has-text-white">Capacity (GB)</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><b>{{subscription.storagequotas[0].storageaccounts}}</b></td>
                                <td><b>{{subscription.storagequotas[0].capacity.toLocaleString()}} GB</b></td>
                              </tr>
                            </tbody>
                          </table>
                          </div>
                      </div>
                      <div class="panel-block">
                          <div class="column is-one-quarter">
                            Custom
                          </div>
                          <div class="column is-three-quarters">
                            <table class="table-profile table is-fullwidth is-narrow is-bordered">
                            <thead class="has-background-link has-text-white">
                              <tr class="has-text-white">
                                <th class="has-text-white">VM Type</th>
                                <th class="has-text-white">Daily Baseline</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <input class="control"
                                         type="text">
                                </td>
                                <td>
                                  <input class="control"
                                         type="text">
                                </td>
                                <td>
                                  <button class="button is-small is-link">Add</button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="column">
                    <div class="card is-shadowless">
                      <div class="card-content">
                        <h3 class="title is-4">Resource Usage Summary</h3>
                        <div class="content">
                            <table class="table is-striped is-fullwidth has-mobile-cards is-hoverable">
                              <thead>
                                <tr>
                                  <!---->
                                  <th class="">
                                    <div class="th-wrap"></div>
                                  </th>
                                  <th class="is-current-sort is-sortable">
                                    <div class="th-wrap">Meter ID </div>
                                  </th>
                                  <th class="is-sortable">
                                    <div class="th-wrap">Meter Name </div>
                                  </th>
                                  <th class="is-sortable">
                                    <div class="th-wrap">Usage </div>
                                  </th>
                                  <th class="is-sortable">
                                    <div class="th-wrap">MSFT Cost (USD)</div>
                                  </th>
                                  <th class="">
                                    <div class="th-wrap">MDXi Charge (USD)</div>
                                  </th>
                                   <th class="">
                                    <div class="th-wrap">Billing Period </div>
                                  </th>
                                  <!---->
                                </tr>
                                <!---->
                              </thead>
                              <tbody>
                                <tr v-for="usagedata in subscription.usage"
                                    class="">
                                  <!---->
                                  <td class="has-no-head-mobile is-image-cell">
                                    
                                  </td>
                                  <td data-label="Meter ID"
                                      class="">
                                    {{usagedata.meterid}}
                                  </td>
                                  <td data-label="Meter Name"
                                      class="">
                                    {{usagedata.metername}}
                                  </td>
                                  <td data-label="Quantity Used"
                                      class="">
                                    {{usagedata.usage}}
                                  </td>
                                  <td data-label="Cost"
                                      class="is-progress-col">
                                    {{ (usagedata.usage*rates[usagedata.metername].cost).toFixed(4)}}
                                  </td>
                                  <td data-label="Charge"
                                      class="">{{ (usagedata.usage*rates[usagedata.metername].rate).toFixed(2)}}</td>
                                  <td data-label="Billing Period"
                                      class="">{{usagedata.billing_period}}</td>
                                  <!---->
                                </tr>
                                <!---->
                              </tbody>
                              <!---->
                            </table>
                        </div>
                        <div class="buttons has-addons is-centered">
                          <a @click="getBreakdown(subscription.subscriptionid)" :class="{'is-loading':breakdownLoading}" class="button is-primary is-fullwidth">Download Breakdown</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
          </div>

</template>

<script>

export default {

props : ['subscription','rates','tenant'],

name: "Subscription",

data: function() {
	return {
		csvarray: [],
		csvcontent: "data:text/csv;charset=utf-8,",
		addarray:[],
    breakdownLoading: false,
	}
},

computed: {

	totalusage () {
      return this.subscription.usage.reduce((usagesum,meter)=> usagesum + (meter.usage*this.rates[meter.metername].rate),0);
    },
  totalcost () {
      return this.subscription.usage.reduce((usagesum,meter)=> usagesum + (meter.usage*this.rates[meter.metername].cost),0);
    },

},

methods: {

	getBreakdown(subscriberID){
    this.breakdownLoading = true;
      this.$http(
      {
        method: 'get',
        url: 'subscriptions/' + subscriberID +'/currentbill'
      }).then((res) => {
        this.csvarray = res.data;
        var parent = this;
        this.csvarray.forEach(function (element) {
          element.unit = parent.$props.rates[element.name].unit;
        	element.msft_rate = parent.$props.rates[element.name].cost;
          element.mdxi_rate = parent.$props.rates[element.name].rate;
          element.msft_cost = (element.usage*parent.$props.rates[element.name].cost).toFixed(3);
          element.mdxi_charge = (element.usage*element.mdxi_rate).toFixed(2);
        });
        this.csvExport(this.csvarray);
        this.breakdownLoading = false;
        this.$notify({
          group: 'foo',
          type: 'success',
          title: 'Success',
          text: 'Usage Breakdown generated successfully'
        });
      }).catch((error) => {

      });

      },
    csvExport(arrData) {
      let csvContent = "data:text/csv;charset=utf-8,";
      csvContent += [
        Object.keys(arrData[0]).join(","),
        ...arrData.map(item => Object.values(item).join(","))
      ]
        .join("\n")
        .replace(/(^\[)|(\]$)/gm, "");

      const data = encodeURI(csvContent);
      const link = document.createElement("a");
      link.setAttribute("href", data);
      link.setAttribute("download", this.$props.tenant+"_"+this.$props.subscription.name+"_"+this.$props.subscription.usage[0].billing_period+".csv");
      link.click();
    }

},

created()
{
	
}

}
	
</script>

<style scoped="">
table {
  width: 100%
}

table>thead>tr,
table>tbody>tr {
  font-size: 11px;
  letter-spacing: 1px;
  margin-bottom: 5px;
  text-transform: uppercase;
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

section>.hero-body {
  padding: 1rem;
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

.tile.is-ancestor {
  border-bottom: 1px solid rgba(24, 28, 33, 0.06);
}

section.section.is-main-section {
  padding-top: 1.5rem;
}
</style>
