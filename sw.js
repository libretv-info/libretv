const CACHE_NAME = "libretv-cache-v1";
const urlsToCache = [
  "/",
  "/index.html",
  "/manifest.json",
  "/films.html",
  "/docus.html",
  "/noticias.html",
  "/sports.html",
  "/music.html",
  "/humor.html",
  "/infantil.html",
  "/world.html",
  "/videochat.html",
  "/styles.css", // si tienes CSS separado
  "/script.js"   // si tienes JS separado
];

// Instalación y caché inicial
self.addEventListener("install", event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      return cache.addAll(urlsToCache);
    })
  );
  self.skipWaiting();
});

// Activación y limpieza de caché antigua
self.addEventListener("activate", event => {
  event.waitUntil(
    caches.keys().then(keys =>
      Promise.all(
        keys.map(key => {
          if (key !== CACHE_NAME) return caches.delete(key);
        })
      )
    )
  );
});

// Interceptar solicitudes y servir desde caché si es posible
self.addEventListener("fetch", event => {
  event.respondWith(
    caches.match(event.request).then(response => {
      return response || fetch(event.request);
    })
  );
});
