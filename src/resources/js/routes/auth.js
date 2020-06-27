import Register from '../pages/Auth/Register';
import Login from '../pages/Auth/Login';

const routes = [
  {
    name: 'register',
    path: '/register',
    component: Register,
    meta: {
      public: true
    }
  },
  {
    name: 'login',
    path: '/login',
    component: Login,
    meta: {
      public: true
    }
  },
];

export default {
  routes
};
