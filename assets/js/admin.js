// Complete Firebase Admin Script for admin.php
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js";
import {
  getAuth,
  onAuthStateChanged,
  signOut,
} from "https://www.gstatic.com/firebasejs/9.6.10/firebase-auth.js";
import {
  getFirestore,
  collection,
  getDocs,
  addDoc,
  doc,
  getDoc,
  updateDoc,
  deleteDoc,
  query,
  where,
  orderBy,
  limit,
  serverTimestamp,
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
let teamData = {};
let finalResults = [];
let resultsGenerated = false;

document.addEventListener("DOMContentLoaded", async function () {
  const authChecking = document.getElementById("auth-checking");
  const adminContent = document.getElementById("admin-content");
  const adminLogoutBtn = document.getElementById("admin-logout-btn");

  // Tab Navigation Elements
  const navLinks = document.querySelectorAll(".nav-link");
  const tabContents = document.querySelectorAll(".tab-content");

  // Team Management Elements
  const addTeamBtn = document.getElementById("add-team-btn");
  const teamModal = document.getElementById("team-modal");
  const teamForm = document.getElementById("team-form");
  const closeModalBtn = document.getElementById("close-modal");
  const teamSearch = document.getElementById("team-search");
  const deleteTeamBtn = document.getElementById("delete-team-btn");

  // Results Elements
  const generateResultsBtn = document.getElementById("generate-results-btn");
  const exportResultsBtn = document.getElementById("export-results-btn");
  const r1Weight = document.getElementById("r1-weight");
  const r2Weight = document.getElementById("r2-weight");
  const r3Weight = document.getElementById("r3-weight");
  const r1WeightValue = document.getElementById("r1-weight-value");
  const r2WeightValue = document.getElementById("r2-weight-value");
  const r3WeightValue = document.getElementById("r3-weight-value");

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

  // Close the team modal
  closeModalBtn.addEventListener("click", function () {
    teamModal.style.display = "none";
  });

  // Click outside modal to close
  teamModal.addEventListener("click", function (e) {
    if (e.target === teamModal) {
      teamModal.style.display = "none";
    }
  });

  // Team search functionality
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

  // Team form submission
  teamForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    try {
      const teamDocId = document.getElementById("team-doc-id").value;
      const teamId = document.getElementById("edit-team-id").value;
      const teamName = document.getElementById("edit-team-name").value;
      const teamSize = document.getElementById("edit-team-size").value;
      const projectTitle = document.getElementById("edit-project-title").value;

      // Validation
      if (!teamId || !teamName || !teamSize) {
        alert("Please fill in all required fields.");
        return;
      }

      const teamData = {
        teamId: parseInt(teamId),
        teamName: teamName,
        teamSize: parseInt(teamSize),
        projectTitle: projectTitle || "Untitled Project",
        updatedAt: serverTimestamp(),
      };

      // Check if we're updating or creating
      if (teamDocId) {
        // Update existing team
        await updateDoc(doc(db, "teams", teamDocId), teamData);
        console.log("Team updated successfully!");
      } else {
        // Check if team ID already exists
        const q = query(
          collection(db, "teams"),
          where("teamId", "==", parseInt(teamId))
        );
        const querySnapshot = await getDocs(q);

        if (!querySnapshot.empty) {
          alert(
            `Team ID ${teamId} already exists. Please choose a different ID.`
          );
          return;
        }

        // Create new team
        teamData.createdAt = serverTimestamp();
        await addDoc(collection(db, "teams"), teamData);
        console.log("Team added successfully!");
      }

      // Close the modal and refresh teams data
      teamModal.style.display = "none";
      await loadTeamsData();
    } catch (error) {
      console.error("Error saving team:", error);
      alert("Failed to save team. Please try again.");
    }
  });

  // Delete team handler
  deleteTeamBtn.addEventListener("click", async function () {
    const teamDocId = document.getElementById("team-doc-id").value;
    const teamId = document.getElementById("edit-team-id").value;

    if (!teamDocId) {
      alert("Cannot delete: This team hasn't been saved yet.");
      return;
    }

    if (
      confirm(
        `Are you sure you want to delete Team ${teamId}? This action cannot be undone.`
      )
    ) {
      try {
        await deleteDoc(doc(db, "teams", teamDocId));
        console.log("Team deleted successfully!");

        // Close the modal and refresh teams data
        teamModal.style.display = "none";
        await loadTeamsData();
      } catch (error) {
        console.error("Error deleting team:", error);
        alert("Failed to delete team. Please try again.");
      }
    }
  });

  // Handle result weight sliders
  r1Weight.addEventListener("input", updateWeights);
  r2Weight.addEventListener("input", updateWeights);
  r3Weight.addEventListener("input", updateWeights);

  // Generate final results
  generateResultsBtn.addEventListener("click", async function () {
    if (
      !confirm(
        "Are you sure you want to generate final results? This will process all evaluation data."
      )
    ) {
      return;
    }

    try {
      generateResultsBtn.disabled = true;
      generateResultsBtn.innerHTML = `<span>Processing...</span>`;

      // Get weights from sliders
      const weights = {
        r1: parseInt(r1Weight.value) / 100,
        r2: parseInt(r2Weight.value) / 100,
        r3: parseInt(r3Weight.value) / 100,
      };

      // Generate results
      await generateFinalResults(weights);

      // Show results table
      document
        .getElementById("results-table-container")
        .classList.remove("hidden");
      document.getElementById("results-notice").innerHTML = `
        <div class="text-center text-green-400 py-4">
          <p>✓ Results generated successfully with weights:</p>
          <p>Round 1: ${weights.r1 * 100}% | Round 2: ${
        weights.r2 * 100
      }% | Round 3: ${weights.r3 * 100}%</p>
        </div>
      `;

      // Update dashboard top teams section
      document.getElementById("top-teams-section").classList.remove("hidden");
      populateTopTeams();

      // Mark as generated
      resultsGenerated = true;
    } catch (error) {
      console.error("Error generating results:", error);
      alert("Failed to generate results. Please try again.");
    } finally {
      generateResultsBtn.disabled = false;
      generateResultsBtn.innerHTML = `<span>Generate Final Results</span>`;
    }
  });

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

  // Load teams data
  async function loadTeamsData() {
    try {
      // Try getting teams from dedicated collection first
      let teamsSnapshot = await getDocs(collection(db, "teams"));

      // If no dedicated teams collection or it's empty, compile from evaluations
      if (teamsSnapshot.empty) {
        // Get unique teams from evaluations instead
        const evaluationsSnapshot = await getDocs(
          collection(db, "evaluations")
        );
        const teamMap = {};

        evaluationsSnapshot.forEach((doc) => {
          const data = doc.data();
          const teamId = data.teamId;

          if (teamId && !teamMap[teamId]) {
            teamMap[teamId] = {
              teamId: teamId,
              teamName: data.teamName || `Team ${teamId}`,
              teamSize: data.teamSize || 3,
              projectTitle: data.projectTitle || "Unknown Project",
              evaluationCount: 0,
              isEvaluated: true,
            };
          }

          if (teamId && teamMap[teamId]) {
            teamMap[teamId].evaluationCount++;
          }
        });

        // Convert to array
        teamData = Object.values(teamMap);
      } else {
        // Process teams from dedicated collection
        teamData = [];
        teamsSnapshot.forEach((doc) => {
          const data = doc.data();
          teamData.push({
            id: doc.id,
            ...data,
            evaluationCount: 0,
            isEvaluated: false,
          });
        });

        // Check which teams have evaluations
        const evaluationsSnapshot = await getDocs(
          collection(db, "evaluations")
        );
        const evalCountMap = {};

        evaluationsSnapshot.forEach((doc) => {
          const data = doc.data();
          const teamId = data.teamId;

          if (!evalCountMap[teamId]) {
            evalCountMap[teamId] = 0;
          }

          evalCountMap[teamId]++;
        });

        // Update evaluation status and count
        teamData.forEach((team) => {
          if (evalCountMap[team.teamId]) {
            team.isEvaluated = true;
            team.evaluationCount = evalCountMap[team.teamId];
          }
        });
      }

      // Sort teams by ID
      teamData.sort((a, b) => a.teamId - b.teamId);

      // Populate teams table
      populateTeamsTable(teamData);
    } catch (error) {
      console.error("Error loading teams data:", error);
    }
  }

  // Populate teams table
  function populateTeamsTable(teams) {
    const tableBody = document.getElementById("teams-table-body");

    if (!teams.length) {
      tableBody.innerHTML =
        '<tr class="border-b border-gray-800"><td colspan="6" class="px-6 py-4 text-center text-gray-400">No teams found</td></tr>';
      return;
    }

    tableBody.innerHTML = "";

    teams.forEach((team) => {
      const evaluationStatus = team.isEvaluated
        ? `<span class="px-2 py-1 bg-green-900/20 text-green-400 rounded-full text-xs">Evaluated (${team.evaluationCount})</span>`
        : `<span class="px-2 py-1 bg-yellow-900/20 text-yellow-400 rounded-full text-xs">Not Evaluated</span>`;

      tableBody.innerHTML += `
        <tr class="border-b border-gray-800">
          <td class="px-6 py-4 text-sm text-white">${team.teamId}</td>
          <td class="px-6 py-4 text-sm text-white">${team.teamName}</td>
          <td class="px-6 py-4 text-sm text-white">${team.teamSize} members</td>
          <td class="px-6 py-4 text-sm text-white">${team.projectTitle}</td>
          <td class="px-6 py-4 text-sm">${evaluationStatus}</td>
          <td class="px-6 py-4 text-sm">
            <button class="edit-team-btn px-2 py-1 bg-cyan-900/20 text-cyan-400 rounded hover:bg-cyan-900/40"
                    data-id="${team.id || ""}"
                    data-team-id="${team.teamId}"
                    data-team-name="${team.teamName}"
                    data-team-size="${team.teamSize}"
                    data-project-title="${team.projectTitle}">
              Edit
            </button>
          </td>
        </tr>
      `;
    });

    // Add event listeners to edit buttons
    document.querySelectorAll(".edit-team-btn").forEach((btn) => {
      btn.addEventListener("click", function () {
        const modalTitle = document.getElementById("modal-title");
        modalTitle.textContent = "Edit Team";

        // Fill form with team data
        document.getElementById("team-doc-id").value = this.dataset.id;
        document.getElementById("edit-team-id").value = this.dataset.teamId;
        document.getElementById("edit-team-name").value = this.dataset.teamName;
        document.getElementById("edit-team-size").value = this.dataset.teamSize;
        document.getElementById("edit-project-title").value =
          this.dataset.projectTitle;

        // Disable team ID field for existing teams
        document.getElementById("edit-team-id").disabled = true;

        // Show the modal
        teamModal.style.display = "flex";
      });
    });
  }

  // MENTOR FUNCTIONS

  // Load mentors data
  async function loadMentorsData() {
    try {
      const evaluationsSnapshot = await getDocs(collection(db, "evaluations"));

      // Process evaluations by mentor
      const mentorStats = {};

      evaluationsSnapshot.forEach((doc) => {
        const data = doc.data();
        const mentorEmail = data.mentorEmail;

        if (!mentorEmail) return;

        if (!mentorStats[mentorEmail]) {
          mentorStats[mentorEmail] = {
            mentorEmail: mentorEmail,
            teams: new Set(),
            rounds: { 1: 0, 2: 0, 3: 0 },
            scores: {
              innovation: [],
              technical: [],
              presentation: [],
              overall: [],
            },
          };
        }

        // Track unique teams
        mentorStats[mentorEmail].teams.add(data.teamId);

        // Track rounds
        const round = data.round || "1";
        mentorStats[mentorEmail].rounds[round]++;

        // Track scores
        if (data.innovationScore)
          mentorStats[mentorEmail].scores.innovation.push(
            parseFloat(data.innovationScore)
          );
        if (data.technicalScore)
          mentorStats[mentorEmail].scores.technical.push(
            parseFloat(data.technicalScore)
          );
        if (data.presentationScore)
          mentorStats[mentorEmail].scores.presentation.push(
            parseFloat(data.presentationScore)
          );
        if (data.overallScore)
          mentorStats[mentorEmail].scores.overall.push(
            parseFloat(data.overallScore)
          );
      });

      // Calculate aggregates
      Object.values(mentorStats).forEach((mentor) => {
        mentor.teamCount = mentor.teams.size;
        mentor.totalEvaluations =
          mentor.rounds["1"] + mentor.rounds["2"] + mentor.rounds["3"];

        // Calculate average scores
        const calcAvg = (arr) =>
          arr.length
            ? (arr.reduce((a, b) => a + b, 0) / arr.length).toFixed(1)
            : "N/A";

        mentor.avgScores = {
          innovation: calcAvg(mentor.scores.innovation),
          technical: calcAvg(mentor.scores.technical),
          presentation: calcAvg(mentor.scores.presentation),
          overall: calcAvg(mentor.scores.overall),
        };
      });

      // Convert to array and sort by team count
      const sortedMentors = Object.values(mentorStats).sort(
        (a, b) => b.teamCount - a.teamCount
      );

      // Populate mentors table
      populateMentorsTable(sortedMentors);
    } catch (error) {
      console.error("Error loading mentors data:", error);
    }
  }

  // Populate mentors table
  function populateMentorsTable(mentors) {
    const tableBody = document.getElementById("mentors-table-body");

    if (!mentors.length) {
      tableBody.innerHTML =
        '<tr class="border-b border-gray-800"><td colspan="4" class="px-6 py-4 text-center text-gray-400">No mentors found</td></tr>';
      return;
    }

    tableBody.innerHTML = "";

    mentors.forEach((mentor) => {
      tableBody.innerHTML += `
        <tr class="border-b border-gray-800">
          <td class="px-6 py-4 text-sm text-white">${mentor.mentorEmail}</td>
          <td class="px-6 py-4 text-sm text-white">${mentor.teamCount} teams (${mentor.totalEvaluations} evals)</td>
          <td class="px-6 py-4 text-sm">
            <div class="flex flex-col gap-1">
              <div class="flex items-center justify-between">
                <span class="text-xs text-gray-400">Innovation:</span>
                <span class="text-xs font-bold text-cyan-400">${mentor.avgScores.innovation}</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-xs text-gray-400">Technical:</span>
                <span class="text-xs font-bold text-cyan-400">${mentor.avgScores.technical}</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-xs text-gray-400">Presentation:</span>
                <span class="text-xs font-bold text-cyan-400">${mentor.avgScores.presentation}</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-xs text-gray-400">Overall:</span>
                <span class="text-xs font-bold text-cyan-400">${mentor.avgScores.overall}</span>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 text-sm">
            <div class="flex gap-2">
              <span class="px-2 py-1 bg-cyan-900/30 text-cyan-400 rounded-full text-xs">R1: ${mentor.rounds["1"]}</span>
              <span class="px-2 py-1 bg-cyan-900/30 text-cyan-400 rounded-full text-xs">R2: ${mentor.rounds["2"]}</span>
              <span class="px-2 py-1 bg-cyan-900/30 text-cyan-400 rounded-full text-xs">R3: ${mentor.rounds["3"]}</span>
            </div>
          </td>
        </tr>
      `;
    });
  }

  // RESULTS FUNCTIONS

  // Update weights on slider change
  function updateWeights() {
    // Get values
    let r1 = parseInt(r1Weight.value);
    let r2 = parseInt(r2Weight.value);
    let r3 = parseInt(r3Weight.value);

    // Calculate total
    const total = r1 + r2 + r3;

    // If total is not 100%, adjust the values
    if (total !== 100) {
      // Adjust r3 to make total 100%
      r3 = 100 - r1 - r2;

      // Ensure r3 is within bounds
      if (r3 < 10) {
        r3 = 10;
        r1 = Math.min(r1, 90 - r2);
      } else if (r3 > 50) {
        r3 = 50;
        if (r1 + r2 < 50) {
          // Distribute the remainder proportionally
          const ratio = r1 / (r1 + r2);
          r1 = 50 * ratio;
          r2 = 50 - r1;
        }
      }

      // Update sliders with adjusted values
      r1Weight.value = r1;
      r2Weight.value = r2;
      r3Weight.value = r3;
    }

    // Update display values
    r1WeightValue.textContent = `${r1}%`;
    r2WeightValue.textContent = `${r2}%`;
    r3WeightValue.textContent = `${r3}%`;
  }

  // Generate final results
  async function generateFinalResults(weights) {
    try {
      // Get all evaluations
      const evaluationsSnapshot = await getDocs(collection(db, "evaluations"));

      // Group evaluations by team
      const teamEvaluations = {};

      evaluationsSnapshot.forEach((doc) => {
        const data = doc.data();
        const teamId = data.teamId;

        if (!teamId) return;

        if (!teamEvaluations[teamId]) {
          teamEvaluations[teamId] = {
            teamId: teamId,
            teamName: data.teamName || `Team ${teamId}`,
            projectTitle: data.projectTitle || "Untitled Project",
            teamSize: data.teamSize || 3,
            rounds: { 1: [], 2: [], 3: [] },
          };
        }

        // Store team data from most recent evaluation
        if (data.teamName) teamEvaluations[teamId].teamName = data.teamName;
        if (data.projectTitle)
          teamEvaluations[teamId].projectTitle = data.projectTitle;
        if (data.teamSize) teamEvaluations[teamId].teamSize = data.teamSize;

        // Add evaluation to appropriate round
        const round = data.round || "1";
        teamEvaluations[teamId].rounds[round].push({
          mentorId: data.mentorId,
          innovationScore: parseFloat(data.innovationScore) || 0,
          technicalScore: parseFloat(data.technicalScore) || 0,
          presentationScore: parseFloat(data.presentationScore) || 0,
          overallScore: parseFloat(data.overallScore) || 0,
        });
      });

      // Calculate round averages and final scores
      finalResults = [];

      Object.values(teamEvaluations).forEach((team) => {
        // Calculate average scores for each round
        const roundScores = {
          r1: calculateRoundScore(team.rounds["1"]),
          r2: calculateRoundScore(team.rounds["2"]),
          r3: calculateRoundScore(team.rounds["3"]),
        };

        // Calculate weighted final score
        let finalScore = 0;
        let effectiveWeight = { r1: 0, r2: 0, r3: 0 };
        let totalWeight = 0;

        if (roundScores.r1 !== null) {
          finalScore += roundScores.r1 * weights.r1;
          effectiveWeight.r1 = weights.r1;
          totalWeight += weights.r1;
        }

        if (roundScores.r2 !== null) {
          finalScore += roundScores.r2 * weights.r2;
          effectiveWeight.r2 = weights.r2;
          totalWeight += weights.r2;
        }

        if (roundScores.r3 !== null) {
          finalScore += roundScores.r3 * weights.r3;
          effectiveWeight.r3 = weights.r3;
          totalWeight += weights.r3;
        }

        // Normalize score if not all rounds have evaluations
        if (totalWeight > 0 && totalWeight < 1) {
          finalScore = finalScore / totalWeight;
        }

        // Add to results array
        finalResults.push({
          teamId: team.teamId,
          teamName: team.teamName,
          projectTitle: team.projectTitle,
          teamSize: team.teamSize,
          roundScores: roundScores,
          finalScore: finalScore,
          effectiveWeight: effectiveWeight,
        });
      });

      // Sort by final score (descending)
      finalResults.sort((a, b) => b.finalScore - a.finalScore);

      // Populate results table
      populateResultsTable(finalResults);

      return finalResults;
    } catch (error) {
      console.error("Error generating results:", error);
      throw error;
    }
  }

  // Calculate average score for a round
  function calculateRoundScore(evaluations) {
    if (!evaluations.length) return null;

    let totalScore = 0;
    evaluations.forEach((evaluation) => {
      // Changed 'eval' to 'evaluation'
      totalScore += evaluation.overallScore;
    });

    return totalScore / evaluations.length;
  }

  // Populate results table
  function populateResultsTable(results) {
    const tableBody = document.getElementById("results-table-body");

    if (!results.length) {
      tableBody.innerHTML =
        '<tr class="border-b border-gray-800"><td colspan="8" class="px-6 py-4 text-center text-gray-400">No results available</td></tr>';
      return;
    }

    tableBody.innerHTML = "";

    results.forEach((team, index) => {
      const rank = index + 1;
      const rankClass = rank <= 3 ? "text-yellow-400 font-bold" : "text-white";

      tableBody.innerHTML += `
        <tr class="border-b border-gray-800 ${
          rank <= 10 ? "bg-gradient-to-r from-cyan-900/10 to-transparent" : ""
        }">
          <td class="px-6 py-4 text-sm ${rankClass}">${rank}</td>
          <td class="px-6 py-4 text-sm text-white">${team.teamId}</td>
          <td class="px-6 py-4 text-sm text-white">${team.teamName}</td>
          <td class="px-6 py-4 text-sm text-white">${team.projectTitle}</td>
          <td class="px-6 py-4 text-sm ${
            team.roundScores.r1 !== null ? "text-cyan-400" : "text-gray-500"
          }">${
        team.roundScores.r1 !== null ? team.roundScores.r1.toFixed(2) : "N/A"
      }</td>
          <td class="px-6 py-4 text-sm ${
            team.roundScores.r2 !== null ? "text-cyan-400" : "text-gray-500"
          }">${
        team.roundScores.r2 !== null ? team.roundScores.r2.toFixed(2) : "N/A"
      }</td>
          <td class="px-6 py-4 text-sm ${
            team.roundScores.r3 !== null ? "text-cyan-400" : "text-gray-500"
          }">${
        team.roundScores.r3 !== null ? team.roundScores.r3.toFixed(2) : "N/A"
      }</td>
          <td class="px-6 py-4 text-sm font-bold text-yellow-400">${team.finalScore.toFixed(
            2
          )}</td>
        </tr>
      `;
    });
  }

  // Populate top teams section in dashboard
  function populateTopTeams() {
    const tableBody = document.getElementById("top-teams-body");

    if (!finalResults.length) {
      tableBody.innerHTML =
        '<tr class="border-b border-gray-800"><td colspan="8" class="px-6 py-4 text-center text-gray-400">No results available</td></tr>';
      return;
    }

    tableBody.innerHTML = "";

    // Get top 10 teams
    const topTeams = finalResults.slice(0, 10);

    topTeams.forEach((team, index) => {
      const rank = index + 1;
      const rankClass = rank <= 3 ? "text-yellow-400 font-bold" : "text-white";

      tableBody.innerHTML += `
        <tr class="border-b border-gray-800 ${
          rank <= 3 ? "bg-gradient-to-r from-cyan-900/10 to-transparent" : ""
        }">
          <td class="px-6 py-4 text-sm ${rankClass}">${rank}</td>
          <td class="px-6 py-4 text-sm text-white">${team.teamId}</td>
          <td class="px-6 py-4 text-sm text-white">${team.teamName}</td>
          <td class="px-6 py-4 text-sm text-white">${team.projectTitle}</td>
          <td class="px-6 py-4 text-sm ${
            team.roundScores.r1 !== null ? "text-cyan-400" : "text-gray-500"
          }">${
        team.roundScores.r1 !== null ? team.roundScores.r1.toFixed(2) : "N/A"
      }</td>
          <td class="px-6 py-4 text-sm ${
            team.roundScores.r2 !== null ? "text-cyan-400" : "text-gray-500"
          }">${
        team.roundScores.r2 !== null ? team.roundScores.r2.toFixed(2) : "N/A"
      }</td>
          <td class="px-6 py-4 text-sm ${
            team.roundScores.r3 !== null ? "text-cyan-400" : "text-gray-500"
          }">${
        team.roundScores.r3 !== null ? team.roundScores.r3.toFixed(2) : "N/A"
      }</td>
          <td class="px-6 py-4 text-sm font-bold text-yellow-400">${team.finalScore.toFixed(
            2
          )}</td>
        </tr>
      `;
    });
  }

  // Replace the populateAdminTable function in admin.php with this fixed version
  function populateAdminTable(evaluations) {
    const tableBody = document.getElementById("recent-evaluations-body");

    if (!tableBody) {
      console.error("Table body element not found");
      return;
    }

    if (evaluations.length === 0) {
      tableBody.innerHTML =
        '<tr class="border-b border-gray-800"><td colspan="5" class="px-6 py-4 text-center text-gray-400">No evaluations found.</td></tr>';
      return;
    }

    // Sort by timestamp and get most recent
    evaluations.sort((a, b) => {
      return (b.createdAt?.toMillis() || 0) - (a.createdAt?.toMillis() || 0);
    });

    // Take only the most recent 5 evaluations for the dashboard
    const recentEvaluations = evaluations.slice(0, 5);

    tableBody.innerHTML = "";
    recentEvaluations.forEach((evaluation) => {
      const timestamp = evaluation.createdAt?.toDate() || new Date();
      const formattedTime = timestamp.toLocaleString();

      tableBody.innerHTML += `
            <tr class="border-b border-gray-800">
                <td class="px-6 py-4 text-sm text-white">${
                  evaluation.mentorEmail || "—"
                }</td>
                <td class="px-6 py-4 text-sm text-white">${
                  evaluation.teamId
                } - ${evaluation.teamName}</td>
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

  // Add this to the bottom of your script
  // Chart interaction functionality
  document.addEventListener("DOMContentLoaded", function () {
    // Get all chart containers
    const chartContainers = document.querySelectorAll(".chart-container");
    const chartModal = document.getElementById("chart-modal");
    const closeChartModal = document.getElementById("close-chart-modal");
    const modalChart = document.getElementById("modal-chart");
    const modalTitle = document.getElementById("chart-modal-title");
    let modalChartInstance = null;

    // Initialize chart interactions
    chartContainers.forEach((container) => {
      // Add resize handle
      const wrapper = container.querySelector(".chart-wrapper");
      const resizeHandle = document.createElement("div");
      resizeHandle.className = "resize-handle";
      wrapper.classList.add("resizable-chart");
      wrapper.appendChild(resizeHandle);

      // Get buttons
      const expandBtn = container.querySelector(".chart-expand-btn");
      const pinBtn = container.querySelector(".chart-pin-btn");

      // Set up event listeners
      if (expandBtn) {
        expandBtn.addEventListener("click", function () {
          // If already in full-screen modal, return to normal
          if (container.classList.contains("in-modal")) {
            container.classList.remove("in-modal");
            chartModal.classList.add("hidden");
            return;
          }

          // Get the chart canvas
          const canvas = container.querySelector("canvas");
          const chartId = canvas.id;
          const chartTitle = container.querySelector("h3").textContent;

          // Set modal title
          modalTitle.textContent = chartTitle;

          // Clone the chart to the modal
          showChartInModal(chartId, chartTitle);
        });
      }

      if (pinBtn) {
        pinBtn.addEventListener("click", function () {
          container.classList.toggle("fixed");

          if (container.classList.contains("fixed")) {
            // Calculate position based on current scroll
            const containerRect = container.getBoundingClientRect();
            const containerWidth = containerRect.width;

            // Set fixed position styles
            container.style.width = `${containerWidth}px`;
            container.style.left = `${containerRect.left}px`;

            // Change icon to "unpin"
            pinBtn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
            </svg>
          `;
          } else {
            // Remove fixed styles
            container.style.width = "";
            container.style.left = "";

            // Change icon back to "pin"
            pinBtn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h14a2 2 0 012 2v3a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v5" />
            </svg>
          `;
          }
        });
      }

      // Make charts resizable
      if (resizeHandle) {
        let startY, startHeight;

        resizeHandle.addEventListener("mousedown", function (e) {
          startY = e.clientY;
          startHeight = parseInt(
            document.defaultView.getComputedStyle(wrapper).height,
            10
          );
          document.addEventListener("mousemove", resizeChart);
          document.addEventListener("mouseup", stopResize);
          e.preventDefault();
        });

        function resizeChart(e) {
          const newHeight = startHeight + e.clientY - startY;
          if (newHeight > 150) {
            // Minimum height
            wrapper.style.height = `${newHeight}px`;

            // Trigger chart resize
            const chartId = wrapper.querySelector("canvas").id;
            const chart = getChartById(chartId);
            if (chart) {
              chart.resize();
            }
          }
        }

        function stopResize() {
          document.removeEventListener("mousemove", resizeChart);
          document.removeEventListener("mouseup", stopResize);
        }
      }
    });

    // Close modal button
    if (closeChartModal) {
      closeChartModal.addEventListener("click", function () {
        chartModal.classList.add("hidden");

        // Destroy modal chart to prevent memory leaks
        if (modalChartInstance) {
          modalChartInstance.destroy();
          modalChartInstance = null;
        }
      });
    }

    // Function to get chart instance by ID
    function getChartById(chartId) {
      // Find the chart instance from Chart.js
      return Chart.getChart(chartId);
    }

    // Function to show chart in modal
    function showChartInModal(chartId, title) {
      // Get the original chart instance
      const originalChart = getChartById(chartId);

      if (!originalChart) {
        console.error("Chart not found:", chartId);
        return;
      }

      // Destroy existing modal chart if any
      if (modalChartInstance) {
        modalChartInstance.destroy();
      }

      // Clone chart configuration
      const newConfig = {
        type: originalChart.config.type,
        data: JSON.parse(JSON.stringify(originalChart.data)),
        options: JSON.parse(JSON.stringify(originalChart.options)),
      };

      // Make the modal chart a bit bigger and more detailed
      if (newConfig.options.scales) {
        if (newConfig.options.scales.y) {
          newConfig.options.scales.y.ticks.display = true;
          newConfig.options.scales.y.grid.display = true;
        }
        if (newConfig.options.scales.x) {
          newConfig.options.scales.x.ticks.display = true;
        }
      }

      // Add animations for the modal chart
      newConfig.options.animation = {
        duration: 500,
        easing: "easeOutQuad",
      };

      // Show more detail in tooltips
      newConfig.options.plugins = newConfig.options.plugins || {};
      newConfig.options.plugins.tooltip = {
        ...newConfig.options.plugins.tooltip,
        displayColors: true,
        backgroundColor: "rgba(0, 0, 0, 0.8)",
        titleFont: { size: 16 },
        bodyFont: { size: 14 },
        padding: 12,
      };

      // Show the modal
      chartModal.classList.remove("hidden");

      // Create the new chart in the modal
      modalChartInstance = new Chart(modalChart, newConfig);
    }

    // Update charts when window is resized
    window.addEventListener("resize", function () {
      const fixedContainers = document.querySelectorAll(
        ".chart-container.fixed"
      );

      fixedContainers.forEach((container) => {
        // Reset position of fixed containers when window resizes
        if (container.classList.contains("fixed")) {
          container.classList.remove("fixed");
          container.style.width = "";
          container.style.left = "";

          // Reset pin button icon
          const pinBtn = container.querySelector(".chart-pin-btn");
          if (pinBtn) {
            pinBtn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h14a2 2 0 012 2v3a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v5" />
            </svg>
          `;
          }
        }
      });
    });
  });
});
