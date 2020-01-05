<template>
    <div>
        <h2>ユーザー新規登録</h2>
        <form class="form">
            <label for="mail_address">ユーザーID(メールアドレス)</label>
            <input
                    id="mail_address"
                    name="mail_address"
                    type="text"
                    v-model="memberData.mail_address"
            >
            <label for="nickname">ニックネーム</label>
            <input
                    id="nickname"
                    name="nickname"
                    type="text"
                    v-model="memberData.nickname"
            >
            <label for="age">年齢</label>
            <input
                    id="age"
                    name="age"
                    type="text"
                    v-model="memberData.age"
            >
            <label for="sex">性別</label>
            <select
                    id="sex"
                    name="sex"
                    v-model="memberData.sex"
            >
                <option v-for="sex in sexs" :value="sex.id" :key="sex.id">
                    {{ sex.name }}
                </option>
            </select>
            <label for="area">エリア</label>
            <select
                    id="area"
                    name="area"
                    v-model="memberData.area"
            >
                <option v-for="area in areas" :value="area.id" :key="area.id">
                    {{ area.area_name }}
                </option>
            </select>
            <label for="prefecture">都道府県</label>
            <select
                    id="prefecture"
                    name="prefecture"
                    v-model="memberData.prefecture"
            >
                <option v-for="prefecture in prefectures" :value="prefecture.id" :key="prefecture.id">
                    {{ prefecture.prefecture_name }}
                </option>
            </select>
            <label for="password">パスワード</label>
            <input
                    id="password"
                    type="password"
                    v-model="memberData.password"
            >
            <label for="re_password">パスワード(確認)</label>
            <input
                    id="re_password"
                    type="password"
                    v-model="memberData.re_password"
            >
            <button @click="register"> 登  録 </button>
        </form>
    </div>
</template>

<script>
  export default {
    name: "Register",
    data: function () {
      return {
        sexs: [
          {id: 1, name :'男'},
          {id: 2, name :'女'},
        ],
        memberData: {
          mail_address: '',
          nickname: '',
          age: '',
          sex: 1,
          area: 1,
          prefecture: 1,
          password: '',
          re_password: '',
        },
      }
    },
    computed: {
      areas: function () {
        return this.$store.getters.areas;
      },
      prefectures: function () {
        return this.$store.getters.prefectures;
      },
    },
    methods: {
      register: function () {
        this.$store.dispatch('register', {
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