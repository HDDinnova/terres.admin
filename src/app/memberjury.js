angular
  .module('app')
  .controller('MemberCtrl', MemberCtrl);

MemberCtrl.$inject = ['$state', '$log', 'Member'];

function MemberCtrl($state, $log, Member) {
  var vm = this;
  vm.members = Member.query();
  $log.info(vm.members);
  vm.crear = function () {
    var m = Member.create(vm.user).$promise;
    m.then(function () {
      $state.reload();
    });
  };
}
