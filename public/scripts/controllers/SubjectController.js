(function() {

    'use strict';

    angular
        .module('app')
        .controller('SubjectController', SubjectController);

    function SubjectController($http, $auth, $rootScope, $location, $state, $stateParams, Auth, subjectsResolve, httpAsPromise) {

        var self = this;
        self.subjectsResolve = subjectsResolve;
        //console.log(subjectsResolve);


        //Visibility Object
        self.objVisible = [{ name: 'Visible', value: 1 }, { name: 'Invisible', value: 0 }];

        

            self.subjects = subjectsResolve.subjects;
            self.subjectsVisible = subjectsResolve.subjectsVisible;
            self.pages = subjectsResolve.pages;

            //Filter Visible Pages for each Subject
            self.filterPages = function(subject) {
                var filtered = self.pages.filter(function(page) {
                    return (page.subject_id === subject.id && page.visible === 1);
                })
                return filtered;
            }

            //Find the length of subjects array plus 1
            self.subjectsLength = function() {
                var ar = [];
                for (var i = 1; i <= self.subjects.length + 1; i++) {
                    ar.push(i);
                }
                return ar;
            }

            //Create subject
            self.addSubject = function() {
                httpAsPromise.post('http://localhost/cms/public/subject', {
                    name: self.name,
                    visible: self.visible,
                    position: self.position

                }).success(function(response) {
                    location.reload();
                    self.subjects.unshift(response.subjects);
                    self.subject_name = '';
                }).error(function() {
                    console.log("error");
                });
            };

            //Delete Subject
            self.deleteSubject = function(subjectId) {
                var isConfirmDelete = confirm('Are you sure you want this record?');

                if (isConfirmDelete) {
                    httpAsPromise.delete('http://localhost/cms/public/subject/' + subjectId)

                    .success(function() {
                        location.reload();
                    });
                }
            }
       

        self.logout = Auth.logout;
    }

    SubjectController.$inject = ['$http', '$auth', '$rootScope', '$location', '$state', '$stateParams', 'Auth', 'subjectsResolve', 'httpAsPromise'];

})();
