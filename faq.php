<?php
// Page-specific variables
$pageTitle = 'FAQ | ByteVerse 1.0';
$loaderPrefix = 'ByteVerse FAQs';
$loaderText = 'Loading knowledge base...';
$currentPage = 'faq';

// Additional styles specific to the FAQ page
$additionalStyles = '
/* FAQ Page Specific Styles */
.faq-container {
    position: relative;
    max-width: 900px;
    margin: 0 auto;
}

.faq-category {
    margin-bottom: 3rem;
    position: relative;
}

.category-header {
    background: rgba(0, 215, 254, 0.1);
    border: 1px solid var(--primary-accent);
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.category-header:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0, 215, 254, 0.15);
}

.category-header::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--primary-accent), transparent);
    top: 0;
    left: 0;
    animation: scan 2s infinite linear;
}

.category-title {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-family: "Orbitron", sans-serif;
    font-size: 1.5rem;
    color: var(--primary-accent);
    margin: 0;
}

.faq-item {
    background: rgba(10, 20, 40, 0.3);
    border: 1px solid rgba(0, 215, 254, 0.2);
    border-radius: 8px;
    margin-bottom: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
}

.faq-item:hover {
    border-color: var(--primary-accent);
    box-shadow: 0 5px 15px rgba(0, 215, 254, 0.1);
}

.faq-question {
    padding: 1.25rem;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-family: "Orbitron", sans-serif;
    font-size: 1.1rem;
    color: white;
    user-select: none;
}

.faq-question::after {
    content: "+";
    font-size: 1.5rem;
    color: var(--primary-accent);
    transition: transform 0.3s ease;
}

.faq-item.active .faq-question::after {
    transform: rotate(45deg);
}

.faq-answer {
    font-family: "Rajdhani", sans-serif;
    color: white; /* Changed from var(--text-dim) to white for better visibility */
    line-height: 1.6;
    padding: 0 1.25rem;
    max-height: 0;
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0, 1, 0, 1);
}

.faq-item.active .faq-answer {
    max-height: 1000px;
    padding: 0 1.25rem 1.25rem;
    transition: all 0.5s cubic-bezier(1, 0, 1, 0);
}

.faq-answer a {
    color: var(--primary-accent);
    text-decoration: none;
    border-bottom: 1px dashed var(--primary-accent);
    transition: all 0.3s ease;
}

.faq-answer a:hover {
    color: var(--primary-accent-light);
    border-bottom: 1px solid var(--primary-accent-light);
}

.faq-search {
    margin-bottom: 2rem;
    position: relative;
}

.search-input {
    width: 100%;
    padding: 1rem 1.5rem;
    background: rgba(10, 20, 40, 0.3);
    border: 1px solid rgba(0, 215, 254, 0.3);
    border-radius: 8px;
    font-family: "Chakra Petch", sans-serif;
    font-size: 1rem;
    color: white;
    transition: all 0.3s ease;
}

.search-input:focus {
    outline: none;
    border-color: var(--primary-accent);
    box-shadow: 0 0 15px rgba(0, 215, 254, 0.2);
}

.search-input::placeholder {
    color: rgba(255, 255, 255, 0.4);
}

.search-icon {
    position: absolute;
    right: 1.5rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--primary-accent);
}

.highlight {
    background: rgba(0, 215, 254, 0.2);
    padding: 0 3px;
    border-radius: 3px;
}

.no-results {
    text-align: center;
    padding: 2rem;
    font-family: "Rajdhani", sans-serif;
    color: white; /* Changed from var(--text-dim) to white for better visibility */
}

.faq-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 0.5rem;
}

.faq-tag {
    font-family: "Chakra Petch", sans-serif;
    font-size: 0.75rem;
    padding: 0.15rem 0.5rem;
    border-radius: 20px;
    background: rgba(0, 215, 254, 0.1);
    border: 1px solid rgba(0, 215, 254, 0.2);
    color: var(--primary-accent-light);
}

