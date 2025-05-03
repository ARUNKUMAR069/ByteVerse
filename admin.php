<?php
// Page-specific variables
$pageTitle = 'Admin Dashboard | ByteVerse 1.0';
$loaderPrefix = 'ByteVerse Admin';
$loaderText = 'Loading admin dashboard...';
$currentPage = 'admin';

// Include header
require_once('components/header.php');

// Include navbar
require_once('components/navbar.php');
?>

<!-- Authentication Check Overlay -->
<div id="auth-checking" class="fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center">
    <div class="text-center">
        <div class="inline-block animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-cyan-400 mb-4"></div>
        <p class="text-cyan-400 text-xl">Verifying admin credentials...</p>
    </div>
</div>

<!-- Admin Dashboard with Sidebar -->
<div id="admin-content" class="hidden flex min-h-screen pt-24">
    <!-- Sidebar -->
    <div class="w-64 bg-opacity-10 backdrop-filter backdrop-blur-lg bg-gray-800 border-r border-cyan-900/30 fixed h-screen z-10">
        <div class="p-4 border-b border-cyan-900/30">
            <h2 class="text-xl text-cyan-400 font-bold">Admin Panel</h2>
            <p class="text-gray-400 text-sm">singhkashish364@gmail.com</p>
        </div>
        <nav class="mt-4">
            <ul class="space-y-2 px-2">
                <li>
                    <button class="nav-link active w-full flex items-center px-4 py-3 text-left rounded hover:bg-cyan-900/20" data-target="dashboard">
                        <span class="icon mr-3">📊</span>
                        <span>Dashboard</span>
                    </button>
                </li>
                <li>
                    <button class="nav-link w-full flex items-center px-4 py-3 text-left rounded hover:bg-cyan-900/20" data-target="teams">
                        <span class="icon mr-3">👥</span>
                        <span>Manage Teams</span>
                    </button>
                </li>
                <li>
                    <button class="nav-link w-full flex items-center px-4 py-3 text-left rounded hover:bg-cyan-900/20" data-target="mentors">
                        <span class="icon mr-3">🧑‍🏫</span>
                        <span>Mentors</span>
                    </button>
                </li>
                <li>
                    <button class="nav-link w-full flex items-center px-4 py-3 text-left rounded hover:bg-cyan-900/20" data-target="results">
                        <span class="icon mr-3">🏆</span>
                        <span>Results</span>
                    </button>
                </li>
                <li class="mt-8">
                    <button id="admin-logout-btn" class="w-full flex items-center px-4 py-3 text-left rounded hover:bg-red-900/20 text-red-400">
                        <span class="icon mr-3">🚪</span>
                        <span>Logout</span>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
    
    <!-- Main Content Area -->
    <div class="flex-1 ml-64 px-6 py-8">
        <!-- Dashboard Tab -->
        <div id="dashboard" class="tab-content active">
            <h1 class="glitch-text text-4xl mb-6" data-text="Admin Dashboard">Admin Dashboard</h1>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <!-- Total Evaluations Card -->
                <div class="p-4 border border-cyan-900/30 rounded-lg bg-black/20 backdrop-blur-md">
                    <p class="text-gray-400 text-sm">Total Evaluations</p>
                    <p class="text-2xl text-white font-bold" id="total-evaluations-count">0</p>
                    <p class="text-xs text-gray-400 mt-1">Evaluations submitted</p>
                </div>
                
                <!-- Teams Card -->
                <div class="p-4 border border-cyan-900/30 rounded-lg bg-black/20 backdrop-blur-md">
                    <p class="text-gray-400 text-sm">Teams</p>
                    <p class="text-2xl text-white font-bold" id="total-teams-count">0</p>
                    <p class="text-xs text-gray-400 mt-1">Participating teams</p>
                </div>
                
                <!-- Mentors Card -->
                <div class="p-4 border border-cyan-900/30 rounded-lg bg-black/20 backdrop-blur-md">
                    <p class="text-gray-400 text-sm">Mentors</p>
                    <p class="text-2xl text-white font-bold" id="total-mentors-count">0</p>
                    <p class="text-xs text-gray-400 mt-1">Active mentors</p>
                </div>
                
                <!-- Teams Evaluated Card -->
                <div class="p-4 border border-cyan-900/30 rounded-lg bg-black/20 backdrop-blur-md">
                    <p class="text-gray-400 text-sm">Teams Evaluated</p>
                    <p class="text-2xl text-white font-bold" id="teams-evaluated-ratio">0%</p>
                    <p class="text-xs text-gray-400 mt-1">Of available teams</p>
                </div>
            </div>
            
            <!-- Charts Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
              <!-- Rounds Chart Container -->
              <div class="chart-container bg-black/20 backdrop-blur-md border border-cyan-900/30 rounded-lg p-4">
                <div class="flex justify-between items-center mb-4">
                  <h3 class="text-lg text-cyan-400">Evaluations by Round</h3>
                  <div class="flex space-x-2">
                    <button class="chart-expand-btn px-2 py-1 bg-cyan-900/20 text-cyan-400 rounded hover:bg-cyan-900/40">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                      </svg>
                    </button>
                    <button class="chart-pin-btn px-2 py-1 bg-cyan-900/20 text-cyan-400 rounded hover:bg-cyan-900/40">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h14a2 2 0 012 2v3a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v5" />
                      </svg>
                    </button>
                  </div>
                </div>
                <div class="chart-wrapper" style="position: relative; height:250px; width:100%">
                  <canvas id="rounds-chart"></canvas>
                </div>
              </div>
              
              <!-- Scores Chart Container -->
              <div class="chart-container bg-black/20 backdrop-blur-md border border-cyan-900/30 rounded-lg p-4">
                <div class="flex justify-between items-center mb-4">
                  <h3 class="text-lg text-cyan-400">Score Distribution</h3>
                  <div class="flex space-x-2">
                    <button class="chart-expand-btn px-2 py-1 bg-cyan-900/20 text-cyan-400 rounded hover:bg-cyan-900/40">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                      </svg>
                    </button>
                    <button class="chart-pin-btn px-2 py-1 bg-cyan-900/20 text-cyan-400 rounded hover:bg-cyan-900/40">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h14a2 2 0 012 2v3a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v5" />
                      </svg>
                    </button>
                  </div>
                </div>
                <div class="chart-wrapper" style="position: relative; height:250px; width:100%">
                  <canvas id="scores-chart"></canvas>
                </div>
              </div>
            </div>
            
            <!-- Recent Evaluations Table -->
            <div class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-6 mb-8">
                <h3 class="text-lg text-cyan-400 mb-4">Recent Evaluations</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-opacity-20 bg-black">
                        <thead>
                            <tr class="border-b border-cyan-900/30">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Mentor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Round</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Score</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Time</th>
                            </tr>
                        </thead>
                        <tbody id="recent-evaluations-body">
                            <!-- Will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Top Teams Section (initially hidden) -->
            <div id="top-teams-section" class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-6 mb-8 hidden">
                <h3 class="text-lg text-cyan-400 mb-4">Top 10 Teams</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-opacity-20 bg-black">
                        <thead>
                            <tr class="border-b border-cyan-900/30">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Rank</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Project</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">R1</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">R2</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">R3</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Final</th>
                            </tr>
                        </thead>
                        <tbody id="top-teams-body">
                            <!-- Will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Teams Management Tab -->
        <div id="teams" class="tab-content hidden">
            <h1 class="glitch-text text-4xl mb-6" data-text="Manage Teams">Manage Teams</h1>
            
            <div class="flex mb-6">
                <div class="relative w-64 mr-4">
                    <input type="text" id="team-search" placeholder="Search teams..." class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400">
                </div>
                <button id="add-team-btn" class="cyber-button primary">
                    <span>Add New Team</span>
                </button>
            </div>
            
            <div class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-opacity-20 bg-black">
                        <thead>
                            <tr class="border-b border-cyan-900/30">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team Size</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Project Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="teams-table-body">
                            <!-- Will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Team Edit Modal -->
            <div id="team-modal" class="fixed inset-0 bg-black bg-opacity-80 z-50 flex-col items-center justify-center hidden">
                <div class="bg-opacity-95 backdrop-blur-xl bg-gray-900 border border-cyan-800/50 rounded-lg p-8 max-w-2xl w-full mx-4 relative">
                    <h3 class="text-xl text-cyan-400 mb-6" id="modal-title">Edit Team</h3>
                    <button class="absolute top-4 right-4 text-gray-400 hover:text-white" id="close-modal">✕</button>
                    
                    <form id="team-form" class="space-y-6">
                        <input type="hidden" id="team-doc-id">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="edit-team-id" class="block text-gray-300 mb-2">Team ID</label>
                                <input type="number" id="edit-team-id" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-team-name" class="block text-gray-300 mb-2">Team Name</label>
                                <input type="text" id="edit-team-name" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-team-size" class="block text-gray-300 mb-2">Team Size</label>
                                <select id="edit-team-size" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" required>
                                    <option value="3">3 Members</option>
                                    <option value="4">4 Members</option>
                                    <option value="5">5 Members</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit-project-title" class="block text-gray-300 mb-2">Project Title</label>
                                <input type="text" id="edit-project-title" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" required>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-4 pt-4">
                            <button type="button" id="delete-team-btn" class="cyber-button danger">
                                <span>Delete Team</span>
                            </button>
                            <button type="submit" class="cyber-button primary">
                                <span>Save Changes</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Mentors Tab -->
        <div id="mentors" class="tab-content hidden">
            <h1 class="glitch-text text-4xl mb-6" data-text="Mentors">Mentors</h1>
            
            <div class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-opacity-20 bg-black">
                        <thead>
                            <tr class="border-b border-cyan-900/30">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Mentor Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Teams Evaluated</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Avg. Scores</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Rounds</th>
                            </tr>
                        </thead>
                        <tbody id="mentors-table-body">
                            <!-- Will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Results Tab -->
        <div id="results" class="tab-content hidden">
            <h1 class="glitch-text text-4xl mb-6" data-text="Final Results">Final Results</h1>
            
            <div class="p-6 border border-cyan-900/30 rounded-lg bg-black/20 backdrop-blur-md mb-8">
                <div class="mb-6">
                    <h3 class="text-lg text-cyan-400 mb-4">Results Configuration</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-gray-300 mb-2">Round 1 Weight</label>
                            <input type="range" id="r1-weight" min="10" max="50" value="30" class="w-full">
                            <p class="text-center text-white mt-1" id="r1-weight-value">30%</p>
                        </div>
                        <div>
                            <label class="block text-gray-300 mb-2">Round 2 Weight</label>
                            <input type="range" id="r2-weight" min="10" max="50" value="30" class="w-full">
                            <p class="text-center text-white mt-1" id="r2-weight-value">30%</p>
                        </div>
                        <div>
                            <label class="block text-gray-300 mb-2">Round 3 Weight</label>
                            <input type="range" id="r3-weight" min="10" max="50" value="40" class="w-full">
                            <p class="text-center text-white mt-1" id="r3-weight-value">40%</p>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-center mb-6">
                    <button id="generate-results-btn" class="cyber-button primary">
                        <span>Generate Final Results</span>
                    </button>
                </div>
                
                <div id="results-notice" class="text-center text-gray-400 py-4">
                    Results generation will compile all evaluation data and calculate final team rankings.
                </div>
            </div>
            
            <!-- Results Table (Hidden until generated) -->
            <div id="results-table-container" class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-6 hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg text-cyan-400">Final Rankings</h3>
                    <button id="export-results-btn" class="cyber-button secondary small">
                        <span>Export Results</span>
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-opacity-20 bg-black">
                        <thead>
                            <tr class="border-b border-cyan-900/30">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Rank</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Project</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">R1 Score</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">R2 Score</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">R3 Score</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Final Score</th>
                            </tr>
                        </thead>
                        <tbody id="results-table-body">
                            <!-- Will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Firebase Admin Script -->
