angular
  .module('app')
  .controller('EmailCtrl', Email);

Email.$inject = ['$scope', '$rootScope', '$state', 'Upload'];

function Email($scope, $rootScope, $state, Upload) {
  $scope.send = function () {
    $rootScope.loading = true;
    Upload.upload({
      url: 'api/mailtocomps',
      data: {file: $scope.file, email: $scope.formdata}
    }).then(function (resp) {
      $rootScope.loading = false;
      alert(resp.data);
    }, function (resp) {
      $rootScope.loading = false;
      alert('Captura això i envia-li a Jordi: ' + resp.data);
    });
  };
}
