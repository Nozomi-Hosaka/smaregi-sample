<template>
  <button
    :class="buttonClass"
    @click="click"
  >
    <slot>Button</slot>
  </button>
</template>

<script>
export default {
  name: 'AtomButton',
  props: {
    outline: {
      type: Boolean,
      default: false
    },
    primary: {
      type: Boolean,
      default: false
    },
    warning: {
      type: Boolean,
      default: false
    },
    danger: {
      type: Boolean,
      default: false
    },
    block: {
      type: Boolean,
      default: false,
    },
    large: {
      type: Boolean,
      default: false,
    }
  },
  computed: {
    buttonClass() {
      const result = {'button': true};
      let color = '';
      if (this.primary) {
        color = 'primary';
      } else if (this.warning) {
        color = 'warning';
      } else if (this.danger) {
        color = 'danger';
      } else {
        color = 'default';
      }
      result['button__' + color] = true;
      result['button__' + color + '__outline'] = this.outline;
      result['button__block'] = this.block;
      result['button__large'] = this.large;
      return result;
    },
  },
  methods: {
    click() {
      this.$emit('click');
    }
  }
};
</script>

<style lang="scss" scoped>

</style>
