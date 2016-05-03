var LMenuVM = function(){
    this.template = require("./l-menu.html");

    this.props = ['currentView', 'loggedIn'];

    this.data = function(){
        return {'items': [
                {'screen': 'encuestas', 'label': 'Encuestas'},
                {'screen': 'usuarios', 'label': 'Usuarios'}
            ]
        }
    }

    this.methods = {
        doScreen: function(item){
            this.currentView = item.screen;
        },
        doLogout: function(){
            this.loggedIn = false;
        }
    }
}

module.exports = new LMenuVM();
