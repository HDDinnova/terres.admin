angular
  .module('app')
  .controller('AddLabCtrl', AddLab);

AddLab.$inject = ['$mdSidenav', '$scope', '$state', '$http'];

function AddLab($mdSidenav, $scope, $state, $http) {
  $scope.processTL = function () {
    $http.post('api/addterreslab', $scope.formData)
    .then(function (data) {
      if (data.status === 200) {
        $state.go('index.terreslab');
      }
    });
  };
}
