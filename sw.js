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

// Instalaci�n y cach� inicial
self.addEventListener("install", event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      return cache.addAll(urlsToCache);
    })
  );
  self.skipWaiting();
});

// Activaci�n y limpieza de cach� antigua
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

// Interceptar solicitudes y servir desde cach� si es posible
self.addEventListener("fetch", event => {
  event.respondWith(
    caches.match(event.request).then(response => {
      return response || fetch(event.request);
    })
  );
});
