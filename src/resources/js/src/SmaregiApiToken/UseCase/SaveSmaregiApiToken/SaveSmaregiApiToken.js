class SaveSmaregiApiToken {
  constructor(smaregiApiTokenRepository) {
    this._smaregiApiTokenRepository = smaregiApiTokenRepository;
  }

  async process(input) {
    const result = await this._smaregiApiTokenRepository.create(input);
    if (result === false) {
      throw this._smaregiApiTokenRepository.errors;
    }
    return result;
  }
}

export default SaveSmaregiApiToken;
