class GetWebhookLogs {
  constructor(webhookLogsRepository) {
    this._webhookLogsRepository = webhookLogsRepository;
  }

  async process() {
    const result = await this._webhookLogsRepository.find();
    if (result === false) {
      throw this._webhookLogsRepository.errors;
    }
    return result;
  }
}

export default GetWebhookLogs;
