var app = angular.module('app',[
  'ngRoute',
  'relationshipControllers'
]).constant('API_URL', 'http://localhost/musejam/public/api/');;

app.config(['$routeProvider', function($routeProvider){
  $routeProvider.
  when('/',{
    templateUrl: 'angular/pages/home.html',
    controller: 'homeController'
  }).
  otherwise({
    redirectTo: '/'
  });
}]);
