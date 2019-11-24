<template>

<section class="section">
  <div class="tile is-ancestor">
    <div class="tile is-vertical is-8">
      <div class="tile">
        <div class="tile is-parent is-vertical">
          <article class="tile is-child notification is-link">
            <p class="title">Azure Stack Bill</p>
            <p class="subtitle">Top tile</p>
          </article>
          <article class="tile is-child notification is-link">
            <p class="title">...tiles</p>
            <p class="subtitle">Bottom tile</p>
          </article>
        </div>
        <div class="tile is-parent" @click="redirectTo('tenants')">
          <article class="tile is-child notification is-link">
            <p class="title">Customer Summary</p>
            <p class="subtitle">With an image</p>
            <figure class="image is-4by3">
              <img src="https://bulma.io/images/placeholders/640x480.png">
            </figure>
          </article>
        </div>
      </div>
      <div class="tile is-parent">
        <article class="tile is-child notification">
            <p class="control">
              <a class="button is-link" @click="newCustomerModal=true;">
                New Customer
              </a>
            </p>
        </article>
      </div>
    </div>
    <div class="tile is-parent">
      <article class="tile is-child notification is-primary">
        <div class="content">
          <p class="title">Tall tile</p>
          <p class="subtitle">With even more content</p>
          <div class="content">
            <!-- Content -->
          </div>
        </div>
      </article>
    </div>
    <div class="modal" :class="{ 'is-active' : newCustomerModal }">
  <div class="modal-background"></div>
  <div class="modal-content">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          Create New Customer
        </p>
      </header>
      <div class="card-content vld-parent">

      <article v-if="has_error" class="message is-danger">
          <div class="message-body">
            {{errors.tenant}}
          </div>
        </article>

      <loading :active.sync="isLoading"
        :is-full-page="formloader"></loading>
        
        <form @submit.prevent="submitCustomerForm">
          
          <div class="field">
            <label class="label">Tenant ID</label>
            <div class="control">
              <input class="input" type="text" placeholder="Enter Tenant ID" v-model="tenant.id" @blur="validateTenantID()" :class="{'is-danger':errors.tenant, 'is-success':errors.tenant===false}">
            </div>
            <p v-if="errors.tenant === false" class="help is-success">Tenant ID is valid</p>
          </div>

          <div class="field">
            <label class="label">Name</label>
            <div class="control">
              <input class="input" type="text" placeholder="Tenant Name" v-model="tenant.name" :disabled = "errors.tenant===false">
            </div>
          </div>

          <div class="field">
            <label class="label">Client ID</label>
            <div class="control">
              <input class="input" type="text" placeholder="Enter Application ID" v-model="tenant.client_id">
            </div>
          </div>

          <div class="field">
            <label class="label">Client Secret</label>
            <div class="control">
              <input class="input" type="text" placeholder="Enter Application Secret" v-model="tenant.client_secret">
            </div>
          </div>

          <div class="field is-horizontal">
            <div class="field-body">
              <div class="field">
              <label class="label">MRC (Dollar Value)</label>
                <div class="field has-addons">
                  <p class="control">
                    <a class="button is-static">
                      $
                    </a>
                  </p>
                  <p class="control is-expanded">
                    <input class="input" type="number" v-model="tenant.mrc" placeholder="Enter Value in Dollar">
                  </p>
                </div>
              </div>
              <div class="field">
              <label class="label">MRC (Naira Value)</label>
                <div class="field has-addons">
                  <p class="control">
                    <a class="button is-static">
                      ₦
                    </a>
                  </p>
                  <p class="control is-expanded">
                    <input class="input" disabled type="number" v-model="naira" placeholder="Enter Value in Naira">
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="field">
            <div class="field">
              <p class="control is-expanded">
                <input class="button is-success is-fullwidth" :disabled="errors.tenant === null && errors.tenant === true" type="submit">
              </p>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
  <button class="modal-close is-large" aria-label="close" @click="closeCustomerModal"></button>
</div>
  </div>
</section>

</template>

<script>

import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

export default {
  name: 'Home',
  props: [],
  components: {
      Loading
  },

  data () {
    return {
      newCustomerModal : false,
      isLoading: false,
      formloader: false,
      tenant : {
        'name' : null,
        'id' : null,
        'mrc' : null,
        'client_id' : null,
        'client_secret' : null
      },
      has_error : false,
      errors : {
        'tenant' : null
      }
    }
  },

  computed: {
    naira: function() {
      return this.tenant.mrc*365;
    }
  },

  methods: {

    redirectTo(path) {
      return this.$router.push(path)
    },

    validateTenantID() {
      this.has_error = false;
      this.errors.tenant = null;
      this.isLoading = true;
      this.$http({
        method: 'post',
        url: 'tenants/confirmid',
        data: {'tenantid': this.tenant.id}
      }).then((res) => {
        this.isLoading = false;
        this.errors.tenant = false;
        this.tenant.name = res.data.companyProfile.companyName;
      }).catch((error) => {
        this.isLoading = false;
        this.has_error = true
        this.errors.tenant = "An error has occured";
      });
      return
    },

    submitCustomerForm() {

        if (this.has_error === false) {
          this.isLoading = true;
          this.$http({
            method: 'post',
            url: 'tenants/store',
            data: {'tenantid': this.tenant.id,
                    'name' : this.tenant.name,
                    'mrc' : this.tenant.mrc,
                    'client_id' : this.tenant.client_id,
                    'client_secret' : this.tenant.client_secret
                  }
          }).then((res) => {
            this.isLoading = false;
            this.tenant = {'name' : null, 'id' : null, 'mrc' : null, 'client_id' : null, 'client_secret' : null };
            this.closeCustomerModal();
          }).catch((error) => {
            this.isLoading = false;
            this.has_error = true;
            this.errors.tenant = "an error has occured, check your input";
          });
        }
    },

    closeCustomerModal() {
      this.newCustomerModal = false;
      this.errors.tenant = null;
      this.tenant = {
        'name' : null,
        'id' : null,
        'mrc' : null,
        'client_id' : null,
        'client_secret' : null
      }
      this.errors.tenant = false;
    }

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