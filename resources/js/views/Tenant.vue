<template>
<div>
  <section class="section">
    <div class="columns">
      <div class="column is-2 is-hidden-mobile">
        <app-menu v-bind:menuActive="menuItem"> </app-menu>
      </div>
      <div class="container">
        <!--Tenant Profile Name -->
        <section class="hero is-hero-bar is-main-hero">
          <div class="hero-body">
            <div class="level">
              <div class="level-left">
                <div class="level-item is-hero-avatar-item">
                  <div class="image is-user-avatar"><i class="fas fa-user fa-4x"></i></div>
                </div>
                <div class="level-item is-hero-content-item">
                  <div>
                    <h1 class="title is-4 is-spaced"><b>{{tenant.name}}</b></h1>
                    <h3 class="subtitle"><b>Subscriptions:</b> {{tenant.subscriptions_count}}</h3>
                    <h3 class="subtitle"><b>Contact Email:</b> {{tenant.contact_email}}</h3>
                  </div>
                </div>
              </div>
              <div class="level-right">
              </div>
            </div>
          </div>
        </section>
        <!--Tenant Profile End-->
        <!--Page title-->
        <section class="hero is-hero-bar">
          <div class="hero-body">
            <div class="level">
              <div class="level-left">
                <div class="level-item">
                  <h1 class="title is-4">
                      Subscriptions
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
        <!--Page title end -->
        <section class="section is-main-section">
          <!--subscriptions list-->
          <div class="tabs is-medium">
            <ul>
              <li v-for="subscription,key in subscriptions" @click="selectSub(key)" :class="{ 'is-active': selectedSubscription.name == subscription.name }"><a>{{subscription.name}}</a></li>
            </ul>
          </div>
          <subscription v-if="tabSelected" :subscription="selectedSubscription" :rates="rates" :tenant="tenant.name"></subscription>
          <!--subscriptions list end-->
        </section>
      </div>
    </div>
  </section>
</div>
</template>

<script>
import menu from '../components/TenantMenu';
import subscription from '../components/Subscription';

export default {
  components: {
    'app-menu': menu,
    'subscription':subscription,
  },
  data: function() {
    return {
      tenant: {
        name: '',
        subscriptions_count: '',
        contact_email: ''
      },
      tabSelected:false,
      subscriptions: [],
      selectedSubscription: [],
      rates:[],
      menuItem: this.$route.params.path,
      routename: this.$route.name,
      metricHeading: [
        {
          title: 'Action on Page',
          icon: 'fas fa-fighter-jet fa-4x'
        },
        {
          title: 'Page Views',
          icon: 'fas fa-eye fa-4x'
        },
        {
          title: 'Post Engagement',
          icon: 'fas fa-pencil-alt fa-4x'
        },
        {
          title: 'Reach',
          icon: 'fas fa-shopping-cart fa-4x'
        }
      ]
    }
  },
  computed: {

  },
  methods: {
    selectSub(key){
      this.selectedSubscription = this.subscriptions[key];
      this.tabSelected = true;
    },
  },
  created() {
    this.$http(
      {
        method: 'get',
        url: 'tenants/' + this.$route.params.tenantid
      }).then((res) => {
      this.tenant = res.data[0]
      this.subscriptions = res.data[1]
      this.rates = res.data[2]
      this.selectedSubscription = this.subscriptions[0];
      this.tabSelected = true;
    }).catch((error) => {

    });
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
