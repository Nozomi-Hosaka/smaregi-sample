<template>
  <nav class="navigator navigator__light">
    <div
      v-if="drawer"
      class="navigator__icon"
      @click="open = !open"
    >
      <i class="fas fa-bars" />
    </div>
    <div class="navigator__action">
    </div>
  </nav>
</template>

<script>
import AtomButton from '../atoms/AtomButton';
import Auth from '../../src/Auth/Auth';
export default {
  name: 'Navigator',
  components: {AtomButton},
  props: {
    value: {
      type: Boolean,
      required: true,
    },
    drawer: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    open: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit('input', value);
      }
    }
  },
  methods: {
    async logout() {
      const auth = new Auth();
      const result = await auth.logout();
      if (result === false) {
        // TODO: エラー処理
      }
      await this.$store.dispatch('auth/clearUser');
      await this.$router.push({name: 'login'}).catch(() => {});
      location.href = '/login';
    }
  }
};
</script>

<style lang="scss" scoped>

</style>
