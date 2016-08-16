(function() {

    'use strict';

    angular
        .module('app')
        .controller('AuthController', AuthController);


    function AuthController($auth, $state, $http, $rootScope, Auth) {

        var self = this;

        self.login = function() {
            var credentials = {
                email: self.email,
                password: self.password
            }

            Auth.login(credentials);
        };

        self.logout = Auth.logout;
    }

})();
