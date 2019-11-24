<template>
    <div>
        <nav class="navbar is-link" role="navigation" aria-label="main navigation">
              <div class="navbar-brand">
                <a class="navbar-item" href="/">
                  <img src="https://www.mdx-i.com/wp-content/uploads/2017/08/mdxi-logo-inverted.png" width="87.11" height="40">
                </a>

                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                  <span aria-hidden="true"></span>
                  <span aria-hidden="true"></span>
                  <span aria-hidden="true"></span>
                </a>
              </div>

              <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-start">
                  <a class="navbar-item" href="/">
                    Home
                  </a>

                  <a class="navbar-item" href="/tenants">
                    Tenants
                  </a>

                  <!-- <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                      Options
                    </a>

                    <div class="navbar-dropdown">
                      <a class="navbar-item">
                        About
                      </a>
                      <a class="navbar-item">
                        Jobs
                      </a>
                      <a class="navbar-item">
                        Contact
                      </a>
                      <hr class="navbar-divider">
                      <a class="navbar-item">
                        Report an issue
                      </a>
                    </div>
                  </div> -->
                </div>

                <div class="navbar-end">
                  <div class="navbar-item">
                    <div class="buttons">
                      <a v-if="$auth.check()" class="button is-light" href="#" @click.prevent="$auth.logout()">
                        Logout
                      </a>
                      <a v-if="!$auth.check()" class="button is-light" href="/login">
                        Log in
                      </a>
                    </div>
                  </div>
                </div>
              </div>
        </nav>
        <div class="container">

            <router-view></router-view>
        
        </div>
        <footer class="footer">
          <div class="content has-text-centered">
            <p>
              <strong>MainOne</strong>
            </p>
          </div>
        </footer>
    </div>
</template>
<script>
    export default {}
</script>