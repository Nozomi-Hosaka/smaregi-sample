import Axios from './Axios';

class Api {
  set errors(value) {
    this._errors.push(value);
  }

  get errors() {
    return this._errors;
  }

  constructor() {
    this._api = new Axios();
    this._errors = [];
  }

  checkErrorByResponseStatus(response) {
    this._errors = [];
    if (response.status >= 200 && response.status < 300) {
      return true;
    } else if (response.status === 422) {
      response.data.errors.forEach((item) => {
        this.errors = item;
      });
      return false;
    } else {
      this.errors = response.message
        ? response.message
        : response.data.message
          ? response.data.message
          : 'Server Error.';
      return false;
    }
  }
}

export default Api;
