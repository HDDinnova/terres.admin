angular
  .module('app')
  .controller('SustainCtrl', Sustain);

Sustain.$inject = ['Sustainable', '$state', '$log'];

function Sustain(Sustainable, $state, $log) {
  var vm = this;

  vm.processSustain = function () {
    $log.info(vm.formData);
    var m = Sustainable.create(vm.formData).$promise;
    m.then(function () {
      $state.reload();
    });
  };

  vm.assistents = Sustainable.query();
}
