angular
  .module('app')
  .controller('TerresCtrl', Terres);

Terres.$inject = ['$scope', 'Assistents', '$state', '$http'];

function Terres($scope, Assistents, $state, $http) {
  $scope.edit = function (id) {
    $state.go('index.labassistent', {id: id});
  };

  $scope.assistents = Assistents.query();

  $scope.delete = function (id) {
    var url = 'api/terreslab/' + id;
    if (confirm("Estàs segur d'eliminar aquest usuari?")) {
      $http.delete(url)
      .then(function successCallback(response) {
        alert(response.data);
        $state.reload();
      }, function errorCallback(response) {
        alert(response.data);
      });
    }
  };
}
