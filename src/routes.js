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
    .state('index.addterreslab', {
      url: '',
      templateUrl: 'app/addterreslab.html',
      controller: 'AddLabCtrl',
      controllerAs: 'AddLab'
    })
    .state('index.addcompetitor', {
      url: '',
      templateUrl: 'app/insert.html',
      controller: 'InsertCtrl',
      controllerAs: 'insert'
    })
    .state('index.competitor', {
      url: '',
      params: {
        id: null
      },
      templateUrl: 'app/competitor.html',
      controller: 'CompCtrl',
      controllerAs: 'compctrl'
    })
    .state('index.filmdoc', {
      url: '',
      params: {
        id: null
      },
      templateUrl: 'app/filmdoc.html',
      controller: 'FilmdocCtrl',
      controllerAs: 'filmdoc'
    })
    .state('index.filmcorp', {
      url: '',
      params: {
        id: null
      },
      templateUrl: 'app/filmcorp.html',
      controller: 'FilmcorpCtrl',
      controllerAs: 'filmcorp'
    })
    .state('index.filmtour', {
      url: '',
      params: {
        id: null
      },
      templateUrl: 'app/filmtour.html',
      controller: 'FilmtourCtrl',
      controllerAs: 'filmtour'
    });
}
