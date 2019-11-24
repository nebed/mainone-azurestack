<template>

	<section class="hero is-fullheight">
	  <div class="hero-body">
	    <div class="container">
	      <div class="columns is-centered">
	        <div class="column is-5-tablet is-4-desktop is-3-widescreen">
	          <form novalidate class="box" autocomplete="off" @submit.prevent="checkForm" method="post">
	          	 <article v-if="has_error" class="message is-danger">
				  <div class="message-body">
				    {{errors.login}}
				  </div>
				</article>
	            <div class="field">
	              <label for="" class="label">Email</label>
	              <div class="control has-icons-left">
	                <input type="email" @blur="checkEmail()" placeholder="e.g. bobsmith@gmail.com" :class="{'is-danger':errors.email}" v-model="email" class="input" required>
	                <span class="icon is-small is-left">
	                  <i class="fa fa-envelope"></i>
	                </span>
	              </div>
	              <p class="help is-danger">
			        {{errors.email}}
			      </p>
	            </div>
	            <div class="field">
	              <label for="" class="label">Password</label>
	              <div class="control has-icons-left">
	                <input type="password" @blur="checkPassword()" placeholder="*******" :class="{'is-danger':errors.password}" v-model="password" class="input" required>
	                <span class="icon is-small is-left">
	                  <i class="fa fa-lock"></i>
	                </span>
	              </div>
	              <p class="help is-danger">
			        {{errors.password}}
			      </p>
	            </div>
	            <div class="field">
	              <label for="" class="checkbox">
	                <input type="checkbox">
	               Remember me
	              </label>
	            </div>
	            <div class="field is-grouped is-grouped-centered">
	              <button class="button is-link is-fullwidth">
	                Login
	              </button>
	            </div>
	          </form>
	        </div>
	      </div>
	    </div>
	  </div>
	</section>

</template>

<script>
  export default {
  	name: "Login",
    data () {
      return {
        email: null,
        password: null,
        has_error: null,
        errors: {
        	password:null,
        	email:null,
        	login:null
        }
      }
    },
    mounted() {
      //
    },
    methods: {

    	validEmail: function (email) {
	      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	      return re.test(email);
	    },

	    checkEmail() {
	    	this.has_error = null
	    	this.errors.email=null;
	    	if (!this.email) {
		      this.errors.email = 'Email required.';
		      } else if (!this.validEmail(this.email)) {
		        this.errors.email = 'Valid email required.';
		      }
		      if (!this.errors.email) {
	        	return true;
	      }	
	    },

	    checkPassword() {
	    	this.has_error = null
	    	this.errors.password=null;
	    	if (!this.password) {
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
                    email: app.email,
                    password: app.password
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