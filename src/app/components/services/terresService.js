(function(){
  'use strict';

  angular.module('app')
        .service('terresService', [
        '$q', Competidors,
      terresService
  ])
        .factory('Competidors', [
        '$resource',
        Competidors
  ]);

  function terresService($q, Competidors){
    var tableData = Competidors.query();

    return {
      loadAllItems : function() {
        return $q.when(tableData);
      }
    };
  }

  function Competidors($resource) {
    return $resource('/api/competitors/:id');
  }
})();
