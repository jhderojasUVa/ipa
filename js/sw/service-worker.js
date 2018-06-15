// Service worker JS for caching files
const PRECACHE = 'precache-v1';
const RUNTIME = 'runtime';
var CACHE_NAME = 'ipa-sw-cache';
var urlsToCache = [
  '/img/',
  '/img/icons/001-wifi.png',
  '/img/icons/002-television.png',
  '/img/icons/003-phone.png',
  '/img/icons/004-frigorifico.png',
  '/img/icons/005-vajilla.png',
  '/img/icons/006-cama.png',
  '/img/icons/008-horno.png',
  '/img/icons/009-cocina.png',
  '/img/icons/010-lavadora.png',
  '/img/icons/011-servicio.png',
  '/img/icons/012-secadora.png',
  '/img/icons/013-compartido.png',
  '/css/app.css',
  './'
];

// Installation
self.addEventListener('install', function(event) {
  console.log('Installing!');
  event.waitUntil(
    caches.open(CACHE_NAME)
   .then(function(cache) {
     // Open a cache and cache our files
     return cache.addAll(urlsToCache);
   })
   // Skip waiting if it's on the cache
   .then(self.skipWaiting())
  );
});

//Control fetch and send from cache
self.addEventListener('fetch', function(event) {
    console.log(event.request.url);
    event.respondWith(
        caches.match(event.request).then(function(response) {
            return response || fetch(event.request);
        })
    );
});
