<template>
  <div v-html="code" />
</template>

<script>
import marked from 'marked';
import hljs from 'highlight.js';

export default {
  name: 'JsonViewer',
  props: {
    value: {
      type: Object,
      required: true,
    }
  },
  computed: {
    code: {
      get() {
        const json = JSON.stringify(this.value, null, 4);
        const content = '```json\n' + json + '\n```';
        return marked(content);
      },
      set(value) {
        this.$emit('input', value);
      }
    }
  },
  created() {
    const renderer = new marked.Renderer();
    renderer.code = (code, lang) => {
      return '<pre><code class="hljs language-' + lang + '">' + hljs.highlightAuto(code, [lang]).value + '</code></pre>';
    };
    marked.setOptions({
      renderer: renderer
    });
  }
};
</script>

<style scoped>

</style>
