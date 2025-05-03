// Complete Firebase Admin Script for admin.php
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js";
import { getAuth, onAuthStateChanged, signOut } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-auth.js";
import { 
  getFirestore, 
  collection, 
  getDocs, 
  doc, 
  updateDoc, 
  addDoc,
  deleteDoc,
  query,
  where,
  serverTimestamp,
  writeBatch
} from "https://www.gstatic.com/firebasejs/9.6.10/firebase-firestore.js";

// Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyAETwGMzy0eOv3XfhRgakFcjeij4mk5K70",
  authDomain: "byteverse-1.firebaseapp.com",
  projectId: "byteverse-1",
  storageBucket: "byteverse-1.appspot.com",
  messagingSenderId: "307945328858",
  appId: "1:307945328858:web:5017f868eb9fc977f795e3",
  measurementId: "G-G87GV2W2ZG",
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const db = getFirestore(app);

// Global variables
let roundsChart = null;
let scoresChart = null;
let allEvaluationsData = [];
let teamData = []; // Changed from {} to [] to make it an array
let finalResults = [];
let resultsGenerated = false;

document.addEventListener("DOMContentLoaded", async function () {
  // Fix for error at line 119: Add null check for DOM elements
  const authChecking = document.getElementById("auth-checking");
  const adminContent = document.getElementById("admin-content");
  const adminLogoutBtn = document.getElementById("admin-logout-btn");

  // Tab Navigation Elements - add null checks
  const navLinks = document.querySelectorAll(".nav-link");
  const tabContents = document.querySelectorAll(".tab-content");

  // Team Management Elements - add null checks
  const addTeamBtn = document.getElementById("add-team-btn");
  const teamModal = document.getElementById("team-modal");
  const teamForm = document.getElementById("team-form");
  const closeModalBtn = document.getElementById("close-modal");
  const teamSearch = document.getElementById("team-search");
  const deleteTeamBtn = document.getElementById("delete-team-btn");

  // Results Elements - add null checks
  const generateResultsBtn = document.getElementById("generate-results-btn");
  const exportResultsBtn = document.getElementById("export-results-btn");
  const r1Weight = document.getElementById("r1-weight");
  const r2Weight = document.getElementById("r2-weight");
  const r3Weight = document.getElementById("r3-weight");
  
  // Fix null error - safe element access with optional chaining
  const r1WeightValue = document.getElementById("r1-weight-value");
  const r2WeightValue = document.getElementById("r2-weight-value");
  const r3WeightValue = document.getElementById("r3-weight-value");

  // Apply mobile-specific UI enhancements
  addMobileEnhancements();
  
  // Make all tables horizontally scrollable only (not vertically)
  makeTablesScrollableHorizontally();
  
  // Adjust chart sizes for mobile
  adjustChartSizesForMobile();
  
  // Add floating mobile menu button in bottom right corner
  addMobileMenuButton();
  
  // Check authentication
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

  // Setup tab navigation
  navLinks.forEach((link) => {
    link.addEventListener("click", function () {
      // Get target tab id
      const target = this.dataset.target;

      // Deactivate all tabs
      navLinks.forEach((link) => link.classList.remove("active"));
      tabContents.forEach((content) => content.classList.add("hidden"));

      // Activate selected tab
      this.classList.add("active");
      document.getElementById(target).classList.remove("hidden");
    });
  });

  // Logout functionality
  adminLogoutBtn.addEventListener("click", function () {
    signOut(auth)
      .then(() => {
        window.location.href = "login.php";
      })
      .catch((error) => {
        console.error("Logout Error:", error);
        alert("Error logging out. Please try again.");
      });
  });

  // Team Management: Add new team
  if (addTeamBtn) {
    addTeamBtn.addEventListener("click", function () {
      // Reset form for new team entry
      const modalTitle = document.getElementById("modal-title");
      modalTitle.textContent = "Add New Team";

      document.getElementById("team-doc-id").value = "";
      document.getElementById("edit-team-id").value = "";
      document.getElementById("edit-team-name").value = "";
      document.getElementById("edit-team-size").value = "3";
      document.getElementById("edit-project-title").value = "";

      // Enable team ID for new teams
      document.getElementById("edit-team-id").disabled = false;

      // Show the modal
      teamModal.style.display = "flex";
    });
  }

  // Close the team modal
  if (closeModalBtn) {
    closeModalBtn.addEventListener("click", function () {
      if (teamModal) teamModal.style.display = "none";
    });
  }

  // Click outside modal to close
  if (teamModal) {
    teamModal.addEventListener("click", function (e) {
      if (e.target === teamModal) {
        teamModal.style.display = "none";
      }
    });
  }

  // Team search functionality
  if (teamSearch) {
    teamSearch.addEventListener("input", function () {
      const searchTerm = this.value.toLowerCase();
      const rows = document.querySelectorAll("#teams-table-body tr");

      rows.forEach((row) => {
        const teamId = row
          .querySelector("td:nth-child(1)")
          .textContent.toLowerCase();
        const teamName = row
          .querySelector("td:nth-child(2)")
          .textContent.toLowerCase();
        const projectTitle = row
          .querySelector("td:nth-child(4)")
          .textContent.toLowerCase();

        if (
          teamId.includes(searchTerm) ||
          teamName.includes(searchTerm) ||
          projectTitle.includes(searchTerm)
        ) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      });
    });
  }

  // Team form submission
  if (teamForm) {
    teamForm.addEventListener("submit", async function (e) {
      e.preventDefault(); // Prevent form submission/page reload

      try {
        const originalTeamId = document.getElementById("edit-team-id").getAttribute("data-original-value");
        const teamId = parseInt(document.getElementById("edit-team-id").value);
        const teamName = document.getElementById("edit-team-name").value;
        const teamSize = parseInt(document.getElementById("edit-team-size").value);
        const projectTitle = document.getElementById("edit-project-title").value;
        
        // Get all detailed scores
        const r1Score = getNumericValue("edit-r1-score");
        const r1Innovation = getNumericValue("edit-r1-innovation");
        const r1Technical = getNumericValue("edit-r1-technical");
        const r1Presentation = getNumericValue("edit-r1-presentation");
        
        const r2Score = getNumericValue("edit-r2-score");
        const r2Innovation = getNumericValue("edit-r2-innovation");
        const r2Technical = getNumericValue("edit-r2-technical");
        const r2Presentation = getNumericValue("edit-r2-presentation");
        
        const r3Score = getNumericValue("edit-r3-score");
        const r3Innovation = getNumericValue("edit-r3-innovation");
        const r3Technical = getNumericValue("edit-r3-technical");
        const r3Presentation = getNumericValue("edit-r3-presentation");

        // Validation
        if (isNaN(teamId) || !teamName || isNaN(teamSize)) {
          showNotification("Please fill in all required fields correctly.", "error");
          return;
        }

        // Create a batch to update all evaluations atomically
        const batch = writeBatch(db);
        
        console.log(`Processing team ${teamId}: ${teamName}`);
        
        // Find all existing evaluations for this team using original team ID if changed
        const evaluationsQuery = query(
          collection(db, "evaluations"), 
          where("teamId", "==", originalTeamId || teamId)
        );
        
        const evaluationSnapshot = await getDocs(evaluationsQuery);
        let updatedEvaluations = 0;
        
        // First, update all existing evaluations
        evaluationSnapshot.forEach((evalDoc) => {
          const evalData = evalDoc.data();
          const evalRef = doc(db, "evaluations", evalDoc.id);
          const round = evalData.round || "1";
          
          // Base update data for all evaluations - always update these common fields
          // If team ID changed, update it too
          const updateData = {
            teamId: teamId, // Update teamId if it changed
            teamName: teamName,
            teamSize: teamSize,
            projectTitle: projectTitle || "Untitled Project",
            updatedAt: serverTimestamp()
          };
          
          // Add round-specific scores only for the matching round
          if (round === "1" || round === 1) {
            if (!isNaN(r1Score)) updateData.overallScore = r1Score;
            if (!isNaN(r1Innovation)) updateData.innovationScore = r1Innovation;
            if (!isNaN(r1Technical)) updateData.technicalScore = r1Technical;
            if (!isNaN(r1Presentation)) updateData.presentationScore = r1Presentation;
          } else if (round === "2" || round === 2) {
            if (!isNaN(r2Score)) updateData.overallScore = r2Score;
            if (!isNaN(r2Innovation)) updateData.innovationScore = r2Innovation;
            if (!isNaN(r2Technical)) updateData.technicalScore = r2Technical;
            if (!isNaN(r2Presentation)) updateData.presentationScore = r2Presentation;
          } else if (round === "3" || round === 3) {
            if (!isNaN(r3Score)) updateData.overallScore = r3Score;
            if (!isNaN(r3Innovation)) updateData.innovationScore = r3Innovation;
            if (!isNaN(r3Technical)) updateData.technicalScore = r3Technical;
            if (!isNaN(r3Presentation)) updateData.presentationScore = r3Presentation;
          }
          
          // Add update to batch
          batch.update(evalRef, updateData);
          updatedEvaluations++;
          console.log(`Updating existing evaluation ${evalDoc.id} for round ${round}`);
        });
        
        // Only create new evaluations for rounds that don't exist yet and have scores
        if (evaluationSnapshot.empty || originalTeamId !== teamId) {
          for (let round = 1; round <= 3; round++) {
            const roundStr = round.toString();
            
            // Check if we have this round already
            const hasRound = Array.from(evaluationSnapshot.docs).some(doc => {
              const data = doc.data();
              return (data.round === roundStr || data.round === round) && 
                     data.teamId == teamId; // Compare as string and number
            });
            
            // Skip if we already have this round for the new team ID
            if (hasRound) {
              continue;
            }
            
            // Check if we have scores for this round
            let hasScores = false;
            let scores = {};
            
            if (round === 1 && (!isNaN(r1Score) || !isNaN(r1Innovation) || 
                              !isNaN(r1Technical) || !isNaN(r1Presentation))) {
              hasScores = true;
              scores = {
                overallScore: !isNaN(r1Score) ? r1Score : 0,
                innovationScore: !isNaN(r1Innovation) ? r1Innovation : 0,
                technicalScore: !isNaN(r1Technical) ? r1Technical : 0,
                presentationScore: !isNaN(r1Presentation) ? r1Presentation : 0
              };
            } else if (round === 2 && (!isNaN(r2Score) || !isNaN(r2Innovation) || 
                                  !isNaN(r2Technical) || !isNaN(r2Presentation))) {
              hasScores = true;
              scores = {
                overallScore: !isNaN(r2Score) ? r2Score : 0,
                innovationScore: !isNaN(r2Innovation) ? r2Innovation : 0,
                technicalScore: !isNaN(r2Technical) ? r2Technical : 0,
                presentationScore: !isNaN(r2Presentation) ? r2Presentation : 0
              };
            } else if (round === 3 && (!isNaN(r3Score) || !isNaN(r3Innovation) || 
                                  !isNaN(r3Technical) || !isNaN(r3Presentation))) {
              hasScores = true;
              scores = {
                overallScore: !isNaN(r3Score) ? r3Score : 0,
                innovationScore: !isNaN(r3Innovation) ? r3Innovation : 0,
                technicalScore: !isNaN(r3Technical) ? r3Technical : 0,
                presentationScore: !isNaN(r3Presentation) ? r3Presentation : 0
              };
            }
            
            // Create new evaluation only if we have scores and no existing record
            if (hasScores) {
              const newEvalRef = doc(collection(db, "evaluations"));
              
              batch.set(newEvalRef, {
                teamId: teamId,
                teamName: teamName,
                teamSize: teamSize,
                projectTitle: projectTitle || "Untitled Project",
                round: roundStr,
                mentorEmail: "admin@byteverse.org", // Admin-created evaluation
                ...scores,
                isLocked: true,
                createdAt: serverTimestamp(),
                updatedAt: serverTimestamp()
              });
              
              updatedEvaluations++;
              console.log(`Creating new evaluation for team ${teamId}, round ${round} - no existing record found`);
            }
          }
        }
        
        // Commit the batch
        if (updatedEvaluations > 0) {
          await batch.commit();
          showNotification(`Team "${teamName}" updated successfully! Updated ${updatedEvaluations} evaluations.`);
        } else {
          showNotification(`No changes were made to team "${teamName}".`);
        }
        
        // Close the modal without reloading
        if (teamModal) {
          teamModal.style.display = "none";
        }
        
        // Reload data to refresh the UI
        await loadTeamsData();
        
      } catch (error) {
        console.error("Error saving team:", error);
        showNotification("Failed to save team: " + error.message, "error");
      }
    });
  }

  // Delete team handler - Updated to delete evaluations only
  if (deleteTeamBtn) {
    deleteTeamBtn.addEventListener("click", async function () {
      const originalTeamId = document.getElementById("edit-team-id").getAttribute("data-original-value");
      const teamId = parseInt(document.getElementById("edit-team-id").value);
      const teamToDelete = originalTeamId || teamId;
      
      if (isNaN(teamToDelete)) {
        alert("Invalid team ID. Cannot delete team.");
        return;
      }
      
      if (confirm(`Are you sure you want to delete Team ${teamToDelete}? This will remove all evaluations for this team.`)) {
        try {
          // Find all evaluations for this team
          const evaluationsQuery = query(
            collection(db, "evaluations"), 
            where("teamId", "==", teamToDelete)
          );
          
          const evaluationSnapshot = await getDocs(evaluationsQuery);
          
          if (evaluationSnapshot.empty) {
            showNotification(`No evaluations found for Team ${teamToDelete}.`, "error");
            return;
          }
          
          // Create a batch for deletion
          const batch = writeBatch(db);
          
          evaluationSnapshot.forEach(doc => {
            batch.delete(doc.ref);
          });
          
          // Commit the batch
          await batch.commit();
          
          console.log(`Deleted all evaluations for Team ${teamToDelete}`);
          
          // Close the modal and refresh teams data
          if (teamModal) {
            teamModal.style.display = "none";
          }
          
          showNotification(`Team ${teamToDelete} deleted successfully! Removed ${evaluationSnapshot.size} evaluations.`);
          
          await loadTeamsData();
        } catch (error) {
          console.error("Error deleting team:", error);
          alert("Failed to delete team. Please try again.");
        }
      }
    });
  }

  // Handle result weight sliders with null checks
  if (r1Weight) r1Weight.addEventListener("input", updateWeights);
  if (r2Weight) r2Weight.addEventListener("input", updateWeights);
  if (r3Weight) r3Weight.addEventListener("input", updateWeights);
  
  // Fix function that updates weights to handle null elements
  function updateWeights() {
    if (!r1Weight || !r2Weight || !r3Weight || 
        !r1WeightValue || !r2WeightValue || !r3WeightValue) return;
    
    const r1Value = parseInt(r1Weight.value);
    const r2Value = parseInt(r2Weight.value);
    const r3Value = parseInt(r3Weight.value);
    
    // Update displayed values
    r1WeightValue.textContent = `${r1Value}%`;
    r2WeightValue.textContent = `${r2Value}%`;
    r3WeightValue.textContent = `${r3Value}%`;
    
    // Ensure total equals 100%
    const total = r1Value + r2Value + r3Value;
    if (total !== 100) {
      // Highlight in red if not equal to 100%
      [r1WeightValue, r2WeightValue, r3WeightValue].forEach(el => {
        el.classList.add('text-red-500');
        el.classList.remove('text-green-400');
      });
    } else {
      // Show in green if equal to 100%
      [r1WeightValue, r2WeightValue, r3WeightValue].forEach(el => {
        el.classList.add('text-green-400');
        el.classList.remove('text-red-500');
      });
    }
  }
  
  // Fix Generate final results button
  if (generateResultsBtn) {
    generateResultsBtn.addEventListener("click", async function () {
      if (!confirm("Are you sure you want to generate final results? This will process all evaluation data.")) {
        return;
      }

      try {
        this.disabled = true;
        this.innerHTML = `<span>Processing...</span>`;

        // Get weights from sliders with null checks
        const weights = {
          r1: parseInt((r1Weight && r1Weight.value) ? r1Weight.value : 33) / 100,
          r2: parseInt((r2Weight && r2Weight.value) ? r2Weight.value : 33) / 100,
          r3: parseInt((r3Weight && r3Weight.value) ? r3Weight.value : 34) / 100,
        };

        // Generate results
        await generateFinalResults(weights);

        // Show results table with null check
        const resultsTable = document.getElementById("results-table-container");
        if (resultsTable) {
          resultsTable.classList.remove("hidden");
        }

        const resultsNotice = document.getElementById("results-notice");
        if (resultsNotice) {
          resultsNotice.innerHTML = `
            <div class="text-center text-green-400 py-4">
              <p>✓ Results generated successfully with weights:</p>
              <p>Round 1: ${weights.r1 * 100}% | Round 2: ${weights.r2 * 100}% | Round 3: ${weights.r3 * 100}%</p>
            </div>
          `;
        }

        // Update dashboard top teams section with null check
        const topTeamsSection = document.getElementById("top-teams-section");
        if (topTeamsSection) {
          topTeamsSection.classList.remove("hidden");
        }
        
        // Call populateTopTeams if it exists
        if (typeof populateTopTeams === "function") {
          populateTopTeams();
        }

        // Mark as generated
        resultsGenerated = true;
      } catch (error) {
        console.error("Error generating results:", error);
        alert("Failed to generate results. Please try again.");
      } finally {
        this.disabled = false;
        this.innerHTML = `<span>Generate Final Results</span>`;
      }
    });
  }

  // Export results to CSV
  exportResultsBtn.addEventListener("click", function () {
    if (!resultsGenerated) {
      alert("Please generate results first.");
      return;
    }

    try {
      // Create CSV content
      let csvContent = "data:text/csv;charset=utf-8,";
      csvContent +=
        "Rank,Team ID,Team Name,Project Title,Round 1 Score,Round 2 Score,Round 3 Score,Final Score\n";

      finalResults.forEach((team, index) => {
        csvContent += `${index + 1},`;
        csvContent += `${team.teamId},`;
        csvContent += `"${team.teamName || ""}",`;
        csvContent += `"${team.projectTitle || ""}",`;
        csvContent += `${team.roundScores.r1 || "N/A"},`;
        csvContent += `${team.roundScores.r2 || "N/A"},`;
        csvContent += `${team.roundScores.r3 || "N/A"},`;
        csvContent += `${team.finalScore.toFixed(2)}\n`;
      });

      // Create download link
      const encodedUri = encodeURI(csvContent);
      const link = document.createElement("a");
      link.setAttribute("href", encodedUri);
      link.setAttribute("download", "byteverse_final_results.csv");
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    } catch (error) {
      console.error("Error exporting results:", error);
      alert("Failed to export results. Please try again.");
    }
  });

  // MAIN DASHBOARD FUNCTIONS

  // Load dashboard data
  async function loadDashboardData() {
    try {
      // Get all evaluations
      const evaluationsSnapshot = await getDocs(collection(db, "evaluations"));
      const totalEvaluationsCount = document.getElementById(
        "total-evaluations-count"
      );

      if (!evaluationsSnapshot.empty) {
        // Process evaluations
        allEvaluationsData = [];
        const mentors = new Set();
        const teams = new Set();
        let lockedCount = 0;

        // Round statistics
        const roundCounts = { 1: 0, 2: 0, 3: 0 };
        const scoreDistribution = {
          "0-2": 0,
          "2-4": 0,
          "4-6": 0,
          "6-8": 0,
          "8-10": 0,
        };

        evaluationsSnapshot.forEach((doc) => {
          const data = doc.data();
          const evaluation = {
            id: doc.id,
            ...data,
          };

          allEvaluationsData.push(evaluation);

          if (data.mentorEmail) mentors.add(data.mentorEmail);
          if (data.teamId) teams.add(data.teamId);
          if (data.isLocked) lockedCount++;

          // Count rounds
          const round = data.round || "1";
          if (roundCounts[round] !== undefined) {
            roundCounts[round]++;
          }

          // Count score distribution
          const score = parseFloat(data.overallScore) || 0;
          if (score < 2) scoreDistribution["0-2"]++;
          else if (score < 4) scoreDistribution["2-4"]++;
          else if (score < 6) scoreDistribution["4-6"]++;
          else if (score < 8) scoreDistribution["6-8"]++;
          else scoreDistribution["8-10"]++;
        });

        // Update stats
        totalEvaluationsCount.textContent = allEvaluationsData.length;
        document.getElementById("total-teams-count").textContent = teams.size;
        document.getElementById("total-mentors-count").textContent =
          mentors.size;

        // Calculate and display team evaluation ratio and percentage
        const evaluationPercentage = Math.round((teams.size / 100) * 100);
        document.getElementById(
          "teams-evaluated-ratio"
        ).textContent = `${evaluationPercentage}%`;

        // Initialize charts
        initializeRoundsChart(roundCounts);
        initializeScoresChart(scoreDistribution);

        // Populate recent evaluations
        populateRecentEvaluations(allEvaluationsData);
      } else {
        totalEvaluationsCount.textContent = "0";
        document.getElementById("total-teams-count").textContent = "0";
        document.getElementById("total-mentors-count").textContent = "0";
        document.getElementById("teams-evaluated-ratio").textContent = "0%";
      }
    } catch (error) {
      console.error("Error loading dashboard data:", error);
    }
  }

  // Update initialize rounds chart function
  function initializeRoundsChart(roundCounts) {
    const ctx = document.getElementById("rounds-chart").getContext("2d");

    // Destroy existing chart if it exists
    if (roundsChart) {
      roundsChart.destroy();
    }

    roundsChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Round 1", "Round 2", "Round 3"],
        datasets: [
          {
            label: "Teams Evaluated",
            data: [roundCounts["1"], roundCounts["2"], roundCounts["3"]],
            backgroundColor: [
              "rgba(0, 215, 254, 0.4)",
              "rgba(0, 215, 254, 0.6)",
              "rgba(0, 215, 254, 0.8)",
            ],
            borderColor: [
              "rgba(0, 215, 254, 1)",
              "rgba(0, 215, 254, 1)",
              "rgba(0, 215, 254, 1)",
            ],
            borderWidth: 1,
            borderRadius: 4,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        layout: {
          padding: {
            top: 10,
          },
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              color: "rgba(255, 255, 255, 0.7)",
              font: {
                size: 10,
              },
              precision: 0,
            },
            grid: {
              color: "rgba(255, 255, 255, 0.1)",
            },
          },
          x: {
            ticks: {
              color: "rgba(255, 255, 255, 0.7)",
              font: {
                size: 10,
              },
            },
            grid: {
              display: false,
            },
          },
        },
        plugins: {
          legend: {
            display: false,
          },
          tooltip: {
            callbacks: {
              title: function (tooltipItems) {
                return tooltipItems[0].label;
              },
              label: function (context) {
                return `Teams evaluated: ${context.raw}`;
              },
            },
          },
        },
      },
    });
  }

  // Update initialize scores chart function
  function initializeScoresChart(scoreDistribution) {
    const ctx = document.getElementById("scores-chart").getContext("2d");

    // Destroy existing chart if it exists
    if (scoresChart) {
      scoresChart.destroy();
    }

    // Calculate total for percentage
    const total = Object.values(scoreDistribution).reduce((a, b) => a + b, 0);

    scoresChart = new Chart(ctx, {
      type: "doughnut",
      data: {
        labels: ["0-2", "2-4", "4-6", "6-8", "8-10"],
        datasets: [
          {
            data: [
              scoreDistribution["0-2"],
              scoreDistribution["2-4"],
              scoreDistribution["4-6"],
              scoreDistribution["6-8"],
              scoreDistribution["8-10"],
            ],
            backgroundColor: [
              "rgba(255, 99, 132, 0.7)",
              "rgba(255, 159, 64, 0.7)",
              "rgba(255, 205, 86, 0.7)",
              "rgba(75, 192, 192, 0.7)",
              "rgba(54, 162, 235, 0.7)",
            ],
            borderColor: [
              "rgb(255, 99, 132)",
              "rgb(255, 159, 64)",
              "rgb(255, 205, 86)",
              "rgb(75, 192, 192)",
              "rgb(54, 162, 235)",
            ],
            borderWidth: 1,
            borderRadius: 4,
            hoverOffset: 15,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        layout: {
          padding: 20,
        },
        plugins: {
          legend: {
            position: "right",
            labels: {
              color: "rgba(255, 255, 255, 0.7)",
              padding: 20,
              boxWidth: 12,
              boxHeight: 12,
              font: {
                size: 10,
              },
            },
          },
          tooltip: {
            callbacks: {
              label: function (context) {
                const value = context.raw;
                const percentage = Math.round((value / total) * 100);
                return `Score ${context.label}: ${value} evals (${percentage}%)`;
              },
            },
          },
        },
        cutout: "65%",
      },
    });
  }

  // Populate recent evaluations
  function populateRecentEvaluations(evaluations) {
    const tableBody = document.getElementById("recent-evaluations-body");

    if (!evaluations.length) {
      tableBody.innerHTML =
        '<tr class="border-b border-gray-800"><td colspan="5" class="px-6 py-4 text-center text-gray-400">No evaluations found</td></tr>';
      return;
    }

    // Sort evaluations by timestamp (newest first)
    const recentEvals = [...evaluations]
      .sort((a, b) => {
        return (b.createdAt?.toMillis() || 0) - (a.createdAt?.toMillis() || 0);
      })
      .slice(0, 5); // Get most recent 5

    tableBody.innerHTML = "";

    recentEvals.forEach((evaluation) => {
      // Changed 'eval' to 'evaluation'
      const timestamp = evaluation.createdAt?.toDate() || new Date();
      const formattedTime = timestamp.toLocaleString();

      tableBody.innerHTML += `
        <tr class="border-b border-gray-800">
          <td class="px-6 py-4 text-sm text-white">${
            evaluation.mentorEmail || "—"
          }</td>
          <td class="px-6 py-4 text-sm text-white">${evaluation.teamId} - ${
        evaluation.teamName
      }</td>
          <td class="px-6 py-4 text-sm text-white"><span class="px-2 py-1 bg-cyan-900/30 text-cyan-400 rounded-full text-xs">Round ${
            evaluation.round || "1"
          }</span></td>
          <td class="px-6 py-4 text-sm font-bold text-cyan-400">${
            evaluation.overallScore
          }</td>
          <td class="px-6 py-4 text-sm text-gray-400">${formattedTime}</td>
        </tr>
      `;
    });
  }

  // TEAM MANAGEMENT FUNCTIONS

  // Load teams data - Modified to get teams primarily from evaluations collection
  async function loadTeamsData() {
    try {
      console.log("Loading teams data from evaluations collection...");
      // Create an array to store teams
      window.teamData = [];
      
      // Get evaluations collection
      const evaluationsSnapshot = await getDocs(collection(db, "evaluations"));
      
      console.log(`Found ${evaluationsSnapshot.size} evaluations`);
      
      // Create a Map to store unique teams by ID
      const teamsMap = new Map();
      
      // Process all evaluations to extract team data
      evaluationsSnapshot.forEach((doc) => {
        const data = doc.data();
        if (!data.teamId) return;
        
        const teamId = String(data.teamId);
        const round = data.round || "1";
        
        console.log(`Processing evaluation for team: ${teamId}, round: ${round}, project: ${data.projectTitle}`);
        
        // If team doesn't exist yet in our map, create it
        if (!teamsMap.has(teamId)) {
          teamsMap.set(teamId, {
            teamId: teamId,
            teamName: data.teamName || `Team ${teamId}`,
            teamSize: parseInt(data.teamSize || "3"),
            projectTitle: data.projectTitle || "Untitled Project",
            createdAt: data.createdAt || null,
            updatedAt: data.updatedAt || null,
            source: 'evaluations'
          });
        }
        
        // Update the team entry with additional data from this evaluation
        const teamEntry = teamsMap.get(teamId);
        
        // Store score data based on round
        const scoreField = `r${round}Score`;
        const innovationField = `r${round}Innovation`;
        const technicalField = `r${round}Technical`;
        const presentationField = `r${round}Presentation`;
        
        // Capture scores from evaluations
        teamEntry[scoreField] = parseFloat(data.overallScore) || 0;
        teamEntry[innovationField] = parseFloat(data.innovationScore) || 0;
        teamEntry[technicalField] = parseFloat(data.technicalScore) || 0;
        teamEntry[presentationField] = parseFloat(data.presentationScore) || 0;
      });
      
      // Convert Map to Array
      window.teamData = Array.from(teamsMap.values());
      
      // Sort teams by ID
      window.teamData.sort((a, b) => parseInt(a.teamId) - parseInt(b.teamId));
      
      // Debug info
      console.log(`Total teams extracted from evaluations: ${window.teamData.length}`);
      console.log("Teams data loaded:", window.teamData);
      
      // Populate teams table
      populateTeamsTable(window.teamData);
      
    } catch (error) {
      console.error("Error loading teams data from evaluations:", error);
      showNotification("Failed to load teams data", "error");
    }
  }

  // Load mentors data
  async function loadMentorsData() {
    try {
      // Get mentors from evaluations
      const mentorsSet = new Set();
      const mentorsTableBody = document.getElementById("mentors-table-body");
      
      if (!mentorsTableBody) {
        console.log("Mentors table not found in current view, skipping");
        return;
      }
      
      mentorsTableBody.innerHTML = ""; // Clear existing rows
      
      // Use existing evaluations data if available
      if (allEvaluationsData.length === 0) {
        const evaluationsSnapshot = await getDocs(collection(db, "evaluations"));
        evaluationsSnapshot.forEach(doc => {
          const data = doc.data();
          if (data.mentorEmail) {
            mentorsSet.add(data.mentorEmail);
          }
        });
      } else {
        allEvaluationsData.forEach(evaluation => {
          if (evaluation.mentorEmail) {
            mentorsSet.add(evaluation.mentorEmail);
          }
        });
      }
      
      if (mentorsSet.size === 0) {
        mentorsTableBody.innerHTML = `
          <tr class="border-b border-gray-800">
            <td colspan="5" class="px-6 py-4 text-center text-gray-400">No mentors found</td>
          </tr>
        `;
        return;
      }
      
      // Convert to array and sort alphabetically
      const mentors = Array.from(mentorsSet).sort();
      
      mentors.forEach((mentorEmail, index) => {
        // Create counts for each mentor
        const mentorData = {
          email: mentorEmail,
          evaluations: 0,
          teams: new Set(),
          rounds: { 1: 0, 2: 0, 3: 0 }
        };
        
        // Count evaluations for this mentor
        allEvaluationsData.forEach(evaluation => {
          if (evaluation.mentorEmail === mentorEmail) {
            mentorData.evaluations++;
            if (evaluation.teamId) mentorData.teams.add(evaluation.teamId);
            const round = evaluation.round || "1";
            if (mentorData.rounds[round] !== undefined) {
              mentorData.rounds[round]++;
            }
          }
        });
        
        // Add mentor row to table
        mentorsTableBody.innerHTML += `
          <tr class="border-b border-gray-800">
            <td class="px-6 py-4 text-sm text-white">${index + 1}</td>
            <td class="px-6 py-4 text-sm text-white">${mentorEmail}</td>
            <td class="px-6 py-4 text-sm text-white">${mentorData.evaluations}</td>
            <td class="px-6 py-4 text-sm text-white">${mentorData.teams.size}</td>
            <td class="px-6 py-4 text-sm text-white">
              ${mentorData.rounds[1] ? `<span class="px-2 py-1 bg-cyan-900/30 text-cyan-400 rounded-full text-xs mr-1">R1: ${mentorData.rounds[1]}</span>` : ''}
              ${mentorData.rounds[2] ? `<span class="px-2 py-1 bg-cyan-900/30 text-cyan-400 rounded-full text-xs mr-1">R2: ${mentorData.rounds[2]}</span>` : ''}
              ${mentorData.rounds[3] ? `<span class="px-2 py-1 bg-cyan-900/30 text-cyan-400 rounded-full text-xs mr-1">R3: ${mentorData.rounds[3]}</span>` : ''}
            </td>
          </tr>
        `;
      });
      
      console.log(`Loaded ${mentors.length} mentors`);
    } catch (error) {
      console.error("Error loading mentors data:", error);
      showNotification("Failed to load mentors data", "error");
    }
  }

  // Populate teams table
  function populateTeamsTable(teams) {
    const tableBody = document.getElementById("teams-table-body");
    if (!tableBody) {
      console.warn("Teams table body not found");
      return;
    }
    
    tableBody.innerHTML = ""; // Clear existing rows
    
    if (!teams.length) {
      tableBody.innerHTML = '<tr class="border-b border-gray-800"><td colspan="8" class="px-6 py-4 text-center text-gray-400">No teams found</td></tr>';
      return;
    }
    
    // Display each team only once
    const processedIds = new Set();
    
    teams.forEach((team) => {
      // Skip if we've already processed this team ID
      if (processedIds.has(team.teamId)) return;
      
      processedIds.add(team.teamId);
      
      // Create team row
      const row = document.createElement("tr");
      row.classList.add("border-b", "border-gray-800");
      
      // Team ID cell
      const teamIdCell = document.createElement("td");
      teamIdCell.classList.add("px-6", "py-4", "text-sm", "text-white");
      teamIdCell.textContent = team.teamId;
      row.appendChild(teamIdCell);
      
      // Team Name cell
      const teamNameCell = document.createElement("td");
      teamNameCell.classList.add("px-6", "py-4", "text-sm", "text-white");
      teamNameCell.textContent = team.teamName;
      row.appendChild(teamNameCell);
      
      // Team Size cell
      const teamSizeCell = document.createElement("td");
      teamSizeCell.classList.add("px-6", "py-4", "text-sm", "text-white");
      teamSizeCell.textContent = team.teamSize;
      row.appendChild(teamSizeCell);
      
      // Project Title cell
      const projectTitleCell = document.createElement("td");
      projectTitleCell.classList.add("px-6", "py-4", "text-sm", "text-white");
      projectTitleCell.textContent = team.projectTitle;
      row.appendChild(projectTitleCell);
      
      // Create score cells for rounds 1-3
      const createScoreCell = (scoreType, round) => {
        const cell = document.createElement("td");
        cell.classList.add("px-6", "py-4", "text-sm", "cursor-pointer", "hover:bg-gray-700");
        
        // Get the score value
        const fieldName = `r${round}${scoreType !== 'overall' ? scoreType.charAt(0).toUpperCase() + scoreType.slice(1) : 'Score'}`;
        const scoreValue = team[fieldName];
        
        // Set cell content
        cell.innerHTML = `
          <div class="text-xs text-gray-400">${scoreType === 'overall' ? 'Overall' : scoreType.charAt(0).toUpperCase() + scoreType.slice(1)}</div>
          <span class="${scoreValue !== undefined && scoreValue !== null ? 'text-cyan-400 font-medium' : 'text-gray-500'}">
            ${scoreValue !== undefined && scoreValue !== null ? parseFloat(scoreValue).toFixed(1) : '—'}
          </span>
        `;
        
        // Add data attributes for easy access
        cell.dataset.teamId = team.teamId;
        cell.dataset.round = round;
        cell.dataset.scoreType = scoreType;
        cell.dataset.score = scoreValue !== null ? scoreValue : 'null';
        
        // Add click handler for editing
        cell.addEventListener("click", function() {
          // Store original content for reverting if needed
          const originalContent = this.innerHTML;
          
          // Get current score value from data attribute
          const currentScore = this.dataset.score !== 'null' ? parseFloat(this.dataset.score) : '';
          
          // Get details from data attributes
          const teamId = this.dataset.teamId;
          const round = this.dataset.round;
          const scoreType = this.dataset.scoreType;
          
          // Highlight the current row
          document.querySelectorAll('#teams-table-body tr').forEach(r => {
            r.classList.remove('highlight-row');
          });
          this.closest('tr').classList.add('highlight-row');
          
          // Replace with input field
          this.innerHTML = `
            <div class="flex items-center gap-2">
              <input type="number" min="0" max="10" step="0.1" class="w-16 px-2 py-1 rounded bg-gray-800 text-white border border-cyan-600" value="${currentScore}">
              <button class="save-score-btn bg-green-700 hover:bg-green-600 text-white px-2 py-1 rounded text-xs">Save</button>
            </div>
          `;
          
          const input = this.querySelector('input');
          input.focus();
          
          // Add ESC key handler to cancel
          input.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
              cell.innerHTML = originalContent;
            } else if (e.key === 'Enter') {
              // Submit when Enter is pressed
              this.parentElement.querySelector('.save-score-btn').click();
            }
          });
          
          // Add save button handler
          const saveBtn = this.querySelector('.save-score-btn');
          saveBtn.addEventListener('click', async function() {
            const newScore = input.value !== '' ? parseFloat(input.value) : null;
            try {
              // Convert teamId to string for consistent comparison
              const teamIdStr = String(teamId);
              
              // Find the team in the data - use string comparison
              const foundTeam = window.teamData.find(t => String(t.teamId) === teamIdStr);
              
              console.log(`Looking for team ID: "${teamIdStr}" (${typeof teamIdStr})`);
              console.log("Found team:", foundTeam);
              
              if (foundTeam) {
                // If team exists but has no document ID, create it first
                let teamDocId = foundTeam.id;
                
                if (!teamDocId) {
                  console.log("Team found in data but has no document ID - creating new team document");
                  
                  // Prepare data for new team
                  const newTeamData = {
                    teamId: teamIdStr,
                    teamName: foundTeam.teamName || `Team ${teamIdStr}`,
                    teamSize: foundTeam.teamSize || "3",
                    projectTitle: foundTeam.projectTitle || "Unknown Project",
                    createdAt: serverTimestamp(),
                    updatedAt: serverTimestamp()
                  };
                  
                  // Add to teams collection
                  const docRef = await addDoc(collection(db, "teams"), newTeamData);
                  teamDocId = docRef.id;
                  foundTeam.id = teamDocId;
                  console.log(`Created new team document with ID: ${teamDocId}`);
                }
                
                // Determine field name based on round and score type
                let fieldName;
                if (scoreType === 'overall') {
                  fieldName = `r${round}Score`;
                } else {
                  fieldName = `r${round}${scoreType.charAt(0).toUpperCase() + scoreType.slice(1)}`;
                }
                
                // Update the score in Firebase
                const updateData = {};
                updateData[fieldName] = newScore;
                updateData.updatedAt = serverTimestamp();
                
                console.log(`Updating team ${teamIdStr}, doc ID: ${teamDocId}, field: ${fieldName} to ${newScore}`);
                
                // Update Firebase
                await updateDoc(doc(db, "teams", teamDocId), updateData);
                console.log("Firebase update successful");
                
                // Get display label for the score type
                let displayLabel = scoreType === 'overall' ? 'Overall' : 
                                 scoreType === 'innovation' ? 'Innovation' :
                                 scoreType === 'technical' ? 'Technical' : 'Presentation';
                
                // Update the cell display
                cell.innerHTML = `
                  <div class="text-xs text-gray-400">${displayLabel}</div>
                  <span class="${newScore !== null ? 'text-cyan-400 font-medium' : 'text-gray-500'}">
                    ${newScore !== null ? newScore.toFixed(1) : '—'}
                  </span>
                `;
                
                // Update the data attribute
                cell.dataset.score = newScore !== null ? newScore : 'null';
                
                // Update the teamData array for future operations
                foundTeam[fieldName] = newScore;
                
                showNotification(`Updated ${scoreType} score for Team ${teamIdStr} to ${newScore}`, "success");
              } else {
                throw new Error(`Team not found in database. TeamID: ${teamIdStr}`);
              }
            } catch (error) {
              console.error("Error updating score:", error);
              cell.innerHTML = originalContent;
              showNotification(`Failed to update score: ${error.message}`, "error");
            } finally {
              // Remove highlight from all rows
              document.querySelectorAll('#teams-table-body tr').forEach(row => {
                row.classList.remove('highlight-row');
              });
            }
          });
        });
        
        return cell;
      };
      
      // Round 1 Score cell
      row.appendChild(createScoreCell('overall', '1'));
      
      // Round 2 Score cell
      row.appendChild(createScoreCell('overall', '2'));
      
      // Round 3 Score cell
      row.appendChild(createScoreCell('overall', '3'));
      
      // Final Score cell (calculated, not editable)
      const finalScoreCell = document.createElement("td");
      finalScoreCell.classList.add("px-6", "py-4", "text-sm", "text-white");
      // Add null check before using toFixed
      finalScoreCell.textContent = team.finalScore !== undefined && team.finalScore !== null 
        ? team.finalScore.toFixed(1) 
        : "—";
      row.appendChild(finalScoreCell);
      
      // Actions cell
      const actionsCell = document.createElement("td");
      actionsCell.classList.add("px-6", "py-4", "text-sm", "text-white");
      
      // Edit button
      const editBtn = document.createElement("button");
      editBtn.classList.add("text-cyan-400", "hover:underline");
      editBtn.textContent = "Edit";
      editBtn.addEventListener("click", function () {
        openEditTeamModal(team);
      });
      actionsCell.appendChild(editBtn);
      
      row.appendChild(actionsCell);
      
      tableBody.appendChild(row);
    });
  }

  // Open edit team modal
  function openEditTeamModal(team) {
    const modalTitle = document.getElementById("modal-title");
    modalTitle.textContent = "Edit Team";
    
    // Store original team ID for comparison later
    const teamIdInput = document.getElementById("edit-team-id");
    teamIdInput.value = team.teamId || '';
    teamIdInput.setAttribute("data-original-value", team.teamId || '');
    
    document.getElementById("team-doc-id").value = team.id || '';
    document.getElementById("edit-team-name").value = team.teamName || '';
    document.getElementById("edit-team-size").value = team.teamSize || '3';
    document.getElementById("edit-project-title").value = team.projectTitle || '';
    
    // Fix for scores with proper null checking - add parseFloat only when values exist
    // Round 1 scores
    document.getElementById("edit-r1-score").value = 
      team.r1Score !== undefined && team.r1Score !== null ? parseFloat(team.r1Score).toFixed(1) : '';
    document.getElementById("edit-r1-innovation").value = 
      team.r1Innovation !== undefined && team.r1Innovation !== null ? parseFloat(team.r1Innovation).toFixed(1) : '';
    document.getElementById("edit-r1-technical").value = 
      team.r1Technical !== undefined && team.r1Technical !== null ? parseFloat(team.r1Technical).toFixed(1) : '';
    document.getElementById("edit-r1-presentation").value = 
      team.r1Presentation !== undefined && team.r1Presentation !== null ? parseFloat(team.r1Presentation).toFixed(1) : '';
    
    // Round 2 scores
    document.getElementById("edit-r2-score").value = 
      team.r2Score !== undefined && team.r2Score !== null ? parseFloat(team.r2Score).toFixed(1) : '';
    document.getElementById("edit-r2-innovation").value = 
      team.r2Innovation !== undefined && team.r2Innovation !== null ? parseFloat(team.r2Innovation).toFixed(1) : '';
    document.getElementById("edit-r2-technical").value = 
      team.r2Technical !== undefined && team.r2Technical !== null ? parseFloat(team.r2Technical).toFixed(1) : '';
    document.getElementById("edit-r2-presentation").value = 
      team.r2Presentation !== undefined && team.r2Presentation !== null ? parseFloat(team.r2Presentation).toFixed(1) : '';
    
    // Round 3 scores
    document.getElementById("edit-r3-score").value = 
      team.r3Score !== undefined && team.r3Score !== null ? parseFloat(team.r3Score).toFixed(1) : '';
    document.getElementById("edit-r3-innovation").value = 
      team.r3Innovation !== undefined && team.r3Innovation !== null ? parseFloat(team.r3Innovation).toFixed(1) : '';
    document.getElementById("edit-r3-technical").value = 
      team.r3Technical !== undefined && team.r3Technical !== null ? parseFloat(team.r3Technical).toFixed(1) : '';
    document.getElementById("edit-r3-presentation").value = 
      team.r3Presentation !== undefined && team.r3Presentation !== null ? parseFloat(team.r3Presentation).toFixed(1) : '';
    
    // Show the modal
    const modal = document.getElementById("team-modal");
    if (modal) modal.style.display = "flex";
  }

  // Update round weights display
  function updateWeights() {
    const r1Value = parseInt(r1Weight.value);
    const r2Value = parseInt(r2Weight.value);
    const r3Value = parseInt(r3Weight.value);
    
    // Update displayed values
    r1WeightValue.textContent = `${r1Value}%`;
    r2WeightValue.textContent = `${r2Value}%`;
    r3WeightValue.textContent = `${r3Value}%`;
    
    // Ensure total equals 100%
    const total = r1Value + r2Value + r3Value;
    if (total !== 100) {
      // Highlight in red if not equal to 100%
      [r1WeightValue, r2WeightValue, r3WeightValue].forEach(el => {
        el.classList.add('text-red-500');
        el.classList.remove('text-green-400');
      });
    } else {
      // Show in green if equal to 100%
      [r1WeightValue, r2WeightValue, r3WeightValue].forEach(el => {
        el.classList.add('text-green-400');
        el.classList.remove('text-red-500');
      });
    }
  }

  // Initial load
  await loadTeamsData();
});

