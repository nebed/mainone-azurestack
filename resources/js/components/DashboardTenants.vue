<template>
<div>
  <section class="hero is-hero-bar">
    <div class="hero-body">
      <div class="level">
        <div class="level-left">
          <div class="level-item">
            <h1 class="title">
                Tenants
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
    <div class="card has-table has-mobile-sort-spaced">
      <header class="card-header">
        <p class="card-header-title">
          <!---->
          Tenants
        </p>
        <!---->
      </header>
      <div class="card-content">
        <div>
          <!---->
          <div class="b-table">
            <div class="field table-mobile-sort">
              <div class="field has-addons">
                <div class="control is-expanded">
                  <span class="select is-fullwidth">
                    <select><!----> <!----> <!---->
                      <option value="[object Object]">
                        Name
                      </option>
                      <option value="[object Object]">
                        Subscription Count
                      </option>
                    </select>
                  </span>
                  <!---->
                </div>
                <div class="control">
                  <button class="button is-primary">
                    <span class="icon is-small">
                      <i class="mdi mdi-arrow-up">

                      </i>
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <!---->
            <div class="table-wrapper">
              <table class="table is-striped has-mobile-cards is-fullwidth is-hoverable">
                <thead>
                  <tr>
                    <!---->
                    <!---->
                    <th class="is-current-sort">
                    </th>
                    <th class="is-current-sort is-sortable" @click="sort('name')">
                      <div class="th-wrap">Name <span class="icon is-small"><i class="fas fa-chevron-down"></i></span></div>
                    </th>
                    <th class="">
                      <div class="th-wrap">TenantID <span class="icon is-small"
                              style="display: none;"><i class="mdi mdi-arrow-up"></i></span></div>
                    </th>
                    <th class="">
                      <div class="th-wrap">Contact Email </div>
                    </th>
                    <th class="is-sortable">
                      <div class="th-wrap">Subscription Count </div>
                    </th>
                    <th class="">
                      <div class="th-wrap">Last Updated</div>
                    </th>
                    <th class="">
                      <div class="th-wrap"> <span class="icon is-small"
                              style="display: none;"><i class="mdi mdi-arrow-up"></i></span></div>
                    </th>
                    <!---->
                  </tr>
                  <!---->
                </thead>
                <tbody>
                  <tr v-for="tenant in sortedTenants" draggable="false"
                      class="" @click="redirectTo('/tenants/'+tenant.tenantid)">
                    <!---->
                    <td class="has-no-head-mobile is-image-cell">
                      <span class="image">
                          <i class="fas fa-user"></i>
                        </span>
                    </td>
                    <td data-label="Name"
                        class="">
                      {{tenant.name}}
                    </td>
                    <td data-label="TenantID"
                        class="">
                      {{tenant.tenantid}}
                    </td>
                    <td data-label="email"
                        class="">
                      {{tenant.contact_email}}
                    </td>
                    <td data-label="count"
                        class="">
                      {{tenant.subscriptions_count}}
                    </td>
                    <td data-label="Created"
                        class=""><small title=""
                             class="has-text-grey is-abbr-like">{{tenant.updated_at}}</small></td>
                    <td class="is-actions-cell">
                      <div class="buttons is-right"><a href="#/client/15"
                           class="button is-small is-primary"><span class="icon is-small"><i class="mdi mdi-account-edit"></i></span></a>
                        <button type="button"
                                class="button is-small is-danger"><span class="icon is-small"><i class="mdi mdi-trash-can"></i></span></button>
                      </div>
                    </td>
                    <!---->
                  </tr>
                </tbody>
                <!---->
              </table>
            </div>
            <div class="level">
              <div class="level-left"></div>
              <div class="level-right">
                <div class="level-item">
                  <nav class="pagination"><a role="button"
                       href="#"
                       class="pagination-link pagination-previous" @click="prevPage"><span class="icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span></a> <a role="button"
                       href="#"
                       class="pagination-link pagination-next" @click="nextPage"><span class="icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span></a>
                  </nav>
                </div>
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
import randomMixins from '../mixins/random';
export default
{
  data: function()
  {
    return {
      tenants: [],
      currentSort:'name',
      currentSortDir:'asc',
      pageSize:5,
      currentPage:1

    }
  },
  mixins: [
    randomMixins
  ],
  directives:
  {
    randomColor:
    {
      bind(el, binding, vnode)
      {
        var colorPicker = [
          '#353535',
          '#00d1b2',
          '#209cef',
          '#ff3860'
        ]
        el.style.backgroundColor = colorPicker[binding.value]
        el.style.color = '#fff'
      }
    }
  },
  created()
  {
    this.$http({
            method: 'get',
            url: 'tenants/',
          }).then((res) => {
            this.tenants = res.data;
          }).catch((error) => {
  
          });
  },

  computed:
  {
    sortedTenants() {
      return this.tenants.sort((a,b) => {
        let modifier = 1;
        if(this.currentSortDir === 'desc') modifier = -1;
        if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
        if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
        return 0;
      }).filter((row, index) => {
        let start = (this.currentPage-1)*this.pageSize;
        let end = this.currentPage*this.pageSize;
        if(index >= start && index < end) return true;
      });
    }
  },

  methods: {
    redirectTo(path) {
      return this.$router.push(path);
    },
    sort:function(s) 
    {
      //if s == current sort, reverse
      if(s === this.currentSort) {
        this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
      }
      this.currentSort = s;
    },
    nextPage:function() 
    {
      if((this.currentPage*this.pageSize) < this.tenants.length) this.currentPage++;
    },
    prevPage:function() 
    {
      if(this.currentPage > 1) this.currentPage--;
    }
  }
}

</script>

/* beautify ignore:start */
<style scoped>
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

section > .hero-body {
  padding:1rem;
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

section.section.is-main-section {
  padding-top: 1.5rem;
}

</style>
/* beautify ignore:end */
