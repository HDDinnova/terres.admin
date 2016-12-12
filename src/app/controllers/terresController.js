(function(){

  angular
    .module('app')
    .controller('terresController', [
      'terresService',
      terresController
    ]);

  function terresController(terresService) {
    var vm = this;

    vm.tableData = [];

    terresService
      .loadAllItems()
      .then(function(tableData) {
        vm.tableData = [].concat(tableData);
      });
  }

})();
