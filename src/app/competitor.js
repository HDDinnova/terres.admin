angular
  .module('app')
  .controller('CompCtrl', Competitor);

Competitor.$inject = ['$scope', '$state', '$stateParams', '$http'];

function Competitor($scope, $state, $stateParams, $http) {
  var url = 'api/competitor/' + $stateParams.id;
  $scope.user = [];
  $scope.film = {};

  $http.get(url)
  .then(function (data) {
    $scope.user = data.data;
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

  $scope.addDoc = function () {
    var url = 'api/addfilm/documentary/' + $scope.user.id;
    if (angular.isUndefined($scope.film.titledoc)) {
      alert('Escriu un títol de película');
    } else {
      if (angular.isUndefined($scope.film.section)) {
        $scope.film.section = '1';
      }
      $http.post(url, $scope.film)
      .then(function (data) {
        if (data.status === 200) {
          $state.reload();
        }
      });
    }
  };

  $scope.addTour = function () {
    var url = 'api/addfilm/tourism/' + $scope.user.id;
    if (angular.isUndefined($scope.film.titletour)) {
      alert('Escriu un títol de película');
    } else {
      if (angular.isUndefined($scope.film.section)) {
        $scope.film.section = '1';
      }
      $http.post(url, $scope.film)
      .then(function (data) {
        if (data.status === 200) {
          $state.reload();
        }
      });
    }
  };

  $scope.addCorp = function () {
    var url = 'api/addfilm/corporate/' + $scope.user.id;
    if (angular.isUndefined($scope.film.titlecorp)) {
      alert('Escriu un títol de película');
    } else {
      if (angular.isUndefined($scope.film.section)) {
        $scope.film.section = '1';
      }
      $http.post(url, $scope.film)
      .then(function (data) {
        if (data.status === 200) {
          $state.reload();
        }
      });
    }
  };

  $scope.save = function () {
    var factu = {};
    factu.id = $scope.user.id;
    factu.factura = $scope.user.factura;
    factu.payment = $scope.user.payment;
    factu.numfactura = $scope.user.numfactura;
    $http.post('api/saveuser/', factu)
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

  $scope.saveComp = function () {
    $http.post('api/modifyuser/', $scope.user)
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
