angular
  .module('app')
  .controller('DashCtrl', Dashboard);

Dashboard.$inject = ['$mdSidenav', '$scope', 'Competitors'];

function Dashboard($mdSidenav, $scope, Competitors) {
  /* jshint validthis: true */
  var vm = this;

  vm.toggleSidenav = function (menuId) {
    $mdSidenav(menuId).toggle();
  };

  $scope.competitors = Competitors.query();
}
