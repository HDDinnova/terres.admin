angular
  .module('app', ['ui.router', 'ngMaterial', 'ngResource', 'ngMdIcons', 'md.data.table', 'ngFileUpload', 'naif.base64', 'ngSanitize', 'angularTrix'])
  .config(function ($mdThemingProvider) {
    $mdThemingProvider.theme('default')
      .primaryPalette('red')
      .accentPalette('indigo');
  });
