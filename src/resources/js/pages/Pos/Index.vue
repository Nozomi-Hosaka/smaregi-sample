<template>
  <div>
    <panel>
      <template #body>
        <div class="m-3">
          <atom-input-text
            v-model="name"
            placeholder="部門名を入力してください。"
            description="85文字以内で入力してください。"
            :max="85"
          />
        </div>
        <div class="m-3 text-right">
          <atom-button
            primary
            outline
            @click="createCategory"
          >
            登録
          </atom-button>
        </div>
      </template>
    </panel>
  </div>
</template>

<script>
import Panel from '../../components/parts/Panel';
import AtomInputText from '../../components/atoms/AtomInputText';
import AtomButton from '../../components/atoms/AtomButton';
import CreateCategory from '../../src/Pos/Category/UseCase/CreateCategory/CreateCategory';
import CategoryRepository from '../../src/Pos/Category/Repository/CategoryRepository';
import CreateCategoryInput from '../../src/Pos/Category/UseCase/CreateCategory/CreateCategoryInput';
export default {
  name: 'Index',
  components: {AtomButton, AtomInputText, Panel},
  data() {
    return {
      createCategoryUseCase: new CreateCategory(new CategoryRepository()),
      name: '',
    };
  },
  methods: {
    async createCategory() {
      try {
        const input = new CreateCategoryInput(this.name);
        await this.createCategoryUseCase.process(input);
      } catch (e) {
        console.error(e);
      }
    }
  },
};
</script>

<style scoped>

</style>
