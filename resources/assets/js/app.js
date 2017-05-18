require('./bootstrap');

import store from './store';
import { router } from './router';

Jism.Vue = new Vue({
    el: '#jism-app',
    router,
    store
});

/*
 * Perform initial launch of status loading. WARNING. This runs for infiniti;
 */
Jism.Vue.$store.dispatch('status/LOAD');

/*
 * Update the data in landlord
 */
Jism.Vue.$store.dispatch('landlord/UPDATE', Jism.Vue.$route);
router.beforeEach((to, from, next) => {
    Jism.Vue.$store.dispatch('landlord/UPDATE', to);
    next();
});
