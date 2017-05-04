angular
  .module('app')
  .controller('ValoracionsCtrl', ValoracionsCtrl);

ValoracionsCtrl.$inject = ['Valoracions'];

function ValoracionsCtrl(Valoracions) {
  var vm = this;
  vm.valoracions = Valoracions.query();
}