// Add this JavaScript for the hamburger menu functionality
document.addEventListener("DOMContentLoaded", function() {
  // Mobile hamburger menu
  const hamburgerMenu = document.getElementById("hamburger-menu");
  const sidebar = document.querySelector(".sidebar");
  const adminContent = document.getElementById("admin-content");
  
  // Add responsive styles for tables and dashboard
  addResponsiveStyles();
  
  // Create overlay for mobile only if adminContent exists
  if (adminContent) {
    const overlay = document.createElement("div");
    overlay.className = "sidebar-overlay";
    adminContent.appendChild(overlay);
    
    // Close sidebar when clicking on overlay if sidebar exists
    overlay.addEventListener("click", function() {
      if (sidebar) {
        sidebar.classList.remove("active");
        overlay.classList.remove("active");
      }
    });
  }
  
  // Toggle sidebar on hamburger click with null checks
  if (hamburgerMenu && sidebar) {
    hamburgerMenu.addEventListener("click", function() {
      sidebar.classList.toggle("active");
      const overlay = document.querySelector(".sidebar-overlay");
      if (overlay) {
        overlay.classList.toggle("active");
      }
    });
  }
  
  // Fix for mobile header toggle with null checks
  const mobileHeader = document.querySelector(".mobile-header");
  
  // Fix for checkMobile function that was causing the null error
  function checkMobile() {
    if (window.innerWidth <= 768) {
      if (mobileHeader) {
        mobileHeader.classList.remove("hidden");
      }
    } else {
      if (mobileHeader) {
        mobileHeader.classList.add("hidden");
      }
      if (sidebar) {
        sidebar.classList.remove("active");
      }
      const overlay = document.querySelector(".sidebar-overlay");
      if (overlay) {
        overlay.classList.remove("active");
      }
    }
  }
  
  // Make all tables scrollable horizontally
  makeTablesScrollable();
  
  // Check on page load and resize
  checkMobile();
  window.addEventListener("resize", checkMobile);
});

