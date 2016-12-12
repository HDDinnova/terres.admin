(function(){
  'use strict';

  angular.module('app')
          .service('navService', ['$q', navService]);

  function navService($q){
    var menuItems = [
      {
        name: 'terres Catalunya',
        icon: 'dashboard',
        sref: '.dashboard'
      },
      {
        name: 'terres LAB',
        icon: 'person',
        sref: '.profile'
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
