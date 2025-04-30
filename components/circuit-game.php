<section id="circuit-game" class="py-16 relative overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-orbitron font-bold mb-4">Circuit <span class="text-cyan-400">Cracker</span></h2>
            <p class="text-gray-300 max-w-2xl mx-auto">Connect the circuit paths to power up the ByteVerse network. Complete the puzzle to earn rewards at the hackathon!</p>
        </div>
        
        <div class="max-w-4xl mx-auto bg-gray-900/70 border border-cyan-500/30 rounded-lg p-6 backdrop-blur-sm relative">
            <!-- Game Status Display -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center">
                    <span class="mr-2 text-cyan-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </svg>
                    </span>
                    <span class="font-chakra">Rotate the circuit pieces to connect all paths</span>
                </div>
                <div class="bg-gray-800 py-1 px-3 rounded-lg text-sm font-chakra">
                    Level: <span id="game-level">1</span> | Moves: <span id="move-counter">0</span>
                </div>
            </div>
            
            <!-- Game Board -->
            <div id="circuit-board" class="grid grid-cols-5 gap-1 mb-6 max-w-lg mx-auto aspect-square">
                <!-- Circuit pieces will be generated here -->
            </div>
            
            <!-- Game Controls -->
            <div class="flex justify-between items-center mt-8">
                <button id="hint-button" class="cyber-button secondary-sm">
                    <span>Get Hint</span>
                    <i></i>
                </button>
                
                <div id="level-message" class="text-center font-chakra hidden">
                    <!-- Level completion message will appear here -->
                </div>
                
                <button id="next-level-button" class="cyber-button primary-sm hidden">
                    <span>Next Level</span>
                    <i></i>
                </button>
            </div>
            
            <!-- Game Complete Screen (initially hidden) -->
            <div id="game-complete" class="text-center py-8 hidden">
                <h3 class="text-2xl font-orbitron text-cyan-400 mb-4">ByteVerse Network Activated!</h3>
                <div class="pulse-circle mx-auto mb-8"></div>
                <p class="mb-6">You've connected the entire circuit network in <span id="final-moves" class="text-cyan-400 font-bold">0</span> moves!</p>
                <p class="mb-4 text-sm text-gray-300">Take a screenshot and show it at the ByteVerse registration for special swag!</p>
                <div class="mt-6">
                    <button id="restart-button" class="cyber-button primary-sm">
                        <span>Play Again</span>
                        <i></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Circuit Game CSS -->
<style>
.circuit-cell {
    background: rgba(10, 15, 25, 0.8);
    border: 1px solid rgba(0, 215, 254, 0.2);
    aspect-ratio: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    position: relative;
    overflow: hidden;
}

.circuit-cell:hover {
    transform: scale(1.05);
    border-color: rgba(0, 215, 254, 0.6);
    z-index: 10;
}

.circuit-cell svg {
    width: 100%;
    height: 100%;
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.circuit-cell.rotating svg {
    animation: rotateCircuit 0.3s forwards;
}

.circuit-cell.connected {
    background: rgba(0, 215, 254, 0.1);
    border-color: rgba(0, 215, 254, 0.8);
}

.circuit-cell.connected svg path {
    stroke: rgba(0, 215, 254, 0.8);
    filter: drop-shadow(0 0 3px rgba(0, 215, 254, 0.8));
}

.circuit-cell.sponsor-cell {
    background: rgba(20, 25, 40, 0.9);
}

.circuit-cell.sponsor-cell::after {
    content: attr(data-sponsor);
    position: absolute;
    bottom: 2px;
    right: 2px;
    font-size: 0.6rem;
    color: rgba(255, 255, 255, 0.6);
    background: rgba(0, 0, 0, 0.3);
    padding: 1px 3px;
    border-radius: 2px;
}

.pulse-circle {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: rgba(0, 215, 254, 0.1);
    border: 2px solid rgba(0, 215, 254, 0.6);
    position: relative;
    animation: pulse 2s infinite;
}

.pulse-circle::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    background: rgb(0, 215, 254);
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(0, 215, 254, 0.4);
    }
    70% {
        box-shadow: 0 0 0 30px rgba(0, 215, 254, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(0, 215, 254, 0);
    }
}

@keyframes rotateCircuit {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(90deg);
    }
}

#level-message.success {
    color: #27C93F;
}

.special-node {
    position: absolute;
    width: 12px;
    height: 12px;
    background: rgb(255, 79, 79);
    border-radius: 50%;
    z-index: 5;
    box-shadow: 0 0 8px rgba(255, 79, 79, 0.8);
}

