require('./bootstrap');

import store from './store';
import { router } from './router';

Jism.Vue = new Vue({
    el: '#jism-app',
    router,
    store
});

/*
 * Perform initial launch of graph loading. WARNING. This runs for infiniti;
 */
Jism.Vue.$store.dispatch('graph/LOAD');
setInterval(() => {
    Jism.Vue.$store.dispatch('graph/LOAD');
}, 1000);

/*
 * Update the data in landlord
 */
Jism.Vue.$store.dispatch('landlord/UPDATE', Jism.Vue.$route);
router.beforeEach((to, from, next) => {
    Jism.Vue.$store.dispatch('landlord/UPDATE', to);
    next();
});
