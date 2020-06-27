<template>
  <div>
    <panel>
      <template #body>
        <div class="m-3">
          <atom-input-text
            v-model="contractId"
            placeholder="取得したい契約IDを入力してください。"
            description="テスト用です。パブリックなユーザーで殆どの契約IDのデータを取得できます。"
            :max="50"
          />
        </div>
        <div class="m-3">
          {{ message }}
        </div>
      </template>
      <template #footer_action>
        <div class="mx-3">
          <atom-button
            primary
            outline
            @click="fetchStaff"
          >
            取得
          </atom-button>
        </div>
      </template>
    </panel>
  </div>
</template>

<script>
import AtomInputText from '../../components/atoms/AtomInputText';
import AtomButton from '../../components/atoms/AtomButton';
import Panel from '../../components/parts/Panel';

export default {
  name: 'Index',
  components: {Panel, AtomButton, AtomInputText},
  data() {
    return {
      contractId: '',
      message: '',
    };
  },
  methods: {
    async fetchStaff() {
      this.message = '現在準備中です。';
    }
  }
};
</script>

<style scoped>

</style>
