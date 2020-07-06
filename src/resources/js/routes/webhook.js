import Index from '../pages/Webhook/Index';

const routes = [
  {
    name: 'webhook',
    path: '/webhook',
    component: Index,
    meta: {
      public: true,
    }
  },
];

export default {
  routes
};
