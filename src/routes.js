angular
  .module('app')
  .config(routesConfig);

function routesConfig($stateProvider, $urlRouterProvider, $locationProvider) {
  $locationProvider.html5Mode(true);
  $urlRouterProvider.otherwise('/');

  $stateProvider
    .state('index', {
      url: '/',
      abstract: true,
      templateUrl: 'app/main.html'
    })
    .state('index.dashboard', {
      url: '',
      templateUrl: 'app/dashboard.html',
      controller: 'DashCtrl',
      controllerAs: 'dash'
    })
    .state('index.terreslab', {
      url: '',
      templateUrl: 'app/terreslab.html',
      controller: 'TerresCtrl',
      controllerAs: 'terres'
    })
    .state('index.addcompetitor', {
      url: '',
      templateUrl: 'app/insert.html',
      controller: 'InsertCtrl',
      controllerAs: 'insert'
    });
}
