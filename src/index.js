angular
  .module('app', ['ui.router', 'ngAnimate', 'ngMaterial', 'ngResource', 'ngMdIcons', 'md.data.table', 'ngFileUpload'])
  .config(function ($mdThemingProvider) {
    $mdThemingProvider.theme('default')
      .primaryPalette('red')
      .accentPalette('light-blue');
  });
