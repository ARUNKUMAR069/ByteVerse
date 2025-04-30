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
    color: var(--text-dim);
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
    color: var(--text-dim);
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
}

.contact-cta h3 {
    font-family: "Orbitron", sans-serif;
    color: var(--neon-purple);
    margin-bottom: 1rem;
}

.contact-cta p {
    font-family: "Rajdhani", sans-serif;
    color: var(--text-dim);
    margin-bottom: 1.5rem;
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
        
        <h1 class="glitch-text text-4xl md:text-6xl mb-6" data-text="FAQ">FAQ</h1>
        <div class="max-w-3xl mx-auto">
            <p class="text-lg md:text-xl mb-10 text-gray-300 leading-relaxed">
                Find answers to frequently asked questions about ByteVerse 1.0. If you can't find what you're looking for, reach out to our support team.
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
                        <p>ByteVerse 1.0 is a 48-hour hackathon where participants (individually or in teams) create innovative tech solutions to real-world problems. It brings together coders, designers, and tech enthusiasts from across the region to collaborate, learn, and build projects that push the boundaries of technology.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">About</span>
                            <span class="faq-tag">Event</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">When and where is ByteVerse 1.0 taking place?</div>
                    <div class="faq-answer">
                        <p>ByteVerse 1.0 will take place from April 28-30, 2025, at the Tech Innovation Center. The event will run for a full 48 hours, with opening ceremonies beginning at 10:30 AM on April 28th and closing ceremonies ending at 7:00 PM on April 30th. Check out our <a href="schedule.php">complete schedule</a> for more details.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Location</span>
                            <span class="faq-tag">Date</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Who can participate in ByteVerse 1.0?</div>
                    <div class="faq-answer">
                        <p>ByteVerse 1.0 is open to students, professionals, and tech enthusiasts of all skill levels. Whether you're a seasoned developer or just starting your coding journey, you're welcome to join! Participants must be at least 18 years old or have parental consent. We especially encourage underrepresented groups in tech to apply.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Eligibility</span>
                            <span class="faq-tag">Registration</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Is there a registration fee?</div>
                    <div class="faq-answer">
                        <p>No, ByteVerse 1.0 is completely free to attend, thanks to our generous sponsors. However, registration is required and space is limited, so make sure to secure your spot early. Registration includes access to the venue, meals, snacks, swag, workshops, and networking events.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Registration</span>
                            <span class="faq-tag">Costs</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">How do I register for the event?</div>
                    <div class="faq-answer">
                        <p>Registration is available through our website. Click the "Register" button in the navigation menu and fill out the required information. You'll receive a confirmation email once your registration is complete. Early registration is encouraged as spots are limited.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Registration</span>
                            <span class="faq-tag">Process</span>
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
                
                <div class="faq-item">
                    <div class="faq-question">What is the format of ByteVerse 1.0?</div>
                    <div class="faq-answer">
                        <p>ByteVerse 1.0 is a 48-hour continuous hackathon where participants form teams and build tech projects from scratch. The event includes workshops, mentoring sessions, networking opportunities, and a final showcase where teams present their projects to judges. Prizes will be awarded in various categories.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Format</span>
                            <span class="faq-tag">Structure</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Do I need to have a team before registering?</div>
                    <div class="faq-answer">
                        <p>No, you can register individually and find teammates at the event. We'll have a team formation session on the first day where you can pitch your ideas and connect with potential teammates. If you already have a team, you can also register together (maximum team size is 4 members).</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Teams</span>
                            <span class="faq-tag">Registration</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">What's the maximum team size?</div>
                    <div class="faq-answer">
                        <p>Teams can have up to 4 members. We recommend having a diverse team with a mix of developers, designers, and business/domain experts to create well-rounded solutions.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Teams</span>
                            <span class="faq-tag">Rules</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">What kind of projects can we build?</div>
                    <div class="faq-answer">
                        <p>You can build any tech project that addresses one of our challenge categories, which will be announced at the opening ceremony. Projects can include web apps, mobile apps, hardware solutions, games, AI/ML applications, blockchain applications, and more. All code must be written during the hackathon - you can use open-source libraries and APIs, but the core project should be created during the event.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Projects</span>
                            <span class="faq-tag">Ideas</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Will there be specific challenges or themes?</div>
                    <div class="faq-answer">
                        <p>Yes, ByteVerse 1.0 will feature multiple challenge tracks that participants can choose from. These will be announced during the opening ceremony. Each track will have specific criteria and prizes. Teams are free to choose any challenge track that interests them.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Challenges</span>
                            <span class="faq-tag">Themes</span>
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
                    <div class="faq-question">Do I need to bring my own laptop/equipment?</div>
                    <div class="faq-answer">
                        <p>Yes, participants should bring their own laptops and any specific equipment needed for their projects. Basic hardware components will be available for those working on hardware hacks, and we'll have a limited number of monitors, keyboards, and mice available on a first-come, first-served basis.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Equipment</span>
                            <span class="faq-tag">Preparation</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Will food be provided during the hackathon?</div>
                    <div class="faq-answer">
                        <p>Yes, we'll provide meals, snacks, and beverages throughout the entire 48-hour event. This includes breakfast, lunch, and dinner each day, as well as midnight snacks for those hacking through the night. Vegetarian, vegan, and gluten-free options will be available. If you have specific dietary restrictions, please note them during registration.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Food</span>
                            <span class="faq-tag">Accommodations</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Can I stay overnight at the venue?</div>
                    <div class="faq-answer">
                        <p>Yes, the venue will be open 24/7 during the hackathon. We'll have designated quiet areas with bean bags and mats for those who want to rest. However, we recommend bringing sleeping bags or blankets for comfort. Shower facilities will be available for participants staying overnight.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Accommodations</span>
                            <span class="faq-tag">Venue</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Is there a dress code for the event?</div>
                    <div class="faq-answer">
                        <p>There's no formal dress code - wear what's comfortable for coding and creating! Many participants wear casual attire like t-shirts, jeans, and comfortable shoes. We recommend bringing layers as temperature can vary in the venue. All participants will receive a ByteVerse t-shirt as part of their swag.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Preparation</span>
                            <span class="faq-tag">Attire</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Will there be Wi-Fi and power outlets?</div>
                    <div class="faq-answer">
                        <p>Yes, high-speed Wi-Fi will be available throughout the venue. We'll provide the network information during check-in. Power strips will be set up at each team table, but we recommend bringing extension cords and power strips if you have specific power needs or multiple devices.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Technical</span>
                            <span class="faq-tag">Facilities</span>
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
                        <p>ByteVerse 1.0 features a prize pool worth over $15,000, including cash prizes, tech gadgets, software subscriptions, and opportunities for internships and mentorships with our sponsor companies. Prizes will be awarded for the top overall projects, as well as category winners in each challenge track. There will also be special recognition for innovation, design, technical difficulty, and social impact.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Prizes</span>
                            <span class="faq-tag">Rewards</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">How will projects be judged?</div>
                    <div class="faq-answer">
                        <p>Projects will be evaluated by a panel of judges from the tech industry, academia, and our sponsor organizations. Judging criteria include:</p>
                        <ul class="list-disc pl-6 mt-2 mb-2">
                            <li>Innovation and creativity</li>
                            <li>Technical complexity and execution</li>
                            <li>Completeness and functionality</li>
                            <li>User experience and design</li>
                            <li>Potential impact and practicality</li>
                            <li>Adherence to challenge themes</li>
                            <li>Presentation quality</li>
                        </ul>
                        <p>Each team will have 5 minutes to present their project and 2 minutes for Q&A with the judges.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Judging</span>
                            <span class="faq-tag">Criteria</span>
                        </div>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">When will winners be announced?</div>
                    <div class="faq-answer">
                        <p>Winners will be announced during the closing ceremony on April 30th at 5:30 PM. All participants are expected to attend the closing ceremony, where prizes will be distributed immediately following the announcements.</p>
                        <div class="faq-tags">
                            <span class="faq-tag">Schedule</span>
                            <span class="faq-tag">Prizes</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Can't find what you're looking for? -->
            <div class="contact-cta">
                <h3>Can't find what you're looking for?</h3>
                <p>If you have any other questions that aren't covered here, feel free to reach out to our team. We're here to help!</p>
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