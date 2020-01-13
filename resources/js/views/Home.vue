<template>
  <div>
    <section class="section">
      <div class="columns">
        <div class="column is-2 is-hidden-mobile">
          <app-menu v-bind:menuActive="menuItem"> </app-menu>
        </div>
        <div class="container">
          <app-dashboard v-if="routename === 'Home'"> </app-dashboard>
          <app-rates v-if="routename === 'Rates'"> </app-rates>
          <app-alerts v-if="routename === 'Alerts'"> </app-alerts>
          <app-tenants v-if="routename === 'Tenants'"> </app-tenants>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
  import menu from '../components/Menu';
  import dashboardHome from '../components/DashboardHome';
  import dashboardRates from '../components/DashboardRates';
  import dashboardAlerts from '../components/DashboardAlerts';
  import dashboardTenants from '../components/DashboardTenants';


  export default {
    components: {
      'app-menu': menu,
      'app-dashboard': dashboardHome,
      'app-rates': dashboardRates,
      'app-alerts': dashboardAlerts,
      'app-tenants': dashboardTenants,
    },
    data: function() {
      return {
        menuItem: this.$route.name,
        routename: this.$route.name,
        metricHeading: [{
          title: 'Action on Page',
          icon: 'fas fa-fighter-jet fa-4x'
        },{
          title: 'Page Views',
          icon: 'fas fa-eye fa-4x'
        },{
          title: 'Post Engagement',
          icon: 'fas fa-pencil-alt fa-4x'
        },{
          title: 'Reach',
          icon: 'fas fa-shopping-cart fa-4x'
        }]
      }
    },

    mounted()
    {
    }
  }

</script>

<style>

</style>
