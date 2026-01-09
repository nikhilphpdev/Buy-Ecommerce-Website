importScripts('https://www.gstatic.com/firebasejs/9.22.2/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.22.2/firebase-messaging-compat.js');

firebase.initializeApp({
  apiKey: "AIzaSyDD-nadMgzQafMraYob4ETn956_9EbHB9Q",
  authDomain: "buyjee-ba483.firebaseapp.com",
  projectId: "buyjee-ba483",
  storageBucket: "buyjee-ba483.appspot.com",
  messagingSenderId: "733579014702",
  appId: "1:733579014702:web:bb3362b9a79c33938065bf",
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log('[firebase-messaging-sw.js] Background message received: ', payload);
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: '/icon.png'
    };
    self.registration.showNotification(notificationTitle, notificationOptions);
});
