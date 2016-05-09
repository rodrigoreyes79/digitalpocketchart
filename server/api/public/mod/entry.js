require("bootstrap/dist/css/bootstrap.css");
require("../css/common.scss");
var StackTrace = require("stacktrace-js");
var Vue = require("vue");

var callback = function(stackframes) {
    var stringifiedStack = stackframes.map(function(sf) {
        return sf.toString();
    }).join('\n');
    console.log(stringifiedStack);
    alert('Un error técnico inesperado ha ocurrido y ha sido notificado al equipo técnico.\nIntente refrescar la página y/o dejar de usar IE.');
};

var errback = function(err) { console.log(err.message); };

window.onerror = function(msg, file, line, col, error) {
    // callback is called with an Array[StackFrame]
    StackTrace.fromError(error).then(callback).catch(errback);
};

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
