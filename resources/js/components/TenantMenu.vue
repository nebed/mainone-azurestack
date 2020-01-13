<template>
  <div>
    <aside class="menu">
      <p class="menu-label">
        Tenant
      </p>
      <ul class="menu-list">
        <li v-for="generalList in generalLists">
          <a v-bind:class="{'is-active': tabActive(generalList.name)}" v-bind:href="path+'/'+generalList.name">
            {{ generalList.title }}
          </a>
        </li>
      </ul>
      <p class="menu-label">
        AzureStack
      </p>
      <ul class="menu-list">
        <li v-for="networkList in networkLists">
          <a v-bind:class="{'is-active': tabActive(networkList.name)}" v-bind:href="networkList.name">
            {{ networkList.title }}
          </a>
        </li>
      </ul>
      <!--<p class="menu-label">
        Dummy Links
      </p>
      <ul class="menu-list">
        <li v-for="dummyList in dummyLists"><a>{{ dummyList }}</a></li>
      </ul>-->
    </aside>
  </div>
</template>

<script>
  export default {
    props: [
      'menuActive'
    ],
    data: function() {
      return {
        path: null,
        generalLists: [{
          name: '',
          title: 'Dashboard'
        },{
          name: 'invoices',
          title: 'Invoices'
        },
        {
          name: 'usage',
          title: 'Usage Summary'
        }
        ],
        networkLists:[{
          name: '/tenants',
          title: 'Tenants'
        },{
          name: '/',
          title: 'Home'
        }],
        dummyLists: ['Payments', 'Transaction', 'Balance']
      }
    },
    methods: {
      tabActive: function(tab) {
        return this.menuActive === tab
      }
    },

    mounted()
    {
      this.path = this.$router.currentRoute.path;
    }
  }

</script>

<style>

</style>
