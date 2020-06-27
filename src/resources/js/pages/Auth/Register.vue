<template>
  <div>
    <panel>
      <template #header>
        <h3 class="p-0 mb-0">
          ユーザー登録
        </h3>
      </template>
      <template #body>
        <div class="row">
          <div class="col mt-5 mb-3 mx-3">
            <atom-input-text
              v-model="name"
              placeholder="ユーザー名"
              :description="errors.name ? errors.name[0] : ''"
              :max="50"
              :error="errors.name ? errors.name.length > 0 : false"
            />
          </div>
        </div>
        <div class="row">
          <div class="col m-3">
            <atom-input-text
              v-model="email"
              placeholder="メールアドレス"
              :description="errors.email ? errors.email[0] : ''"
              :max="255"
              :error="errors.email ? errors.email.length > 0 : false"
            />
          </div>
        </div>
        <div class="row">
          <div class="col m-3">
            <atom-input-text
              v-model="password"
              placeholder="パスワード"
              password
              :description="errors.password ? errors.password[0] : '8文字以上で入力してください。'"
              :max="255"
              :min="8"
              :error="errors.password ? errors.password.length > 0 : false"
            />
          </div>
        </div>
        <div class="row">
          <div class="col m-3">
            <atom-input-text
              v-model="passwordConfirm"
              placeholder="パスワード確認"
              password
              :max="255"
              :min="8"
            />
          </div>
        </div>
      </template>
      <template #footer_action>
        <atom-button
          class="float-right"
          primary
          outline
          @click="register"
        >
          登録
        </atom-button>
      </template>
    </panel>
  </div>
</template>

<script>
import AtomInputText from '../../components/atoms/AtomInputText';
import AtomButton from '../../components/atoms/AtomButton';
import Auth from '../../src/Auth/Auth';
import Panel from '../../components/parts/Panel';

export default {
  name: 'Register',
  components: {Panel, AtomButton, AtomInputText},
  data() {
    return {
      name: '',
      email: '',
      password: '',
      passwordConfirm: '',
      errors: {},
    };
  },
  created() {
    this.errors = this.getInitErrors();
  },
  methods: {
    async register() {
      this.errors = this.getInitErrors();
      const auth = new Auth();
      const user = await auth.register(this.name, this.email, this.password, this.passwordConfirm);
      if (user === false) {
        this.errors = auth.errorMessage;
        return false;
      }
      await this.$store.dispatch('auth/setUser', user);
      location.href = '/';
      return true;
    },
    getInitErrors() {
      return {
        name: [],
        email: [],
        password: [],
        passwordConfirm: [],
      };
    }
  }
};
</script>

<style scoped>

</style>