.contact-cta {
    margin-top: 3rem;
    padding: 2rem;
    background: rgba(189, 0, 255, 0.05);
    border: 1px solid var(--neon-purple);
    border-radius: 8px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.contact-cta h3 {
    font-family: "Orbitron", sans-serif;
    color: var(--neon-purple);
    margin-bottom: 1rem;
}

.contact-cta p {
    font-family: "Rajdhani", sans-serif;
    color: white; /* Changed from var(--text-dim) to white for better visibility */
    margin-bottom: 1.5rem;
}

/* Center the contact button properly */
.contact-cta .cyber-button {
    display: inline-flex;
    margin: 0 auto;
}

/* Circuit board aesthetics for FAQ */
.circuit-dots {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-image: 
        radial-gradient(circle at 25% 25%, rgba(0, 215, 254, 0.1) 1px, transparent 1px),
        radial-gradient(circle at 75% 75%, rgba(0, 215, 254, 0.1) 1px, transparent 1px);
    background-size: 30px 30px;
    z-index: -1;
    opacity: 0.3;
    pointer-events: none;
}

/* Responsive design */
@media (max-width: 768px) {
    .category-title {
        font-size: 1.25rem;
    }
    
    .faq-question {
        font-size: 1rem;
    }
}
';

// Additional scripts for the FAQ page
$additionalScripts = '
document.addEventListener("DOMContentLoaded", function() {
    // FAQ accordion functionality
    const faqItems = document.querySelectorAll(".faq-item");
    
    faqItems.forEach(item => {
        const question = item.querySelector(".faq-question");
        
        question.addEventListener("click", () => {
            const alreadyActive = item.classList.contains("active");
            
            // Close all items
            faqItems.forEach(faq => {
                faq.classList.remove("active");
            });
            
            // Open clicked item (if it wasn\'t already open)
            if (!alreadyActive) {
                item.classList.add("active");
            }
        });
    });
    
    // Search functionality
    const searchInput = document.getElementById("faq-search");
    const faqCategories = document.querySelectorAll(".faq-category");
    const noResults = document.querySelector(".no-results");
    
    searchInput.addEventListener("input", function() {
        const searchTerm = this.value.toLowerCase().trim();
        let matchFound = false;
        
        if (searchTerm === "") {
            // If search is empty, show all categories and questions, remove highlights
            faqCategories.forEach(category => {
                category.style.display = "block";
                
                const questions = category.querySelectorAll(".faq-item");
                questions.forEach(item => {
                    item.style.display = "block";
                    
                    // Remove any highlighting
                    const questionText = item.querySelector(".faq-question");
                    questionText.innerHTML = questionText.textContent;
                    
                    const answerText = item.querySelector(".faq-answer");
                    answerText.innerHTML = answerText.dataset.original || answerText.innerHTML;
                });
            });
            
            // Hide no results message
            noResults.style.display = "none";
            return;
        }
        
        // Search through all questions and answers
        faqCategories.forEach(category => {
            let categoryMatch = false;
            const questions = category.querySelectorAll(".faq-item");
            
            questions.forEach(item => {
                const questionText = item.querySelector(".faq-question").textContent.toLowerCase();
                const answerText = item.querySelector(".faq-answer").textContent.toLowerCase();
                const answerElement = item.querySelector(".faq-answer");
                
                // Store original text if not already stored
                if (!answerElement.dataset.original) {
                    answerElement.dataset.original = answerElement.innerHTML;
                }
                
                if (questionText.includes(searchTerm) || answerText.includes(searchTerm)) {
                    // Show this question as it matches
                    item.style.display = "block";
                    categoryMatch = true;
                    matchFound = true;
                    
                    // Highlight matching text in question
                    const questionElement = item.querySelector(".faq-question");
                    questionElement.innerHTML = highlightText(questionElement.textContent, searchTerm);
                    
                    // Highlight matching text in answer
                    answerElement.innerHTML = highlightText(answerElement.dataset.original, searchTerm);
                    
                    // Open the item to show the match
                    item.classList.add("active");
                } else {
                    // Hide this question as it doesn\'t match
                    item.style.display = "none";
                }
            });
            
            // Show/hide the category based on if it has any matching questions
            category.style.display = categoryMatch ? "block" : "none";
        });
        
        // Show/hide no results message
        noResults.style.display = matchFound ? "none" : "block";
    });
    
    function highlightText(text, term) {
        if (!text) return "";
        
        const regex = new RegExp(term, "gi");
        return text.replace(regex, match => `<span class="highlight">${match}</span>`);
    }
});
';

// Include header
require_once('components/header.php');

// Include navbar
require_once('components/navbar.php');
?>

<!-- FAQ Hero Section -->
<section class="min-h-[40vh] relative overflow-hidden flex items-center justify-center pt-24">
    <div class="container mx-auto px-4 py-16 relative z-10 text-center">
        <div class="grid-lines"></div>
        
        <h1 class="glitch-text text-4xl md:text-6xl mb-6" data-text="FAQs">FAQs</h1>
        <div class="max-w-3xl mx-auto">
            <p class="text-lg md:text-xl mb-10 text-white leading-relaxed">
                Find answers to frequently asked questions about ByteVerse 1.0, our 24-hour National Level Hackathon for students.
            </p>
        </div>
    </div>
</section>

<!-- FAQ Content Section -->
<section class="py-12 relative">
    <div class="container mx-auto px-4">
        <div class="circuit-dots"></div>
        <div class="faq-container">
            <!-- Search -->
            <div class="faq-search">
                <input type="text" id="faq-search" class="search-input" placeholder="Search for questions or keywords..." />
                <div class="search-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            
            <div class="no-results" style="display: none;">
                <p>No matching questions found. Please try a different search term or <a href="contact.php" class="text-primary-accent hover:underline">contact us</a> directly.</p>
            </div>
            
            <!-- General Questions Category -->
            <div class="faq-category">
                <div class="category-header">
                    <h2 class="category-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        General Information
                    </h2>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">What is ByteVerse 1.0?</div>
                    <div class="faq-answer">
                        <p>ByteVerse 1.0 is a <span class="highlight">24-hour National Level Hackathon</span> designed exclusively for students. It's an intensive coding experience where participants collaborate to solve real-world problems through technology.</p>
                        <p>The event will be held on <span class="highlight">September 27-28, 2025</span> with continuous coding, mentorship sessions, and exciting activities throughout.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">About</span>
                            <span class="faq-tag">Event</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">When and where is ByteVerse 1.0 taking place?</div>
                    <div class="faq-answer">
                        <p>ByteVerse 1.0 will take place from <span class="highlight">September 27-28, 2025</span>. The event will run for a full 24 hours, starting with registration at 9:00 AM on September 27th and concluding with the announcement of winners at 2:00 PM on September 28th. Check our <a href="schedule.php">complete schedule</a> for more details.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Location</span>
                            <span class="faq-tag">Date</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Who can participate in ByteVerse 1.0?</div>
                    <div class="faq-answer">
                        <p>ByteVerse 1.0 is open to all college students from across India. Whether you're pursuing engineering, arts, commerce, or any other degree, if you have a passion for coding and innovation, you're welcome to join!</p>
                        <p>We encourage diversity in participation and welcome students from all backgrounds and skill levels.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Eligibility</span>
                            <span class="faq-tag">Registration</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Is there a registration fee?</div>
                    <div class="faq-answer">
                        <p>Yes, there is a participation fee of <span class="highlight">₹500 per team</span> (not per individual). This fee covers:</p>
                        <ul>
                            <li>Three complete meals during the 24-hour event</li>
                            <li>Two tea/refreshment breaks</li>
                            <li>Access to DJ night and fun activities</li>
                            <li>Participation certificate</li>
                            <li>ByteVerse swag</li>
                        </ul>
                        <p>This fee ensures we can provide quality services throughout the hackathon.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Registration</span>
                            <span class="faq-tag">Costs</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Do I need to have a team before registering?</div>
                    <div class="faq-answer">
                        <p>Yes, you need to have a team formed before registering for ByteVerse 1.0. Each team must have <span class="highlight">3-5 members</span>. Solo participation is not permitted.</p>
                        <p>We recommend forming teams with diverse skills (development, design, presentation, etc.) to maximize your chances of success.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Teams</span>
                            <span class="faq-tag">Registration</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Hackathon Format Category -->
            <div class="faq-category">
                <div class="category-header">
                    <h2 class="category-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Hackathon Format
                    </h2>
                </div>
                
                <!-- <div class="faq-item">
                    <div class="faq-question">What is the format of ByteVerse 1.0?</div>
                    <div class="faq-answer">
                        <p>ByteVerse 1.0 is structured as a 24-hour continuous hackathon divided into several rounds:</p>
                        <ul>
                            <li><span class="highlight">Round 1:</span> Ideation Pitch & Tech Stack Evaluation</li>
                            <li><span class="highlight">Round 2:</span> Prototype Development (in two phases)</li>
                            <li><span class="highlight">Round 3:</span> Final Development & Presentation Preparation</li>
                            <li><span class="highlight">Finals:</span> Top 20 teams present their solutions</li>
                        </ul>
                        <p>Teams will work on their projects through all rounds, with judging at key milestones.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Format</span>
                            <span class="faq-tag">Structure</span>
                        </div>
                    </div>
                </div> -->
                
                <div class="faq-item">
                    <div class="faq-question">What's the maximum team size?</div>
                    <div class="faq-answer">
                        <p>Teams must have a <span class="highlight">minimum of 3 members</span> and a <span class="highlight">maximum of 5 members</span>. This team size requirement is strictly enforced.</p>
                        <p>We recommend having a diverse team with members having different skill sets (coding, design, presentation, domain knowledge) to maximize your chances of success.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Teams</span>
                            <span class="faq-tag">Rules</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">What kind of projects can we build?</div>
                    <div class="faq-answer">
                        <p>You can build any tech project that solves a real-world problem. Projects can include web applications, mobile apps, AI/ML solutions, blockchain applications, IoT implementations, and more.</p>
                        <p>All code must be written during the hackathon. You can use open-source libraries and APIs, but the core implementation must be developed during the event.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Projects</span>
                            <span class="faq-tag">Ideas</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Prizes & Judging Category -->
            <div class="faq-category">
                <div class="category-header">
                    <h2 class="category-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                        Prizes & Judging
                    </h2>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">What prizes can we win?</div>
                    <div class="faq-answer">
                        <p>ByteVerse 1.0 offers prizes worth up to <span class="highlight">₹50,000</span>, distributed among the top-performing teams:</p>
                        <ul>
                            <li><span class="highlight">1st Place:</span> Cash prizes</li>
                            <li><span class="highlight">2nd Place:</span> Cash prizes and sponsored goodies</li>
                            <li><span class="highlight">3rd Place:</span> Cash prizes and sponsored goodies</li>
                            <li>Special recognition for innovation, design, and technical implementation</li>
                        </ul>
                        <div class="faq-tags">
                            <span class="faq-tag">Prizes</span>
                            <span class="faq-tag">Rewards</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">How will projects be judged?</div>
                    <div class="faq-answer">
                        <p>Projects will be evaluated by a panel of industry experts and academics based on:</p>
                        <ul>
                            <li>Innovation and creativity</li>
                            <li>Technical complexity and execution</li>
                            <li>Completeness and functionality</li>
                            <li>User experience and design</li>
                            <li>Problem-solving capability and impact</li>
                            <li>Presentation quality</li>
                        </ul>
                        <p>Each round has specific evaluation criteria that will be explained at the beginning of the hackathon.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Judging</span>
                            <span class="faq-tag">Criteria</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">When will winners be announced?</div>
                    <div class="faq-answer">
                        <p>Winners will be announced on <span class="highlight">September 28th at 2:00 PM</span> during the closing ceremony. All participants are expected to attend the final presentations and closing ceremony where prizes will be distributed.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Schedule</span>
                            <span class="faq-tag">Prizes</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Logistics Category -->
            <div class="faq-category">
                <div class="category-header">
                    <h2 class="category-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Logistics & Accommodations
                    </h2>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">What should I bring to the hackathon?</div>
                    <div class="faq-answer">
                        <p>Essential items to bring:</p>
                        <ul>
                            <li>Laptop and charger</li>
                            <li>Student ID card</li>
                            <li>Personal hygiene items</li>
                            <li>A change of clothes</li>
                            <li>Any medications you might need</li>
                            <li>Your enthusiasm and creative spirit!</li>
                        </ul>
                        <p>We'll provide mattresses for those who need to rest during the night.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Preparation</span>
                            <span class="faq-tag">Materials</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Will food be provided during the hackathon?</div>
                    <div class="faq-answer">
                        <p>Yes! Your team registration fee covers:</p>
                        <ul>
                            <li>Three complete meals during the 24-hour event</li>
                            <li>Two tea/coffee breaks with light snacks</li>
                            <li>Energy drinks and refreshments available throughout</li>
                        </ul>
                        <p>If you have specific dietary restrictions, please mention them during registration.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Food</span>
                            <span class="faq-tag">Facilities</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact CTA -->
            <div class="contact-cta">
                <h3>Still have questions?</h3>
                <p>If you couldn't find the answer to your question, please feel free to contact our team.</p>
                <a href="contact.php" class="cyber-button primary">
                    <span>Contact Us</span>
                    <i></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Include terminal and footer -->
<?php 
require_once('components/terminal.php');
require_once('components/footer.php');
?>