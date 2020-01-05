<template>
  <div id="app"
       class="wrapper"
       style="width: 700px; margin: auto; padding-top: 120px"
  >
    <div class="container">
      <nav>
        <template v-if="isAuthenticated">
          <router-link
                  to="/" tag="div" class="nav-item"
                  active-class="nav-active" exact>
            Home
          </router-link>
          <span @click="logout">Logout</span>
        </template>
        <template v-if="!isAuthenticated">
          <router-link
                  to="/login" tag="div" class="nav-item"
                  active-class="nav-active" exact>
            Login
          </router-link>
          <router-link
                  to="/register" tag="div" class="nav-item"
                  active-class="nav-active" exact>
            Register
          </router-link>
        </template>
      </nav>
      <router-view></router-view>
    </div>
  </div>
</template>

<script>

export default {
  name: 'app',
  computed: {
    isAuthenticated() {
      return this.$store.getters.idToken !== null;
    },
  },
  methods: {
    logout() {
      this.$store.dispatch('logout');
    },
  },
  components: {
  }
}
</script>

<style scoped>
.nav-item {
  flex: auto;
}

.nav-active {
  font-size: 18px;
  font-weight: bold;
}
</style>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

</style>
