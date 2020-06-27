import Index from '../pages/Timecard/Index';

const routes = [
  {
    name: 'timecard',
    path: '/timecard',
    component: Index,
    meta: {
      public: true,
    }
  },
];

export default {
  routes
};
