var api = require('./api.js');
require('../node_modules/font-awesome/css/font-awesome.css');


var LoginVM = function(){
    this.template = require("./login.html");

    this.props = ['msg'];

    this.methods = {
        doLogin: function(){
            this.$dispatch('login', true);
        }
    }
}

module.exports = new LoginVM();
