const CACHE_NAME = 'dokitalink-cache-v1';
const urlsToCache = [
  './',
  './index.php',
  './style.css',
  './images/logo2.png'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => cache.addAll(urlsToCache))
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request).then(response => response || fetch(event.request))
  );
});
