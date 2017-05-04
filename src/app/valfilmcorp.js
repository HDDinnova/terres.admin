angular
  .module('app')
  .controller('ValCorpCtrl', ValCorpCtrl);

ValCorpCtrl.$inject = ['$scope', '$stateParams', '$http'];

function ValCorpCtrl($scope, $stateParams, $http) {
  var url = 'api/valcorpfilm/' + $stateParams.id;
  console.log(url);
  $http.get(url)
  .then(function (res) {
    console.log(res);
    $scope.valoracions = res.data;
  });
}
