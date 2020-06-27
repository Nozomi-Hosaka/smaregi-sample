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
    console.log();
    if (response.status >= 200 && response.status < 300) {
      return true;
    } else if (response.status === 422) {
      Object.keys(response.data.errors).forEach((key) => {
        this.errors = response.data.errors[key];
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
