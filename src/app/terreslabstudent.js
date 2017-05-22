angular
  .module('app')
  .controller('TerresStudentCtrl', TerresStudentCtrl);

TerresStudentCtrl.$inject = ['$scope', 'Estudiants'];

function TerresStudentCtrl($scope, Estudiants) {
  $scope.estudiants = Estudiants.query();
}
