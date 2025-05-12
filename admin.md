# ByteVerse Administrative System Documentation

This document provides a comprehensive guide to the ByteVerse administrative system, including the login system, mentor dashboard, and admin dashboard.

## Table of Contents

1. [System Overview](#system-overview)
2. [Firebase Schema](#firebase-schema)
3. [Login System](#login-system)
4. [Mentor Dashboard](#mentor-dashboard)
5. [Admin Dashboard](#admin-dashboard)
6. [Authentication and Security](#authentication-and-security)
7. [Code Structure](#code-structure)

## System Overview

ByteVerse is a hackathon management system that provides interfaces for:

- **Mentors**: Evaluate teams across multiple rounds
- **Administrators**: Manage teams, view evaluations, and generate final results

The system is built with:
- PHP for server-side rendering
- Firebase for authentication and data storage
- Tailwind CSS for styling
- JavaScript for client-side functionality

## Firebase Schema

### Collections

#### 1. Authentication (Firebase Auth)

Firebase Authentication stores user accounts. Each user has:
- Email address
- Password (securely stored)
- UID (unique identifier)

The system uses email/password authentication with a special case for admin access.

#### 2. Evaluations Collection

```
evaluations/
  ├── [evaluation_id]/
  │     ├── mentorId: string (UID of mentor)
  │     ├── mentorEmail: string
  │     ├── teamId: string
  │     ├── teamName: string
  │     ├── teamSize: number
  │     ├── projectTitle: string
  │     ├── round: string ("1", "2", or "3")
  │     ├── innovationScore: number (1-10)
  │     ├── technicalScore: number (1-10)
  │     ├── presentationScore: number (1-10)
  │     ├── overallScore: number (calculated average)
  │     ├── feedback: string
  │     ├── isLocked: boolean
  │     ├── lockedAt: timestamp (optional)
  │     ├── createdAt: timestamp
  │     └── updatedAt: timestamp (optional)
```

This collection stores all team evaluations submitted by mentors. Each document represents a single evaluation of a team in a specific round.

#### 3. Teams Collection

```
teams/
  ├── [team_id]/
  │     ├── teamId: string
  │     ├── teamName: string 
  │     ├── teamSize: number
  │     ├── projectTitle: string
  │     ├── r1Score: number (optional)
  │     ├── r1Innovation: number (optional)
  │     ├── r1Technical: number (optional)
  │     ├── r1Presentation: number (optional)
  │     ├── r2Score: number (optional)
  │     ├── r2Innovation: number (optional)
  │     ├── r2Technical: number (optional)
  │     ├── r2Presentation: number (optional)
  │     ├── r3Score: number (optional)
  │     ├── r3Innovation: number (optional)
  │     ├── r3Technical: number (optional)
  │     ├── r3Presentation: number (optional)
  │     ├── createdAt: timestamp
  │     └── updatedAt: timestamp
```

The teams collection can store team information independent of evaluations, but most team data is derived from the evaluations collection.

### Relationships

- A team can have multiple evaluations (one per round per mentor)
- A mentor can evaluate multiple teams
- Evaluations are linked to mentors via the mentorId field
- Evaluations are linked to teams via the teamId field

## Login System

### Overview

The login system (`login.php`) provides authentication for mentors and administrators. It uses Firebase Authentication for secure login.

### Key Features

1. **Email/Password Authentication**: Mentors log in with email and password
2. **Admin Detection**: Special routing for admin users
3. **Session Persistence**: Remembers logged in users
4. **Secure Redirects**: Authenticated routing to appropriate dashboards

### Implementation Details

The login page connects to Firebase using the Firebase JavaScript SDK. After authentication:
- If the user's email is `singhkashish364@gmail.com`, they're identified as an admin and redirected to `admin.php`
- All other authenticated users are redirected to `mentor.php`

### Code Structure

The login form submission handler:
```javascript
loginForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    // Show loading state
    const submitBtn = loginForm.querySelector('button[type="submit"]');
    const originalContent = submitBtn.innerHTML;
    submitBtn.innerHTML = `
        <div class="loader-dots">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
        <span style="margin-left: 8px;">Authenticating...</span>
    `;
    submitBtn.disabled = true;
    
    // Sign in with email and password
    firebase.auth().signInWithEmailAndPassword(email, password)
        .then((userCredential) => {
            // Check if this is admin email
            if (email === 'singhkashish364@gmail.com') {
                window.location.href = 'admin.php';
            } else {
                // For all other users, go to mentor dashboard
                window.location.href = 'mentor.php';
            }
        })
        .catch((error) => {
            // Handle errors
            console.error("Login error:", error.code, error.message);
            loginError.classList.remove('hidden');
            
            // Reset button
            submitBtn.innerHTML = originalContent;
            submitBtn.disabled = false;
        });
});
```

## Mentor Dashboard

### Overview

The mentor dashboard (`mentor.php`) allows mentors to:
1. View their evaluations
2. Submit new evaluations for teams
3. Lock evaluations to prevent further changes
4. Navigate between different rounds of evaluations

### Key Sections

1. **Dashboard Tab**: Overview of evaluation statistics and all evaluations
2. **Round Tabs**: Filtered views of round 1, 2, and 3 evaluations
3. **Evaluation Form**: Interface to submit new team evaluations
4. **Team Locks**: Functionality to lock evaluations

### Authentication and Access Control

The mentor dashboard checks for authenticated users:
```javascript
onAuthStateChanged(auth, async function(user) {
    if (user) {
        // User is logged in
        currentUser = user;
        
        // Show mentor content
        authChecking.style.display = 'none';
        mentorContent.classList.remove('hidden');
        
        // Load evaluations data
        await loadEvaluations();
    } else {
        // Not logged in, redirect to login page
        window.location.href = 'login.php';
    }
});
```

### Team Evaluation Process

1. Mentor selects a team ID
2. The system checks which rounds have already been evaluated for that team
3. Mentor provides scores for innovation, technical, and presentation aspects
4. Overall score is calculated as the average
5. Evaluation is stored in Firebase
6. Mentor can lock evaluations to prevent further changes

### Data Management

The evaluation form submission handler:
```javascript
evaluationForm.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const teamId = document.getElementById('team-id').value;
    const evaluationRound = document.getElementById('evaluation-round').value;
    
    // ... other form values ...

    // Calculate overall score
    const overallScore = ((innovationScore + technicalScore + presentationScore) / 3).toFixed(1);
    
    // Add evaluation to Firestore
    const docRef = await addDoc(collection(db, "evaluations"), {
        mentorId: currentUser.uid,
        mentorEmail: currentUser.email,
        teamId: teamId,
        teamName: teamName,
        teamSize: teamSize,
        projectTitle: projectTitle,
        round: evaluationRound,
        innovationScore: innovationScore,
        technicalScore: technicalScore,
        presentationScore: presentationScore,
        overallScore: parseFloat(overallScore),
        feedback: feedback,
        isLocked: false,
        createdAt: serverTimestamp()
    });
    
    // ... update UI and show success message ...
});
```

## Admin Dashboard

### Overview

The admin dashboard (`admin.php`) provides comprehensive management of the hackathon:

1. **Dashboard Overview**: Statistics about teams, mentors, and evaluations
2. **Team Management**: View, add, edit, and delete teams
3. **Mentor Management**: View mentor activity
4. **Final Results**: Generate weighted final results across all rounds

### Authentication and Access Control

The admin dashboard uses strict authentication:
```javascript
onAuthStateChanged(auth, async function (user) {
    if (user && user.email === "singhkashish364@gmail.com") {
        // This is the admin
        console.log("Admin authenticated:", user.email);

        // Show admin content
        authChecking.style.display = "none";
        adminContent.classList.remove("hidden");

        // Load admin data
        await loadDashboardData();
        await loadTeamsData();
        await loadMentorsData();
    } else {
        // Not admin, redirect
        console.log("Not admin, redirecting to login");
        window.location.href = "login.php";
    }
});
```

### Team Management

The admin can:
1. View all teams and their scores
2. Add new teams
3. Edit existing teams
4. Delete teams and their evaluations

### Results Generation

Final results are calculated using weighted scores from all rounds:
```javascript
async function generateFinalResults(weights) {
    // ... process evaluations ...
    
    Object.values(teamEvaluations).forEach(team => {
        // Calculate weighted scores for each round
        const r1Score = team.rounds["1"] ? team.rounds["1"].overallScore : 0;
        const r2Score = team.rounds["2"] ? team.rounds["2"].overallScore : 0;
        const r3Score = team.rounds["3"] ? team.rounds["3"].overallScore : 0;
        
        // Calculate final score with weights
        const finalScore = 
            (r1Score * weights.r1) + 
            (r2Score * weights.r2) + 
            (r3Score * weights.r3);
        
        finalResults.push({
            teamId: team.teamId,
            teamName: team.teamName,
            projectTitle: team.projectTitle,
            teamSize: team.teamSize,
            finalScore: finalScore,
            roundScores: {
                r1: r1Score,
                r2: r2Score,
                r3: r3Score
            }
        });
    });
    
    // Sort by final score (highest first)
    finalResults.sort((a, b) => b.finalScore - a.finalScore);
}
```

## Authentication and Security

### Authentication Flow

1. Users log in via email/password on `login.php`
2. Firebase Authentication validates credentials
3. Based on email, users are directed to admin or mentor dashboards
4. Each dashboard verifies authentication status on load
5. Unauthorized access attempts are redirected to the login page

### Firebase Security Rules

While not shown in the code, Firebase security rules should be configured to:
1. Restrict read/write access to authenticated users
2. Limit mentors to reading only their own evaluations
3. Allow mentors to create new evaluations
4. Restrict admin functions to the admin user

### Password Security

Authentication is handled through Firebase Authentication, which:
- Securely hashes passwords
- Enforces minimum password strength
- Provides account lockout protection
- Supports password reset functionality

## Code Structure

### Common Components

1. **Header** (`components/header.php`): Page head with meta tags and styles
2. **Navbar** (`components/navbar.php`): Navigation bar
3. **Footer** (`components/footer.php`): Page footer
4. **Terminal** (`components/terminal.php`): Terminal-style UI element

### JavaScript Files

1. **Firebase Config** (`firebase-config.js`): Firebase initialization
2. **Team Management** (`assets/js/team-management.js`): Team management functions
3. **Admin** (`assets/js/admin.js`): Admin dashboard functionality

### Authentication Pattern

All authenticated pages follow this pattern:
1. Show loading state initially
2. Check authentication state using `onAuthStateChanged`
3. If authenticated, show appropriate content
4. If not authenticated, redirect to login page

### Data Management Pattern

For Firebase operations:
1. Use `collection()` and `doc()` to reference collections and documents
2. Use `getDocs()` to fetch multiple documents
3. Use `addDoc()` to create new documents
4. Use `updateDoc()` to modify existing documents
5. Use `deleteDoc()` to remove documents
6. Use `writeBatch()` for atomic operations on multiple documents

## Configuration

The Firebase configuration is contained in `firebase-config.js`:
```javascript
const firebaseConfig = {
  apiKey: "AIzaSyAETwGMzy0eOv3XfhRgakFcjeij4mk5K70",
  authDomain: "byteverse-1.firebaseapp.com",
  projectId: "byteverse-1",
  storageBucket: "byteverse-1.appspot.com",
  messagingSenderId: "307945328858",
  appId: "1:307945328858:web:5017f868eb9fc977f795e3",
  measurementId: "G-G87GV2W2ZG"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
```

## Conclusion

The ByteVerse administrative system provides a robust platform for hackathon management. It separates mentor and admin roles with appropriate permissions, allows for streamlined evaluation of teams across multiple rounds, and provides comprehensive tools for final result generation and data export.

The system leverages Firebase for secure authentication and real-time data storage, ensuring that all evaluations are synchronized across users and protected from unauthorized access.
