angular
  .module('app')
  .controller('FilmcorpCtrl', Filmcorp);

Filmcorp.$inject = ['$scope', '$rootScope', '$state', '$stateParams', '$http', 'Upload'];

function Filmcorp($scope, $rootScope, $state, $stateParams, $http, Upload) {
  $rootScope.loading = true;
  var url = 'api/film/corp/' + $stateParams.id;
  $scope.film = [];

  $http.get(url)
  .then(function (data) {
    $scope.film = data.data;
    $rootScope.loading = false;
  });

  $scope.upload = function (file) {
    $rootScope.loading = true;
    var url = 'api/upload/corporatefilms/' + $scope.film.id;
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
    $http.post('api/modifycorpfilm/', $scope.film)
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
