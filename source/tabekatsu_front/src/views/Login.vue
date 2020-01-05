<template>
    <div>
        <h2>ログイン</h2>
        <label for="mail_address">ユーザーID(メールアドレス):</label>
        <input
                id="mail_address"
                type="text"
                v-model="memberData.mail_address"
        >
        <label for="password">パスワード:</label>
        <input
                id="password"
                type="password"
                v-model="memberData.password"
        >
        <button @click="login"> ログイン </button>
    </div>
</template>

<script>
  // import axios from 'axios';

  export default {
    name: "Login",
    data: function () {
      return {
        memberData: {
          mail_address: '',
          password: '',
        },
      }
    },
    methods: {
      login: function () {
        this.$store.dispatch('login', {
          user_id: this.user_id,
          password: this.password,
        });
      },
      getSample: function() {
        // axios
        //   .get('url', options)
        //   .then(response => {
        //     //処理
        //     this.sample_list = response.data;
        //
        //   })
        //   .catch(error => {
        //     //処理
        //   });
      }
    },
  }
</script>

<style scoped>

</style>