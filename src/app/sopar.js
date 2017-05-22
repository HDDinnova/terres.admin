angular
  .module('app')
  .controller('SoparCtrl', SoparCtrl);

SoparCtrl.$inject = ['Sopardades', '$state', '$http'];

function SoparCtrl(Sopardades, $state, $http) {
  var vm = this;

  vm.processSustain = function () {
    var m = Sopardades.create(vm.formData).$promise;
    m.then(function () {
      $state.reload();
    });
  };

  vm.assistents = Sopardades.query();

  vm.delete = function (id) {
    var url = 'api/sopar/' + id;
    if (confirm("Estàs segur d'eliminar aquest usuari?")) {
      $http.delete(url)
      .then(function successCallback(response) {
        alert(response.data);
        $state.reload();
      }, function errorCallback(response) {
        alert(response.data);
      });
    }
  };

  vm.edit = function (id) {
    $state.go('index.soparassistent', {id: id});
  };
}
