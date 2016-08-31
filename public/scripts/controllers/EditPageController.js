(function() {

    'use strict';

    angular
        .module('app')
        .controller('EditPageController', EditPageController);

    function EditPageController($http, $location, $stateParams, Auth, httpAsPromise) {
        var self = this;

        //Visibility Object
        self.pageVisible = [{ name: 'Visible', value: 1 }, { name: 'Invisible', value: 0 }];

        $http.get('http://localhost/cms/public/page/' + $stateParams.id + '/edit').success(function(page, subjects) {


            self.page = page.page;
            self.subjects = page.subjects;

            self.updatePage = function(pageId) {
                httpAsPromise.put('http://localhost/cms/public/page/' + $stateParams.id + '/update', {
                    title: self.page.title,
                    visible: self.page.visible,
                    content: self.page.content,
                    subject_id: self.page.subject_id
                }).success(function(response) {
                    location.href = '/cms/public/#/pages';
                }).error(function() {
                    console.log("error");
                });
            }
        }).error(function(error) {
            self.error = error;
        });

        self.logout = Auth.logout;
    }

    EditPageController.$inject = ['$http', '$location', '$stateParams', 'Auth', 'httpAsPromise'];

})();
