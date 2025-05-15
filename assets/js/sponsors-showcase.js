/**
 * ByteVerse Sponsors Showcase
 * Handles interactions for the sponsors section
 */

document.addEventListener('DOMContentLoaded', function() {
    // Sponsor Card Interactions
    const sponsorCards = document.querySelectorAll('.sponsor-card');
    
    // Add hover interactions with tilt effect
    if (typeof VanillaTilt !== 'undefined') {
        VanillaTilt.init(sponsorCards, {
            max: 10,
            speed: 400,
            glare: true,
            "max-glare": 0.2,
            scale: 1.05
        });
    } else {
        // Fallback hover effect if VanillaTilt is not available
        sponsorCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    }
    
    // Sponsor data for potential popups or details display
    const sponsorDetails = {
        'techcorp': {
            name: 'TechCorp',
            description: 'A global leader in cloud infrastructure and AI solutions.',
            website: 'https://techcorp.example.com'
        },
        'innovatech': {
            name: 'InnovaTech',
            description: 'Pioneering the future of quantum computing and advanced algorithms.',
            website: 'https://innovatech.example.com'
        },
        'netgrid': {
            name: 'NetGrid',
            description: 'Building the backbone of next-generation networking and connectivity.',
            website: 'https://netgrid.example.com'
        },
        'dataflow': {
            name: 'DataFlow',
            description: 'Big data solutions for enterprise and research applications.',
            website: 'https://dataflow.example.com'
        },
        'quantumbit': {
            name: 'QuantumBit',
            description: 'Advancing the frontiers of cryptography and secure communications.',
            website: 'https://quantumbit.example.com'
        },
        'codeforge': {
            name: 'CodeForge',
            description: 'Developer tools and platforms that power modern application development.',
            website: 'https://codeforge.example.com'
        },
        'bytecraft': {
            name: 'ByteCraft',
            description: 'Innovative solutions in machine learning and data science.',
            website: 'https://bytecraft.example.com'
        },
        'cloudmatrix': {
            name: 'CloudMatrix',
            description: 'Serverless architecture and edge computing specialists.',
            website: 'https://cloudmatrix.example.com'
        },
        'syntaxlabs': {
            name: 'SyntaxLabs',
            description: 'Creating the programming languages and toolchains of tomorrow.',
            website: 'https://syntaxlabs.example.com'
        }
    };
    
    // Optional: Add click event to show sponsor details
    sponsorCards.forEach(card => {
        card.addEventListener('click', function() {
            const sponsorId = this.getAttribute('data-sponsor');
            const details = sponsorDetails[sponsorId];
            
            if (details && typeof showSponsorDetails === 'function') {
                showSponsorDetails(details);
            } else {
                // Fallback - just open the website in a new tab
                // In a real implementation, you might want to show a modal with details
                console.log('Sponsor details for', details ? details.name : sponsorId);
            }
        });
    });
    
    // Add animation on scroll for sponsor tiers and cards
    const sponsorTiers = document.querySelectorAll('.sponsors-tier');
    
    const animateOnScroll = () => {
        sponsorTiers.forEach(tier => {
            const tierTop = tier.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (tierTop < windowHeight * 0.9) {
                tier.classList.add('visible');
                
                // Animate cards in this tier with stagger
                const cards = tier.querySelectorAll('.sponsor-card');
                cards.forEach((card, index) => {
                    setTimeout(() => {
                        card.classList.add('visible');
                    }, index * 100);
                });
            }
        });
    };
    
    // Initial check for elements in viewport
    animateOnScroll();
    
    // Check on scroll
    window.addEventListener('scroll', animateOnScroll);
});