import Test from '../pages/Test';

const routes = [
  {
    name: 'test',
    path: '/test',
    component: Test,
    meta: {
      public: false,
    }
  }
];

export default {
  routes
};
