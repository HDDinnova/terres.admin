angular
  .module('app')
  .factory('Competitors', Competitors)
  .factory('Assistents', Assistents);

function Competitors($resource) {
  return $resource('api/', {}, {
    query: {method: 'GET', isArray: true}
  });
}

function Assistents($resource) {
  return $resource('api/terreslab', {}, {
    query: {method: 'GET', isArray: true}
  });
}
