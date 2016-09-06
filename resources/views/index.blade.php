<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Simple CMS Laravel - Angular</title>

        <!-- Fonts -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

        <!-- Styles -->
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
        
    </head>
    <body ng-app="app">
            <div ui-view></div>             
    </body>

    <!-- Application Dependencies -->
    <script src="node_modules/angular/angular.js"></script>
    <script src="node_modules/angular-ui-router/release/angular-ui-router.js"></script>
    <script src="node_modules/satellizer/dist/satellizer.js"></script>

    <!-- Application Scripts -->
    <script src="scripts/app.js"></script>

    <!-- services -->
    <script src="scripts/services/AuthService/authService.js"></script>
    <script src="scripts/services/httpService.js"></script>

    <!-- directives -->
    <script src="scripts/directives/menu.js"></script>

    <!-- controllers -->
    <script src="scripts/controllers/AuthController.js"></script>
    <script src="scripts/controllers/SubjectController.js"></script>
    <script src="scripts/controllers/EditSubjectController.js"></script>
    <script src="scripts/controllers/PageController.js"></script>
    <script src="scripts/controllers/EditPageController.js"></script>
</html>
