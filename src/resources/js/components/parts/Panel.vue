<template>
  <div class="panel">
    <div
      v-if="header"
      class="panel__header"
    >
      <div class="row">
        <div
          class="col"
          style="margin-top: auto;"
        >
          <slot name="header" />
        </div>
        <div
          v-if="headerAction"
          class="panel__header__action col text-right"
        >
          <slot name="header_action" />
        </div>
      </div>
    </div>
    <div class="panel__body">
      <slot name="body" />
    </div>
    <div
      v-if="footer"
      class="panel__footer"
    >
      <div class="row">
        <div
          class="col"
          style="margin-top: auto;"
        >
          <slot name="footer" />
        </div>
        <div
          v-if="footerAction"
          class="panel__footer__action col text-right"
        >
          <slot name="footer_action" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Panel',
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