<script type="module">
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js";
  import { getAuth, onAuthStateChanged, signOut } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-auth.js";
  import { 
    getFirestore, 
    collection, 
    getDocs, 
    doc, 
    updateDoc, 
    serverTimestamp 
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
  
  document.addEventListener('DOMContentLoaded', async function() {
    const authChecking = document.getElementById('auth-checking');
    const adminContent = document.getElementById('admin-content');
    const adminLogoutBtn = document.getElementById('admin-logout-btn');
    const exportCsvBtn = document.getElementById('export-csv');
    const lockAllBtn = document.getElementById('lock-all-btn');
    
    // Check authentication
    onAuthStateChanged(auth, async function(user) {
        if (user && user.email === 'singhkashish364@gmail.com') {
            // This is the admin
            console.log("Admin authenticated:", user.email);
            
            // Show admin content
            authChecking.style.display = 'none';
            adminContent.classList.remove('hidden');
            
            // Load admin data
            await loadAdminData();
        } else {
            // Not admin, redirect
            console.log("Not admin, redirecting to login");
            window.location.href = 'login.php';
        }
    });
    
    // Logout functionality
    adminLogoutBtn.addEventListener('click', function() {
        signOut(auth).then(() => {
            window.location.href = 'login.php';
        }).catch((error) => {
            console.error('Logout Error:', error);
            alert("Error logging out. Please try again.");
        });
    });
    
    // Export to CSV functionality
    exportCsvBtn.addEventListener('click', async function() {
        try {
            const evaluationsRef = collection(db, "evaluations");
            const snapshot = await getDocs(evaluationsRef);
            
            if (snapshot.empty) {
                alert("No data to export");
                return;
            }
            
            // Create CSV content
            let csvContent = "data:text/csv;charset=utf-8,";
            csvContent += "Mentor,Team ID,Team Name,Round,Team Size,Project Title,Innovation,Technical,Presentation,Overall,Status,Timestamp\n";
            
            snapshot.forEach(doc => {
                const data = doc.data();
                csvContent += `${data.mentorEmail || ''},`;
                csvContent += `${data.teamId || ''},`;
                csvContent += `"${data.teamName || ''}",`;
                csvContent += `${data.round || '1'},`;
                csvContent += `${data.teamSize || ''},`;
                csvContent += `"${data.projectTitle || ''}",`;
                csvContent += `${data.innovationScore || '0'},`;
                csvContent += `${data.technicalScore || '0'},`;
                csvContent += `${data.presentationScore || '0'},`;
                csvContent += `${data.overallScore || '0'},`;
                csvContent += `${data.isLocked ? 'Locked' : 'Unlocked'},`;
                csvContent += `${data.createdAt?.toDate().toISOString() || ''}\n`;
            });
            
            // Create download link
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "byteverse_evaluations.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        } catch (error) {
            console.error("Error exporting data:", error);
            alert("Failed to export data. Please try again.");
        }
    });
    
    // Lock All Unlocked functionality
    lockAllBtn.addEventListener('click', async function() {
        try {
            // Check if user confirms this action
            if (!confirm('Are you sure you want to lock ALL unlocked evaluations? This action cannot be undone.')) {
                return;
            }
            
            // Show loading state
            lockAllBtn.innerHTML = `<span>Locking...</span>`;
            lockAllBtn.disabled = true;
            
            // Get all evaluations
            const evaluationsRef = collection(db, "evaluations");
            const snapshot = await getDocs(evaluationsRef);
            
            if (snapshot.empty) {
                alert("No evaluations to lock");
                return;
            }
            
            // Count for status message
            let lockedCount = 0;
            let totalToLock = 0;
            
            // Find unlocked evaluations
            const unlocked = [];
            snapshot.forEach(doc => {
                const data = doc.data();
                if (!data.isLocked) {
                    unlocked.push(doc.id);
                    totalToLock++;
                }
            });
            
            if (unlocked.length === 0) {
                alert("All evaluations are already locked");
                return;
            }
            
            // Lock each unlocked evaluation
            for (const docId of unlocked) {
                const evaluationRef = doc(db, "evaluations", docId);
                await updateDoc(evaluationRef, {
                    isLocked: true,
                    lockedAt: serverTimestamp(),
                    lockedBy: "admin"
                });
                lockedCount++;
            }
            
            // Update the UI
            alert(`Successfully locked ${lockedCount} of ${totalToLock} evaluations.`);
            
            // Reload admin data to refresh the table
            await loadAdminData();
        } catch (error) {
            console.error("Error locking evaluations:", error);
            alert("Failed to lock evaluations. Please try again.");
        } finally {
            // Reset button
            lockAllBtn.innerHTML = `<span>Lock All Unlocked</span>`;
            lockAllBtn.disabled = false;
        }
    });
    
    // Load admin data
    async function loadAdminData() {
        try {
            // Get all evaluations
            const evaluationsSnapshot = await getDocs(collection(db, "evaluations"));
            const totalEvaluationsCount = document.getElementById('total-evaluations-count');
            totalEvaluationsCount.textContent = evaluationsSnapshot.size;
            
            // Process evaluations
            const evaluations = [];
            const mentors = new Set();
            const teams = new Set();
            let lockedCount = 0;
            
            evaluationsSnapshot.forEach(doc => {
                const data = doc.data();
                evaluations.push({
                    id: doc.id,
                    ...data
                });
                
                if (data.mentorEmail) mentors.add(data.mentorEmail);
                if (data.teamId) teams.add(data.teamId);
                if (data.isLocked) lockedCount++;
            });
            
            // Update stats
            const totalTeamsCount = document.getElementById('total-teams-count');
            const totalMentorsCount = document.getElementById('total-mentors-count');
            const teamsEvaluatedRatio = document.getElementById('teams-evaluated-ratio');
            
            totalTeamsCount.textContent = teams.size;
            totalMentorsCount.textContent = mentors.size;
            
            // Calculate and display team evaluation ratio and percentage
            const evaluationPercentage = Math.round((teams.size / 100) * 100);
            teamsEvaluatedRatio.textContent = `${teams.size}/100 (${evaluationPercentage}%)`;
            
            // Add unlock status indicator
            const unlockCount = evaluations.length - lockedCount;
            if (unlockCount > 0) {
                const lockAllBtn = document.getElementById('lock-all-btn');
                lockAllBtn.innerHTML = `<span>Lock All (${unlockCount} Unlocked)</span>`;
                // Remove the class that adds animation
                // lockAllBtn.classList.add('pulse-warning');
            } else {
                const lockAllBtn = document.getElementById('lock-all-btn');
                lockAllBtn.innerHTML = `<span>All Evaluations Locked</span>`;
                // No need to remove the class if we're not adding it
                // lockAllBtn.classList.remove('pulse-warning');
                lockAllBtn.disabled = true;
            }
            
            // Populate table
            populateAdminTable(evaluations);
            
        } catch (error) {
            console.error("Error loading admin data:", error);
            alert("Failed to load admin data. Please refresh the page.");
        }
    }
    
    // Populate admin table
    function populateAdminTable(evaluations) {
        const tableBody = document.getElementById('admin-evaluations-table');
        
        if (evaluations.length === 0) {
            tableBody.innerHTML = '<tr class="border-b border-gray-800"><td colspan="10" class="px-6 py-4 text-center text-gray-400">No evaluations found.</td></tr>';
            return;
        }
        
        // Sort by timestamp
        evaluations.sort((a, b) => {
            return b.createdAt?.toMillis() - a.createdAt?.toMillis();
        });
        
        tableBody.innerHTML = '';
        evaluations.forEach(evaluation => {
            const isLocked = evaluation.isLocked || false;
            const round = evaluation.round || "1";
            
            tableBody.innerHTML += `
                <tr class="border-b border-gray-800 hover:bg-black/30">
                    <td class="px-6 py-4 text-sm text-white">${evaluation.mentorEmail || '—'}</td>
                    <td class="px-6 py-4 text-sm text-white">${evaluation.teamId}</td>
                    <td class="px-6 py-4 text-sm text-white">${evaluation.teamName}</td>
                    <td class="px-6 py-4 text-sm text-white"><span class="px-2 py-1 bg-cyan-900/30 text-cyan-400 rounded-full text-xs">Round ${round}</span></td>
                    <td class="px-6 py-4 text-sm text-white">${evaluation.teamSize || '—'} members</td>
                    <td class="px-6 py-4 text-sm text-white">${evaluation.innovationScore}/10</td>
                    <td class="px-6 py-4 text-sm text-white">${evaluation.technicalScore}/10</td>
                    <td class="px-6 py-4 text-sm text-white">${evaluation.presentationScore}/10</td>
                    <td class="px-6 py-4 text-sm font-bold text-cyan-400">${evaluation.overallScore}</td>
                    <td class="px-6 py-4 text-sm">
                        ${isLocked ? 
                            '<span class="px-2 py-1 bg-gray-700/50 text-gray-400 rounded text-xs flex items-center"><span class="mr-1">🔒</span> Locked</span>' : 
                            '<span class="px-2 py-1 bg-green-900/20 text-green-400 rounded text-xs flex items-center"><span class="mr-1">🔓</span> Unlocked</span>'
                        }
                    </td>
                </tr>
            `;
        });
    }
  });
</script>

<!-- Add before closing </body> tag in admin.php -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="module" src="assets/js/admin.js"></script>

<style>
  /* Chart styling */
  .chart-container {
    transition: all 0.3s ease;
  }
  
  .chart-container.fixed {
    position: fixed;
    top: 80px;
    z-index: 20;
    box-shadow: 0 0 20px rgba(0, 215, 254, 0.3);
  }
  
  .chart-container.expanded {
    grid-column: span 2;
  }
  
  .chart-wrapper {
    transition: height 0.3s ease;
  }
  
  .chart-container.expanded .chart-wrapper {
    height: 400px;
  }
  
  /* Ensure modal chart is responsive */
  #chart-modal-container {
    max-height: 70vh;
  }
  
  /* Chart resize handle */
  .resizable-chart {
    position: relative;
  }
  
  .resize-handle {
    position: absolute;
    right: 0;
    bottom: 0;
    width: 20px;
    height: 20px;
    cursor: nwse-resize;
    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M12 14 L14 14 L14 12 M12 18 L18 18 L18 12" stroke="rgba(0, 215, 254, 0.5)" fill="none" stroke-width="2"/></svg>');
    background-repeat: no-repeat;
    background-position: center;
  }
</style>

<!-- Chart Modal for Expanded View -->
<div id="chart-modal" class="fixed inset-0 bg-black bg-opacity-80 z-50 flex-col items-center justify-center hidden">
  <div class="bg-opacity-95 backdrop-blur-xl bg-gray-900 border border-cyan-800/50 rounded-lg p-6 max-w-5xl w-full mx-4 relative">
    <button id="close-chart-modal" class="absolute top-4 right-4 text-gray-400 hover:text-white">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
    <h3 id="chart-modal-title" class="text-xl text-cyan-400 mb-4">Chart Details</h3>
    <div id="chart-modal-container" style="position: relative; height:70vh; width:100%">
      <canvas id="modal-chart"></canvas>
    </div>
  </div>
</div>

<?php 
// Include terminal
require_once('components/terminal.php');

// Include footer
require_once('components/footer.php');
?>

<!-- Add this style tag just before the closing </body> tag -->
<style>
/* Remove pulsing animation but keep visual indicator */
.pulse-warning {
    animation: none !important;
    box-shadow: 0 0 5px 0 rgba(255, 193, 7, 0.5);
}

/* Override other button animations */
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
</style>