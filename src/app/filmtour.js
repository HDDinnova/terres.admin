angular
  .module('app')
  .controller('FilmtourCtrl', Filmtour);

Filmtour.$inject = ['$scope', '$rootScope', '$state', '$stateParams', '$http', 'Upload'];

function Filmtour($scope, $rootScope, $state, $stateParams, $http, Upload) {
  $rootScope.loading = true;
  var url = 'api/film/tour/' + $stateParams.id;
  $scope.film = [];

  $http.get(url)
  .then(function (data) {
    $scope.film = data.data;
    $rootScope.loading = false;
  });

  $scope.upload = function (file) {
    $rootScope.loading = true;
    var url = 'api/upload/tourismfilms/' + $scope.film.id;
    Upload.upload({
      url: url,
      data: {file: file}
    }).then(function (data) {
      if (data.status === 200) {
        $state.reload();
      }
    }, function (resp) {
      console.log('Error status: ' + resp.status);
    }, function (evt) {
      $rootScope.percentage = parseInt(100.0 * evt.loaded / evt.total, 10);
    });
  };
}
