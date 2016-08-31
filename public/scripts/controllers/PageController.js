(function() {

    'use strict';

    angular
        .module('app')
        .controller('PageController', PageController);

    function PageController($location, Auth, pagesResolve, httpAsPromise) {

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

            //Create page
            self.addPage = function() {

                httpAsPromise.post('http://localhost/cms/public/page', {
                    title: self.title,
                    visible: self.visible,
                    content: self.content,
                    subject_id: self.subject_id
                }).success(function(response) {
                    location.reload();
                    self.pages.unshift(response.pages);
                    self.title_name = '';
                }).error(function() {
                    console.log("error");
                });
            };

            //Delete page
            self.deletePage = function(pageId) {
                var isConfirmDelete = confirm('Are you sure you want this record?');

                if (isConfirmDelete) {
                    httpAsPromise.delete('http://localhost/cms/public/page/' + pageId)

                    .success(function() {
                        location.reload();
                    });
                }
            }

        
        self.logout = Auth.logout;
    }

    PageController.$inject = ['$location', 'Auth', 'pagesResolve', 'httpAsPromise'];
})();
