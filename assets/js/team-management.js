// Team management functionality

// Function to format and display scores with edit capability
function formatScore(score, teamId, round, scoreType = 'overall') {
  const scoreValue = score !== null ? score.toFixed(1) : '—';
  const textColor = score !== null ? 'text-cyan-400 font-medium' : 'text-gray-500';
  
  let displayLabel = '';
  if (scoreType === 'overall') {
    displayLabel = 'Overall';
  } else if (scoreType === 'innovation') {
    displayLabel = 'Innovation';
  } else if (scoreType === 'technical') {
    displayLabel = 'Technical';
  } else if (scoreType === 'presentation') {
    displayLabel = 'Presentation';
  }
  
  return `
    <div class="score-quick-edit cursor-pointer hover:bg-cyan-900/30 p-1 rounded mb-1" 
        data-team-id="${teamId}" data-round="${round}" data-score="${score}" data-type="${scoreType}">
      <div class="text-xs text-gray-400">${displayLabel}</div>
      <span class="${textColor}">${scoreValue}</span>
    </div>
  `;
}

// Function to show notifications
function showNotification(message, type = 'success') {
  // Create notification element if it doesn't exist
  let notification = document.querySelector('.notification');
  if (!notification) {
    notification = document.createElement('div');
    notification.className = 'notification';
    document.body.appendChild(notification);
  }
  
  // Set message and show
  notification.textContent = message;
  notification.classList.add('show');
  
  // Add appropriate color based on type
  if (type === 'success') {
    notification.style.borderColor = '#00d7fe';
    notification.style.color = '#00d7fe';
  } else if (type === 'error') {
    notification.style.borderColor = '#ff4b4b';
    notification.style.color = '#ff4b4b';
  }
  
  // Hide after 3 seconds
  setTimeout(() => {
    notification.classList.remove('show');
  }, 3000);
}

