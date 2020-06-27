<template>
  <panel>
    <template #header>
      <slot name="header" />
    </template>
    <template #header_action>
      <slot name="header_action" />
    </template>
    <template #body>
      <div
        v-for="(list, index) in lists"
        :key="index"
        class="list-line"
      >
        <slot :content="list" />
      </div>
    </template>
    <template #footer>
      <slot name="footer" />
    </template>
    <template #footer_action>
      <slot name="footer_action" />
    </template>
  </panel>
</template>

<script>
import Panel from './Panel';
export default {
  name: 'List',
  components: {Panel},
  props: {
    lists: {
      type: Array,
      required: true,
    }
  },
  computed: {
    header() {
      return this.$slots.header || this.$slots.header_action;
    },
    headerAction() {
      return this.$slots.header_action;
    },
    footer() {
      return this.$slots.footer || this.$slots.footer_action;
    },
    footerAction() {
      return this.$slots.footer_action;
    }
  }
};
</script>

<style lang="scss" scoped>

</style>
