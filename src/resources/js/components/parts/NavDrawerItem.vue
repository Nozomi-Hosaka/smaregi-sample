<template>
  <div>
    <div
      class="nav-drawer__item"
      @click="$emit('click')"
    >
      <slot />
    </div>
  </div>
</template>

<script>
export default {
  name: 'NavDrawerItem',
};
</script>

<style lang="scss" scoped>
    @import "../../../sass/app";
</style>
