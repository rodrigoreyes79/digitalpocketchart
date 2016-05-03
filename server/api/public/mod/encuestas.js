var api = require('./api.js');

var EncuestasVM = function(){
    this.template = require("./encuestas.html");

    this.props = [];

    this.methods = {};

    this.data = function(){
        return {'items': [
            {
                'name': 'Terremoto Ecuador 2016',
                'created_at': new Date(),
                'total_votings': 10,
                'status': 'Active'
            },{
                'name': 'Terremoto Peru 2010',
                'created_at': new Date(),
                'total_votings': 10,
                'status': 'Active'
            },{
                'name': 'Terremoto Chile 2012',
                'created_at': new Date(),
                'total_votings': 10,
                'status': 'Active'
            }
        ]};
    }
}

module.exports = new EncuestasVM();
