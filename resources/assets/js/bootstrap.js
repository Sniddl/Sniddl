
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

global.$ = global.jQuery = require('jquery');

// require('bootstrap');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

// window.axios = require('axios');
//
// window.axios.defaults.headers.common = {
//     'X-CSRF-TOKEN': window.Laravel.csrfToken,
//     'X-Requested-With': 'XMLHttpRequest'
// };

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"
//
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });


// Register a global custom directive called v-focus
Vue.directive('href', {
  // When the bound element is inserted into the DOM...
  inserted: function (el) {
    // Focus the element
     el.__data__    = {
       ajax:    $(el).data("ajax"),
       error:   $(el).data("error"),
       href:    $(el).data("href"),
       json:    $(el).data("json"),
       request: $(el).data("request"),
       success: $(el).data("success"),
     }
     $(el).removeAttr("data-href")
          .removeAttr("data-ajax")
          .removeAttr("data-request")
          .removeAttr("data-json")
          .removeAttr("data-success")
          .removeAttr("data-error");

     $(el).addClass("v-href")

    window.el = el;
  }
})



Vue.nextTick(function(){
  $('[document]').ready(function(){
    __FRAMEWORK__();
  })
})
