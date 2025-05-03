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
    <div class="w-64 bg-opacity-10 backdrop-filter backdrop-blur-lg bg-gray-800 border-r border-cyan-900/30 fixed h-screen z-30 transform md:translate-x-0 -translate-x-full transition-transform duration-300" id="admin-sidebar">
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
    <div class="flex-1 md:ml-64 px-4 md:px-6 py-8 transition-all duration-300">
        <!-- Dashboard Tab -->
        <div id="dashboard" class="tab-content active">
            <h1 class="glitch-text text-3xl md:text-4xl mb-6" data-text="Admin Dashboard">Admin Dashboard</h1>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
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
            
            <!-- Charts Row - adjust for better mobile display -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
              <!-- Rounds Chart Container -->
              <div class="chart-container bg-black/20 backdrop-blur-md border border-cyan-900/30 rounded-lg p-4 h-80 md:h-80 sm:h-60">
                <div class="flex justify-between items-center mb-4">
                  <h3 class="text-lg text-cyan-400">Evaluations by Round</h3>
                </div>
                <div class="chart-wrapper" style="position: relative; height:calc(100% - 40px); width:100%">
                  <canvas id="rounds-chart"></canvas>
                </div>
              </div>
              
              <!-- Scores Chart Container -->
              <div class="chart-container bg-black/20 backdrop-blur-md border border-cyan-900/30 rounded-lg p-4 h-80 md:h-80 sm:h-60">
                <div class="flex justify-between items-center mb-4">
                  <h3 class="text-lg text-cyan-400">Score Distribution</h3>
                </div>
                <div class="chart-wrapper" style="position: relative; height:calc(100% - 40px); width:100%">
                  <canvas id="scores-chart"></canvas>
                </div>
              </div>
            </div>
            
            <!-- Recent Evaluations Table - Make scrollable horizontally only -->
            <div class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-6 mb-8">
                <h3 class="text-lg text-cyan-400 mb-4">Recent Evaluations</h3>
                <div class="table-responsive overflow-x-auto overflow-y-visible">
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
            
            <!-- Top Teams Section - Make scrollable horizontally only -->
            <div id="top-teams-section" class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-6 mb-8 hidden">
                <h3 class="text-lg text-cyan-400 mb-4">Top 10 Teams</h3>
                <div class="table-responsive overflow-x-auto overflow-y-visible">
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
        
        <!-- Teams Management Tab - Make table responsive -->
        <div id="teams" class="tab-content hidden">
            <h1 class="glitch-text text-3xl md:text-4xl mb-6" data-text="Manage Teams">Manage Teams</h1>
            
            <!-- Search bar for teams -->
            <div class="flex justify-end items-center mb-4">
                <div class="relative w-full md:w-64">
                    <input type="text" id="team-search" placeholder="Search teams..." class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-2.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            
            <div class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-6">
                <div class="table-responsive overflow-x-auto overflow-y-visible">
                    <table class="min-w-full bg-opacity-20 bg-black">
                        <thead>
                            <tr class="border-b border-cyan-900/30">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Team Size</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Project Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">R1</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">R2</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">R3</th>
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
            <div id="team-modal" class="fixed inset-0 bg-black bg-opacity-80 z-50 flex-col items-center justify-center hidden overflow-y-auto py-10">
                <div class="bg-opacity-95 backdrop-blur-xl bg-gray-900 border border-cyan-800/50 rounded-lg p-4 md:p-8 max-w-2xl w-full mx-4 my-auto relative">
                    <h3 class="text-xl text-cyan-400 mb-6" id="modal-title">Edit Team</h3>
                    <button class="absolute top-4 right-4 text-gray-400 hover:text-white" id="close-modal">✕</button>
                    
                    <!-- Team form with scrollable content -->
                    <div class="max-h-[70vh] overflow-y-auto pr-2 scrollable-content">
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
                            
                            <!-- Add scores section -->
                            <div class="border-t border-cyan-900/30 pt-4 mt-4">
                                <h4 class="text-lg text-cyan-400 mb-4">Team Scores</h4>
                                <!-- Round 1 Scores -->
                                <div class="mb-6">
                                    <h5 class="text-md text-cyan-300 mb-2">Round 1</h5>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                        <div class="form-group">
                                            <label for="edit-r1-score" class="block text-gray-300 mb-2">Overall</label>
                                            <input type="number" id="edit-r1-score" min="0" max="10" step="0.1" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" placeholder="0.0">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-r1-innovation" class="block text-gray-300 mb-2">Innovation</label>
                                            <input type="number" id="edit-r1-innovation" min="0" max="10" step="0.1" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" placeholder="0.0">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-r1-technical" class="block text-gray-300 mb-2">Technical</label>
                                            <input type="number" id="edit-r1-technical" min="0" max="10" step="0.1" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" placeholder="0.0">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-r1-presentation" class="block text-gray-300 mb-2">Presentation</label>
                                            <input type="number" id="edit-r1-presentation" min="0" max="10" step="0.1" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" placeholder="0.0">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Round 2 Scores -->
                                <div class="mb-6">
                                    <h5 class="text-md text-cyan-300 mb-2">Round 2</h5>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                        <div class="form-group">
                                            <label for="edit-r2-score" class="block text-gray-300 mb-2">Overall</label>
                                            <input type="number" id="edit-r2-score" min="0" max="10" step="0.1" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" placeholder="0.0">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-r2-innovation" class="block text-gray-300 mb-2">Innovation</label>
                                            <input type="number" id="edit-r2-innovation" min="0" max="10" step="0.1" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" placeholder="0.0">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-r2-technical" class="block text-gray-300 mb-2">Technical</label>
                                            <input type="number" id="edit-r2-technical" min="0" max="10" step="0.1" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" placeholder="0.0">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-r2-presentation" class="block text-gray-300 mb-2">Presentation</label>
                                            <input type="number" id="edit-r2-presentation" min="0" max="10" step="0.1" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" placeholder="0.0">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Round 3 Scores -->
                                <div class="mb-6">
                                    <h5 class="text-md text-cyan-300 mb-2">Round 3</h5>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                        <div class="form-group">
                                            <label for="edit-r3-score" class="block text-gray-300 mb-2">Overall</label>
                                            <input type="number" id="edit-r3-score" min="0" max="10" step="0.1" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" placeholder="0.0">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-r3-innovation" class="block text-gray-300 mb-2">Innovation</label>
                                            <input type="number" id="edit-r3-innovation" min="0" max="10" step="0.1" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" placeholder="0.0">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-r3-technical" class="block text-gray-300 mb-2">Technical</label>
                                            <input type="number" id="edit-r3-technical" min="0" max="10" step="0.1" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" placeholder="0.0">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-r3-presentation" class="block text-gray-300 mb-2">Presentation</label>
                                            <input type="number" id="edit-r3-presentation" min="0" max="10" step="0.1" class="w-full bg-black/30 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-cyan-400" placeholder="0.0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
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
        </div>
        
        <!-- Mentors Tab -->
        <div id="mentors" class="tab-content hidden">
            <h1 class="glitch-text text-3xl md:text-4xl mb-6" data-text="Mentors">Mentors</h1>
            
            <div class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-6">
                <div class="table-responsive overflow-x-auto overflow-y-visible">
                    <table class="min-w-full bg-opacity-20 bg-black">
                        <thead>
                            <tr class="border-b border-cyan-900/30">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">No.</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Mentor Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Evaluations</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Teams</th>
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
            <h1 class="glitch-text text-3xl md:text-4xl mb-6" data-text="Final Results">Final Results</h1>
            
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
                <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                    <h3 class="text-lg text-cyan-400 mb-2 sm:mb-0">Final Rankings</h3>
                    <button id="export-results-btn" class="cyber-button secondary small">
                        <span>Export Results</span>
                    </button>
                </div>
                <div class="table-responsive overflow-x-auto overflow-y-visible">
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

