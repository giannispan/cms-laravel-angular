(function() {
    'use strict';

    function httpService($http) {
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

    httpService.$inject = ['$http'];

    angular.module('app')
        .factory('httpService', httpService);
})();