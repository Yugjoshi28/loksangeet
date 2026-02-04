importScripts('https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging-compat.js');

firebase.initializeApp({
 apiKey: "AIzaSyB1P7NfrLgn5zuz-N4ovE8wOqf3Pp6uKPA",
  authDomain: "taskboard-c3859.firebaseapp.com",
  projectId: "taskboard-c3859",
  storageBucket: "taskboard-c3859.firebasestorage.app",
  messagingSenderId: "311730411150",
  appId: "1:311730411150:web:b080932dbba40ab70ddbdf"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(payload => {

  self.registration.showNotification(
    payload.notification.title,
    {
      body: payload.notification.body,
      icon: "/framework/assets/remove.png"
    }
  );

});



const CACHE = "framework-v2";

self.addEventListener("install", e => {
  self.skipWaiting();
  e.waitUntil(
    caches.open(CACHE).then(cache => {
      return cache.addAll([
        "/framework/",
        "/framework/index.php/welcome"
      ]);
    })
  );
});

self.addEventListener("activate", e => {
  clients.claim();
});

self.addEventListener("fetch", e => {
  e.respondWith(
    fetch(e.request).catch(() => caches.match(e.request))
  );
});
