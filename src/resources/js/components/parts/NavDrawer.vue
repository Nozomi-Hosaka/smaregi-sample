<template>
  <div>
    <div
      class="nav-drawer"
      :class="{'nav-drawer__close': !drawer, 'nav-drawer__open': drawer}"
    >
      <div
        v-if="title"
        class="nav-drawer__header"
      >
        <div class="row p-2">
          <div class="col-9">
            <span class="nav-drawer__header__title">{{ title }}</span>
          </div>
          <div
            class="col-3"
            style="cursor: pointer"
            @click="drawer = false"
          >
            <i class="fas fa-chevron-left" />
          </div>
        </div>
      </div>
      <slot />
    </div>
    <div
      v-show="drawer"
      class="nav-close"
      :class="{'nav-close__active': drawer}"
      @click="drawer = false"
    />
  </div>
</template>

<script>
export default {
  name: 'NavDrawer',
  props: {
    value: {
      type: Boolean,
      required: true,
    },
    title: {
      type: String,
      default: '',
    }
  },
  computed: {
    drawer: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit('input', value);
      }
    }
  }
};
</script>

<style lang="scss" scoped>
    @import "../../../sass/app";
</style>
