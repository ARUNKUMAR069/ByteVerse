<section id="cyber-hacker" class="py-16 relative overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-orbitron font-bold mb-4">Cyber <span class="text-cyan-400">Hacker</span></h2>
            <p class="text-gray-300 max-w-2xl mx-auto">Decrypt the password fragments and beat the security system. Sharpen your hacking skills for the ByteVerse hackathon!</p>
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
                    <span class="font-chakra">Select the correct encryption keys to hack the system</span>
                </div>
                <div class="bg-gray-800 py-1 px-3 rounded-lg text-sm font-chakra">
                    Level: <span id="hacker-level">1</span> | Score: <span id="hacker-score">0</span>
                </div>
            </div>
            
            <!-- Command Terminal -->
            <div class="mb-6 bg-gray-950 p-4 rounded-lg text-gray-300 font-mono text-sm overflow-x-auto max-h-[150px] overflow-y-auto" id="hacker-terminal">
                <div class="terminal-line">C:\ByteVerse> <span class="text-cyan-400">initializing security breach...</span></div>
            </div>
            
            <!-- Password Display -->
            <div class="mb-6 flex justify-center">
                <div id="password-display" class="grid grid-cols-6 gap-2 p-3 bg-gray-800/50 border border-cyan-500/30 rounded-lg w-fit"></div>
            </div>
            
            <!-- Game Board -->
            <div id="hacker-board" class="grid grid-cols-3 md:grid-cols-4 gap-4 mb-6">
                <!-- Hacking keys will be generated here -->
            </div>
            
            <!-- Game Controls -->
            <div class="flex justify-between items-center mt-8">
                <button id="hacker-hint-button" class="cyber-button secondary-sm">
                    <span>Get Hint</span>
                    <i></i>
                </button>
                
                <div id="hacker-message" class="text-center font-chakra hidden">
                    <!-- Level completion message will appear here -->
                </div>
                
                <button id="hacker-next-button" class="cyber-button primary-sm hidden">
                    <span>Next Level</span>
                    <i></i>
                </button>
            </div>
            
            <!-- Game Complete Screen (initially hidden) -->
            <div id="hacker-complete" class="text-center py-8 hidden">
                <h3 class="text-2xl font-orbitron text-cyan-400 mb-4">System Compromised!</h3>
                <div class="pulse-circle mx-auto mb-8"></div>
                <p class="mb-6">You've successfully breached the security with <span id="final-score" class="text-cyan-400 font-bold">0</span> ByteCredits!</p>
                <p class="mb-4 text-sm text-gray-300">Take a screenshot to claim your ByteVerse Hacker badge!</p>
                <div class="mt-6">
                    <button id="hacker-restart-button" class="cyber-button primary-sm">
                        <span>Play Again</span>
                        <i></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cyber Hacker Game CSS -->
<style>
.hacker-key {
    background: rgba(10, 15, 25, 0.8);
    border: 1px solid rgba(0, 215, 254, 0.2);
    aspect-ratio: 1;
    padding: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    position: relative;
    overflow: hidden;
    font-family: 'Chakra Petch', monospace;
    color: var(--primary-accent);
    font-size: 1.25rem;
    transform: perspective(500px) rotateX(10deg);
}

.hacker-key:hover {
    transform: perspective(500px) rotateX(10deg) scale(1.05);
    border-color: rgba(0, 215, 254, 0.6);
    box-shadow: 0 0 15px rgba(0, 215, 254, 0.3);
    z-index: 10;
}

.hacker-key.selected {
    background: rgba(0, 215, 254, 0.15);
    border-color: rgba(0, 215, 254, 0.8);
    transform: perspective(500px) rotateX(0deg) scale(1.05) translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
}

.hacker-key.correct {
    background: rgba(39, 201, 63, 0.15);
    border-color: rgba(39, 201, 63, 0.8);
    color: rgba(39, 201, 63, 1);
}

.hacker-key.incorrect {
    background: rgba(255, 79, 79, 0.15);
    border-color: rgba(255, 79, 79, 0.8);
    color: rgba(255, 79, 79, 1);
}

.hacker-key .key-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, transparent, rgba(0, 215, 254, 0.05), transparent);
    z-index: -1;
}

