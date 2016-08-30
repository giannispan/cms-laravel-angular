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
                var deferred = $q.defer();
                $http.post(endpoint, obj)
                    .success(function(data) {
                        deferred.resolve(data);
                    }).error(function() {
                        deferred.reject();
                    });
                return deferred.promise;
            },
            put: function(endpoint, obj) {
                var deferred = $q.defer();
                $http.put(endpoint, obj)
                    .success(function(data) {
                        deferred.resolve(data);
                    }).error(function() {
                        deferred.reject();
                    });
                return deferred.promise;
            }
        }
    }

    httpAsPromise.$inject = ['$q', '$http'];

    angular.module('app')
        .factory('httpAsPromise', httpAsPromise);
})();