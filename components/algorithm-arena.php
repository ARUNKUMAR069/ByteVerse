<section id="algorithm-arena" class="py-16 relative overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-orbitron font-bold mb-4">Algorithm <span class="text-cyan-400">Arena</span></h2>
            <p class="text-gray-300 max-w-2xl mx-auto">Test your algorithm knowledge by solving sorting and searching puzzles. Perfect training for the ByteVerse hackathon!</p>
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
                    <span class="font-chakra">Select the correct algorithm to solve each challenge</span>
                </div>
                <div class="bg-gray-800 py-1 px-3 rounded-lg text-sm font-chakra">
                    Level: <span id="algorithm-level">1</span> | Efficiency: <span id="algorithm-score">0</span>%
                </div>
            </div>
            
            <!-- Algorithm Challenge Display -->
            <div class="mb-6">
                <div class="mb-3 font-chakra text-cyan-400">Challenge:</div>
                <div id="challenge-description" class="bg-gray-950 p-4 rounded-lg text-gray-300 font-mono text-sm overflow-x-auto max-h-[100px] overflow-y-auto">
                    Sort the array in ascending order with optimal time complexity
                </div>
                
                <!-- Data Visualization -->
                <div class="my-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-chakra text-sm">Input:</span>
                        <span class="font-chakra text-sm">Time Complexity: <span id="time-complexity">-</span></span>
                    </div>
                    <div id="data-visualization" class="flex items-end justify-center h-32 gap-1 bg-gray-900/70 rounded-lg p-4"></div>
                </div>
            </div>
            
            <!-- Algorithm Selection -->
            <div class="mb-6">
                <div class="mb-3 font-chakra text-cyan-400">Select Algorithm:</div>
                <div id="algorithm-selection" class="grid grid-cols-2 md:grid-cols-3 gap-4"></div>
            </div>
            
            <!-- Execution Controls -->
            <div class="flex justify-between items-center mt-8">
                <button id="algorithm-hint-button" class="cyber-button secondary-sm">
                    <span>Get Hint</span>
                    <i></i>
                </button>
                
                <div id="step-controls" class="flex gap-2">
                    <button id="algorithm-execute-button" class="cyber-button primary-sm">
                        <span>Execute</span>
                        <i></i>
                    </button>
                </div>
                
                <button id="algorithm-next-button" class="cyber-button primary-sm hidden">
                    <span>Next Challenge</span>
                    <i></i>
                </button>
            </div>
            
            <!-- Results Display -->
            <div id="algorithm-results" class="mt-6 text-center font-chakra hidden"></div>
            
            <!-- Game Complete Screen (initially hidden) -->
            <div id="algorithm-complete" class="text-center py-8 hidden">
                <h3 class="text-2xl font-orbitron text-cyan-400 mb-4">Algorithm Master!</h3>
                <div class="pulse-circle mx-auto mb-8"></div>
                <p class="mb-6">You've completed all challenges with <span id="final-efficiency" class="text-cyan-400 font-bold">0</span>% efficiency!</p>
                <p class="mb-4 text-sm text-gray-300">Your algorithm skills are ready for the ByteVerse hackathon!</p>
                <div class="mt-6">
                    <button id="algorithm-restart-button" class="cyber-button primary-sm">
                        <span>Try Again</span>
                        <i></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Algorithm Arena CSS -->
<style>
.data-element {
    width: 20px;
    background: linear-gradient(to top, rgba(0, 215, 254, 0.7), rgba(0, 215, 254, 0.3));
    border-radius: 2px 2px 0 0;
    position: relative;
    transition: all 0.5s ease;
    box-shadow: 0 0 5px rgba(0, 215, 254, 0.3);
}

.data-element.comparing {
    background: linear-gradient(to top, rgba(255, 215, 0, 0.7), rgba(255, 215, 0, 0.3));
    box-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
}

.data-element.sorted {
    background: linear-gradient(to top, rgba(39, 201, 63, 0.7), rgba(39, 201, 63, 0.3));
    box-shadow: 0 0 5px rgba(39, 201, 63, 0.5);
}

.data-element::after {
    content: attr(data-value);
    position: absolute;
    top: -20px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 0.7rem;
    color: white;
    font-family: 'Chakra Petch', monospace;
}

.algorithm-button {
    background: rgba(10, 15, 25, 0.8);
    border: 1px solid rgba(0, 215, 254, 0.2);
    padding: 1rem 0.5rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    position: relative;
    overflow: hidden;
    text-align: center;
    min-height: 100px;
}