<!-- Add floating menu button for mobile -->
<button id="mobile-menu-toggle" class="fixed bottom-4 right-4 z-50 md:hidden bg-cyan-700 hover:bg-cyan-600 text-white p-3 rounded-full shadow-lg">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
    </svg>
</button>

<!-- Add this enhanced CSS for responsive design and scrolling fixes -->
<style>
/* Custom scrollbar styling */
.scrollable-content {
  scrollbar-width: thin;
  scrollbar-color: rgba(0, 215, 254, 0.5) rgba(0, 0, 0, 0.2);
}

.scrollable-content::-webkit-scrollbar {
  width: 8px;
}

.scrollable-content::-webkit-scrollbar-track {
  background: rgba(0, 0, 0, 0.2);
  border-radius: 4px;
}

.scrollable-content::-webkit-scrollbar-thumb {
  background-color: rgba(0, 215, 254, 0.5);
  border-radius: 4px;
}

/* Horizontal scrolling for tables */
.table-responsive {
  overflow-x: auto;
  overflow-y: visible !important;
  -webkit-overflow-scrolling: touch;
  width: 100%;
  max-width: 100%;
  margin-bottom: 0;
}

.table-responsive::-webkit-scrollbar {
  height: 6px;
}

.table-responsive::-webkit-scrollbar-track {
  background: rgba(0, 0, 0, 0.2);
  border-radius: 3px;
}

