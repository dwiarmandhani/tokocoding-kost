window.Vue = require('vue');

window.moment = require('moment'); // require

Vue.filter('timeformat', function(arg) {
    moment.locale('id');
    return moment(arg).format('LLL')
});
