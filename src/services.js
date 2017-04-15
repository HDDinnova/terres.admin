angular
  .module('app')
  .factory('Competitors', Competitors)
  .factory('Assistents', Assistents)
  .factory('Films', Films)
  .factory('Member', Member)
  .factory('Valoracions', Valoracions)
  .factory('Sustainable', Sustainable);

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

function Member($resource) {
  return $resource('api/memberjury', {}, {
    create: {method: 'POST'},
    query: {method: 'GET', isArray: true}
  });
}

function Valoracions($resource) {
  return $resource('api/valoration', {}, {
    query: {method: 'GET'}
  });
}

function Sustainable($resource) {
  return $resource('api/sustainable', {}, {
    create: {method: 'POST'},
    query: {method: 'GET', isArray: true}
  });
}