// Add responsive styles function
function addResponsiveStyles() {
  const style = document.createElement('style');
  style.textContent = `
    /* Responsive text sizes */
    @media (max-width: 768px) {
      .glitch-text {
        font-size: 1.5rem !important;
      }
      .text-2xl, .text-3xl, .text-4xl {
        font-size: 1.25rem !important;
      }
      .chart-container {
        height: 250px !important;
      }
    }
    
    /* Horizontal scrollbar for tables */
    .overflow-x-auto {
      overflow-x: auto;
      scrollbar-width: thin;
      scrollbar-color: rgba(0, 215, 254, 0.5) rgba(0, 0, 0, 0.2);
    }
    
    .overflow-x-auto::-webkit-scrollbar {
      height: 6px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-track {
      background: rgba(0, 0, 0, 0.2);
      border-radius: 3px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb {
      background-color: rgba(0, 215, 254, 0.5);
      border-radius: 3px;
    }
    
    /* Make table cells and headers nowrap */
    table th, table td {
      white-space: nowrap;
    }
    
    /* Make sure modals don't overflow on mobile */
    #team-modal {
      padding: 1rem;
    }
    
    #team-modal > div {
      max-height: 90vh;
      overflow-y: auto;
    }
  `;
  document.head.appendChild(style);
}

