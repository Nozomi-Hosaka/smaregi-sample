import Vue from 'vue';
import VueRouter from 'vue-router';

import test from '../routes/test';
import top from '../routes/top';
import auth from '../routes/auth';
import timecard from '../routes/timecard';
import webhook from '../routes/webhook';

Vue.use(VueRouter);

let routes = [];
routes = routes.concat(test.routes);
routes = routes.concat(top.routes);
routes = routes.concat(auth.routes);
routes = routes.concat(timecard.routes);
routes = routes.concat(webhook.routes);

export default new VueRouter({
  mode: 'history',
  routes
});
