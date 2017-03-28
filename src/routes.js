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
      url: 'terreslab',
      templateUrl: 'app/terreslab.html',
      controller: 'TerresCtrl',
      controllerAs: 'terres'
    })
    .state('index.addterreslab', {
      url: 'afegir-assistent',
      templateUrl: 'app/addterreslab.html',
      controller: 'AddLabCtrl',
      controllerAs: 'AddLab'
    })
    .state('index.labassistent', {
      url: 'assistent/{id}',
      params: {
        id: null
      },
      templateUrl: 'app/labassistent.html',
      controller: 'LabassistCtrl'
    })
    .state('index.addcompetitor', {
      url: 'afegir-competidor',
      templateUrl: 'app/insert.html',
      controller: 'InsertCtrl',
      controllerAs: 'insert'
    })
    .state('index.competitor', {
      url: 'competidor/{id}',
      params: {
        id: null
      },
      templateUrl: 'app/competitor.html',
      controller: 'CompCtrl',
      controllerAs: 'compctrl'
    })
    .state('index.filmdoc', {
      url: 'films/documentals/{id}',
      params: {
        id: null
      },
      templateUrl: 'app/filmdoc.html',
      controller: 'FilmdocCtrl',
      controllerAs: 'filmdoc'
    })
    .state('index.filmcorp', {
      url: 'films/corporatius/{id}',
      params: {
        id: null
      },
      templateUrl: 'app/filmcorp.html',
      controller: 'FilmcorpCtrl',
      controllerAs: 'filmcorp'
    })
    .state('index.filmtour', {
      url: 'films/turistics/{id}',
      params: {
        id: null
      },
      templateUrl: 'app/filmtour.html',
      controller: 'FilmtourCtrl',
      controllerAs: 'filmtour'
    })
    .state('index.films', {
      url: 'films',
      templateUrl: 'app/films.html',
      controller: 'FilmsCtrl',
      controllerAs: 'films'
    })
    .state('index.memberjury', {
      url: 'membresjurat',
      templateUrl: 'app/memberjury.html',
      controller: 'MemberCtrl',
      controllerAs: 'memberjury'
    })
    .state('index.jury', {
      url: 'valoracions',
      templateUrl: 'app/valoracions.html',
      controller: 'ValoracionsCtrl',
      controllerAs: 'valoracions'
    });
}
