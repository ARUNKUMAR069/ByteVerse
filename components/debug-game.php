<section id="debug-game" class="py-12 relative overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-orbitron font-bold mb-4">Debug <span class="text-cyan-400">Challenge</span></h2>
            <p class="text-gray-300 max-w-2xl mx-auto">Find the bugs in the code snippets and earn ByteCredits - redeemable during the hackathon!</p>
        </div>
        
        <div class="max-w-4xl mx-auto bg-gray-900/70 border border-cyan-500/30 rounded-lg p-6 backdrop-blur-sm relative">
            <div class="absolute top-0 right-0 py-1 px-3 bg-cyan-500 text-black text-sm font-bold rounded-bl-lg">
                <span id="debug-score">0</span> ByteCredits
            </div>
            
            <!-- Challenge Display -->
            <div id="debug-challenge" class="mb-6">
                <div class="mb-2 font-semibold text-cyan-400 flex items-center">
                    <span class="inline-block mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M10.478 1.647a.5.5 0 1 0-.956-.294l-4 13a.5.5 0 0 0 .956.294l4-13zM4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0zm6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0z"/>
                        </svg>
                    </span>
                    <span>Challenge <span id="challenge-num">1</span>/5</span>
                </div>
                <div class="overflow-x-auto custom-scrollbar">
                    <pre id="code-snippet" class="text-left text-sm bg-gray-950 p-4 rounded-lg text-gray-300 overflow-x-auto max-h-[280px]" tabindex="0"></pre>
                </div>
            </div>
            
            <!-- Bug Selection -->
            <div id="bug-options" class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6">
                <!-- Bug options will be dynamically added here -->
            </div>
            
            <!-- Game Actions -->
            <div class="flex justify-between items-center">
                <button id="skip-button" class="cyber-button secondary-sm">
                    <span>Skip</span>
                    <i></i>
                </button>
                
                <div id="result-message" class="text-center font-chakra hidden">
                    <!-- Result message will be displayed here -->
                </div>
                
                <button id="next-button" class="cyber-button primary-sm hidden">
                    <span>Next Challenge</span>
                    <i></i>
                </button>
            </div>
            
            <!-- Final Results Screen (initially hidden) -->
            <div id="game-complete" class="text-center py-8 hidden">
                <h3 class="text-2xl font-orbitron text-cyan-400 mb-4">Challenge Complete!</h3>
                <p class="mb-6">You've earned <span id="final-score" class="text-cyan-400 font-bold text-2xl">0</span> ByteCredits</p>
                <p class="mb-4 text-sm text-gray-300">Show this score at the ByteVerse registration desk for special swag!</p>
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

<!-- Debug Game CSS -->
<style>
.highlight-error {
    background-color: rgba(255, 79, 79, 0.3);
    border-radius: 3px;
    padding: 2px;
    cursor: pointer;
}

.bug-option {
    background: rgba(10, 20, 40, 0.7);
    border: 1px solid rgba(0, 215, 254, 0.3);
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: 'Chakra Petch', monospace;
}

.bug-option:hover {
    background: rgba(0, 215, 254, 0.1);
    transform: translateY(-2px);
}

.bug-option.correct {
    background: rgba(39, 201, 63, 0.2);
    border-color: rgba(39, 201, 63, 0.7);
}

.bug-option.incorrect {
    background: rgba(255, 95, 86, 0.2);
    border-color: rgba(255, 95, 86, 0.7);
}

#result-message.correct {
    color: #27C93F;
}

#result-message.incorrect {
    color: #FF5F56;
}

#challenge-complete-message {
    color: #00D7FE;
}
</style>

