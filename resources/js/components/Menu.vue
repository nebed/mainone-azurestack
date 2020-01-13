<template>
  <div>
    <aside class="menu">
      <p class="menu-label">
        General
      </p>
      <ul class="menu-list">
        <li v-for="generalList in generalLists">
          <a v-bind:class="{'is-active': tabActive(generalList.title)}" v-bind:href="generalList.name">
            {{ generalList.title }}
          </a>
        </li>
      </ul>
      <p class="menu-label">
        AzureStack
      </p>
      <ul class="menu-list">
        <li v-for="networkList in networkLists">
          <a v-bind:class="{'is-active': tabActive(networkList.title)}" v-bind:href="networkList.name">
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
        generalLists: [{
          name: '/',
          title: 'Home'
        }, {
          name: 'tenants',
          title: 'Tenants'
        }],
        networkLists:[{
          name: 'alerts',
          title: 'Alerts'
        },{
          name: 'rates',
          title: 'Rates'
        },{
          name: 'invoices',
          title: 'Invoices'
        }],
        dummyLists: ['Payments', 'Transaction', 'Balance']
      }
    },
    methods: {
      tabActive: function(tab) {
        return this.menuActive === tab
      }
    }
  }

</script>

<style>

</style>
