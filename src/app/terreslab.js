angular
  .module('app')
  .controller('TerresCtrl', Terres);

Terres.$inject = ['$mdSidenav', '$scope', 'Assistents'];

function Terres($mdSidenav, $scope, Assistents) {
  /* jshint validthis: true */
  var vm = this;

  vm.toggleSidenav = function (menuId) {
    $mdSidenav(menuId).toggle();
  };

  $scope.assistents = Assistents.query();
}
