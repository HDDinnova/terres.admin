angular
  .module('app')
  .controller('InsertCtrl', Insert);

Insert.$inject = ['$mdSidenav', '$scope', '$http'];

function Insert($mdSidenav, $scope, $http) {
  /* jshint validthis: true */
  var vm = this;

  vm.toggleSidenav = function (menuId) {
    $mdSidenav(menuId).toggle();
  };

  $scope.send = function () {
    $http.post('api/', $scope.user)
    .then(function (data) {
      console.log(data.data);
    });
  };
}
