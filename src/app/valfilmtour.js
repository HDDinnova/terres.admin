angular
  .module('app')
  .controller('ValTourCtrl', ValTourCtrl);

ValTourCtrl.$inject = ['$scope', '$stateParams', '$http'];

function ValTourCtrl($scope, $stateParams, $http) {
  var url = 'api/valtourfilm/' + $stateParams.id;
  console.log(url);
  $http.get(url)
  .then(function (res) {
    console.log(res);
    $scope.valoracions = res.data;
  });
}