// Make all tables scrollable
function makeTablesScrollable() {
  // Find all tables that aren't already in scrollable containers
  const tables = document.querySelectorAll('table');
  tables.forEach(table => {
    let parent = table.parentElement;
    // Check if the parent already has overflow-x-auto
    if (!parent.classList.contains('overflow-x-auto')) {
      // If not inside a scrollable container, wrap it
      const wrapper = document.createElement('div');
      wrapper.className = 'overflow-x-auto';
      parent.insertBefore(wrapper, table);
      wrapper.appendChild(table);
    }
  });
}

/**
 * Makes tables scrollable horizontally only on mobile devices
 */
function makeTablesScrollableHorizontally() {
  // Target all table containers but leave their vertical scrolling alone
  const tableContainers = document.querySelectorAll('.overflow-x-auto');
  tableContainers.forEach(container => {
    // Only modify horizontal scrolling behavior
    container.style.overflowX = 'auto';
    container.style.overflowY = 'visible';
    
    // Add custom styling for mobile horizontal scrolling
    container.style.width = '100%';
    container.style.maxWidth = '100%';
    
    // Add visible scrollbar styling for better UX on mobile
    const style = document.createElement('style');
    style.textContent = `
      @media (max-width: 768px) {
        .overflow-x-auto {
          -webkit-overflow-scrolling: touch;
          scrollbar-width: thin;
          scrollbar-color: rgba(0, 215, 254, 0.6) rgba(0, 0, 0, 0.2);
        }
        
        .overflow-x-auto::-webkit-scrollbar {
          height: 6px;
        }
        
        .overflow-x-auto::-webkit-scrollbar-track {
          background: rgba(0, 0, 0, 0.2);
          border-radius: 3px;
        }
        
        .overflow-x-auto::-webkit-scrollbar-thumb {
          background-color: rgba(0, 215, 254, 0.6);
          border-radius: 3px;
        }
        
        /* Force table cells to be compact on mobile */
        table th, table td {
          white-space: nowrap;
          padding: 0.5rem 0.75rem !important;
        }
      }
    `;
    document.head.appendChild(style);
  });
}

