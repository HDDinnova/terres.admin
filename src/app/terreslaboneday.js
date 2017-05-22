angular
  .module('app')
  .controller('TerresOneDayCtrl', TerresOneDayCtrl);

TerresOneDayCtrl.$inject = ['$scope', 'Oneday'];

function TerresOneDayCtrl($scope, Oneday) {
  $scope.oneday = Oneday.query();
}
