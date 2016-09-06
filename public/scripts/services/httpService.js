(function() {
    'use strict';

    function httpAsPromise($q, $http) {
        return {
            fetch: function(endpoint) {
                return $http.get(endpoint).then(function (response) {                     
                    return response.data; 
                });
            },
            post: function(endpoint, obj) {           
                return $http.post(endpoint, obj).success(function (response) {
                }).error(function() {
                    console.log("error");
                });
            },
            put: function(endpoint, obj) {
                return $http.put(endpoint, obj).success(function (response) {
                }).error(function() {
                    console.log("error");
                });
            },
            delete: function(endpoint) {
                return $http.delete(endpoint).success(function (response) {
                }).error(function() {
                    console.log("error");
                });
            }
        }
    }

    httpAsPromise.$inject = ['$q', '$http'];

    angular.module('app')
        .factory('httpAsPromise', httpAsPromise);
})();