/**
 * Adjusts chart sizes for better mobile viewing
 */
function adjustChartSizesForMobile() {
  const chartStyle = document.createElement('style');
  chartStyle.textContent = `
    @media (max-width: 768px) {
      .chart-container {
        height: 200px !important; /* Smaller height on mobile */
        margin-bottom: 1.5rem;
      }
      
      .chart-wrapper {
        height: 180px !important; /* Smaller chart wrapper */
      }
      
      /* Adjust font sizes in charts */
      .chart-container h3 {
        font-size: 0.95rem !important;
        margin-bottom: 0.5rem !important;
      }
    }
  `;
  document.head.appendChild(chartStyle);
}

/**
 * Adds a floating menu button for mobile navigation
 */
function addMobileMenuButton() {
  const mobileMenuBtn = document.createElement('button');
  mobileMenuBtn.className = 'mobile-menu-btn fixed bottom-4 right-4 z-50 rounded-full bg-cyan-700 text-white p-3 shadow-lg md:hidden';
  mobileMenuBtn.innerHTML = `
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
    </svg>
  `;
  
  document.body.appendChild(mobileMenuBtn);
  
  // Add styles for the button
  const btnStyle = document.createElement('style');
  btnStyle.textContent = `
    .mobile-menu-btn {
      transition: all 0.3s ease;
      transform: scale(1);
    }
    
    .mobile-menu-btn:hover, .mobile-menu-btn:focus {
      transform: scale(1.1);
      background-color: #0e7490; /* darker cyan */
    }
    
    .mobile-menu-btn:active {
      transform: scale(0.95);
    }
    
    @media (min-width: 769px) {
      .mobile-menu-btn {
        display: none;
      }
    }
  `;
  document.head.appendChild(btnStyle);
  
  // Add click event to toggle sidebar
  mobileMenuBtn.addEventListener('click', function() {
    const sidebar = document.querySelector('#admin-sidebar');
    if (sidebar) {
      sidebar.classList.toggle('-translate-x-full');
      sidebar.classList.toggle('translate-x-0');
      
      // Toggle overlay
      const overlay = document.querySelector('.sidebar-overlay');
      if (overlay) {
        overlay.classList.toggle('hidden');
      }
    }
  });
}

