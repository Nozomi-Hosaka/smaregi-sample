import Index from '../pages/Index';

const routes = [
  {
    name: 'top',
    path: '/',
    component: Index,
    meta: {
      public: true,
    }
  },
];

export default {
  routes
};
