angular
  .module('app')
  .controller('FilmtourCtrl', Filmtour);

Filmtour.$inject = ['$scope', '$rootScope', '$state', '$stateParams', '$http', 'Upload'];

function Filmtour($scope, $rootScope, $state, $stateParams, $http, Upload) {
  $scope.max = 3;
  $scope.checked = 0;
  $scope.checkChanged = function (item) {
    if (item === '1') {
      ++$scope.checked;
    } else {
      --$scope.checked;
    }
  };

  $rootScope.loading = true;
  var url = 'api/film/tour/' + $stateParams.id;
  $scope.film = [];

  $http.get(url)
  .then(function (data) {
    $scope.film = data.data;
    $rootScope.loading = false;
    if ($scope.film.travel === '1') {
      ++$scope.checked;
    }
    if ($scope.film.sports === '1') {
      ++$scope.checked;
    }
    if ($scope.film.expedition === '1') {
      ++$scope.checked;
    }
    if ($scope.film.hotels === '1') {
      ++$scope.checked;
    }
    if ($scope.film.events === '1') {
      ++$scope.checked;
    }
    if ($scope.film.health === '1') {
      ++$scope.checked;
    }
    if ($scope.film.enotourism === '1') {
      ++$scope.checked;
    }
    if ($scope.film.destinations === '1') {
      ++$scope.checked;
    }
    if ($scope.film.animation === '1') {
      ++$scope.checked;
    }
    if ($scope.film.rural === '1') {
      ++$scope.checked;
    }
    if ($scope.film.cultural === '1') {
      ++$scope.checked;
    }
    if ($scope.film.naturaltour === '1') {
      ++$scope.checked;
    }
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

  $scope.save = function () {
    $http.post('api/modifytourfilm/', $scope.film)
    .then(function (resp) {
      console.log(resp.data);
      if (resp.data.status === 200) {
        alert('Informació actualitzada amb èxit');
        $state.reload();
      } else {
        alert('Hi ha hagut un error, contacta amb Jordi ;-)');
      }
    });
  };
}
