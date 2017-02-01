angular
  .module('app')
  .controller('DashCtrl', Dashboard);

Dashboard.$inject = ['$mdSidenav', '$scope', 'Competitors', '$state', '$http'];

function Dashboard($mdSidenav, $scope, Competitors, $state, $http) {
  /* jshint validthis: true */
  var vm = this;

  vm.toggleSidenav = function (menuId) {
    $mdSidenav(menuId).toggle();
  };

  $scope.competitors = Competitors.query();
  $scope.edit = function (a) {
    $state.go('index.competitor', {id: a});
  };

  $scope.mail = function (id) {
    var url = 'api/resend/' + id;
    $http.post(url)
    .then(function (data) {
      alert(data.data);
    });
  };
}
