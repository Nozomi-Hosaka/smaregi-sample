import Api from '../../Api';

class SmaregiApiTokenRepository extends Api {
  constructor() {
    super();
  }

  async find() {
    const response = await this._api.send('get', 'api/smaregi/token');
    if (!this.checkErrorByResponseStatus(response)) {
      return false;
    }
    return response.data;
  }
}

export default SmaregiApiTokenRepository;
