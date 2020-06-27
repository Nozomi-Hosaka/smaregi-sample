import Api from '../Api';

class Auth extends Api {
  async register(userName, userEmail, password, passwordConfirm) {
    const params = new FormData();
    params.append('name', userName);
    params.append('email', userEmail);
    params.append('password', password);
    params.append('password_confirmation', passwordConfirm);
    const response = await this._api.send('post', '/register', params);
    if (!this.checkErrorByResponseStatus(response)) {
      return false;
    }
    return response.data;
  }

  async login(userEmail, password, remember) {
    const params = new FormData();
    params.append('email', userEmail);
    params.append('password', password);
    if (remember) {
      params.append('remember', null);
    }
    const response = await this._api.send('post', '/login', params);
    if (!this.checkErrorByResponseStatus(response)) {
      return false;
    }
    return response.data;
  }

  async logout() {
    const params = new FormData();
    const response = await this._api.send('post', '/logout', params);
    if (!this.checkErrorByResponseStatus(response)) {
      return false;
    }
    return response.data;
  }

  async user() {
    const params = new URLSearchParams();
    const response = await this._api.send('get', '/api/user', params);
    if (!this.checkErrorByResponseStatus(response)) {
      return false;
    }
    return response.data;
  }
}

export default Auth;
