angular
  .module('app')
  .controller('FilmsCtrl', Filmsctrl);

Filmsctrl.$inject = ['$scope', '$state', '$http'];

function Filmsctrl($scope, $state, $http) {
  $http.get('api/films')
  .then(function (data) {
    $scope.films = data.data;
  });

  $scope.filmdoc = function (id) {
    $state.go('index.filmdoc', {id: id});
  };
  $scope.filmcorp = function (id) {
    $state.go('index.filmcorp', {id: id});
  };
  $scope.filmtour = function (id) {
    $state.go('index.filmtour', {id: id});
  };
}