.algorithm-button .name {
    font-family: 'Chakra Petch', monospace;
    color: var(--primary-accent);
    font-size: 1rem;
    margin-bottom: 0.5rem;
}

.algorithm-button .complexity {
    font-family: 'Chakra Petch', monospace;
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.8rem;
}

.algorithm-button:hover {
    transform: scale(1.05);
    border-color: rgba(0, 215, 254, 0.6);
    box-shadow: 0 0 15px rgba(0, 215, 254, 0.3);
    z-index: 10;
}

.algorithm-button.selected {
    background: rgba(0, 215, 254, 0.15);
    border-color: rgba(0, 215, 254, 0.8);
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
}

.algorithm-button.correct {
    background: rgba(39, 201, 63, 0.15);
    border-color: rgba(39, 201, 63, 0.8);
}

.algorithm-button.correct .name {
    color: rgba(39, 201, 63, 1);
}

.algorithm-button.incorrect {
    background: rgba(255, 79, 79, 0.15);
    border-color: rgba(255, 79, 79, 0.8);
}

.algorithm-button.incorrect .name {
    color: rgba(255, 79, 79, 1);
}

#algorithm-results.success {
    color: #27C93F;
    animation: appear 0.5s forwards;
}

#algorithm-results.error {
    color: #FF5F56;
    animation: appear 0.5s forwards;
}

@keyframes appear {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
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
    0% { box-shadow: 0 0 0 0 rgba(0, 215, 254, 0.4); }
    70% { box-shadow: 0 0 0 30px rgba(0, 215, 254, 0); }
    100% { box-shadow: 0 0 0 0 rgba(0, 215, 254, 0); }
}

/* Code visualization */
.code-block {
    font-family: 'Courier New', monospace;
    background: rgba(20, 30, 40, 0.6);
    border-radius: 4px;
    padding: 10px;
    margin: 10px 0;
    color: #E5E5E5;
    position: relative;
    overflow-x: auto;
}

.code-line {
    display: block;
    padding: 2px 0;
    white-space: pre;
}

.code-line.highlighted {
    background: rgba(255, 215, 0, 0.15);
    color: rgba(255, 215, 0, 0.9);
}

.code-comment {
    color: #608B4E;
}

.code-keyword {
    color: #569CD6;
}

.code-function {
    color: #DCDCAA;
}

.code-number {
    color: #B5CEA8;
}

.code-string {
    color: #CE9178;
}
</style>