/**
 * Adds general mobile enhancements for the admin dashboard
 */
function addMobileEnhancements() {
  const mobileStyle = document.createElement('style');
  mobileStyle.textContent = `
    @media (max-width: 768px) {
      /* Text size adjustments */
      .glitch-text {
        font-size: 1.5rem !important;
      }
      
      .text-2xl {
        font-size: 1.1rem !important;
      }
      
      /* Dashboard card adjustments */
      .dashboard-card {
        padding: 0.75rem !important;
      }
      
      /* Improve form elements on mobile */
      input, select, textarea {
        font-size: 16px !important; /* Prevents iOS zoom on focus */
      }
      
      /* Make modal content better on mobile */
      #team-modal > div {
        width: 95% !important;
        margin: 0 auto;
        padding: 1rem !important;
      }
      
      /* Adjust spacing in forms */
      .form-group {
        margin-bottom: 0.75rem !important;
      }
      
      /* Make sidebar appear properly on mobile */
      #admin-sidebar {
        width: 75% !important;
        z-index: 40 !important;
      }
    }
  `;
  document.head.appendChild(mobileStyle);
}

// Make sure the populateTopTeams function is defined
function populateTopTeams() {
  if (!finalResults || finalResults.length === 0) return;
  
  const topTeamsBody = document.getElementById("top-teams-body");
  if (!topTeamsBody) return;
  
  topTeamsBody.innerHTML = "";
  
  // Take top 10 or fewer if less are available
  const teamsToShow = Math.min(finalResults.length, 10);
  
  for (let i = 0; i < teamsToShow; i++) {
    const team = finalResults[i];
    
    topTeamsBody.innerHTML += `
      <tr class="border-b border-gray-800 ${i < 3 ? 'bg-black/50' : ''}">
        <td class="px-6 py-4 text-sm ${i === 0 ? 'text-yellow-400 font-bold' : i === 1 ? 'text-gray-300 font-bold' : i === 2 ? 'text-amber-700 font-bold' : 'text-white'}">${i + 1}</td>
        <td class="px-6 py-4 text-sm text-white">${team.teamId}</td>
        <td class="px-6 py-4 text-sm text-white">${team.teamName}</td>
        <td class="px-6 py-4 text-sm text-white">${team.projectTitle || "—"}</td>
        <td class="px-6 py-4 text-sm ${team.roundScores.r1 > 0 ? "text-white" : "text-gray-500"}">${team.roundScores.r1 > 0 ? team.roundScores.r1.toFixed(1) : "N/A"}</td>
        <td class="px-6 py-4 text-sm ${team.roundScores.r2 > 0 ? "text-white" : "text-gray-500"}">${team.roundScores.r2 > 0 ? team.roundScores.r2.toFixed(1) : "N/A"}</td>
        <td class="px-6 py-4 text-sm ${team.roundScores.r3 > 0 ? "text-white" : "text-gray-500"}">${team.roundScores.r3 > 0 ? team.roundScores.r3.toFixed(1) : "N/A"}</td>
        <td class="px-6 py-4 text-sm font-bold text-cyan-400">${team.finalScore.toFixed(1)}</td>
      </tr>
    `;
  }
}

