<template>
  <div>
    <h1>TOP</h1>
    <panel>
      <template #body>
        <atom-button
          primary
          outline
        />
      </template>
    </panel>
  </div>
</template>

<script>
import AtomButton from '../components/atoms/AtomButton';
import Panel from '../components/parts/Panel';

export default {
  name: 'Index',
  components: {Panel, AtomButton},
};
</script>

<style scoped>

</style>
