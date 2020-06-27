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
              @click="saveSmaregiToken"
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
            <json-viewer v-model="list.content" />
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
import SaveSmaregiApiToken from '../src/SmaregiApiToken/UseCase/SaveSmaregiApiToken/SaveSmaregiApiToken';
import SaveSmaregiApiTokenInput from '../src/SmaregiApiToken/UseCase/SaveSmaregiApiToken/SaveSmaregiApiTokenInput';
import JsonViewer from '../components/components/JsonViewer';

export default {
  name: 'Index',
  components: {JsonViewer, List, AtomInputText, Panel, AtomButton},
  data() {
    return {
      fetching: false,
      getSmaregiTokenUseCase: new GetSmaregiApiToken(new SmaregiApiTokenRepository()),
      saveSmaregiTokenUseCase: new SaveSmaregiApiToken(new SmaregiApiTokenRepository()),
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
        this.smaregiTokens = await this.getSmaregiTokenUseCase.process();
      } catch (e) {
        this.smaregiTokens = e;
      }
    },
    async saveSmaregiToken() {
      try {
        const input = new SaveSmaregiApiTokenInput(this.contractId);
        const token = await this.saveSmaregiTokenUseCase.process(input);
        this.smaregiTokens.push(token);
      } catch (e) {
        this.smaregiTokens = e;
      }
    }
  }
};
</script>

<style scoped>

</style>
