angular
  .module('app')
  .controller('SustainAssistCtrl', SustainAssistCtrl);

SustainAssistCtrl.$inject = ['$scope', '$state', '$stateParams', '$http'];

function SustainAssistCtrl($scope, $state, $stateParams, $http) {
  var url = 'api/sustainable/' + $stateParams.id;
  $scope.user = [];

  $http.get(url)
  .then(function (data) {
    $scope.user = data.data;
  });

  $scope.saveComp = function () {
    $http.post('api/modifysustain/', $scope.user)
    .then(function (resp) {
      console.log(resp.data);
      if (resp.data.status === 200) {
        alert('Informació actualitzada amb èxit');
        $state.reload();
      } else {
        alert('Hi ha hagut un error, contacta amb Jordi ;-)');
      }
    });
  };
}
