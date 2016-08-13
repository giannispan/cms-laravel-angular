(function() {
	'use strict';

	function Controller(Auth, $rootScope) {
		var self = this;

		self.currentUser = $rootScope.currentUser;
		self.logout = Auth.logout;
	}

	function directive() {
		return {
			restrict: 'E',
			templateUrl: 'scripts/directives/menu.html',
			controller: ['Auth', '$rootScope', Controller],
			controllerAs: 'vm',
			bindToController: true
		}
	}

	angular.module('app')
		.directive('menu', directive);
})();