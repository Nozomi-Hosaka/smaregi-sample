<template>
  <div>
    <list :lists="lists">
      <template #default="list">
        <div class="m-3">
          <json-viewer v-model="list.content" />
        </div>
      </template>
    </list>
  </div>
</template>

<script>
import List from '../../components/parts/List';
import JsonViewer from '../../components/components/JsonViewer';
import GetWebhookLogs from '../../src/WebhookLogs/UseCase/GetWebhookLogs/GetWebhookLogs';
import WebhookLogsRepository from '../../src/WebhookLogs/Repository/WebhookLogsRepository';

export default {
  name: 'Index',
  components: {JsonViewer, List},
  data() {
    return {
      getWebhookLogs: new GetWebhookLogs(new WebhookLogsRepository()),
      lists: [],
    };
  },
  async created() {
    await Promise.all([this.fetchWebhookLogs()]);
  },
  methods: {
    async fetchWebhookLogs() {
      try {
        this.lists = await this.getWebhookLogs.process();
      } catch (e) {
        console.log(e);
      }
    }
  }
};
</script>

<style scoped>

</style>
