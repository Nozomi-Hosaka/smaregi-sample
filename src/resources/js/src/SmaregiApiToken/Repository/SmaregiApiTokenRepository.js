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

  async create(input) {
    const params = new FormData();
    params.append('contract_id', input.contractId);
    const response = await this._api.send('post', 'api/smaregi/token', params);
    if (!this.checkErrorByResponseStatus(response)) {
      return false;
    }
    return response.data;
  }
}

export default SmaregiApiTokenRepository;
