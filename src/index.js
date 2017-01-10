angular
  .module('app', ['ui.router', 'ngAnimate', 'ngMaterial', 'ngResource', 'ngMdIcons', 'md.data.table'])
  .config(function ($mdThemingProvider) {
    $mdThemingProvider.theme('default')
      .primaryPalette('blue-grey', {
        'default': '400',
        'hue-1': '50'
      })
      .accentPalette('light-blue');
  });
