angular
  .module('app')
  .factory('Competitors', Competitors)
  .factory('Assistents', Assistents)
  .factory('Films', Films);

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

function Films($resource) {
  return $resource('api/films', {}, {
    query: {method: 'GET'}
  });
}
