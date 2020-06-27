<template>
  <div>
    <list :lists="lists">
      <template #default="list">
        {{ list.content.name }}
      </template>
      <template #footer>
        フッター
      </template>
      <template #footer_action>
        <slot name="footer_action">
          <div
            class="text-right link"
            @click="clickAddList"
          >
            リストを追加
          </div>
        </slot>
      </template>
    </list>
  </div>
</template>

<script>
import List from './List';

export default {
  name: 'AddList',
  components: {List},
  props: {
    lists: {
      type: Array,
      required: true,
    }
  },
  methods: {
    clickAddList() {
      this.$emit('add');
    }
  }
};
</script>

<style scoped>

</style>
