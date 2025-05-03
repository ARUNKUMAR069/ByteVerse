<?php
// Page-specific variables
$pageTitle = 'Mentor Dashboard | ByteVerse 1.0';
$loaderPrefix = 'ByteVerse Portal';
$loaderText = 'Loading mentor dashboard...';
$currentPage = 'mentor';

// Include header
require_once('components/header.php');

// Include navbar
require_once('components/navbar.php');
?>

  <!-- Authentication Check Overlay -->
<div id="auth-checking" class="fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center">
    <div class="text-center">
        <div class="inline-block animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-cyan-400 mb-4"></div>
        <p class="text-cyan-400 text-xl">Verifying credentials...</p>
    </div>
</div>

<!-- Mobile Menu Toggle Button -->
<button id="mobile-menu-toggle" class="fixed bottom-4 right-4 z-40 rounded-full bg-cyan-600 text-white p-3 shadow-lg md:hidden">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
    </svg>
</button>

<!-- Mentor Dashboard -->
<div id="mentor-content" class="hidden flex min-h-screen pt-24">
    <!-- Sidebar -->
    <div id="sidebar" class="w-64 bg-opacity-10 backdrop-filter backdrop-blur-lg bg-gray-800 border-r border-cyan-900/30 fixed h-screen z-20 transition-transform duration-300 ease-in-out transform md:translate-x-0 -translate-x-full">
        <div class="p-4 border-b border-cyan-900/30">
            <h2 class="text-xl text-cyan-400 font-bold">Mentor Panel</h2>
            <p class="text-gray-400 text-sm" id="sidebar-mentor-name">Loading...</p>
        </div>
        <!-- Close button for mobile -->
        <button id="close-sidebar" class="absolute top-4 right-4 text-gray-400 md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
        <nav class="mt-4">
            <ul class="space-y-2 px-2">
                <li>
                    <button class="nav-link active w-full flex items-center px-4 py-3 text-left rounded hover:bg-cyan-900/20" data-target="dashboard">
                        <span class="icon mr-3">📊</span>
                        <span>Dashboard</span>
                    </button>
                </li>
                <li>
                    <button class="nav-link w-full flex items-center px-4 py-3 text-left rounded hover:bg-cyan-900/20" data-target="round1">
                        <span class="icon mr-3">1️⃣</span>
                        <span>Round 1</span>
                    </button>
                </li>
                <li>
                    <button class="nav-link w-full flex items-center px-4 py-3 text-left rounded hover:bg-cyan-900/20" data-target="round2">
                        <span class="icon mr-3">2️⃣</span>
                        <span>Round 2</span>
                    </button>
                </li>
                <li>
                    <button class="nav-link w-full flex items-center px-4 py-3 text-left rounded hover:bg-cyan-900/20" data-target="round3">
                        <span class="icon mr-3">3️⃣</span>
                        <span>Round 3</span>
                    </button>
                </li>
                <li>
                    <button class="nav-link w-full flex items-center px-4 py-3 text-left rounded hover:bg-cyan-900/20" data-target="evaluation">
                        <span class="icon mr-3">📝</span>
                        <span>Evaluate Team</span>
                    </button>
                </li>
                <li>
                    <button id="team-locks-button" class="w-full flex items-center justify-between px-4 py-3 text-left rounded hover:bg-cyan-900/20 text-cyan-400">
                        <div>
                            <span class="icon mr-3">🔒</span>
                            <span>Team Locks</span>
                        </div>
                        <span id="unlocked-count" class="px-2 py-1 bg-yellow-500/20 text-yellow-400 rounded-full text-xs hidden">0</span>
                    </button>
                </li>
                <li>
                    <button id="sidebar-logout-btn" class="w-full flex items-center px-4 py-3 text-left rounded hover:bg-red-900/20 text-red-400">
                        <span class="icon mr-3">🚪</span>
                        <span>Logout</span>
                    </button>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Sidebar Overlay for Mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-10 hidden md:hidden"></div>

    <!-- Main Content -->
    <div class="flex-1 md:ml-64 px-2 md:px-6 py-8 transition-all duration-300 ease-in-out">
        <!-- Dashboard Tab -->
        <div id="dashboard" class="tab-content active">
            <h1 class="glitch-text text-3xl md:text-4xl mb-6" data-text="Dashboard">Dashboard</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="p-4 border border-cyan-900/30 rounded-lg bg-black/20 backdrop-blur-md relative overflow-hidden">
                    <div class="relative z-10">
                        <p class="text-gray-400 text-sm">Teams Evaluated</p>
                        <p class="text-2xl text-white font-bold" id="teams-evaluated-count">0</p>
                        <p class="text-xs text-gray-400 mt-1">Unique teams evaluated</p>
                        <p class="text-xs text-cyan-400 mt-1" id="teams-evaluated-percentage">0% of available teams</p>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gray-800">
                        <div id="teams-progress-bar" class="h-full bg-gradient-to-r from-cyan-500 to-cyan-300" style="width: 0%"></div>
                    </div>
                </div>
                <div class="p-4 border border-cyan-900/30 rounded-lg bg-black/20 backdrop-blur-md">
                    <p class="text-gray-400 text-sm">Evaluation Rounds</p>
                    <p class="text-2xl text-white font-bold" id="rounds-stats">0/0/0</p>
                    <p class="text-xs text-gray-400 mt-1">R1/R2/R3</p>
                </div>
                <div class="p-4 border border-cyan-900/30 rounded-lg bg-black/20 backdrop-blur-md">
                    <p class="text-gray-400 text-sm">Team Lock Status</p>
                    <p class="text-2xl text-white font-bold" id="lock-status">0 of 0 locked</p>
                </div>
            </div>
            
            <div class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-3 md:p-6 mb-8">
                <h2 class="text-xl text-cyan-400 mb-4">All Evaluations</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-opacity-20 bg-black">
                        <thead>
                            <tr class="border-b border-cyan-900/30">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Round</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team Size</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Project Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Innovation</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Technical</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Presentation</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Overall</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody id="evaluations-table-body">
                            <!-- Evaluations will be loaded here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Round 1 Tab -->
        <div id="round1" class="tab-content hidden">
            <h1 class="glitch-text text-3xl md:text-4xl mb-6" data-text="Round 1 Evaluations">Round 1 Evaluations</h1>
            
            <div class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-3 md:p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-opacity-20 bg-black">
                        <thead>
                            <tr class="border-b border-cyan-900/30">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team Size</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Project Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Innovation</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Technical</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Presentation</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Overall</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody id="round1-table-body">
                            <!-- Round 1 evaluations will be loaded here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Round 2 Tab -->
        <div id="round2" class="tab-content hidden">
            <h1 class="glitch-text text-3xl md:text-4xl mb-6" data-text="Round 2 Evaluations">Round 2 Evaluations</h1>
            
            <div class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-3 md:p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-opacity-20 bg-black">
                        <thead>
                            <tr class="border-b border-cyan-900/30">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team Size</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Project Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Innovation</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Technical</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Presentation</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Overall</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody id="round2-table-body">
                            <!-- Round 2 evaluations will be loaded here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Round 3 Tab -->
        <div id="round3" class="tab-content hidden">
            <h1 class="glitch-text text-3xl md:text-4xl mb-6" data-text="Round 3 Evaluations">Round 3 Evaluations</h1>
            
            <div class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-3 md:p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-opacity-20 bg-black">
                        <thead>
                            <tr class="border-b border-cyan-900/30">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team Size</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Project Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Innovation</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Technical</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Presentation</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Overall</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody id="round3-table-body">
                            <!-- Round 3 evaluations will be loaded here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Evaluation Form Tab -->
        <div id="evaluation" class="tab-content hidden">
            <h1 class="glitch-text text-3xl md:text-4xl mb-6" data-text="Evaluate Team">Evaluate Team</h1>
            
            <div class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-3 md:p-6">
                <form id="evaluation-form" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="form-group">
                            <label for="team-id" class="block text-gray-300 mb-2">Team ID</label>
                            <div class="relative">
                                <select id="team-id" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" required>
                                    <option value="">Select Team ID</option>
                                    <?php for($i = 1; $i <= 100; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="team-name" class="block text-gray-300 mb-2">Team Name</label>
                            <div class="relative">
                                <input type="text" id="team-name" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="team-size" class="block text-gray-300 mb-2">Team Size</label>
                            <div class="relative">
                                <select id="team-size" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" required>
                                    <option value="">Select Team Size</option>
                                    <option value="3">3 Members</option>
                                    <option value="4">4 Members</option>
                                    <option value="5">5 Members</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label for="evaluation-round" class="block text-gray-300 mb-2">Evaluation Round</label>
                            <div class="relative">
                                <select id="evaluation-round" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" required>
                                    <option value="1">Round 1</option>
                                    <option value="2">Round 2</option>
                                    <option value="3">Round 3</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="project-title" class="block text-gray-300 mb-2">Project Title</label>
                            <div class="relative">
                                <input type="text" id="project-title" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="form-group">
                            <label for="innovation-score" class="block text-gray-300 mb-2">Innovation Score (1-10)</label>
                            <div class="relative">
                                <input type="number" id="innovation-score" min="1" max="10" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="technical-score" class="block text-gray-300 mb-2">Technical Score (1-10)</label>
                            <div class="relative">
                                <input type="number" id="technical-score" min="1" max="10" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="presentation-score" class="block text-gray-300 mb-2">Presentation Score (1-10)</label>
                            <div class="relative">
                                <input type="number" id="presentation-score" min="1" max="10" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="feedback" class="block text-gray-300 mb-2">Feedback & Comments</label>
                        <div class="relative">
                            <textarea id="feedback" rows="4" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" required></textarea>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-4">
                        <button type="reset" class="cyber-button secondary">
                            <span>Reset</span>
                            <i></i>
                        </button>
                        <button type="submit" class="cyber-button primary">
                            <span>Submit Evaluation</span>
                            <i></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Firebase Modules -->
<script type="module">
  // Import Firebase modules
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js";
  import { getAuth, onAuthStateChanged, signOut } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-auth.js";
  import { 
    getFirestore, 
    collection, 
    addDoc, 
    getDocs, 
    query, 
    where, 
    serverTimestamp, 
    doc, 
    updateDoc 
  } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-firestore.js";
  
  // Firebase configuration
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
  const app = initializeApp(firebaseConfig);
  const auth = getAuth(app);
  const db = getFirestore(app);
  
  // Global variables
  let currentUser = null;
  
  document.addEventListener('DOMContentLoaded', function() {
    const authChecking = document.getElementById('auth-checking');
    const mentorContent = document.getElementById('mentor-content');
    const sidebarMentorName = document.getElementById('sidebar-mentor-name');
    const sidebarLogoutBtn = document.getElementById('sidebar-logout-btn');
    const teamLocksButton = document.getElementById('team-locks-button');
    const evaluationForm = document.getElementById('evaluation-form');
    const navLinks = document.querySelectorAll('.nav-link');
    const tabContents = document.querySelectorAll('.tab-content');
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const closeSidebar = document.getElementById('close-sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    
    // Check if all required elements exist
    if (!authChecking || !mentorContent || !sidebarMentorName || 
        !sidebarLogoutBtn || !teamLocksButton || !evaluationForm) {
        console.error("Required DOM elements are missing");
    }
    
    // Mobile menu toggle functionality
    if (mobileMenuToggle && sidebar) {
      mobileMenuToggle.addEventListener('click', function() {
        sidebar.classList.remove('-translate-x-full');
        if (sidebarOverlay) sidebarOverlay.classList.remove('hidden');
      });
    }

    // Close sidebar on mobile
    if (closeSidebar && sidebar) {
      closeSidebar.addEventListener('click', function() {
        sidebar.classList.add('-translate-x-full');
        if (sidebarOverlay) sidebarOverlay.classList.add('hidden');
      });
    }

    // Close sidebar when overlay is clicked
    if (sidebarOverlay && sidebar) {
      sidebarOverlay.addEventListener('click', function() {
        sidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('hidden');
      });
    }

    // Close sidebar after clicking a navigation link on mobile
    navLinks.forEach(link => {
      link.addEventListener('click', function() {
        if (window.innerWidth < 768) { // md breakpoint is typically 768px
          sidebar.classList.add('-translate-x-full');
          if (sidebarOverlay) sidebarOverlay.classList.add('hidden');
        }
      });
    });
    
    console.log("Mentor page loaded, checking authentication");
    
    // Check if user is logged in
    onAuthStateChanged(auth, async function(user) {
        console.log("Auth state:", user ? "User logged in" : "No user");
        
        if (user) {
            // User is logged in
            currentUser = user;
            console.log("User authenticated:", user.email);
            
            // Update UI elements
            if (sidebarMentorName) {
                sidebarMentorName.textContent = user.email || 'Mentor';
            }
            
            // Show mentor content
            if (authChecking) {
                authChecking.style.display = 'none';
            }
            if (mentorContent) {
                mentorContent.classList.remove('hidden');
            }
            
            // Load evaluations data
            await loadEvaluations();
        } else {
            // Not logged in, redirect to login page
            console.log("No authenticated user, redirecting to login");
            window.location.href = 'login.php';
        }
    });
    
    // Tab navigation
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            const target = this.dataset.target;
            
            // Update active tab
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            
            // Show target content
            tabContents.forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('active');
            });
            document.getElementById(target).classList.remove('hidden');
            document.getElementById(target).classList.add('active');
        });
    });
    
    // Logout functionality
    sidebarLogoutBtn.addEventListener('click', function() {
        console.log("Logout clicked");
        signOut(auth).then(() => {
            console.log("Logout successful");
            window.location.href = 'login.php';
        }).catch((error) => {
            console.error('Logout Error:', error);
            alert("Error logging out. Please try again.");
        });
    });
    
    // Team locks button functionality
    teamLocksButton.addEventListener('click', async function() {
        try {
            // Query evaluations to get lock stats
            const q = query(collection(db, "evaluations"), where("mentorId", "==", currentUser.uid));
            const querySnapshot = await getDocs(q);
            
            let totalEvaluations = 0;
            let lockedEvaluations = 0;
            let teamCount = new Set();
            let lockedTeams = new Set();
            let unlockedEvaluations = [];
            
            querySnapshot.forEach(doc => {
                const data = doc.data();
                totalEvaluations++;
                teamCount.add(data.teamId);
                
                if (data.isLocked) {
                    lockedEvaluations++;
                    lockedTeams.add(data.teamId);
                } else {
                    unlockedEvaluations.push({
                        id: doc.id,
                        teamId: data.teamId,
                        round: data.round || "1"
                    });
                }
            });
            
            // Check if there are any unlocked evaluations
            const hasUnlocked = unlockedEvaluations.length > 0;
            
            // Create options for the user
            const teamStatusInfo = `You have evaluated ${teamCount.size} teams total.\n${lockedTeams.size} of ${teamCount.size} teams have locked evaluations.\n${lockedEvaluations} of ${totalEvaluations} total evaluations are locked.`;
            
            if (hasUnlocked) {
                const lockAll = confirm(`${teamStatusInfo}\n\nWould you like to lock all ${unlockedEvaluations.length} unlocked evaluations?`);
                
                if (lockAll) {
                    let successCount = 0;
                    const totalToLock = unlockedEvaluations.length;
                    
                    for (const evaluation of unlockedEvaluations) {
                        try {
                            // Update the evaluation document to mark it as locked
                            const evaluationRef = doc(db, "evaluations", evaluation.id);
                            await updateDoc(evaluationRef, {
                                isLocked: true,
                                lockedAt: serverTimestamp()
                            });
                            successCount++;
                        } catch (error) {
                            console.error(`Error locking evaluation for Team ${evaluation.teamId} Round ${evaluation.round}:`, error);
                        }
                    }
                    
                    alert(`Successfully locked ${successCount} of ${totalToLock} evaluations.`);
                    
                    // Refresh evaluations to update the UI
                    await loadEvaluations();
                }
            } else {
                alert(`${teamStatusInfo}\n\nAll your evaluations are already locked.`);
            }
        } catch (error) {
            console.error("Error fetching lock stats:", error);
            alert("Failed to fetch team lock statistics. Please try again.");
        }
    });
    
    // Add team ID change listener to prefill data
    document.getElementById('team-id').addEventListener('change', async function() {
        const teamId = this.value;
        if (!teamId) return;
        
        try {
            // Check if we've already evaluated this team before
            const teamQuery = query(collection(db, "evaluations"), 
                                  where("teamId", "==", teamId));
            const teamSnapshot = await getDocs(teamQuery);
            
            if (!teamSnapshot.empty) {
                // Get the most recent evaluation for this team
                let latestEval = null;
                let latestTime = 0;
                
                teamSnapshot.forEach(doc => {
                    const data = doc.data();
                    const timestamp = data.createdAt?.toMillis() || 0;
                    if (timestamp > latestTime) {
                        latestEval = data;
                        latestTime = timestamp;
                    }
                });
                
                if (latestEval) {
                    // Prefill team name, size, and project title
                    document.getElementById('team-name').value = latestEval.teamName || '';
                    document.getElementById('project-title').value = latestEval.projectTitle || '';
                    document.getElementById('team-size').value = latestEval.teamSize || '';
                }
            }
            
            // Check which rounds have already been evaluated for this team by this mentor
            const mentorTeamQuery = query(collection(db, "evaluations"), 
                                       where("mentorId", "==", currentUser.uid),
                                       where("teamId", "==", teamId));
            const mentorTeamSnapshot = await getDocs(mentorTeamQuery);
            
            // Track completed rounds
            const completedRounds = {};
            mentorTeamSnapshot.forEach(doc => {
                const data = doc.data();
                completedRounds[data.round || "1"] = true;
            });
            
            // Disable completed rounds in the dropdown
            const roundSelect = document.getElementById('evaluation-round');
            Array.from(roundSelect.options).forEach(option => {
                if (completedRounds[option.value]) {
                    option.disabled = true;
                    option.textContent = `Round ${option.value} (Completed)`;
                } else {
                    option.disabled = false;
                    option.textContent = `Round ${option.value}`;
                }
            });
            
            // Select the first available round
            for (let i = 1; i <= 3; i++) {
                if (!completedRounds[i.toString()]) {
                    roundSelect.value = i.toString();
                    break;
                }
            }
        } catch (error) {
            console.error("Error checking team data:", error);
        }
    });
    
    // Evaluation form submission
    evaluationForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const teamId = document.getElementById('team-id').value;
        const evaluationRound = document.getElementById('evaluation-round').value;
        
        if (!teamId) {
            alert("Please select a Team ID.");
            return;
        }
        
        // Define submitBtn
        const submitBtn = document.querySelector('#evaluation-form button[type="submit"]');
        const originalContent = submitBtn.innerHTML;
        
        try {
            // Check if this team has already been evaluated by this mentor in this round
            const teamQuery = query(collection(db, "evaluations"), 
                                  where("mentorId", "==", currentUser.uid),
                                  where("teamId", "==", teamId),
                                  where("round", "==", evaluationRound));
            const teamSnapshot = await getDocs(teamQuery);
            
            if (!teamSnapshot.empty) {
                alert(`You've already evaluated Team ${teamId} for Round ${evaluationRound}. Please select a different team or round.`);
                return;
            }
            
            // Get form values
            const teamName = document.getElementById('team-name').value;
            const teamSize = document.getElementById('team-size').value;
            const projectTitle = document.getElementById('project-title').value;
            const innovationScore = parseInt(document.getElementById('innovation-score').value);
            const technicalScore = parseInt(document.getElementById('technical-score').value);
            const presentationScore = parseInt(document.getElementById('presentation-score').value);
            const feedback = document.getElementById('feedback').value;
            
            // Validate scores
            if (innovationScore < 1 || innovationScore > 10 ||
                technicalScore < 1 || technicalScore > 10 ||
                presentationScore < 1 || presentationScore > 10) {
                alert("Scores must be between 1 and 10.");
                return;
            }
            
            // Calculate overall score
            const overallScore = ((innovationScore + technicalScore + presentationScore) / 3).toFixed(1);
            
            // Show loading state
            submitBtn.innerHTML = `<span>Submitting...</span>`;
            submitBtn.disabled = true;
            
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
            
            console.log("Evaluation submitted with ID:", docRef.id);
            
            // Reset score and feedback fields only
            document.getElementById('innovation-score').value = "";
            document.getElementById('technical-score').value = "";
            document.getElementById('presentation-score').value = "";
            document.getElementById('feedback').value = "";
            
            // Auto-increment to next round if possible
            const nextRound = parseInt(evaluationRound) + 1;
            if (nextRound <= 3) {
                document.getElementById('evaluation-round').value = nextRound;
            }
            
            // Reload evaluations
            await loadEvaluations();
            
            // Go to the round-specific tab for the evaluation just submitted
            document.querySelector(`.nav-link[data-target="round${evaluationRound}"]`).click();
            
            // Show success message
            alert(`Evaluation for Team ${teamId} (Round ${evaluationRound}) submitted successfully!`);
        } catch (error) {
            console.error("Error submitting evaluation:", error);
            alert("Failed to submit evaluation. Please try again.");
        } finally {
            // Reset button
            submitBtn.innerHTML = originalContent;
            submitBtn.disabled = false;
        }
    });
    
    // Team lock functionality
    async function handleTeamLock(e) {
        e.preventDefault();
        
        const teamId = this.dataset.team;
        const round = this.dataset.round;
        const docId = this.dataset.id;
        
        if (confirm(`Are you sure you want to lock the evaluation for Team ${teamId} (Round ${round})? This action cannot be undone.`)) {
            try {
                // Update the evaluation document to mark it as locked
                const evaluationRef = doc(db, "evaluations", docId);
                await updateDoc(evaluationRef, {
                    isLocked: true,
                    lockedAt: serverTimestamp()
                });
                
                // Update UI to show locked status
                const row = this.closest('tr');
                const lockCell = this.parentElement;
                lockCell.innerHTML = '<span class="px-2 py-1 bg-gray-700/50 text-gray-400 rounded text-xs flex items-center"><span class="mr-1">🔒</span> Locked</span>';
                
                // Show success message
                alert(`Evaluation for Team ${teamId} (Round ${round}) has been locked successfully.`);
                
                // Refresh evaluations to update the counts
                await loadEvaluations();
            } catch (error) {
                console.error("Error locking team evaluation:", error);
                alert("Failed to lock evaluation. Please try again.");
            }
        }
    }
    
    // Load evaluations function
    async function loadEvaluations() {
        if (!currentUser) return;
        
        try {
            // Query evaluations for current mentor
            const q = query(collection(db, "evaluations"), where("mentorId", "==", currentUser.uid));
            const querySnapshot = await getDocs(q);
            
            // Get table bodies
            const allTableBody = document.getElementById('evaluations-table-body');
            const round1TableBody = document.getElementById('round1-table-body');
            const round2TableBody = document.getElementById('round2-table-body');
            const round3TableBody = document.getElementById('round3-table-body');
            const teamsEvaluatedCount = document.getElementById('teams-evaluated-count');
            const roundsStats = document.getElementById('rounds-stats');
            const lockStatus = document.getElementById('lock-status');
            
            // Reset tables
            allTableBody.innerHTML = '';
            round1TableBody.innerHTML = '';
            round2TableBody.innerHTML = '';
            round3TableBody.innerHTML = '';
            
            // No evaluations
            if (querySnapshot.empty) {
                const noDataMsg = '<tr class="border-b border-gray-800"><td colspan="10" class="px-6 py-4 text-center text-gray-400">No evaluations found. Start evaluating teams.</td></tr>';
                allTableBody.innerHTML = noDataMsg;
                round1TableBody.innerHTML = noDataMsg;
                round2TableBody.innerHTML = noDataMsg;
                round3TableBody.innerHTML = noDataMsg;
                
                teamsEvaluatedCount.textContent = '0';
                roundsStats.textContent = '0/0/0';
                lockStatus.textContent = '0 of 0 locked';
                return;
            }
            
            // Process evaluations
            let evaluations = [];
            let lockedCount = 0;
            let rounds = { "1": 0, "2": 0, "3": 0 };
            let teamMap = {};
            
            querySnapshot.forEach((doc) => {
                const data = doc.data();
                // Store document ID with data
                const evaluation = {
                    id: doc.id,
                    ...data
                };
                evaluations.push(evaluation);
                
                // Track round counts
                const round = data.round || "1";
                if (rounds[round] !== undefined) {
                    rounds[round]++;
                }
                
                // Track unique teams
                if (!teamMap[data.teamId]) {
                    teamMap[data.teamId] = true;
                }
                
                if (data.isLocked) lockedCount++;
            });
            
            // Update statistics
            const uniqueTeamsCount = Object.keys(teamMap).length;
            teamsEvaluatedCount.textContent = uniqueTeamsCount;

            const teamsEvaluatedPercentage = document.getElementById('teams-evaluated-percentage');
            const teamsProgressBar = document.getElementById('teams-progress-bar');
            if (teamsEvaluatedPercentage && teamsProgressBar) {
                const percentage = Math.round((uniqueTeamsCount / 100) * 100);
                teamsEvaluatedPercentage.textContent = `${percentage}% of available teams`;
                teamsProgressBar.style.width = `${percentage}%`;
            }
            
            roundsStats.textContent = `${rounds["1"]}/${rounds["2"]}/${rounds["3"]}`;
            lockStatus.textContent = `${lockedCount} of ${evaluations.length} locked`;
            
            // Sort evaluations by timestamp (newest first)
            evaluations.sort((a, b) => {
                return b.createdAt?.toMillis() - a.createdAt?.toMillis();
            });
            
            // Group evaluations by round
            const round1Evals = evaluations.filter(e => (e.round || "1") === "1");
            const round2Evals = evaluations.filter(e => e.round === "2");
            const round3Evals = evaluations.filter(e => e.round === "3");
            
            // Populate tables
            populateTable(evaluations, allTableBody);
            populateTable(round1Evals, round1TableBody);
            populateTable(round2Evals, round2TableBody);
            populateTable(round3Evals, round3TableBody);
            
            // Add event listeners for lock buttons
            document.querySelectorAll('.lock-team-btn').forEach(button => {
                button.addEventListener('click', handleTeamLock);
            });

            // Update unlocked count badge
            const unlockedCount = evaluations.length - lockedCount;
            const unlockCountBadge = document.getElementById('unlocked-count');
            if (unlockCountBadge) {
                if (unlockedCount > 0) {
                    unlockCountBadge.textContent = unlockedCount;
                    unlockCountBadge.classList.remove('hidden');
                } else {
                    unlockCountBadge.classList.add('hidden');
                }
            }
        } catch (error) {
            console.error("Error loading evaluations:", error);
            alert("Failed to load evaluations. Please refresh the page.");
        }
    }
    
    // Table population helper
    function populateTable(evaluations, tableBody) {
        if (evaluations.length === 0) {
            tableBody.innerHTML = '<tr class="border-b border-gray-800"><td colspan="10" class="px-6 py-4 text-center text-gray-400">No evaluations found.</td></tr>';
            return;
        }
        
        tableBody.innerHTML = '';
        evaluations.forEach(evaluation => {
            const isLocked = evaluation.isLocked || false;
            const round = evaluation.round || "1";
            
            tableBody.innerHTML += `
                <tr class="border-b border-gray-800 hover:bg-black/30" data-team-id="${evaluation.teamId}" data-round="${round}">
                    <td class="px-6 py-4 text-sm text-white">${evaluation.teamId}</td>
                    <td class="px-6 py-4 text-sm text-white">${evaluation.teamName}</td>
                    <td class="px-6 py-4 text-sm text-white"><span class="px-2 py-1 bg-cyan-900/30 text-cyan-400 rounded-full text-xs">Round ${round}</span></td>
                    <td class="px-6 py-4 text-sm text-white">${evaluation.teamSize || '—'} members</td>
                    <td class="px-6 py-4 text-sm text-white">${evaluation.projectTitle}</td>
                    <td class="px-6 py-4 text-sm text-white">${evaluation.innovationScore}/10</td>
                    <td class="px-6 py-4 text-sm text-white">${evaluation.technicalScore}/10</td>
                    <td class="px-6 py-4 text-sm text-white">${evaluation.presentationScore}/10</td>
                    <td class="px-6 py-4 text-sm font-bold text-cyan-400">${evaluation.overallScore}</td>
                    <td class="px-6 py-4 text-sm">
                        ${isLocked ? 
                            '<span class="px-2 py-1 bg-gray-700/50 text-gray-400 rounded text-xs flex items-center"><span class="mr-1">🔒</span> Locked</span>' : 
                            `<button class="lock-team-btn px-2 py-1 bg-yellow-500/20 hover:bg-yellow-500/30 text-yellow-400 rounded text-xs flex items-center" data-id="${evaluation.id}" data-team="${evaluation.teamId}" data-round="${round}">
                                <span class="mr-1">🔓</span> Lock
                            </button>`
                        }
                    </td>
                </tr>
            `;
        });
    }

    // Add this function after the populateTable function
    async function getUnlockedEvaluations() {
        if (!currentUser) return [];
        
        try {
            const q = query(collection(db, "evaluations"), 
                          where("mentorId", "==", currentUser.uid),
                          where("isLocked", "==", false));
            const querySnapshot = await getDocs(q);
            
            const unlocked = [];
            querySnapshot.forEach(doc => {
                const data = doc.data();
                unlocked.push({
                    id: doc.id,
                    teamId: data.teamId,
                    teamName: data.teamName,
                    round: data.round || "1"
                });
            });
            
            return unlocked;
        } catch (error) {
            console.error("Error getting unlocked evaluations:", error);
            return [];
        }
    }

   
  });
