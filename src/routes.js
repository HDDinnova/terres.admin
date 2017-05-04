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
    })
    .state('index.sustain', {
      url: 'sustainable-day',
      templateUrl: 'app/sustain.html',
      controller: 'SustainCtrl',
      controllerAs: 'sustain'
    })
    .state('index.sustainassistent', {
      url: 'sustainable-assistent/{id}',
      params: {
        id: null
      },
      templateUrl: 'app/sustainassistent.html',
      controller: 'SustainAssistCtrl'
    })
    .state('index.email', {
      url: 'mailing',
      templateUrl: 'app/email.html',
      controller: 'EmailCtrl',
      controllerAs: 'email'
    })
    .state('index.valfilmtour', {
      url: 'valoracions/turistics/{id}',
      params: {
        id: null
      },
      templateUrl: 'app/valfilmtour.html',
      controller: 'ValTourCtrl'
    })
    .state('index.valfilmcorp', {
      url: 'valoracions/corporatius/{id}',
      params: {
        id: null
      },
      templateUrl: 'app/valfilmcorp.html',
      controller: 'ValCorpCtrl'
    })
    .state('index.valfilmdoc', {
      url: 'valoracions/documentals/{id}',
      params: {
        id: null
      },
      templateUrl: 'app/valfilmdoc.html',
      controller: 'ValDocCtrl'
    });
}