// Make sure we have a safe way to get numeric values
function getNumericValue(elementId) {
  const element = document.getElementById(elementId);
  if (!element) return NaN;
  
  const value = parseFloat(element.value);
  return isNaN(value) ? NaN : value;
}

// Utility function to show notifications
function showNotification(message, type = "success") {
  const notification = document.createElement("div");
  notification.classList.add(
    "fixed",
    "top-4",
    "right-4",
    "z-50",
    "px-4",
    "py-3",
    "rounded",
    "shadow-lg",
    "transition-all",
    "duration-300",
    "ease-in-out",
    "transform",
    "opacity-0",
    "translate-y-2"
  );
  
  // Set color scheme based on notification type
  if (type === "success") {
    notification.classList.add("bg-green-100", "border-green-400", "text-green-800", "border-l-4");
  } else {
    notification.classList.add("bg-red-100", "border-red-400", "text-red-800", "border-l-4");
  }

  // Use the appropriate icon based on notification type
  const iconPath = type === "success"
    ? "M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
    : "M10 14.586L4.707 9.293a1 1 0 00-1.414 1.414l6 6a1 1 0 001.414 0l6-6a1 1 0 00-1.414-1.414L10 14.586z";

  notification.innerHTML = `
    <div class="flex items-center justify-between">
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="${iconPath}" clip-rule="evenodd"></path>
          </svg>
        </div>
        <div class="ml-3">
          <p class="text-sm font-medium">${message}</p>
        </div>
      </div>
      <button class="ml-4 text-gray-400 hover:text-gray-900 focus:outline-none">
        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
  `;

  // Add to DOM
  document.body.appendChild(notification);

  // Add close button functionality
  const closeBtn = notification.querySelector('button');
  closeBtn.addEventListener('click', () => {
    notification.classList.add('opacity-0', 'translate-y-2');
    setTimeout(() => {
      if (document.body.contains(notification)) {
        document.body.removeChild(notification);
      }
    }, 300);
  });

  // Trigger entrance animation
  setTimeout(() => {
    notification.classList.remove('opacity-0', 'translate-y-2');
  }, 10);

  // Auto-remove after 5 seconds
  setTimeout(() => {
    if (document.body.contains(notification)) {
      notification.classList.add('opacity-0', 'translate-y-2');
      setTimeout(() => {
        if (document.body.contains(notification)) {
          document.body.removeChild(notification);
        }
      }, 300);
    }
  }, 5000);
  
  return notification;
}