// Function to populate the teams table
function populateTeamsTable(teams) {
  const tableBody = document.getElementById("teams-table-body");

  if (!teams || !teams.length) {
    tableBody.innerHTML =
      '<tr class="border-b border-gray-800"><td colspan="9" class="px-6 py-4 text-center text-gray-400">No teams found</td></tr>';
    return;
  }

  tableBody.innerHTML = "";

  teams.forEach((team) => {
    const evaluationStatus = team.isEvaluated
      ? `<span class="px-2 py-1 bg-green-900/20 text-green-400 rounded-full text-xs">Evaluated (${team.evaluationCount})</span>`
      : `<span class="px-2 py-1 bg-yellow-900/20 text-yellow-400 rounded-full text-xs">Not Evaluated</span>`;

    tableBody.innerHTML += `
      <tr class="border-b border-gray-800">
        <td class="px-6 py-4 text-sm text-white">${team.teamId || '—'}</td>
        <td class="px-6 py-4 text-sm text-white">${team.teamName || '—'}</td>
        <td class="px-6 py-4 text-sm text-white">${team.teamSize || '—'} members</td>
        <td class="px-6 py-4 text-sm text-white">${team.projectTitle || '—'}</td>
        <td class="px-6 py-4 text-sm">
          <div class="space-y-1">
            ${formatScore(team.r1Score, team.teamId, 1, 'overall')}
            ${formatScore(team.r1Innovation, team.teamId, 1, 'innovation')}
            ${formatScore(team.r1Technical, team.teamId, 1, 'technical')}
            ${formatScore(team.r1Presentation, team.teamId, 1, 'presentation')}
          </div>
        </td>
        <td class="px-6 py-4 text-sm">
          <div class="space-y-1">
            ${formatScore(team.r2Score, team.teamId, 2, 'overall')}
            ${formatScore(team.r2Innovation, team.teamId, 2, 'innovation')}
            ${formatScore(team.r2Technical, team.teamId, 2, 'technical')}
            ${formatScore(team.r2Presentation, team.teamId, 2, 'presentation')}
          </div>
        </td>
        <td class="px-6 py-4 text-sm">
          <div class="space-y-1">
            ${formatScore(team.r3Score, team.teamId, 3, 'overall')}
            ${formatScore(team.r3Innovation, team.teamId, 3, 'innovation')}
            ${formatScore(team.r3Technical, team.teamId, 3, 'technical')}
            ${formatScore(team.r3Presentation, team.teamId, 3, 'presentation')}
          </div>
        </td>
        <td class="px-6 py-4 text-sm">${evaluationStatus}</td>
        <td class="px-6 py-4 text-sm">
          <button class="edit-team-btn px-2 py-1 bg-cyan-900/20 text-cyan-400 rounded hover:bg-cyan-900/40"
                  data-id="${team.id || ""}"
                  data-team-id="${team.teamId || ""}"
                  data-team-name="${team.teamName || ""}"
                  data-team-size="${team.teamSize || ""}"
                  data-project-title="${team.projectTitle || ""}"
                  data-r1-score="${team.r1Score !== null ? team.r1Score : ''}"
                  data-r1-innovation="${team.r1Innovation !== null ? team.r1Innovation : ''}"
                  data-r1-technical="${team.r1Technical !== null ? team.r1Technical : ''}"
                  data-r1-presentation="${team.r1Presentation !== null ? team.r1Presentation : ''}"
                  data-r2-score="${team.r2Score !== null ? team.r2Score : ''}"
                  data-r2-innovation="${team.r2Innovation !== null ? team.r2Innovation : ''}"
                  data-r2-technical="${team.r2Technical !== null ? team.r2Technical : ''}"
                  data-r2-presentation="${team.r2Presentation !== null ? team.r2Presentation : ''}"
                  data-r3-score="${team.r3Score !== null ? team.r3Score : ''}"
                  data-r3-innovation="${team.r3Innovation !== null ? team.r3Innovation : ''}"
                  data-r3-technical="${team.r3Technical !== null ? team.r3Technical : ''}"
                  data-r3-presentation="${team.r3Presentation !== null ? team.r3Presentation : ''}">
            Edit
          </button>
        </td>
      </tr>
    `;
  });

  // Add quick edit functionality for scores
  document.querySelectorAll(".score-quick-edit").forEach((cell) => {
    cell.addEventListener("click", function() {
      // Highlight the parent row
      const parentRow = this.closest('tr');
      document.querySelectorAll('#teams-table-body tr').forEach(row => {
        row.classList.remove('highlight-row');
      });
      if (parentRow) {
        parentRow.classList.add('highlight-row');
      }
      
      const teamId = this.dataset.teamId;
      const round = this.dataset.round;
      const scoreType = this.dataset.type;
      const currentScore = this.dataset.score !== 'null' ? parseFloat(this.dataset.score) : '';
      
      // Create inline edit form
      const originalContent = this.innerHTML;
      this.innerHTML = `
        <div class="flex items-center">
          <input type="number" class="w-16 bg-black/50 border border-cyan-500 rounded px-2 py-1 text-white text-sm" 
                min="0" max="10" step="0.1" value="${currentScore}">
          <div class="flex ml-1">
            <button class="save-score-btn p-1 text-green-400 hover:text-green-300">✓</button>
            <button class="cancel-score-btn p-1 text-red-400 hover:text-red-300">✕</button>
          </div>
        </div>
      `;
      
      // Focus the input
      const input = this.querySelector('input');
      input.focus();
      
      // Save button
      this.querySelector('.save-score-btn').addEventListener('click', async function() {
        const newScore = input.value !== '' ? parseFloat(input.value) : null;
        try {
          // Find the team in the data
          const foundTeam = window.teamData.find(t => t.teamId == teamId);
          if (foundTeam && foundTeam.id) {
            // Determine field name based on round and score type
            let fieldName;
            if (scoreType === 'overall') {
              fieldName = `r${round}Score`;
            } else {
              // Capitalize first letter of scoreType for field naming (e.g., r1Innovation)
              fieldName = `r${round}${scoreType.charAt(0).toUpperCase() + scoreType.slice(1)}`;
            }
            
            // Update the score in Firebase
            const updateData = {};
            updateData[fieldName] = newScore;
            
            await updateDoc(doc(db, "teams", foundTeam.id), updateData);
            
            // Get display label for the score type
            let displayLabel = '';
            if (scoreType === 'overall') {
              displayLabel = 'Overall';
            } else if (scoreType === 'innovation') {
              displayLabel = 'Innovation';
            } else if (scoreType === 'technical') {
              displayLabel = 'Technical';
            } else if (scoreType === 'presentation') {
              displayLabel = 'Presentation';
            }
            
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
            
            // Show notification
            showNotification(`Updated ${scoreType} score for Team ${teamId} to ${newScore}`);
            
            console.log(`Updated ${fieldName} for Team ${teamId} to ${newScore}`);
          } else {
            throw new Error("Team not found in database");
          }
        } catch (error) {
          console.error("Error updating score:", error);
          cell.innerHTML = originalContent;
          showNotification("Failed to update score. Please try again.", "error");
        }
        
        // Remove row highlight
        document.querySelectorAll('#teams-table-body tr').forEach(row => {
          row.classList.remove('highlight-row');
        });
      });
      
      // Cancel button
      this.querySelector('.cancel-score-btn').addEventListener('click', function() {
        cell.innerHTML = originalContent;
        
        // Remove row highlight
        document.querySelectorAll('#teams-table-body tr').forEach(row => {
          row.classList.remove('highlight-row');
        });
      });
      
      // Handle Enter and Escape keys
      input.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
          cell.querySelector('.save-score-btn').click();
        } else if (e.key === 'Escape') {
          cell.querySelector('.cancel-score-btn').click();
        }
      });
    });
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
      document.getElementById("edit-project-title").value = this.dataset.projectTitle;
      
      // Fill detailed score data for Round 1
      document.getElementById("edit-r1-score").value = this.dataset.r1Score;
      document.getElementById("edit-r1-innovation").value = this.dataset.r1Innovation;
      document.getElementById("edit-r1-technical").value = this.dataset.r1Technical;
      document.getElementById("edit-r1-presentation").value = this.dataset.r1Presentation;
      
      // Fill detailed score data for Round 2
      document.getElementById("edit-r2-score").value = this.dataset.r2Score;
      document.getElementById("edit-r2-innovation").value = this.dataset.r2Innovation;
      document.getElementById("edit-r2-technical").value = this.dataset.r2Technical;
      document.getElementById("edit-r2-presentation").value = this.dataset.r2Presentation;
      
      // Fill detailed score data for Round 3
      document.getElementById("edit-r3-score").value = this.dataset.r3Score;
      document.getElementById("edit-r3-innovation").value = this.dataset.r3Innovation;
      document.getElementById("edit-r3-technical").value = this.dataset.r3Technical;
      document.getElementById("edit-r3-presentation").value = this.dataset.r3Presentation;

      // Disable team ID field for existing teams
      document.getElementById("edit-team-id").disabled = true;

      // Show the modal
      document.getElementById("team-modal").style.display = "flex";
    });
  });
}

// Export functions
export { formatScore, showNotification, populateTeamsTable };