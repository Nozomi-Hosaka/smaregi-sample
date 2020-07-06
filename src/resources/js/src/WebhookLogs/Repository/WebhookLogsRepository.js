import Api from '../../Api';

class WebhookLogsRepository extends Api{
  async find() {
    const response = await this._api.send('get', 'api/webhook');
    if (!this.checkErrorByResponseStatus(response)) {
      return false;
    }
    return response.data;
  }
}

export default WebhookLogsRepository;
