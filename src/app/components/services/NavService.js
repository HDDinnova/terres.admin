(function(){
  'use strict';

  angular.module('app')
          .service('navService', ['$q', navService]);

  function navService($q){
    var menuItems = [
      {
        name: 'terres Catalunya',
        icon: 'terres.svg',
        sref: '.terres'
      },
      {
        name: 'terres LAB',
        icon: 'terreslab.svg',
        sref: '.terreslab'
      },
      {
        name: 'Afegir competidors',
        icon: 'view_module',
        sref: '.table'
      }
    ];

    return {
      loadAllItems : function() {
        return $q.when(menuItems);
      }
    };
  }

})();
