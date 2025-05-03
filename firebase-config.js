// Firebase configuration - using Firebase v11.6.1
const firebaseConfig = {
  apiKey: "AIzaSyAETwGMzy0eOv3XfhRgakFcjeij4mk5K70",
  authDomain: "byteverse-1.firebaseapp.com",
  projectId: "byteverse-1",
  storageBucket: "byteverse-1.appspot.com",
  messagingSenderId: "307945328858",
  appId: "1:307945328858:web:5017f868eb9fc977f795e3",
  measurementId: "G-G87GV2W2ZG"
};

// Initialize Firebase using compat version for backward compatibility
firebase.initializeApp(firebaseConfig);

console.log("Firebase initialized successfully");
// Initialize Firebase Authentication
const auth = firebase.auth();

// Initialize Firestore if you're using it for roles
const db = firebase.firestore();

// Function to check user role
async function getUserRole(userId) {
  try {
    const doc = await db.collection('users').doc(userId).get();
    if (doc.exists) {
      return doc.data().role || 'user';
    } else {
      console.log("No user document found!");
      return 'user';
    }
  } catch (error) {
    console.error("Error getting user role:", error);
    return 'user';
  }
}