<!-- Debug Game JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Game elements
    const codeSnippet = document.getElementById('code-snippet');
    const bugOptions = document.getElementById('bug-options');
    const resultMessage = document.getElementById('result-message');
    const skipButton = document.getElementById('skip-button');
    const nextButton = document.getElementById('next-button');
    const challengeNum = document.getElementById('challenge-num');
    const scoreDisplay = document.getElementById('debug-score');
    const gameComplete = document.getElementById('game-complete');
    const finalScore = document.getElementById('final-score');
    const restartButton = document.getElementById('restart-button');
    
    // Game state
    let currentChallenge = 0;
    let score = 0;
    let selectedOption = null;
    
    // Code challenges - each has code, options and the correct answer index
    const challenges = [
        {
            code: `function calculateTotal(prices) {
    let total = 0;
    for (let i = 0; i <= prices.length; i++) {
        total += prices[i];
    }
    return total;
}`,
            options: [
                "Variable 'total' should be initialized as an array",
                "Loop condition should be 'i < prices.length'",
                "Function name should be camelCased",
                "Missing semicolon after return statement"
            ],
            correctIndex: 1
        },
        {
            code: `class User {
    constructor(name, email) {
        this.name = email;
        this.email = name;
    }
    
    getInfo() {
        return \`\${this.name} (\${this.email})\`;
    }
}`,
            options: [
                "Properties are assigned to wrong parameters",
                "Missing 'this' keyword in getInfo method",
                "Class name should start with lowercase",
                "Missing constructor parameter types"
            ],
            correctIndex: 0
        },
        {
            code: `async function fetchData() {
    try {
        const response = await fetch('https://api.example.com/data');
        const data = response.json();
        return data;
    } catch (error) {
        console.log('Error fetching data:', error);
    }
}`,
            options: [
                "Missing 'new' keyword before fetch",
                "response.json() needs to be awaited",
                "Should use arrow function syntax",
                "Try/catch block is unnecessary"
            ],
            correctIndex: 1
        },
        {
            code: `const sortNumbers = (numbers) => {
    return numbers.sort();
}

// Example usage
const result = sortNumbers([10, 5, 100, 20, 1]);
console.log(result); // Output: [1, 10, 100, 20, 5]`,
            options: [
                "Should not use arrow function for sorting",
                "Missing return statement in the function",
                "sort() method sorts numbers as strings by default",
                "Variable name 'numbers' is reserved in JavaScript"
            ],
            correctIndex: 2
        },
        {
            code: `import React, { useState } from 'react';

function Counter() {
    const [count, setCount] = useState(0);
    
    function increment() {
        setCount(count++);
    }
    
    return (
        <button onClick={increment}>
            Count: {count}
        </button>
    );
}`,
            options: [
                "Should use setCount(count + 1) instead of count++",
                "Missing export statement for the component",
                "onClick should be written as onClick()",
                "useState should receive an object as initial state"
            ],
            correctIndex: 0
        }
    ];
    
    // Initialize game
    function initGame() {
        currentChallenge = 0;
        score = 0;
        scoreDisplay.textContent = score;
        loadChallenge();
    }
    
    // Load current challenge
    function loadChallenge() {
        if (currentChallenge >= challenges.length) {
            showGameComplete();
            return;
        }
        
        const challenge = challenges[currentChallenge];
        challengeNum.textContent = currentChallenge + 1;
        
        // Display code snippet with syntax highlighting
        codeSnippet.textContent = challenge.code;
        
        // Add bug options
        bugOptions.innerHTML = '';
        challenge.options.forEach((option, index) => {
            const optionEl = document.createElement('div');
            optionEl.className = 'bug-option';
            optionEl.dataset.index = index;
            optionEl.textContent = option;
            optionEl.addEventListener('click', () => selectOption(index));
            bugOptions.appendChild(optionEl);
        });
        
        // Reset UI state
        nextButton.classList.add('hidden');
        resultMessage.classList.add('hidden');
        skipButton.classList.remove('hidden');
        
        // Make elements visible
        document.getElementById('debug-challenge').classList.remove('hidden');
        bugOptions.classList.remove('hidden');
        gameComplete.classList.add('hidden');
    }
    
    // Handle option selection
    function selectOption(index) {
        // Prevent selecting after already chosen
        if (nextButton.classList.contains('hidden') === false) {
            return;
        }
        
        const challenge = challenges[currentChallenge];
        const isCorrect = index === challenge.correctIndex;
        
        // Update visuals for all options
        Array.from(bugOptions.children).forEach(option => {
            const optionIndex = parseInt(option.dataset.index);
            
            if (optionIndex === index) {
                option.classList.add(isCorrect ? 'correct' : 'incorrect');
            } else if (optionIndex === challenge.correctIndex) {
                option.classList.add('correct');
            }
        });
        
        // Update score
        if (isCorrect) {
            score += 10;
            scoreDisplay.textContent = score;
            resultMessage.textContent = 'Correct! +10 ByteCredits';
            resultMessage.className = 'text-center font-chakra correct';
        } else {
            resultMessage.textContent = 'Not quite! Try again next time.';
            resultMessage.className = 'text-center font-chakra incorrect';
        }
        
        // Show result & next button
        resultMessage.classList.remove('hidden');
        nextButton.classList.remove('hidden');
        skipButton.classList.add('hidden');
    }
    
    // Show game complete screen
    function showGameComplete() {
        document.getElementById('debug-challenge').classList.add('hidden');
        bugOptions.classList.add('hidden');
        nextButton.classList.add('hidden');
        skipButton.classList.add('hidden');
        resultMessage.classList.add('hidden');
        
        finalScore.textContent = score;
        gameComplete.classList.remove('hidden');
    }
    
    // Event listeners
    skipButton.addEventListener('click', () => {
        currentChallenge++;
        loadChallenge();
    });
    
    nextButton.addEventListener('click', () => {
        currentChallenge++;
        loadChallenge();
    });
    
    restartButton.addEventListener('click', initGame);
    
    // Start the game
    initGame();
});
</script>