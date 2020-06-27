<template>
  <div class="text-form-container">
    <label class="label">
      <input
        v-model="text"
        :type="type"
        :class="inputClass"
        :placeholder="placeholder"
        :maxlength="max"
        :minlength="min"
      >
    </label>
    <div
      class="row"
      :class="descriptionClass"
    >
      <div class="col-10">
        {{ description }}
      </div>
      <div class="col-2">
        <span class="length">{{ value.length + '/' + max }}</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AtomInputText',
  props: {
    value: {
      type: String,
      required: true,
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
    placeholder: {
      type: String,
      default: ''
    },
    max: {
      type: Number,
      default: 100,
    },
    min: {
      type: Number,
      default: 0,
    },
    description: {
      type: String,
      default: '',
    },
    password: {
      type: Boolean,
      default: false,
    },
    email: {
      type: Boolean,
      default: false,
    },
    error: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    inputClass() {
      const result = {'text-form': true};
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
      if (this.value.length > 0 && this.value.length < this.min) {
        color = 'danger';
      }
      if (this.error) {
        color = 'danger';
      }
      result['text-form__' + color] = true;
      return result;
    },
    descriptionClass() {
      const result = {'description': true};
      let color = 'default';
      if (this.value.length > 0 && this.value.length < this.min) {
        color = 'danger';
      }
      if (this.error) {
        color = 'danger';
      }
      result['description__' + color] = true;
      return result;
    },
    type() {
      if (this.password) {
        return 'password';
      } else if (this.email) {
        return 'email';
      }
      return 'text';
    },
    text: {
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

</style>
