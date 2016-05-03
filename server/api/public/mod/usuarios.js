var api = require('./api.js');
require('../node_modules/font-awesome/css/font-awesome.css');


var UsuariosVM = function(){
    this.template = require("./usuarios.html");

    this.props = [];

    this.methods = {
    }

    this.data = function(){
        return {
            'items': [
                {
                    'name': 'Rodolfo Arce',
                    'email': 'rodolfoarce@gmail.com',
                    'tipo': 'Administrador',
                    'status': 'Activo'
                },
                {
                    'name': 'Rodrigo Reyes',
                    'email': 'rodrigoreyes@gmail.com',
                    'tipo': 'Facilitador',
                    'status': 'Activo'
                }
            ]
        }
    }
}

module.exports = new UsuariosVM();