.hacker-key::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    width: 5px;
    height: 5px;
    background-color: rgba(0, 215, 254, 0.8);
    z-index: 2;
}

.hacker-key::after {
    content: '';
    position: absolute;
    bottom: -2px;
    right: -2px;
    width: 5px;
    height: 5px;
    background-color: rgba(0, 215, 254, 0.4);
    z-index: 2;
}

.password-char {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(10, 15, 25, 0.8);
    border: 1px solid rgba(0, 215, 254, 0.4);
    color: var(--primary-accent);
    font-family: 'Chakra Petch', monospace;
    font-size: 1.25rem;
    position: relative;
    overflow: hidden;
}

.password-char.filled {
    animation: pulse-border 2s infinite;
}

.password-char.decrypted {
    background: rgba(39, 201, 63, 0.15);
    border-color: rgba(39, 201, 63, 0.8);
    color: rgba(39, 201, 63, 1);
}

@keyframes pulse-border {
    0% { border-color: rgba(0, 215, 254, 0.4); }
    50% { border-color: rgba(0, 215, 254, 0.8); }
    100% { border-color: rgba(0, 215, 254, 0.4); }
}

.terminal-line {
    font-family: 'Courier New', monospace;
    margin-bottom: 0.25rem;
    word-wrap: break-word;
}

#hacker-message.success {
    color: #27C93F;
}

#hacker-message.error {
    color: #FF5F56;
}
</style>