// Add this function definition before it's called in your code

async function generateFinalResults(weights) {
  try {
    // Get all evaluations and extract unique teams
    const evaluationsSnapshot = await getDocs(collection(db, "evaluations"));
    
    if (evaluationsSnapshot.empty) {
      throw new Error("No evaluations found in the database");
    }
    
    // Group evaluations by team
    const teamEvaluations = {};
    
    evaluationsSnapshot.forEach(doc => {
      const data = doc.data();
      const teamId = String(data.teamId);
      
      if (!teamId) return;
      
      // Initialize if first time seeing this team
      if (!teamEvaluations[teamId]) {
        teamEvaluations[teamId] = {
          teamId: teamId,
          teamName: data.teamName || `Team ${teamId}`,
          projectTitle: data.projectTitle || "Unknown Project",
          teamSize: data.teamSize || 3,
          rounds: {}
        };
      }
      
      // Store each round data
      const round = data.round || "1";
      teamEvaluations[teamId].rounds[round] = {
        overallScore: parseFloat(data.overallScore) || 0,
        innovationScore: parseFloat(data.innovationScore) || 0,
        technicalScore: parseFloat(data.technicalScore) || 0,
        presentationScore: parseFloat(data.presentationScore) || 0
      };
    });
    
    // Process team data and calculate final scores
    finalResults = [];
    Object.values(teamEvaluations).forEach(team => {
      // Calculate weighted scores for each round (handle missing rounds)
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
    
    // Update the results table
    populateResultsTable(finalResults);
    
    return finalResults;
   } catch (error) {
    console.error("Error generating results:", error);
    throw error;
  }
}

// Add this helper function to populate the results table
function populateResultsTable(results) {
  const tableBody = document.getElementById("results-table-body");
  if (!tableBody) return;
  
  tableBody.innerHTML = "";
  
  results.forEach((team, index) => {
    tableBody.innerHTML += `
      <tr class="border-b border-gray-800 hover:bg-black/30">
        <td class="px-6 py-4 text-sm text-white">${index + 1}</td>
        <td class="px-6 py-4 text-sm text-white">${team.teamId}</td>
        <td class="px-6 py-4 text-sm text-white">${team.teamName}</td>
        <td class="px-6 py-4 text-sm text-white">${team.projectTitle || "—"}</td>
        <td class="px-6 py-4 text-sm ${team.roundScores.r1 > 0 ? "text-white" : "text-gray-500"}">${team.roundScores.r1 > 0 ? team.roundScores.r1.toFixed(1) : "N/A"}</td>
        <td class="px-6 py-4 text-sm ${team.roundScores.r2 > 0 ? "text-white" : "text-gray-500"}">${team.roundScores.r2 > 0 ? team.roundScores.r2.toFixed(1) : "N/A"}</td>
        <td class="px-6 py-4 text-sm ${team.roundScores.r3 > 0 ? "text-white" : "text-gray-500"}">${team.roundScores.r3 > 0 ? team.roundScores.r3.toFixed(1) : "N/A"}</td>
        <td class="px-6 py-4 text-sm font-bold text-cyan-400">${team.finalScore.toFixed(1)}</td>
      </tr>
    `;
  });
}

// Add this utility function

/**
 * Safely sets a value to an input element, avoiding NaN errors
 * @param {string} elementId - The ID of the input element
 * @param {any} value - The value to set
 */
function safelySetInputValue(elementId, value) {
  const element = document.getElementById(elementId);
  if (element) {
    // If value is NaN, null, or undefined, set to empty string
    if (value === null || value === undefined || (typeof value === 'number' && isNaN(value))) {
      element.value = "";
    } else {
      element.value = value;
    }
  }
}

// Replace your existing edit team function with this safer version

function editTeam(teamDocId) {
  // Find the team in our data - using teamObj instead of team to avoid variable redeclaration
  const teamObj = teamData.find(t => t.docId === teamDocId);
  if (!teamObj) {
    console.error(`Team with document ID ${teamDocId} not found`);
    showNotification("Team data not found. Please refresh the page.", "error");
    return;
  }
  
  // Set modal title
  const modalTitle = document.getElementById("modal-title");
  modalTitle.textContent = `Edit Team ${teamObj.teamId}: ${teamObj.teamName}`;
  
  // Populate form fields safely
  document.getElementById("team-doc-id").value = teamDocId;
  document.getElementById("edit-team-id").value = teamObj.teamId;
  document.getElementById("edit-team-id").disabled = true; // Don't allow ID changes for existing teams
  document.getElementById("edit-team-name").value = teamObj.teamName;
  document.getElementById("edit-team-size").value = teamObj.teamSize || "3";
  document.getElementById("edit-project-title").value = teamObj.projectTitle || "";
  
  // Populate score fields safely
  safelySetInputValue("edit-r1-score", teamObj.r1Score);
  safelySetInputValue("edit-r1-innovation", teamObj.r1Innovation);
  safelySetInputValue("edit-r1-technical", teamObj.r1Technical);
  safelySetInputValue("edit-r1-presentation", teamObj.r1Presentation);
  
  safelySetInputValue("edit-r2-score", teamObj.r2Score);
  safelySetInputValue("edit-r2-innovation", teamObj.r2Innovation);
  safelySetInputValue("edit-r2-technical", teamObj.r2Technical);
  safelySetInputValue("edit-r2-presentation", teamObj.r2Presentation);
  
  safelySetInputValue("edit-r3-score", teamObj.r3Score);
  safelySetInputValue("edit-r3-innovation", teamObj.r3Innovation);
  safelySetInputValue("edit-r3-technical", teamObj.r3Technical);
  safelySetInputValue("edit-r3-presentation", teamObj.r3Presentation);
  
  // Show the modal
  const modal = document.getElementById("team-modal");
  modal.style.display = "flex";
}