<!-- Algorithm Arena JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Game elements
    const challengeDescription = document.getElementById('challenge-description');
    const dataVisualization = document.getElementById('data-visualization');
    const algorithmSelection = document.getElementById('algorithm-selection');
    const timeComplexity = document.getElementById('time-complexity');
    const executeButton = document.getElementById('algorithm-execute-button');
    const nextButton = document.getElementById('algorithm-next-button');
    const hintButton = document.getElementById('algorithm-hint-button');
    const resultsDisplay = document.getElementById('algorithm-results');
    const levelDisplay = document.getElementById('algorithm-level');
    const scoreDisplay = document.getElementById('algorithm-score');
    const gameComplete = document.getElementById('algorithm-complete');
    const finalEfficiency = document.getElementById('final-efficiency');
    const restartButton = document.getElementById('algorithm-restart-button');
    
    // Game state
    let currentLevel = 1;
    let efficiency = 100;
    let selectedAlgorithm = null;
    let dataArray = [];
    let challenges = [];
    let currentChallenge = null;
    
    // Algorithm definitions
    const algorithms = {
        bubbleSort: {
            name: "Bubble Sort",
            complexity: "O(n²)",
            complexityValue: 2,
            description: "Repeatedly step through the list, compare adjacent elements and swap them if in wrong order.",
            pseudocode: [
                "function bubbleSort(arr):",
                "    n = arr.length",
                "    for i from 0 to n-1:",
                "        for j from 0 to n-i-1:",
                "            if arr[j] > arr[j+1]:",
                "                swap(arr[j], arr[j+1])",
                "    return arr"
            ],
            visualSteps: [
                "Compare adjacent elements",
                "Swap if they are in wrong order",
                "Repeat until no swaps needed"
            ],
            bestFor: ["small arrays", "nearly sorted arrays"]
        },
        selectionSort: {
            name: "Selection Sort",
            complexity: "O(n²)",
            complexityValue: 2,
            description: "Find minimum element and place at beginning, repeat for remaining elements.",
            pseudocode: [
                "function selectionSort(arr):",
                "    n = arr.length",
                "    for i from 0 to n-1:",
                "        minIdx = i",
                "        for j from i+1 to n:",
                "            if arr[j] < arr[minIdx]:",
                "                minIdx = j",
                "        swap(arr[i], arr[minIdx])",
                "    return arr"
            ],
            visualSteps: [
                "Find minimum in unsorted part",
                "Swap with first unsorted element",
                "Repeat until all sorted"
            ],
            bestFor: ["small arrays", "minimizing swaps"]
        },
        insertionSort: {
            name: "Insertion Sort",
            complexity: "O(n²)",
            complexityValue: 2,
            description: "Build sorted array one element at a time by repeatedly inserting elements in correct position.",
            pseudocode: [
                "function insertionSort(arr):",
                "    n = arr.length",
                "    for i from 1 to n-1:",
                "        key = arr[i]",
                "        j = i - 1",
                "        while j >= 0 and arr[j] > key:",
                "            arr[j+1] = arr[j]",
                "            j = j - 1",
                "        arr[j+1] = key",
                "    return arr"
            ],
            visualSteps: [
                "Take one element at a time",
                "Insert it into correct position",
                "Shift other elements as needed"
            ],
            bestFor: ["small arrays", "nearly sorted arrays", "online algorithms"]
        },
        mergeSort: {
            name: "Merge Sort",
            complexity: "O(n log n)",
            complexityValue: 1.5,
            description: "Divide array into smaller subarrays, sort them, then merge sorted subarrays.",
            pseudocode: [
                "function mergeSort(arr):",
                "    if arr.length <= 1:",
                "        return arr",
                "    mid = arr.length / 2",
                "    leftHalf = arr[0...mid-1]",
                "    rightHalf = arr[mid...n]",
                "    left = mergeSort(leftHalf)",
                "    right = mergeSort(rightHalf)",
                "    return merge(left, right)"
            ],
            visualSteps: [
                "Divide array in half",
                "Sort each half recursively", 
                "Merge sorted halves"
            ],
            bestFor: ["large arrays", "guaranteed performance", "stable sort"]
        },
        quickSort: {
            name: "Quick Sort",
            complexity: "O(n log n)",
            complexityValue: 1.5,
            description: "Select pivot element and partition array, recursively sort subarrays.",
            pseudocode: [
                "function quickSort(arr, low, high):",
                "    if low < high:",
                "        pivotIndex = partition(arr, low, high)",
                "        quickSort(arr, low, pivotIndex-1)",
                "        quickSort(arr, pivotIndex+1, high)",
                "    return arr",
                "",
                "function partition(arr, low, high):",
                "    pivot = arr[high]",
                "    i = low - 1",
                "    for j from low to high-1:",
                "        if arr[j] <= pivot:",
                "            i = i + 1",
                "            swap(arr[i], arr[j])",
                "    swap(arr[i+1], arr[high])",
                "    return i + 1"
            ],
            visualSteps: [
                "Choose pivot element",
                "Partition array around pivot",
                "Recursively sort subarrays"
            ],
            bestFor: ["large arrays", "average case performance"]
        },
        heapSort: {
            name: "Heap Sort",
            complexity: "O(n log n)",
            complexityValue: 1.5,
            description: "Convert array to heap, repeatedly extract maximum element.",
            pseudocode: [
                "function heapSort(arr):",
                "    n = arr.length",
                "    // Build max heap",
                "    for i from n/2-1 down to 0:",
                "        heapify(arr, n, i)",
                "    // Extract elements one by one",
                "    for i from n-1 down to 0:",
                "        swap(arr[0], arr[i])",
                "        heapify(arr, i, 0)",
                "    return arr"
            ],
            visualSteps: [
                "Build max heap from array",
                "Extract maximum repeatedly",
                "Heapify after each extraction"
            ],
            bestFor: ["large arrays", "in-place sorting", "guaranteed performance"]
        },
        countingSort: {
            name: "Counting Sort",
            complexity: "O(n+k)",
            complexityValue: 1,
            description: "Count occurrences of each value, then reconstruct array in sorted order.",
            pseudocode: [
                "function countingSort(arr, max):",
                "    count = array of size max+1 filled with 0s",
                "    for i from 0 to arr.length-1:",
                "        count[arr[i]] += 1",
                "    // Reconstruct sorted array",
                "    sortedIndex = 0",
                "    for i from 0 to max:",
                "        while count[i] > 0:",
                "            arr[sortedIndex] = i",
                "            sortedIndex += 1",
                "            count[i] -= 1",
                "    return arr"
            ],
            visualSteps: [
                "Count occurrences of each value",
                "Calculate positions in output array",
                "Place elements in correct positions"
            ],
            bestFor: ["integer arrays", "small range of values"]
        },
        radixSort: {
            name: "Radix Sort",
            complexity: "O(d*(n+k))",
            complexityValue: 1,
            description: "Sort numbers digit by digit, from least to most significant digit.",
            pseudocode: [
                "function radixSort(arr):",
                "    max = maximum value in arr",
                "    exp = 1",
                "    while max / exp > 0:",
                "        countingSortByDigit(arr, exp)",
                "        exp *= 10",
                "    return arr"
            ],
            visualSteps: [
                "Sort by least significant digit",
                "Move to next digit",
                "Repeat for all digits"
            ],
            bestFor: ["integer arrays", "fixed-length values"]
        },
        bucketSort: {
            name: "Bucket Sort",
            complexity: "O(n+k)",
            complexityValue: 1,
            description: "Distribute elements into buckets, sort buckets, then concatenate.",
            pseudocode: [
                "function bucketSort(arr, bucketCount):",
                "    buckets = array of bucketCount empty lists",
                "    for i from 0 to arr.length-1:",
                "        bucketIndex = floor(arr[i] * bucketCount)",
                "        add arr[i] to buckets[bucketIndex]",
                "    for i from 0 to bucketCount-1:",
                "        sort(buckets[i])",
                "    return concatenate all buckets"
            ],
            visualSteps: [
                "Distribute items into buckets",
                "Sort each bucket individually",
                "Concatenate all buckets"
            ],
            bestFor: ["uniformly distributed values", "floating point numbers"]
        }
    };
    
    // Challenge definitions
    function generateChallenges() {
        return [
            {
                id: 1,
                description: "Sort the array in ascending order. The array is almost sorted with only a few elements out of place.",
                dataType: "nearly-sorted",
                dataSize: 10,
                optimal: ["insertionSort", "bubbleSort"],
                acceptable: ["mergeSort", "quickSort", "heapSort"],
                suboptimal: ["selectionSort", "radixSort", "countingSort", "bucketSort"]
            },
            {
                id: 2,
                description: "Sort this large array of random integers as efficiently as possible.",
                dataType: "random",
                dataSize: 15,
                optimal: ["quickSort", "mergeSort", "heapSort"],
                acceptable: ["countingSort", "radixSort"],
                suboptimal: ["bubbleSort", "selectionSort", "insertionSort", "bucketSort"]
            },
            {
                id: 3,
                description: "Sort this array of integers between 0-9 with many duplicates. Optimize for speed.",
                dataType: "small-range",
                dataSize: 15,
                optimal: ["countingSort", "radixSort", "bucketSort"],
                acceptable: ["quickSort", "mergeSort", "heapSort"],
                suboptimal: ["bubbleSort", "selectionSort", "insertionSort"]
            }
        ];
    }
    
    // Initialize game
    function initGame() {
        currentLevel = 1;
        efficiency = 100;
        challenges = generateChallenges();
        
        // Reset UI
        scoreDisplay.textContent = efficiency;
        levelDisplay.textContent = currentLevel;
        nextButton.classList.add('hidden');
        resultsDisplay.classList.add('hidden');
        gameComplete.classList.add('hidden');
        
        generateLevel();
    }
    
    // Generate a level
    function generateLevel() {
        // Get the current challenge
        currentChallenge = challenges[currentLevel - 1];
        
        // Update challenge description
        challengeDescription.textContent = currentChallenge.description;
        
        // Generate data array based on challenge type
        dataArray = generateDataArray(currentChallenge.dataType, currentChallenge.dataSize);
        
        // Render data visualization
        renderDataVisualization();
        
        // Clear algorithm selection
        algorithmSelection.innerHTML = '';
        selectedAlgorithm = null;
        
        // Determine which algorithms to show (different for each level)
        let algorithmsToShow = [];
        if (currentLevel === 1) {
            algorithmsToShow = ['bubbleSort', 'insertionSort', 'selectionSort', 'mergeSort', 'quickSort', 'heapSort'];
        } else if (currentLevel === 2) {
            algorithmsToShow = ['bubbleSort', 'mergeSort', 'quickSort', 'heapSort', 'insertionSort', 'selectionSort'];
        } else {
            algorithmsToShow = ['countingSort', 'radixSort', 'bucketSort', 'quickSort', 'mergeSort', 'insertionSort'];
        }
        
        // Create algorithm buttons
        algorithmsToShow.forEach(algId => {
            const alg = algorithms[algId];
            const button = document.createElement('div');
            button.className = 'algorithm-button';
            button.dataset.id = algId;
            button.innerHTML = `
                <div class="name">${alg.name}</div>
                <div class="complexity">${alg.complexity}</div>
            `;
            button.addEventListener('click', () => selectAlgorithm(button));
            algorithmSelection.appendChild(button);
        });
        
        // Reset results display
        resultsDisplay.classList.add('hidden');
        
        // Reset time complexity display
        timeComplexity.textContent = '-';
        
        // Hide next button
        nextButton.classList.add('hidden');
    }
    
    // Generate data array based on challenge type
    function generateDataArray(type, size) {
        const array = [];
        
        if (type === 'nearly-sorted') {
            // Generate a sorted array with a few elements out of place
            for (let i = 0; i < size; i++) {
                array.push(i + 1);
            }
            
            // Swap a few random elements
            for (let i = 0; i < Math.floor(size * 0.2); i++) {
                const index1 = Math.floor(Math.random() * size);
                const index2 = Math.floor(Math.random() * size);
                [array[index1], array[index2]] = [array[index2], array[index1]];
            }
        } else if (type === 'random') {
            // Generate array with random values
            for (let i = 0; i < size; i++) {
                array.push(Math.floor(Math.random() * 50) + 1);
            }
        } else if (type === 'small-range') {
            // Generate array with small range of values (many duplicates)
            for (let i = 0; i < size; i++) {
                array.push(Math.floor(Math.random() * 10));
            }
        }
        
        return array;
    }
    
    // Render data visualization
    function renderDataVisualization() {
        dataVisualization.innerHTML = '';
        
        const maxValue = Math.max(...dataArray);
        
        dataArray.forEach(value => {
            const element = document.createElement('div');
            element.className = 'data-element';
            element.style.height = `${(value / maxValue) * 100}%`;
            element.dataset.value = value;
            dataVisualization.appendChild(element);
        });
    }
    
    // Select algorithm
    function selectAlgorithm(button) {
        // Clear previous selection
        const previouslySelected = algorithmSelection.querySelector('.algorithm-button.selected');
        if (previouslySelected) {
            previouslySelected.classList.remove('selected');
        }
        
        // Mark as selected
        button.classList.add('selected');
        
        // Store selected algorithm
        selectedAlgorithm = button.dataset.id;
        
        // Update time complexity display
        timeComplexity.textContent = algorithms[selectedAlgorithm].complexity;
    }
    
    // Execute algorithm
    function executeAlgorithm() {
        if (!selectedAlgorithm) {
            resultsDisplay.textContent = 'Please select an algorithm first!';
            resultsDisplay.className = 'text-center font-chakra error';
            resultsDisplay.classList.remove('hidden');
            return;
        }
        
        // Determine if the selected algorithm is optimal, acceptable, or suboptimal
        let result = '';
        let resultClass = '';
        let efficiencyChange = 0;
        
        if (currentChallenge.optimal.includes(selectedAlgorithm)) {
            result = `Perfect choice! ${algorithms[selectedAlgorithm].name} is optimal for this problem.`;
            resultClass = 'success';
            efficiencyChange = 0;
        } else if (currentChallenge.acceptable.includes(selectedAlgorithm)) {
            result = `Good choice. ${algorithms[selectedAlgorithm].name} works well, but not the most efficient for this case.`;
            resultClass = 'success';
            efficiencyChange = -10;
        } else {
            result = `Suboptimal choice. ${algorithms[selectedAlgorithm].name} would be inefficient for this case.`;
            resultClass = 'error';
            efficiencyChange = -20;
        }
        
        // Update efficiency
        efficiency = Math.max(0, efficiency + efficiencyChange);
        scoreDisplay.textContent = efficiency;
        
        // Mark the selected algorithm as correct or incorrect
        const selectedButton = algorithmSelection.querySelector('.algorithm-button.selected');
        selectedButton.classList.remove('selected');
        selectedButton.classList.add(efficiencyChange === 0 ? 'correct' : 'incorrect');
        
        // Display result
        resultsDisplay.textContent = result;
        resultsDisplay.className = `text-center font-chakra ${resultClass}`;
        resultsDisplay.classList.remove('hidden');
        
        // Animate the sorting
        animateSorting().then(() => {
            // Show next button
            nextButton.classList.remove('hidden');
            
            // Check if this was the final level
            if (currentLevel >= challenges.length) {
                setTimeout(() => {
                    // Hide other UI elements
                    dataVisualization.parentElement.classList.add('hidden');
                    algorithmSelection.parentElement.classList.add('hidden');
                    executeButton.parentElement.classList.add('hidden');
                    resultsDisplay.classList.add('hidden');
                    nextButton.classList.add('hidden');
                    hintButton.classList.add('hidden');
                    challengeDescription.parentElement.classList.add('hidden');
                    
                    // Show game complete screen
                    gameComplete.classList.remove('hidden');
                    finalEfficiency.textContent = efficiency;
                    
                    // Store completion in localStorage
                    try {
                        localStorage.setItem('byteverse-algorithm-complete', 'true');
                        localStorage.setItem('byteverse-algorithm-efficiency', efficiency.toString());
                    } catch (e) {
                        console.log('Could not save game progress');
                    }
                }, 2000);
            }
        });
    }
    
    // Animate sorting
    async function animateSorting() {
        // Make a copy of the array for visualization
        const arrayToSort = [...dataArray];
        const elements = dataVisualization.querySelectorAll('.data-element');
        
        // Convert all elements to sorted state gradually
        for (let i = 0; i < arrayToSort.length; i++) {
            // Show comparing state
            elements[i].classList.add('comparing');
            
            await new Promise(resolve => setTimeout(resolve, 150));
            
            // Show sorted state
            elements[i].classList.remove('comparing');
            elements[i].classList.add('sorted');
            
            await new Promise(resolve => setTimeout(resolve, 150));
        }
        
        // Sort the actual array and visualize final state
        arrayToSort.sort((a, b) => a - b);
        
        // Update positions to show sorted state
        const maxValue = Math.max(...arrayToSort);
        
        for (let i = 0; i < elements.length; i++) {
            // Update height and value to reflect sorted order
            elements[i].style.height = `${(arrayToSort[i] / maxValue) * 100}%`;
            elements[i].dataset.value = arrayToSort[i];
        }
    }
    
    // Get hint
    function getHint() {
        const optimalAlgorithms = currentChallenge.optimal;
        
        // Find optimal algorithm buttons
        const buttons = Array.from(algorithmSelection.querySelectorAll('.algorithm-button'));
        const optimalButtons = buttons.filter(button => 
            optimalAlgorithms.includes(button.dataset.id)
        );
        
        if (optimalButtons.length > 0) {
            // Randomly select one optimal algorithm
            const randomOptimalButton = optimalButtons[Math.floor(Math.random() * optimalButtons.length)];
            
            // Highlight the button
            randomOptimalButton.style.boxShadow = '0 0 15px rgba(0, 215, 254, 0.7)';
            
            // Show algorithm notes
            const algId = randomOptimalButton.dataset.id;
            const alg = algorithms[algId];
            
            resultsDisplay.innerHTML = `
                <div class="text-left mb-3">
                    <div class="text-cyan-400 mb-1">Hint: Consider ${alg.name}</div>
                    <div class="text-sm mb-2">${alg.description}</div>
                    <div class="text-sm text-gray-400">Best for: ${alg.bestFor.join(', ')}</div>
                </div>
                <div class="code-block text-left text-sm">
                    ${alg.pseudocode.map(line => `<span class="code-line">${line}</span>`).join('')}
                </div>
            `;
            resultsDisplay.className = 'text-left font-chakra';
            resultsDisplay.classList.remove('hidden');
            
            // Remove highlight after a delay
            setTimeout(() => {
                randomOptimalButton.style.boxShadow = '';
            }, 3000);
            
            // Reduce efficiency for using hint
            efficiency = Math.max(0, efficiency - 5);
            scoreDisplay.textContent = efficiency;
        }
    }
    
    // Event listeners
    executeButton.addEventListener('click', executeAlgorithm);
    nextButton.addEventListener('click', () => {
        currentLevel++;
        levelDisplay.textContent = currentLevel;
        generateLevel();
    });
    hintButton.addEventListener('click', getHint);
    restartButton.addEventListener('click', initGame);
    
    // Start the game
    initGame();
});
</script>