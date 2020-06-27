<template>
  <div>
    <panel>
      <template #header>
        <h3 class="p-0 mb-0 mx-3">
          ログイン
        </h3>
      </template>
      <template #body>
        <form
          :action="'/twitter/login'"
          method="post"
        >
          <input
            type="hidden"
            name="_token"
            :value="token"
          >
          <div class="row">
            <div class="col text-right mx-3">
              <atom-button
                primary
                large
              >
                <i class="fab fa-twitter" />
                Twitterでログイン
              </atom-button>
            </div>
          </div>
        </form>
        <hr>
        <div class="row">
          <div class="col mt-5 mb-3 mx-3">
            <atom-input-text
              v-model="email"
              placeholder="メールアドレス"
              :description="errors.email.length ? errors.email[0] : 'メールアドレスを入力してください。'"
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
              :description="errors.password.length ? errors.password[0] : '8文字以上で入力してください。'"
              :max="255"
              :min="8"
              :error="errors.password ? errors.password.length > 0 : false"
            />
          </div>
        </div>
        <div class="row">
          <div class="col m-3">
            <atom-checkbox v-model="remember">
              ログインを維持する
            </atom-checkbox>
          </div>
        </div>
      </template>
      <template #footer_action>
        <div class="row">
          <div class="col mx-3">
            <atom-button
              primary
              outline
              @click="login"
            >
              ログイン
            </atom-button>
          </div>
        </div>
      </template>
    </panel>
  </div>
</template>

<script>
import AtomInputText from '../../components/atoms/AtomInputText';
import AtomButton from '../../components/atoms/AtomButton';
import Auth from '../../src/Auth/Auth';
import Panel from '../../components/parts/Panel';
import AtomCheckbox from '../../components/atoms/AtomCheckbox';

export default {
  name: 'Login',
  components: {AtomCheckbox, Panel, AtomButton, AtomInputText},
  data() {
    return {
      token: '',
      email: '',
      password: '',
      remember: false,
      errors: {},
    };
  },
  created() {
    this.token = getCSRFToken();
    this.errors = this.getInitErrors();
  },
  methods: {
    getInitErrors() {
      return {
        email: [],
        password: []
      };
    },
    async login() {
      this.errors = this.getInitErrors();
      const auth = new Auth();
      const user = await auth.login(this.email, this.password, this.remember);
      if (user === false) {
        this.errors = auth.errorMessage;
        return false;
      }
      await this.$store.dispatch('auth/setUser', user);
      await this.$router.push({name: 'top'}).catch(() => {
      });
      location.href = '/';
      return true;
    }
  }
};

function getCSRFToken() {
  return document.getElementsByName('csrf-token').item(0).content;
}

</script>

<style scoped>

</style>