</script>

<style>
/* Mentor Dashboard Styles */
.nav-link {
    color: white;
    transition: all 0.2s ease;
}

.nav-link.active {
    background: rgba(0, 215, 254, 0.1);
    border-left: 3px solid rgb(0, 215, 254);
    color: rgb(0, 215, 254);
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

/* Tables responsive */
.overflow-x-auto {
    -webkit-overflow-scrolling: touch;
}

/* Mobile menu toggle button animation */
#mobile-menu-toggle {
    transition: all 0.2s ease-in-out;
}

#mobile-menu-toggle:hover {
    transform: scale(1.05);
    background-color: rgba(6, 182, 212, 0.9);
}

#mobile-menu-toggle:active {
    transform: scale(0.95);
}

/* Improved responsive adjustments */
@media (max-width: 768px) {
    #mentor-content {
        flex-direction: column;
    }
    
    .table-responsive {
        display: block;
        width: 100%;
        overflow-x: auto;
    }
    
    /* Make table headers stick to top on small screens */
    thead th {
        position: sticky;
        top: 0;
        background-color: rgba(17, 24, 39, 0.9);
        z-index: 1;
    }
    
    /* Adjust form layout on small screens */
    .form-group {
        margin-bottom: 1rem;
    }
    
    /* Make buttons easier to tap on mobile */
    button, select, input[type="submit"] {
        min-height: 44px;
    }
}

/* For mobile viewport */
@media (max-width: 640px) {
    .px-6 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    h1 {
        font-size: 1.875rem;
    }
    
    /* Improve tap targets for mobile */
    .lock-team-btn, .nav-link {
        padding: 8px 12px;
    }
    
    /* Stack grid items on small screens */
    .grid {
        grid-template-columns: 1fr;
    }
}

/* Override cyber-button animations */
.cyber-button {
    animation: none !important;
    transition: none !important;
}

.cyber-button i {
    animation: none !important;
    transition: none !important;
}

.cyber-button:hover,
.cyber-button:focus {
    animation: none !important;
    transition: background-color 0.2s ease;
}

/* Remove pulsing effect */
.pulse-warning {
    animation: none !important;
    box-shadow: 0 0 5px 0 rgba(255, 193, 7, 0.5);
}

/* Keep the loading spinner but remove unnecessary animations */
.inline-block.animate-spin {
    animation-duration: 1.5s !important;
}

/* Static progress bar instead of animated */
#teams-progress-bar {
    transition: none !important;
}
</style>

<?php 
// Include terminal
require_once('components/terminal.php');

// Include footer
require_once('components/footer.php');
?>
