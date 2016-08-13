(function() {

    'use strict';

    angular
        .module('app')
        .controller('EditSubjectController', EditSubjectController);

    function EditSubjectController($http, $auth, $rootScope, $location, $state, $stateParams, Auth) {

        var self = this;

        //Visibility Object
        self.objVisible = [{ name: 'Visible', value: 1 }, { name: 'Invisible', value: 0 }];

        $http.get('http://localhost/cms/public/subject/' + $stateParams.id + '/edit').success(function(subject) {


            self.subject = subject.subject;
            self.subjects = subject.subjects;

            //Find the length of subjects array plus 1
            self.subjectsLengthEdit = function() {
                var ar = [];
                for (var i = 1; i <= self.subjects.length; i++) {
                    ar.push(i);
                }
                return ar;
            }

            self.updateSubject = function(subjectId) {
                $http.put('http://localhost/cms/public/subject/' + $stateParams.id + '/update', {
                    name: self.subject.name,
                    visible: self.subject.visible,
                    position: self.subject.position
                }).success(function(response) {
                    // alert("Joke Updated Successfully");
                }).error(function() {
                    console.log("error");
                });
            }

            console.log(subject);
        }).error(function(error) {
            self.error = error;
        });

        self.logout = Auth.logout;
    }

    EditSubjectController.$inject = ['$http', '$auth', '$rootScope', '$location', '$state', '$stateParams', 'Auth'];
})();
