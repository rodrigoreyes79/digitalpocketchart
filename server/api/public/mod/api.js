var $ = require('jquery');

var Api = function() {
	var baseUrl = "/api/";

	// ----------
	// Utilities
	// ----------
	var get = function(url){
        var d = $.Deferred();
        amplify.publish('loading', true);

        var data = {
        	url: baseUrl + url,
        	type: 'GET',
            async: true,
            dataType: 'json',
            cache: false
        }

        $.ajax(data).then(function(data){
            amplify.publish('loading', false);
            d.resolve(data);
        }, function(errors){
            amplify.publish('loading', false);
            d.reject(errors);
        });
        return d.promise();
	}

	var post = function(url, data){
		var d = $.Deferred();
        amplify.publish('loading', true);

        var conf = {
        	url: baseUrl + url,
        	type: 'POST',
            async: true,
            dataType: 'json',
            cache: false,
            contentType: 'application/json; charset=utf-8',
            data: JSON.stringify(data)
        }

        $.ajax(conf).then(function(ret){
            amplify.publish('loading', false);
            d.resolve(ret);
        }, function(errors){
            amplify.publish('loading', false);
            d.reject(errors);
        });
        return d.promise();
	}

	var put = function(url, data){
		var d = $.Deferred();
        amplify.publish('loading', true);

        var conf = {
        	url: baseUrl + url,
        	type: 'PUT',
            async: true,
            dataType: 'json',
            cache: false,
            contentType: 'application/json; charset=utf-8',
            data: JSON.stringify(data)
        }

        $.ajax(conf).then(function(ret){
            amplify.publish('loading', false);
            d.resolve(ret);
        }, function(errors){
            amplify.publish('loading', false);
            d.reject(errors);
        });
        return d.promise();
	}

	var del = function(url){
        var d = $.Deferred();
        amplify.publish('loading', true);

        var conf = {
        	url: baseUrl + url,
        	type: 'DELETE',
            async: true,
            dataType: 'json',
            cache: false
        }

        $.ajax(conf).then(function(data){
            amplify.publish('loading', false);
            d.resolve(data);
        }, function(errors){
            amplify.publish('loading', false);
            d.reject(errors);
        });
        return d.promise();
	}

    // -----------
	// /api/login
	// -----------
	var login = function(user, password){
		var d = $.Deferred();
        $.ajax({
            type: "GET",
            url: baseUrl + "login",
            dataType: 'json',
            async: true,
            headers: {
                "Authorization": "Basic " + btoa(user + ':' + password)
            },
            cache: false
        }).then(function(data){
            d.resolve(data);
        }, function(){
            d.reject();
        });
        return d.promise();
	}

    var ping = function() {
        return get('ping');
    }

    var logout = function() {
        return get('logout');
    }
}

module.exports = new Api();
