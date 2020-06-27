<template>
  <div>
    <h1>TOP</h1>
    <div class="m-3">
      <panel>
        <template #body>
          <div class="m-3">
            <atom-input-text
              v-model="contractId"
              placeholder="契約IDを入力してください。"
            />
          </div>
        </template>
        <template #footer_action>
          <div class="mx-3">
            <atom-button
              primary
              outline
              @click="smaregiTokens.push('現在準備中です。')"
            >
              アプリトークンを取得
            </atom-button>
          </div>
        </template>
      </panel>
    </div>

    <div
      v-if="smaregiTokens.length"
      class="m-3"
    >
      <list :lists="smaregiTokens">
        <template #default="list">
          <div class="m-3">
            {{ list.content }}
          </div>
        </template>
      </list>
    </div>
  </div>
</template>

<script>
import AtomButton from '../components/atoms/AtomButton';
import Panel from '../components/parts/Panel';
import GetSmaregiApiToken from '../src/SmaregiApiToken/UseCase/GetSmaregiApiToken/GetSmaregiApiToken';
import SmaregiApiTokenRepository from '../src/SmaregiApiToken/Repository/SmaregiApiTokenRepository';
import AtomInputText from '../components/atoms/AtomInputText';
import List from '../components/parts/List';

export default {
  name: 'Index',
  components: {List, AtomInputText, Panel, AtomButton},
  data() {
    return {
      fetching: false,
      getSmaregiToken: new GetSmaregiApiToken(new SmaregiApiTokenRepository()),
      contractId: '',
      smaregiTokens: [],
    };
  },
  async created() {
    await Promise.all([this.fetchSmaregiToken()]);
  },
  methods: {
    async fetchSmaregiToken() {
      try {
        this.smaregiTokens = await this.getSmaregiToken.process();
      } catch (e) {
        this.smaregiTokens = e;
      }
    }
  }
};
</script>

<style scoped>

</style>
