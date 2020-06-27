import Axios from './Axios';

class Api {
  set exceptionMessage(value) {
    this._exceptionMessage = value;
  }

  get exceptionMessage() {
    return this._exceptionMessage;
  }

  set errorMessage(value) {
    this._errorMessage = value;
  }

  get errorMessage() {
    return this._errorMessage;
  }

  constructor() {
    this._api = new Axios();
  }

  checkErrorByResponseStatus(response) {
    if (response.status >= 200 && response.status < 300) {
      return true;
    } else if (response.status === 422) {
      this._errorMessage = response.data.errors;
      return false;
    } else {
      this._exceptionMessage = response.message;
      return false;
    }
  }
}

export default Api;
