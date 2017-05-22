angular
  .module('app')
  .controller('WinnersCtrl', WinnersCtrl);

WinnersCtrl.$inject = ['Winners'];

function WinnersCtrl(Winners) {
  var vm = this;
  vm.pass = false;
  vm.winners = Winners.query();

  vm.res = prompt("Introdueix la contrasenya");

  if (vm.res === 'valoracions') {
    vm.pass = true;
  }
}
