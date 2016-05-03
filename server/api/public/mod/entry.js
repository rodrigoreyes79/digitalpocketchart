require("bootstrap/dist/css/bootstrap.css");
require("../css/common.scss");
var Vue = require("vue");

// Registering vue components
Vue.component('login', require('./login.js'));
Vue.component('l-menu', require('./l-menu.js'));
Vue.component('encuestas', require('./encuestas.js'));
Vue.component('usuarios', require('./usuarios.js'));

// Instantiating Vue
var app = new Vue({
    el: '#app-container',
    data: {
      loggedIn: false,
      currentView: 'login'
    },
    methods: {
        'doLogin': function(){
            this.loggedIn = true;
        }
    }
})

app.currentView = 'encuestas';