<!-- Cyber Hacker Game JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Game elements
    const hackerBoard = document.getElementById('hacker-board');
    const passwordDisplay = document.getElementById('password-display');
    const terminal = document.getElementById('hacker-terminal');
    const levelDisplay = document.getElementById('hacker-level');
    const scoreDisplay = document.getElementById('hacker-score');
    const hackerMessage = document.getElementById('hacker-message');
    const nextButton = document.getElementById('hacker-next-button');
    const hintButton = document.getElementById('hacker-hint-button');
    const gameComplete = document.getElementById('hacker-complete');
    const finalScore = document.getElementById('final-score');
    const restartButton = document.getElementById('hacker-restart-button');
    
    // Game state
    let currentLevel = 1;
    let score = 0;
    let selectedKey = null;
    let password = [];
    let passwordLength = 0;
    let currentPasswordIndex = 0;
    let availableKeys = [];
    let terminalLines = [];
    
    // Arrays of hacking-themed symbols, terms and phrases
    const symbols = ['@', '#', '$', '%', '&', '*', '!', '?', '<', '>', '{', '}', '[', ']', '^', '~'];
    const hexChars = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'];
    const binaryDigits = ['0', '1'];
    
    const hackingTerms = [
        "SSH", "AES", "RSA", "VPN", "XSS", "SQL", "API", "DNS", 
        "TCP", "UDP", "FTP", "SSL", "TLS", "MAC", "SHA", "MD5"
    ];
    
    const logMessages = [
        "Scanning network ports...",
        "Bypassing firewall...",
        "Detecting security measures...",
        "Analyzing packet structure...",
        "Initiating brute force attack...",
        "Breaking encryption...",
        "Bypassing authentication...",
        "Injecting SQL payload...",
        "Running XSS exploit...",
        "Exploring directory structure...",
        "Analyzing security vulnerabilities...",
        "Accessing restricted files...",
        "Decrypting secure data...",
        "Establishing secure connection...",
        "Bypassing two-factor authentication..."
    ];
    
    // Initialize game
    function initGame() {
        currentLevel = 1;
        score = 0;
        terminalLines = ["C:\\ByteVerse> <span class='text-cyan-400'>initializing security breach...</span>"];
        scoreDisplay.textContent = score;
        levelDisplay.textContent = currentLevel;
        
        // Reset UI
        nextButton.classList.add('hidden');
        hackerMessage.classList.add('hidden');
        gameComplete.classList.add('hidden');
        hackerBoard.classList.remove('hidden');
        passwordDisplay.classList.remove('hidden');
        terminal.classList.remove('hidden');
        updateTerminal("Targeting system...");
        updateTerminal("Security breach initiated. Find the encryption keys.");
        
        generateLevel();
    }
    
    // Generate a level
    function generateLevel() {
        // Clear the board and password display
        hackerBoard.innerHTML = '';
        passwordDisplay.innerHTML = '';
        
        // Increase complexity with level
        passwordLength = 4 + Math.min(currentLevel, 2);
        
        // Generate password and create password display
        password = [];
        for (let i = 0; i < passwordLength; i++) {
            // Create empty password slot
            const passwordChar = document.createElement('div');
            passwordChar.className = 'password-char';
            passwordChar.dataset.index = i;
            passwordDisplay.appendChild(passwordChar);
            
            // Add to password array
            let char;
            if (currentLevel === 1) {
                char = hexChars[Math.floor(Math.random() * hexChars.length)];
            } else if (currentLevel === 2) {
                char = symbols[Math.floor(Math.random() * symbols.length)];
            } else {
                const useHackingTerm = Math.random() < 0.5;
                if (useHackingTerm) {
                    char = hackingTerms[Math.floor(Math.random() * hackingTerms.length)];
                } else {
                    char = symbols[Math.floor(Math.random() * symbols.length)];
                }
            }
            password.push(char);
        }
        
        // Reset current password index
        currentPasswordIndex = 0;
        
        // Generate available keys
        const keyCount = 8 + Math.min(currentLevel, 4);
        availableKeys = [];
        
        // Include correct keys
        for (let i = 0; i < password.length; i++) {
            availableKeys.push(password[i]);
        }
        
        // Add distractors
        while (availableKeys.length < keyCount) {
            let distractor;
            if (currentLevel === 1) {
                distractor = hexChars[Math.floor(Math.random() * hexChars.length)];
            } else if (currentLevel === 2) {
                distractor = symbols[Math.floor(Math.random() * symbols.length)];
            } else {
                const useHackingTerm = Math.random() < 0.5;
                if (useHackingTerm) {
                    distractor = hackingTerms[Math.floor(Math.random() * hackingTerms.length)];
                } else {
                    distractor = symbols[Math.floor(Math.random() * symbols.length)];
                }
            }
            
            // Avoid duplicates
            if (!availableKeys.includes(distractor)) {
                availableKeys.push(distractor);
            }
        }
        
        // Shuffle keys
        availableKeys = shuffleArray(availableKeys);
        
        // Create keys on the board
        availableKeys.forEach((key, index) => {
            const keyElement = document.createElement('div');
            keyElement.className = 'hacker-key';
            keyElement.innerHTML = `
                <div class="key-bg"></div>
                <span>${key}</span>
            `;
            keyElement.dataset.value = key;
            keyElement.addEventListener('click', () => selectKey(keyElement));
            hackerBoard.appendChild(keyElement);
        });
        
        // Update terminal
        updateTerminal(logMessages[Math.floor(Math.random() * logMessages.length)]);
        updateTerminal(`Level ${currentLevel} encryption detected. ${passwordLength} characters required.`);
    }
    
    // Handle key selection
    function selectKey(keyElement) {
        // Do nothing if key is already selected or is disabled
        if (keyElement.classList.contains('selected') || 
            keyElement.classList.contains('correct') || 
            keyElement.classList.contains('incorrect')) {
            return;
        }
        
        // Do nothing if we've already completed the password
        if (currentPasswordIndex >= password.length) {
            return;
        }
        
        // Clear previous selection
        const previouslySelected = hackerBoard.querySelector('.hacker-key.selected');
        if (previouslySelected) {
            previouslySelected.classList.remove('selected');
        }
        
        // Select this key
        keyElement.classList.add('selected');
        selectedKey = keyElement.dataset.value;
        
        // Check if the key matches the current position in the password
        const isCorrect = selectedKey === password[currentPasswordIndex];
        
        setTimeout(() => {
            // Mark the key as correct or incorrect
            keyElement.classList.remove('selected');
            keyElement.classList.add(isCorrect ? 'correct' : 'incorrect');
            
            // Update the password display
            const passwordChar = passwordDisplay.querySelector(`.password-char[data-index="${currentPasswordIndex}"]`);
            passwordChar.textContent = selectedKey;
            passwordChar.classList.add('filled');
            
            if (isCorrect) {
                // Key is correct
                passwordChar.classList.add('decrypted');
                updateTerminal(`Key match found: ${selectedKey}`);
                score += 10 * currentLevel;
                scoreDisplay.textContent = score;
                
                // Move to next character
                currentPasswordIndex++;
                
                // Check if password is complete
                if (currentPasswordIndex >= password.length) {
                    levelComplete();
                }
            } else {
                // Key is incorrect
                updateTerminal(`Invalid key detected: ${selectedKey}`);
                if (score > 0) score -= 5;
                scoreDisplay.textContent = score;
                
                // Clear from password display after a delay
                setTimeout(() => {
                    passwordChar.textContent = '';
                    passwordChar.classList.remove('filled');
                }, 1000);
            }
        }, 500);
    }
    
    // Update the terminal with a new message
    function updateTerminal(message) {
        terminalLines.push(`C:\\ByteVerse> <span class="text-${message.includes('Invalid') ? 'red-400' : 'cyan-400'}">${message}</span>`);
        if (terminalLines.length > 5) {
            terminalLines.shift();
        }
        
        terminal.innerHTML = terminalLines.join('<br>');
        terminal.scrollTop = terminal.scrollHeight;
    }
    
    // Shuffle an array (Fisher-Yates algorithm)
    function shuffleArray(array) {
        const result = [...array];
        for (let i = result.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [result[i], result[j]] = [result[j], result[i]];
        }
        return result;
    }
    
    // Handle level completion
    function levelComplete() {
        // Show success message
        hackerMessage.textContent = `Password cracked! +${100 * currentLevel} ByteCredits`;
        hackerMessage.className = 'text-center font-chakra success';
        hackerMessage.classList.remove('hidden');
        
        // Show next level button
        nextButton.classList.remove('hidden');
        
        // Update terminal
        updateTerminal("Access granted! Security breach successful.");
        
        // Add bonus points
        score += 100 * currentLevel;
        scoreDisplay.textContent = score;
        
        // Check if this was the final level (3 levels total)
        if (currentLevel >= 3) {
            // Show game complete screen after a delay
            setTimeout(() => {
                // Hide the game elements
                hackerBoard.classList.add('hidden');
                passwordDisplay.classList.add('hidden');
                terminal.classList.add('hidden');
                
                // Hide buttons and messages
                nextButton.classList.add('hidden');
                hackerMessage.classList.add('hidden');
                hintButton.classList.add('hidden');
                
                // Show game complete screen
                gameComplete.classList.remove('hidden');
                finalScore.textContent = score;
                
                // Store completion in localStorage
                try {
                    localStorage.setItem('byteverse-hacker-complete', 'true');
                    localStorage.setItem('byteverse-hacker-score', score.toString());
                } catch (e) {
                    console.log('Could not save game progress');
                }
            }, 2000);
        }
    }
    
    // Handle hint button
    hintButton.addEventListener('click', () => {
        // Only provide hint if we haven't completed the password yet
        if (currentPasswordIndex < password.length) {
            // Find the correct key for the current position
            const correctKey = password[currentPasswordIndex];
            const keyElements = Array.from(hackerBoard.querySelectorAll('.hacker-key'));
            const correctKeyElement = keyElements.find(el => el.dataset.value === correctKey);
            
            if (correctKeyElement && !correctKeyElement.classList.contains('correct')) {
                // Highlight the correct key
                correctKeyElement.style.boxShadow = '0 0 15px rgba(39, 201, 63, 0.8)';
                correctKeyElement.style.transform = 'perspective(500px) rotateX(10deg) scale(1.1)';
                
                // Remove highlight after 1.5 seconds
                setTimeout(() => {
                    correctKeyElement.style.boxShadow = '';
                    correctKeyElement.style.transform = '';
                }, 1500);
                
                // Reduce score for using hint
                if (score >= 15) {
                    score -= 15;
                    scoreDisplay.textContent = score;
                    updateTerminal("Hint used: -15 ByteCredits");
                }
            }
        }
    });

    // Handle next level button
    nextButton.addEventListener('click', () => {
        currentLevel++;
        levelDisplay.textContent = currentLevel;
        nextButton.classList.add('hidden');
        hackerMessage.classList.add('hidden');
        generateLevel();
    });

    // Handle restart button
    restartButton.addEventListener('click', initGame);

    // Start the game
    initGame();
});
</script>