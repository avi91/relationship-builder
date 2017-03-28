var relationshipControllers = angular.module('relationshipControllers',[]);

relationshipControllers.controller('homeController',['$scope', '$http', function($scope, $http){
    $scope.getUsers = function(){
      $http({
        method: 'GET',
        url: "api/users"
      }).then(function(success){
        $scope.users = success.data;
      })
    };

    $scope.getTags = function(){
        $http({
        method: 'GET',
        url: "api/tags"
      }).then(function(success){
        $scope.tags = success.data;
      })
    };
    $scope.addUser = function(username){
      $http({
        method: 'POST',
        url: "api/users",
        data: {
          name: username
        }
      }).then(function(success){
        console.log(success);
        $scope.username = '';
        $scope.getUsers();
      });
    };

    $scope.addTag = function(tagname){
      $http({
        method: 'POST',
        url: "api/tags",
        data: {
          tag: tagname
        }
      }).then(function(success){
        console.log(success);
        $scope.tagname = '';
        $scope.getTags();
      });
    };
    $scope.showRelations = function(id){
      $http({
        method: 'GET',
        url: 'api/relationships/'+id
      }).then(function(success){
          $scope.relationship = success.data;
      })
    };
    $scope.showRelations(1);

    $scope.addRelation = function(){
        $http({
          method: 'POST',
          url: 'api/relationships/add',
          data: {
            user1: $scope.user2option,
            user2: $scope.relationship.user.id,
            tag: $scope.tagoption
          }
        }).then(function(success){
          console.log(success);
          $scope.showRelations($scope.relationship.user.id);
        })
    };

    $scope.norelation = false;
    $scope.showdegree = false;
    $scope.recheck = true;
    $scope.showPath = function(id1, id2){
      $scope.recheck = true;
      $('.check-relation').addClass('loading');
      $http({
        method: 'GET',
        url: 'api/path/'+id1+'/to/'+id2
      }).then(function(success){
        $('.check-relation').removeClass('loading');
        if(success.data.result == 'success'){
          $scope.norelation = false;
          $scope.showdegree = true;
          $scope.recheck = false;
          $scope.paths = success.data;
        }
        else {
          $scope.recheck = false;
          $scope.paths = success.data;
          $scope.paths.path = '';
          $scope.showdegree = false;
          $scope.norelation = true;
        }
      })
    };
    $scope.showPath(1,7);
}]);
