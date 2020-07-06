class CreateCategory {
  constructor(categoryRepository) {
    this._categoryRepository = categoryRepository;
  }

  async process(input) {
    const result = await this._categoryRepository.create(input);
    if (result === false) {
      throw this._categoryRepository.errors;
    }
    return result;
  }
}

export default CreateCategory;
