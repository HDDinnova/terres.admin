angular
  .module('app')
  .controller('ValDocCtrl', ValDocCtrl);

ValDocCtrl.$inject = ['$scope', '$stateParams', '$http'];

function ValDocCtrl($scope, $stateParams, $http) {
  var url = 'api/valdocfilm/' + $stateParams.id;
  console.log(url);
  $http.get(url)
  .then(function (res) {
    console.log(res);
    $scope.valoracions = res.data;
  });
}
