class GetSmaregiApiToken {
  constructor(smaregiApiTokenRepository) {
    this._smaregiApiTokenRepository = smaregiApiTokenRepository;
  }

  async process() {
    const result = await this._smaregiApiTokenRepository.find();
    if (result === false) {
      throw this._smaregiApiTokenRepository.errors;
    }
    return result;
  }
}

export default GetSmaregiApiToken;
