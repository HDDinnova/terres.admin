angular
  .module('app')
  .factory('Competitors', Competitors)
  .factory('Assistents', Assistents);

function Competitors($resource) {
  return $resource('api/', {}, {
    query: {method: 'GET', isArray: true},
    insert: {method: 'POST'}
  });
}

function Assistents($resource) {
  return $resource('api/terreslab', {}, {
    query: {method: 'GET', isArray: true}
  });
}
