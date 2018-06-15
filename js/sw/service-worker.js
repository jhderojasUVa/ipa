// Service worker JS for caching files
const PRECACHE = 'precache-v1';
const RUNTIME = 'runtime';
var CACHE_NAME = 'ipa-sw-cache';
var urlsToCache = [
  '/img/icons',
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
