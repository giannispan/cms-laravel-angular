(function() {

    'use strict';

    angular
        .module('app')
        .controller('PageController', PageController);

    function PageController($http, $auth, $rootScope, $location, $state, Auth, pagesResolve) {

        var self = this;
        self.pagesResolve = pagesResolve;
        //console.log(pagesResolve);

        //Visibility Object
        self.pageVisible = [{ name: 'Visible', value: 1 }, { name: 'Invisible', value: 0 }];


            self.subjects = pagesResolve.subjects;
            self.subjectsVisible = pagesResolve.subjectsVisible;
            self.pages = pagesResolve.pages;

            //Filter Visible Pages for each Subject
            self.filterPages = function(subject) {
                var filtered = self.pages.filter(function(page) {
                    return (page.subject_id === subject.id && page.visible === 1);
                });
                return filtered;
            }

            //Create subject
            self.addPage = function() {

                $http.post('http://localhost/cms/public/page', {
                    title: self.title,
                    visible: self.visible,
                    content: self.content,
                    subject_id: self.subject_id
                }).success(function(response) {
                    console.log(response);
                    location.reload();
                    self.pages.unshift(response.pages);
                    console.log(self.pages.pages);
                    self.title_name = '';
                }).error(function() {
                    console.log("error");
                });
            };

            //Delete Subject
            self.deletePage = function(pageId) {
                var isConfirmDelete = confirm('Are you sure you want this record?');

                if (isConfirmDelete) {
                    $http.delete('http://localhost/cms/public/page/' + pageId)

                    .success(function() {
                        location.reload();
                    });
                }
            }

        
        self.logout = Auth.logout;
    }

    PageController.$inject = ['$http', '$auth', '$rootScope', '$location', '$state', 'Auth', 'pagesResolve'];
})();
