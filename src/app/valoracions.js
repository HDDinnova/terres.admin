angular
  .module('app')
  .controller('ValoracionsCtrl', ValoracionsCtrl);

ValoracionsCtrl.$inject = ['Valoracions', '$log'];

function ValoracionsCtrl(Valoracions, $log) {
  var vm = this;
  vm.valoracions = Valoracions.query();
  $log.info(vm.valoracions);
}
