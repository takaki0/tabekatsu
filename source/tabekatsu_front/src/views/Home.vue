<template>
    <h1>HOME</h1>
</template>

<script>
  import axios from 'axios';
  export default {
    name: "Home",
    computed: {
      idToken() {
        return this.$store.getters.idToken;
      }
    },
    created: function() {
      axios.get('/members',
        {
          headers: {
            Authorization: `Bearer ${this.idToken}`,
          }
        })
    }
  }
</script>

<style scoped>

</style>