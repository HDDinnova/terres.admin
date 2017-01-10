angular
  .module('app')
  .controller('LayoutCtrl', Layout);

Layout.$inject = ['$mdSidenav'];

function Layout($mdSidenav) {
  /* jshint validthis: true */
  var vm = this;

  vm.toggleSidenav = function (menuId) {
    $mdSidenav(menuId).toggle();
  };

  var originatorEv;
  vm.openMenu = function ($mdOpenMenu, ev) {
    originatorEv = ev;
    $mdOpenMenu(originatorEv);
  };
}
