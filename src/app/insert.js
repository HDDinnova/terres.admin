angular
  .module('app')
  .controller('InsertCtrl', Insert);

Insert.$inject = ['$mdSidenav', '$scope'];

function Insert($mdSidenav, $scope) {
  /* jshint validthis: true */
  var vm = this;

  vm.toggleSidenav = function (menuId) {
    $mdSidenav(menuId).toggle();
  };
}
