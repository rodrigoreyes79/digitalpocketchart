var api = require('./api.js');
require('../node_modules/font-awesome/css/font-awesome.css');

var LoginVM = function(){
    this.template = require("./login.html");

    this.props = ['msg'];

    this.data = function(){
        return {
            'user': '',
            'pwd': ''
        }
    }

    this.methods = {
        doLogin: function(){
            var self = this;
            api.login(this.user, this.pwd).then(function(){
                self.$dispatch('login', true);
            }, function(error){
                alert('Usuario / Password no encontrados')
            });
        }
    }
}

module.exports = new LoginVM();