.table-responsive::-webkit-scrollbar-thumb {
  background-color: rgba(0, 215, 254, 0.5);
  border-radius: 3px;
}

/* Make cells nowrap to force horizontal scrolling */
.table-responsive table th,
.table-responsive table td {
  white-space: nowrap;
}

/* Make charts smaller on mobile */
@media (max-width: 768px) {
  .chart-container {
    height: 220px !important;
  }
  
  .chart-wrapper {
    height: 180px !important;
  }
  
  .chart-container h3 {
    font-size: 0.95rem !important;
  }
  
  /* Smaller padding on table cells for mobile */
  table th, table td {
    padding: 0.5rem 0.75rem !important;
  }
  
  /* Fix glitch text responsive size */
  .glitch-text {
    font-size: 1.5rem !important;
  }
}

/* Add basic transitions for sidebar toggle */
#admin-sidebar {
  transition: transform 0.3s ease;
}

/* Mobile menu button styling */
#mobile-menu-toggle {
  transition: all 0.3s ease;
  transform: scale(1);
}

#mobile-menu-toggle:hover, #mobile-menu-toggle:focus {
  transform: scale(1.1);
}

#mobile-menu-toggle:active {
  transform: scale(0.95);
}
</style>

<script>
// Mobile sidebar toggle functionality
document.addEventListener('DOMContentLoaded', function() {
  const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
  const sidebar = document.getElementById('admin-sidebar');
  const sidebarOverlay = document.getElementById('sidebar-overlay');
  
  if(mobileMenuToggle && sidebar) {
    // Toggle sidebar
    mobileMenuToggle.addEventListener('click', function() {
      sidebar.classList.toggle('translate-x-0');
      sidebar.classList.toggle('-translate-x-full');
      if(sidebarOverlay) sidebarOverlay.classList.toggle('hidden');
    });
    
    // Close sidebar when clicking overlay
    if(sidebarOverlay) {
      sidebarOverlay.addEventListener('click', function() {
        sidebar.classList.remove('translate-x-0');
        sidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('hidden');
      });
    }
    
    // Close sidebar when clicking a nav link on mobile
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
      if(link) {
        link.addEventListener('click', function() {
          if(window.innerWidth < 768) {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            if(sidebarOverlay) sidebarOverlay.classList.add('hidden');
          }
        });
      }
    });
  }
});
</script>

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
    writeBatch,
    query,
    where,
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
    
    // Load admin data
    async function loadAdminData() {
      try {
        // Get element references with null checks
        const totalEvaluationsCount = document.getElementById("total-evaluations-count");
        const totalTeamsCount = document.getElementById("total-teams-count");
        const totalMentorsCount = document.getElementById("total-mentors-count");
        const teamsEvaluatedRatio = document.getElementById("teams-evaluated-ratio");
        
        // Check if on dashboard tab by verifying if elements exist
        if (!totalEvaluationsCount || !totalTeamsCount || 
            !totalMentorsCount || !teamsEvaluatedRatio) {
          console.log("Dashboard tab not active, skipping dashboard data load");
          return;
        }
        
        // Continue with data loading...
        const evaluationsSnapshot = await getDocs(collection(db, "evaluations"));
        
        if (totalEvaluationsCount) totalEvaluationsCount.textContent = evaluationsSnapshot.size;
        
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
        if (totalTeamsCount) totalTeamsCount.textContent = teams.size;
        if (totalMentorsCount) totalMentorsCount.textContent = mentors.size;
        
        // Calculate and display team evaluation ratio and percentage
        const evaluationPercentage = Math.round((teams.size / 100) * 100);
        teamsEvaluatedRatio.textContent = `${evaluationPercentage}%`;
        
      } catch (error) {
        console.error("Error loading admin data:", error);
      }
    }
  });
</script>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Main Admin Script -->
<script type="module" src="assets/js/admin.js"></script>

<?php 
// Include terminal
require_once('components/terminal.php');

// Include footer
require_once('components/footer.php');
?>
