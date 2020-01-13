<template>
  <div>

    <section class="hero is-hero-bar">
    <div class="hero-body">
      <div class="level">
        <div class="level-left">
          <div class="level-item">
            <h1 class="title">
                Alerts
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
      <div class="columns">
        <div class="column is-4">
          <div class="box has-background-danger has-text-white">
            <article class="media">
              <div class="media-left">
                <figure class="image is-64x64">
                  <i class="fas fa-exclamation-triangle fa-4x"></i>
                </figure>
              </div>
              <div class="media-content">
                <div class="content">
                  <article class="level">
                    <div class="level-left"></div>
                  <div class="level-right">
                    <div class="level-item ">
                      <div>
                        <p class="heading">Critical Alerts</p>
                        <p class="title is-3 salesnumbers">
                          {{ alerts.critical }}</p>
                      </div>
                    </div>
                    <div class="level-item ">
                      
                    </div>
                  </div>
                </article>
                </div>
              </div>
            </article>
          </div>
        </div>
        <div class="column is-4">
          <div class="box has-background-warning has-text-dark">
            <article class="media">
              <div class="media-left">
                <figure class="image is-64x64">
                  <i class="fas fa-exclamation-circle fa-4x"></i>
                </figure>
              </div>
              <div class="media-content">
                <div class="content">
                  <article class="level">
                    <div class="level-left"></div>
                  <div class="level-right">
                    <div class="level-item ">
                      <div>
                        <p class="heading">Warning Alerts</p>
                        <p class="title is-3 has-text-dark salesnumbers">
                          {{ alerts.warning }}</p>
                      </div>
                    </div>
                    <div class="level-item ">
                      
                    </div>
                  </div>
                </article>
                </div>
              </div>
            </article>
          </div>
        </div>
        <div class="column is-4">
          <div class="box has-background-success has-text-white">
            <article class="media">
              <div class="media-left">
                <figure class="image is-64x64">
                  <i class="fas fa-clipboard-check fa-4x"></i>
                </figure>
              </div>
              <div class="media-content">
                <div class="content">
                  <article class="level">
                    <div class="level-left"></div>
                  <div class="level-right">
                    <div class="level-item ">
                      <div>
                        <p class="heading">Closed Alerts</p>
                        <p class="title is-3 salesnumbers">
                          {{ alerts.closed }}</p>
                      </div>
                    </div>
                    <div class="level-item ">
                      
                    </div>
                  </div>
                </article>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
      <div class="columns">
        <div class="column is-full">
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
                        Severity
                      </option>
                      <option value="[object Object]">
                        State
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
                    <th class="is-current-sort is-sortable" @click="sort('severity')">
                      <div class="th-wrap">Severity <span class="icon is-small"><i class="fas fa-chevron-down"></i></span></div>
                    </th>
                    <th class="is-current-sort is-sortable">
                      <div class="th-wrap">Title</div>
                    </th>
                    <th class="">
                      <div class="th-wrap">Fault Type <span class="icon is-small"
                              style="display: none;"><i class="mdi mdi-arrow-up"></i></span></div>
                    </th>
                    <th class="">
                      <div class="th-wrap">Impacted Resource </div>
                    </th>
                    <th class="is-sortable" @click="sort('state')">
                      <div class="th-wrap">State <span class="icon is-small"><i class="fas fa-chevron-down"></i></span></div>
                    </th>
                    <th class="" @click="sort('updated_at')">
                      <div class="th-wrap">Last Updated <span class="icon is-small"><i class="fas fa-chevron-down"></i></span></div>
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
                  <tr  draggable="false"
                      class="" v-for="alert in sortedAlerts">
                    <!---->
                    <td class="">
                      {{alert.severity}}
                    </td>
                    <td data-label="Title"
                        class="">
                      {{alert.title}}
                    </td>
                    <td data-label="Fault Type"
                        class="">
                      {{alert.faulttype}}
                    </td>
                    <td data-label="Impacted Resource"
                        class="">
                      {{alert.impactedresource}}
                    </td>
                    <td data-label="State"
                        class="">
                      {{alert.state}}
                    </td>
                    <td data-label="Created"
                        class=""><small title=""
                             class="has-text-grey is-abbr-like">{{alert.created_at}}</small></td>
                    <td class="is-actions-cell">
                      <div class="buttons is-right"><button @click="showRemediation(alert)"
                           class="button is-small is-primary"><span class="icon is-small"><i class="fas fa-eye"></i></span></button>
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
      </div>    
  </section>

  <div v-if="remediationActive" class="modal is-active is-clipped">
    <div class="modal-background"></div>
    <div class="modal-content">
      <div class="box">
        <article class="media">
          <div class="media-content">
            <div class="content">
              <p><strong>Title:</strong> {{remediationAlert.title}}</p>
              <p><strong>Impacted Resource:</strong> {{remediationAlert.impactedresource}}</p>
              <p><strong>Severity:</strong> {{remediationAlert.severity}}</p>
              <p><strong>State:</strong> {{remediationAlert.state}}</p>
              <p>
                <strong>Description</strong>
                <br>
                {{remediationAlert.description}}
              </p>
              <p>
                <strong>Remediation</strong>
                <br>
                {{remediationAlert.remediation}}
              </p>
            </div>
            <nav class="level is-mobile">
              <div class="level-left">
                <a class="level-item" aria-label="reply">
                  
                </a>
                <a class="level-item" aria-label="retweet">
                  
                </a>
                <a class="level-item" aria-label="like">
                  
                </a>
              </div>
            </nav>
          </div>
        </article>
      </div>
    </div>
    <button @click="remediationActive = false" class="modal-close is-large" aria-label="close"></button>
  </div>


  </div>
</template>

<script>

  import randomMixins from '../mixins/random'
  export default {
    data: function(){
        return {
          alerts:{
            'alerts':[],
            'warning':0,
            'critical':0,
            'closed':0,
          },
          currentSort:'severity',
          currentSortDir:'asc',
          pageSize:10,
          currentPage:1,
          remediationAlert: null,
          remediationActive: false

        }
    },
    mixins: [
      randomMixins
    ],
    directives: {
      randomColor: {
        bind(el, binding, vnode) {
          var colorPicker = ['#353535', '#00d1b2', '#209cef', '#ff3860']
          el.style.backgroundColor = colorPicker[binding.value];
          el.style.color = "#fff";
        }
      }
    },
    created () {
      this.$http({
            method: 'get',
            url: 'alerts/',
          }).then((res) => {
            this.alerts = res.data;
            console.log(this.alerts);
          }).catch((error) => {
  
          });
    },

    computed: {
      sortedAlerts() {
      return this.alerts.alerts.sort((a,b) => {
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
        if((this.currentPage*this.pageSize) < this.alerts.alerts.length) this.currentPage++;
      },
      prevPage:function() 
      {
        if(this.currentPage > 1) this.currentPage--;
      },
      showRemediation(alert)
      {
        this.remediationAlert = alert;
        this.remediationActive = true;
      }
    }
  }

</script>

<style scoped>

  table {
    width: 100%
  }

  table > thead > tr, table > tbody > tr {
    font-size: 11px;
    letter-spacing: 1px;
    margin-bottom: 5px;
    text-transform: uppercase;
  }

  .tenantnumbers{
    float:right;
  }

  .salesnumbers {
    float: right;
    color: #fff;
  }


</style>
