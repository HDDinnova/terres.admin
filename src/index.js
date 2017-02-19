angular
  .module('app', ['ui.router', 'ngAnimate', 'ngMaterial', 'ngResource', 'ngMdIcons', 'md.data.table', 'ngFileUpload', 'naif.base64', 'ngSanitize'])
  .config(function ($mdThemingProvider) {
    $mdThemingProvider.theme('default')
      .primaryPalette('red')
      .accentPalette('indigo');
  });
