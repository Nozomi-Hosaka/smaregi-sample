import Vue from 'vue';
import Vuex from 'vuex';
import auth from '../store/auth';
import loader from '../store/loader';
import reloadDialog from '../store/reloadDialog';
import snackbar from '../store/snackbar';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    auth,
    loader,
    reloadDialog,
    snackbar,
  }
});
