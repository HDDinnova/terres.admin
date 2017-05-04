angular
  .module('app')
  .controller('SustainCtrl', Sustain);

Sustain.$inject = ['Sustainable', '$state', '$http'];

function Sustain(Sustainable, $state, $http) {
  var vm = this;

  vm.processSustain = function () {
    var m = Sustainable.create(vm.formData).$promise;
    m.then(function () {
      $state.reload();
    });
  };

  vm.assistents = Sustainable.query();

  vm.delete = function (id) {
    var url = 'api/sustainable/' + id;
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
    $state.go('index.sustainassistent', {id: id});
  };
}
