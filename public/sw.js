const CACHE_NAME = 'e-asfarm-v2';
const BASE_URL = self.location.origin;

// Halaman dan assets yang akan di-cache
const urlsToCache = [
  '/',
  '/home',
  '/assets/css/style.css',
  '/assets/js/main.js',
  '/assets/images/logos/E-Asfarm-Logo.png',
  '/assets/images/logos/icon-192x192.png',
  '/assets/images/logos/icon-512x512.png',
  // Swiper.js untuk slider banner (offline support)
  'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
  'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css'
];

// Install Service Worker
self.addEventListener('install', event => {
  console.log('[SW] Installing...');
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        console.log('[SW] Caching app shell');
        return cache.addAll(urlsToCache);
      })
      .catch(err => console.log('[SW] Cache failed:', err))
  );
  self.skipWaiting();
});

// Activate Service Worker
self.addEventListener('activate', event => {
  console.log('[SW] Activating...');
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (cacheName !== CACHE_NAME) {
            console.log('[SW] Deleting old cache:', cacheName);
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
  return self.clients.claim();
});

// Fetch Strategy: Cache First, then Network
self.addEventListener('fetch', event => {
  const { request } = event;
  const url = new URL(request.url);
  
  // Skip non-GET requests
  if (request.method !== 'GET') return;
  
  // Skip admin pages and API calls
  if (
    url.pathname.startsWith('/admin') ||
    url.pathname.startsWith('/api') ||
    url.pathname.includes('/auth/')
  ) {
    return;
  }
  
  // Cache CDN resources (Swiper.js)
  if (request.url.includes('cdn.jsdelivr.net/npm/swiper')) {
    event.respondWith(
      caches.match(request).then(response => {
        if (response) {
          console.log('[SW] Serving CDN from cache:', request.url);
          return response;
        }
        return fetch(request).then(response => {
          if (response && response.status === 200) {
            const responseClone = response.clone();
            caches.open(CACHE_NAME).then(cache => {
              cache.put(request, responseClone);
            });
          }
          return response;
        });
      })
    );
    return;
  }
  
  // Skip other external resources
  if (url.origin !== BASE_URL) {
    return;
  }
  
  // Cache strategy for static assets (CSS, JS, Images)
  if (
    request.url.includes('/assets/css/') ||
    request.url.includes('/assets/js/') ||
    request.url.includes('/assets/images/') ||
    request.url.includes('/assets/fonts/') ||
    request.url.match(/\.(css|js|png|jpg|jpeg|gif|svg|webp|woff|woff2|ttf)$/)
  ) {
    event.respondWith(
      caches.match(request).then(response => {
        if (response) {
          console.log('[SW] Serving from cache:', request.url);
          return response;
        }
        return fetch(request).then(response => {
          // Cache the fetched resource
          if (response && response.status === 200) {
            const responseClone = response.clone();
            caches.open(CACHE_NAME).then(cache => {
              cache.put(request, responseClone);
            });
          }
          return response;
        });
      })
    );
    return;
  }
  
  // Cache strategy for home page
  if (url.pathname === '/' || url.pathname === '/home') {
    event.respondWith(
      caches.match(request).then(response => {
        return response || fetch(request).then(fetchResponse => {
          return caches.open(CACHE_NAME).then(cache => {
            cache.put(request, fetchResponse.clone());
            return fetchResponse;
          });
        }).catch(() => {
          // Offline fallback
          return caches.match('/');
        });
      })
    );
    return;
  }
  
  // Network first for other pages
  event.respondWith(
    fetch(request).catch(() => {
      return caches.match(request);
    })
  );
});