.special-node.start {
    background: rgb(39, 201, 63);
    box-shadow: 0 0 8px rgba(39, 201, 63, 0.8);
}

.special-node.end {
    background: rgb(255, 215, 0);
    box-shadow: 0 0 8px rgba(255, 215, 0, 0.8);
}

.special-node.connected {
    background: rgb(0, 215, 254);
    box-shadow: 0 0 8px rgba(0, 215, 254, 0.8);
    animation: pulse-small 1.5s infinite;
}

@keyframes pulse-small {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.3);
    }
    100% {
        transform: scale(1);
    }
}
</style>

<!-- Circuit Game JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Game elements
    const circuitBoard = document.getElementById('circuit-board');
    const levelDisplay = document.getElementById('game-level');
    const moveCounter = document.getElementById('move-counter');
    const levelMessage = document.getElementById('level-message');
    const nextLevelButton = document.getElementById('next-level-button');
    const hintButton = document.getElementById('hint-button');
    const gameComplete = document.getElementById('game-complete');
    const finalMoves = document.getElementById('final-moves');
    const restartButton = document.getElementById('restart-button');
    
    // Game state
    let currentLevel = 1;
    let moves = 0;
    let boardSize = 5; // 5x5 grid
    let circuitState = [];
    let circuitSolved = [];
    let targetConnected = 0;
    
    // Sponsors for branding on cells
    let sponsors = [
        'Alpha Partner', 'Hype Sponsor', 'Boost Sponsor', 'Vibe Sponsor',
        'Crew Sponsor', 'Green Soul', 'Mystery Drop'
    ];
    
    // Circuit types (paths)
    const circuitTypes = {
        empty: (rotation) => `<svg viewBox="0 0 100 100" transform="rotate(${rotation}deg)">
            <rect x="0" y="0" width="100" height="100" fill="transparent" />
        </svg>`,
        
        straight: (rotation) => `<svg viewBox="0 0 100 100" transform="rotate(${rotation}deg)">
            <path d="M 0 50 L 100 50" stroke="#666" stroke-width="12" fill="none" />
        </svg>`,
        
        corner: (rotation) => `<svg viewBox="0 0 100 100" transform="rotate(${rotation}deg)">
            <path d="M 0 50 L 50 50 L 50 100" stroke="#666" stroke-width="12" fill="none" />
        </svg>`,
        
        triple: (rotation) => `<svg viewBox="0 0 100 100" transform="rotate(${rotation}deg)">
            <path d="M 0 50 L 50 50 L 50 0 M 50 50 L 50 100" stroke="#666" stroke-width="12" fill="none" />
        </svg>`,
        
        cross: (rotation) => `<svg viewBox="0 0 100 100" transform="rotate(${rotation}deg)">
            <path d="M 0 50 L 100 50 M 50 0 L 50 100" stroke="#666" stroke-width="12" fill="none" />
        </svg>`
    };
    
    // Allowed rotations for each circuit type
    const allowedRotations = {
        empty: [0],
        straight: [0, 90],  // 0° and 90° are the only distinct rotations
        corner: [0, 90, 180, 270],  // All 4 rotations are distinct
        triple: [0, 90, 180, 270],  // All 4 rotations are distinct
        cross: [0]  // Any rotation looks the same
    };
    
    // Initialize game
    function initGame() {
        currentLevel = 1;
        moves = 0;
        moveCounter.textContent = moves;
        levelDisplay.textContent = currentLevel;
        
        // Reset UI
        nextLevelButton.classList.add('hidden');
        levelMessage.classList.add('hidden');
        gameComplete.classList.add('hidden');
        circuitBoard.classList.remove('hidden');
        
        generateLevel();
    }
    
    // Generate a level
    function generateLevel() {
        // Clear the board
        circuitBoard.innerHTML = '';
        circuitState = [];
        circuitSolved = [];
        
        // Use more complex circuits as levels progress
        const typeProbabilities = {
            straight: Math.max(0.5 - (currentLevel * 0.05), 0.25),
            corner: Math.min(0.3 + (currentLevel * 0.05), 0.4),
            triple: Math.min(0.1 + (currentLevel * 0.05), 0.2),
            cross: Math.min(0.1 + (currentLevel * 0.02), 0.15),
            empty: 0 // No empty cells
        };
        
        // Target number of connections needed to win
        targetConnected = Math.floor((boardSize * boardSize) * (0.6 + (currentLevel * 0.1)));
        
        // Generate circuit pieces
        for (let y = 0; y < boardSize; y++) {
            circuitState[y] = [];
            circuitSolved[y] = [];
            
            for (let x = 0; x < boardSize; x++) {
                // Determine piece type
                let type;
                const rand = Math.random();
                let cumProb = 0;
                
                for (const [pieceType, prob] of Object.entries(typeProbabilities)) {
                    cumProb += prob;
                    if (rand < cumProb) {
                        type = pieceType;
                        break;
                    }
                }
                
                // Sponsor cells (with 15% probability)
                const isSponsorCell = Math.random() < 0.15;
                const sponsorIndex = isSponsorCell ? Math.floor(Math.random() * sponsors.length) : -1;
                
                // Get allowed rotations for this piece type
                const rotations = allowedRotations[type];
                
                // Set the "correct" rotation for the piece
                const correctRotation = rotations[Math.floor(Math.random() * rotations.length)];
                
                // Set a random rotation for the initial state (puzzle)
                const randomRotation = rotations[Math.floor(Math.random() * rotations.length)];
                
                // Create circuit element and add to DOM
                const cell = document.createElement('div');
                cell.className = 'circuit-cell';
                cell.dataset.x = x;
                cell.dataset.y = y;
                cell.dataset.type = type;
                cell.dataset.rotation = randomRotation;
                cell.dataset.correctRotation = correctRotation;
                
                // Add sponsor branding if it's a sponsor cell
                if (isSponsorCell) {
                    cell.classList.add('sponsor-cell');
                    cell.dataset.sponsor = sponsors[sponsorIndex];
                }
                
                // Add the SVG based on type and initial rotation
                cell.innerHTML = circuitTypes[type](randomRotation);
                
                // Add special nodes for visual interest
                if (Math.random() < 0.1) {
                    const node = document.createElement('div');
                    node.className = 'special-node';
                    
                    // Position node randomly on the cell
                    const position = Math.floor(Math.random() * 4);
                    if (position === 0) node.style = 'top: -6px; left: 50%; transform: translateX(-50%);';
                    else if (position === 1) node.style = 'bottom: -6px; left: 50%; transform: translateX(-50%);';
                    else if (position === 2) node.style = 'left: -6px; top: 50%; transform: translateY(-50%);';
                    else node.style = 'right: -6px; top: 50%; transform: translateY(-50%);';
                    
                    cell.appendChild(node);
                }
                
                // Add click event
                cell.addEventListener('click', () => rotateCell(x, y));
                
                circuitBoard.appendChild(cell);
                
                // Store piece state
                circuitState[y][x] = { type, rotation: randomRotation };
                circuitSolved[y][x] = { type, rotation: correctRotation };
                
                // Pre-solve some pieces based on level (easier at level 1)
                if (Math.random() < (0.3 - currentLevel * 0.08)) {
                    cell.dataset.rotation = correctRotation;
                    circuitState[y][x].rotation = correctRotation;
                    cell.innerHTML = circuitTypes[type](correctRotation);
                }
            }
        }
        
        // Check initial connections
        checkConnections();
    }
    
    // Rotate a circuit cell
    function rotateCell(x, y) {
        // Don't allow moves if level is complete
        if (!nextLevelButton.classList.contains('hidden')) {
            return;
        }
        
        const cell = getCell(x, y);
        if (!cell) return;
        
        // Get allowed rotations for this piece type
        const type = cell.dataset.type;
        const rotations = allowedRotations[type];
        
        // Update rotation
        let currentRotation = parseInt(cell.dataset.rotation);
        let nextRotationIndex = (rotations.indexOf(currentRotation) + 1) % rotations.length;
        let newRotation = rotations[nextRotationIndex];
        
        cell.dataset.rotation = newRotation;
        
        // Animate the rotation
        const ANIMATION_DURATION = 300;
        cell.classList.add('rotating');
        cell.querySelector('svg').style.transform = `rotate(${newRotation}deg)`;
        
        setTimeout(() => {
            cell.classList.remove('rotating');
        }, ANIMATION_DURATION);
        
        // Update state
        circuitState[y][x].rotation = newRotation;
        
        // Increment move counter
        moves++;
        moveCounter.textContent = moves;
        
        // Check if level is complete
        setTimeout(() => {
            checkConnections();
        }, ANIMATION_DURATION + 50);
    }
    
    // Check if circuits are connected correctly
    function checkConnections() {
        // Get all cells
        const cells = document.querySelectorAll('.circuit-cell');
        
        // Clear previous connections
        cells.forEach(cell => {
            cell.classList.remove('connected');
            const node = cell.querySelector('.special-node');
            if (node) node.classList.remove('connected');
        });
        
        // Count connected pieces
        let connectedCount = 0;
        
        cells.forEach(cell => {
            const x = parseInt(cell.dataset.x);
            const y = parseInt(cell.dataset.y);
            const currentRotation = parseInt(cell.dataset.rotation);
            const correctRotation = parseInt(cell.dataset.correctRotation);
            const type = cell.dataset.type;
            
            // Check if the rotation is correct or symmetric
            let isCorrect = false;
            
            if (type === 'straight') {
                // Straight pieces are correct at 0° or 180°, and 90° or 270°
                isCorrect = (currentRotation % 180 === correctRotation % 180);
            } else if (type === 'cross') {
                // Cross pieces are always correct regardless of rotation
                isCorrect = true;
            } else {
                // Other pieces must match exactly
                isCorrect = (currentRotation === correctRotation);
            }
            
            if (isCorrect) {
                cell.classList.add('connected');
                connectedCount++;
                
                // Connect nodes if present
                const node = cell.querySelector('.special-node');
                if (node) node.classList.add('connected');
            }
        });
        
        // Check if level is complete
        if (connectedCount >= targetConnected) {
            levelComplete();
        }
    }
    
    // Handle level completion
    function levelComplete() {
        // Show success message
        levelMessage.textContent = `Circuit ${currentLevel} connected! +${100 * currentLevel} ByteCredits`;
        levelMessage.className = 'text-center font-chakra success';
        levelMessage.classList.remove('hidden');
        
        // Show next level button
        nextLevelButton.classList.remove('hidden');
        
        // Auto-connect all cells for visual effect
        setTimeout(() => {
            document.querySelectorAll('.circuit-cell').forEach(cell => {
                cell.classList.add('connected');
                const node = cell.querySelector('.special-node');
                if (node) node.classList.add('connected');
            });
        }, 500);
        
        // Check if this was the final level (3 levels total)
        if (currentLevel >= 3) {
            // Show game complete screen after a delay
            setTimeout(() => {
                // Hide the game board
                circuitBoard.classList.add('hidden');
                
                // Hide buttons and messages
                nextLevelButton.classList.add('hidden');
                levelMessage.classList.add('hidden');
                hintButton.classList.add('hidden');
                
                // Show game complete screen
                gameComplete.classList.remove('hidden');
                finalMoves.textContent = moves;
                
                // Store completion in localStorage
                try {
                    localStorage.setItem('byteverse-circuit-complete', 'true');
                    localStorage.setItem('byteverse-circuit-moves', moves.toString());
                } catch (e) {
                    console.log('Could not save game progress');
                }
            }, 2000);
        }
    }
    
    // Get a cell element by coordinates
    function getCell(x, y) {
        return document.querySelector(`.circuit-cell[data-x="${x}"][data-y="${y}"]`);
    }
    
    // Handle hint button
    hintButton.addEventListener('click', () => {
        // Find a random cell that's not connected yet
        const unconnectedCells = Array.from(document.querySelectorAll('.circuit-cell:not(.connected)'));
        
        if (unconnectedCells.length > 0) {
            const randomCell = unconnectedCells[Math.floor(Math.random() * unconnectedCells.length)];
            const x = parseInt(randomCell.dataset.x);
            const y = parseInt(randomCell.dataset.y);
            
            // Set the cell to the correct rotation
            const correctRotation = parseInt(randomCell.dataset.correctRotation);
            
            // Update the cell
            randomCell.dataset.rotation = correctRotation;
            randomCell.innerHTML = circuitTypes[randomCell.dataset.type](correctRotation);
            circuitState[y][x].rotation = correctRotation;
            
            // Highlight the cell
            randomCell.style.boxShadow = '0 0 15px rgba(0, 215, 254, 0.8)';
            randomCell.style.transform = 'scale(1.1)';
            
            // Remove highlight after 1.5 seconds
            setTimeout(() => {
                randomCell.style.boxShadow = '';
                randomCell.style.transform = '';
                
                // Check connections after hint
                checkConnections();
            }, 1500);
            
            // Count as a move
            moves++;
            moveCounter.textContent = moves;
        }
    });
    
    // Handle next level button
    nextLevelButton.addEventListener('click', () => {
        currentLevel++;
        levelDisplay.textContent = currentLevel;
        nextLevelButton.classList.add('hidden');
        levelMessage.classList.add('hidden');
        generateLevel();
    });
    
    // Handle restart button
    restartButton.addEventListener('click', initGame);
    
    // Start the game
    initGame();
});
</script>