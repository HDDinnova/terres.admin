angular
  .module('app')
  .factory('Competitors', Competitors)
  .factory('Assistents', Assistents)
  .factory('Estudiants', Estudiants)
  .factory('Oneday', Oneday)
  .factory('Films', Films)
  .factory('Member', Member)
  .factory('Valoracions', Valoracions)
  .factory('Sustainable', Sustainable)
  .factory('Sopardades', Sopardades)
  .factory('Winners', Winners);

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

function Sopardades($resource) {
  return $resource('api/sopar', {}, {
    create: {method: 'POST'},
    query: {method: 'GET', isArray: true}
  });
}

function Winners($resource) {
  return $resource('api/winners', {}, {
    query: {method: 'GET'}
  });
}

function Estudiants($resource) {
  return $resource('api/students', {}, {
    query: {method: 'GET', isArray: true}
  });
}

function Oneday($resource) {
  return $resource('api/oneday', {}, {
    query: {method: 'GET', isArray: true}
  });
}
