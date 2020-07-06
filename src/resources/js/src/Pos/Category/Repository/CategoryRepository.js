import Api from '../../../Api';

class CategoryRepository extends Api {
  async create(input) {
    const params = new FormData();
    params.append('name', input.name);
    const response = await this._api.send('post', 'api/pos/category', params);
    if (!this.checkErrorByResponseStatus(response)) {
      return false;
    }
  }
}

export default CategoryRepository;
