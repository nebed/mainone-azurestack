<template>
  <div>
    <section class="hero is-info is-fullheight">

      <div class="hero-body">
        <div class="container has-text-centered">

	      <div class="column is-4 is-offset-4 has-text-left">

				<div class="box">

					<form novalidate @submit.prevent="checkForm" method="post">
					
						<div class="field">
						  <label class="label">Email</label>
						  <div class="control has-icons-left has-icons-right">
						    <input class="input" @blur="checkEmail()" placeholder="e.g. bobsmith@gmail.com" :class="{'is-danger':errors.email}" v-model="formdata.email" required>
						    <span class="icon is-small is-left">
						      <i class="fas fa-envelope"></i>
						    </span>
						    <span class="icon is-small is-right">
						      <i class="fas fa-exclamation-triangle"></i>
						    </span>
						  </div>
						  <p class="help is-danger">{{errors.email}}</p>
						</div>

						<div class="field">
						  <label class="label">Password</label>
						  <div class="control has-icons-left has-icons-right">
						    <input class="input" @blur="checkPassword()" placeholder="*******" :class="{'is-danger':errors.password}" v-model="formdata.password" required>
						    <span class="icon is-small is-left">
						      <i class="fas fa-user"></i>
						    </span>
						    <span class="icon is-small is-right">
						      <i class="fas fa-check"></i>
						    </span>
						  </div>
						  <p class="help is-danger">{{errors.password}}</p>
						</div>

						<div class="field">
						  <div class="control">
						    <button class="button is-link is-fullwidth">Login</button>
						  </div>
						</div>

					</form>
					
				</div>
	      </div>

        </div>
      </div>

    </section>
  </div>
</template>

<script>
  //import logo from './../assets/logo-white.png';
  export default {
    data: function() {
      return {
        'title': 'Hello Stranger !!!!',
        'subtitle1': 'A demo website based on frameworks Bulma (CSS) and Vue JS (JS)',
        'subtitle2': 'Feel free to navigate around and checkout the page',
        'bulmaWebsite': 'https://bulma.io',
        'vueWebsite': 'https://vuejs.org/',
        'repoLink': 'https://github.com/faisaltheparttimecoder/bulma-vuejs-demo-website',
        formdata: {
        	email: null,
        	password: null
        },
        errors: {
        	email: null,
        	password: null,
        	login: null,
        },
        has_error: false,
      }
    },

    methods: {
    	validEmail: function (email) {
	      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	      return re.test(email);
	    },

	    checkEmail() {
	    	this.has_error = null
	    	this.errors.email=null;
	    	if (!this.formdata.email) {
		      this.errors.email = 'Email required.';
		      } else if (!this.validEmail(this.formdata.email)) {
		        this.errors.email = 'Valid email required.';
		      }
		      if (!this.errors.email) {
	        	return true;
	      }	
	    },

	    checkPassword() {
	    	this.has_error = null
	    	this.errors.password=null;
	    	if (!this.formdata.password) {
	        this.errors.password = "Password required."; }
	        if (!this.errors.password) {
	        	return true;
	      }
	    },

	    checkForm() {
	    	var validEmail = this.checkEmail();
	    	var validPassword =this.checkPassword();
	    	if(validEmail == true && validPassword == true){
	    		this.login();
	    	}
	    },

	    login() {

	    	var redirect = this.$auth.redirect()
        
                var app = this
                this.$auth.login({
                  params: {
                    email: app.formdata.email,
                    password: app.formdata.password
                  },
        
                  success: function() {
                    // handle redirection
                    const redirectTo = redirect ? 'redirect.from.name' : 'Home'
                    this.$router.push({name: redirectTo})
                  },
        
                  error: function() {
                    app.has_error = true
                    this.errors.login = "Check your credentials and try again";

                  },
        
                  rememberMe: true,
        
                  fetchUser: false
                })

	    }
    }
  }
</script>

<style scoped>

  .hero.is-info {
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  }

</style>
