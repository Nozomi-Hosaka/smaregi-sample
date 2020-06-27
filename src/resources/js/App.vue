<template>
  <div>
    <navigator
      v-model="drawer"
      drawer
    />
    <nav-drawer
      v-model="drawer"
      title="title"
    >
      <nav-drawer-item @click="toTop">
        TOP
      </nav-drawer-item>
    </nav-drawer>
    <transition mode="out-in">
      <div class="container mt-3">
        <router-view />
      </div>
    </transition>
  </div>
</template>

<script>
import Navigator from './components/parts/Navigator';
import NavDrawer from './components/parts/NavDrawer';
import NavDrawerItem from './components/parts/NavDrawerItem';

export default {
  name: 'App',
  components: {NavDrawerItem, NavDrawer, Navigator},
  data() {
    return {
      drawer: false
    };
  },
  methods: {
    toTop() {
      this.drawer = false;
      this.$router.push({name: 'top'}).catch(() => {});
    },
  }
};
</script>

<style scoped>

</style>
