<template>
  <div>
    <h1>TOP</h1>
    <div class="m-3">
      <panel class="p-3">
        <template #body>
          <atom-button
            primary
            outline
            @click="smaregiToken = '現在準備中です。'"
          >
            アプリトークンを取得
          </atom-button>
          <hr>
          {{ smaregiToken }}
        </template>
      </panel>
    </div>

    <div class="m-3">
      <panel class="p-3">
        <template #body>
          <atom-button
            primary
            outline
            @click="$router.push({name: 'timecard'})"
          >
            タイムカード
          </atom-button>
        </template>
      </panel>
    </div>
  </div>
</template>

<script>
import AtomButton from '../components/atoms/AtomButton';
import Panel from '../components/parts/Panel';
import GetSmaregiApiToken from '../src/SmaregiApiToken/UseCase/GetSmaregiApiToken/GetSmaregiApiToken';
import SmaregiApiTokenRepository from '../src/SmaregiApiToken/Repository/SmaregiApiTokenRepository';

export default {
  name: 'Index',
  components: {Panel, AtomButton},
  data() {
    return {
      fetching: false,
      getSmaregiToken: new GetSmaregiApiToken(new SmaregiApiTokenRepository()),
      smaregiToken: '',
    };
  },
  async created() {
    await Promise.all([this.fetchSmaregiToken()]);
  },
  methods: {
    async fetchSmaregiToken() {
      try {
        this.smaregiToken = await this.getSmaregiToken.process();
      } catch (e) {
        this.smaregiToken = e;
      }
    }
  }
};
</script>

<style scoped>

</style>
