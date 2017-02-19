angular
  .module('app')
  .controller('TerresCtrl', Terres);

Terres.$inject = ['$scope', 'Assistents', '$state'];

function Terres($scope, Assistents, $state) {
  $scope.edit = function (id) {
      $state.go('index.labassistent', {id: id});
  };

  $scope.assistents = Assistents.query();
}
