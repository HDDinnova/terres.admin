angular
  .module('app')
  .controller('CompCtrl', Competitor);

Competitor.$inject = ['$scope', '$state', '$stateParams', '$http'];

function Competitor($scope, $state, $stateParams, $http) {
  var url = 'api/competitor/' + $stateParams.id;
  $scope.user = [];
  $scope.film = {};
  $scope.addfilm = {};

  $http.get(url)
  .then(function (data) {
    $scope.user = data.data;
    $scope.diftour = $scope.user.tourism.nfilms - Object.keys($scope.user.tourism.title).length;
    $scope.difcorp = $scope.user.corporate.nfilms - Object.keys($scope.user.corporate.title).length;
    $scope.difdoc = $scope.user.documentary.nfilms - Object.keys($scope.user.documentary.title).length;
    if (isNaN($scope.diftour)) {
      $scope.diftour = 0;
    }
    if (isNaN($scope.difcorp)) {
      $scope.difcorp = 0;
    }
    if (isNaN($scope.difdoc)) {
      $scope.difdoc = 0;
    }
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
    var url = 'api/addfilm/documentary/' + $scope.user.id + '/false';
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
    var url = 'api/addfilm/tourism/' + $scope.user.id + '/false';
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
    var url = 'api/addfilm/corporate/' + $scope.user.id + '/false';
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

  $scope.addfilmtour = function () {
    var url = 'api/addfilm/tourism/' + $scope.user.id + '/true';
    console.log(url);
    if (angular.isUndefined($scope.addfilm.titletour)) {
      alert('Escriu un títol de película');
    } else {
      if (angular.isUndefined($scope.addfilm.section)) {
        $scope.addfilm.section = '1';
      }
      $http.post(url, $scope.addfilm)
      .then(function (data) {
        if (data.status === 200) {
          $state.reload();
        }
      });
    }
  };

  $scope.addfilmdoc = function () {
    var url = 'api/addfilm/documentary/' + $scope.user.id + '/true';
    console.log(url);
    if (angular.isUndefined($scope.addfilm.titledoc)) {
      alert('Escriu un títol de película');
    } else {
      if (angular.isUndefined($scope.addfilm.section)) {
        $scope.addfilm.section = '1';
      }
      $http.post(url, $scope.addfilm)
      .then(function (data) {
        if (data.status === 200) {
          $state.reload();
        }
      });
    }
  };

  $scope.addfilmcorp = function () {
    var url = 'api/addfilm/corporate/' + $scope.user.id + '/true';
    console.log(url);
    if (angular.isUndefined($scope.addfilm.titlecorp)) {
      alert('Escriu un títol de película');
    } else {
      if (angular.isUndefined($scope.addfilm.section)) {
        $scope.addfilm.section = '1';
      }
      $http.post(url, $scope.addfilm)
      .then(function (data) {
        if (data.status === 200) {
          $state.reload();
        }
      });
    }
  };
}
