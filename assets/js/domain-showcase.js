/**
 * ByteVerse Domain Showcase
 * Handles interactions for the hackathon domains section
 */

document.addEventListener('DOMContentLoaded', function() {
    // Domain Card Interactions
    const domainCards = document.querySelectorAll('.domain-card');
    const domainModal = document.getElementById('domain-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalDescription = document.getElementById('modal-description');
    const modalProblems = document.getElementById('modal-problems');
    const modalLink = document.getElementById('modal-link');
    const modalClose = document.querySelector('.modal-close');
    
    // Domain details data
    const domainDetails = {
        'agriculture': {
            title: 'Agriculture',
            description: 'Develop solutions that solve agricultural challenges from farm to table. Create technology that improves sustainability, efficiency, and food security for a growing population.',
            problems: [
                'Design an IoT-based system for precision agriculture that optimizes water, fertilizer, and pesticide usage based on real-time soil and environmental data.',
                'Create an AI model for early detection of crop diseases using image recognition to prevent losses and reduce chemical interventions.',
                'Develop a blockchain solution to ensure transparency and traceability in agricultural supply chains, from farmer to consumer.',
                'Build a predictive analytics platform that uses machine learning and weather data to forecast optimal planting and harvesting times.'
            ],
            link: 'challenges.php?domain=agriculture'
        },
        'healthcare': {
            title: 'Healthcare',
            description: 'Transform patient care through innovative digital solutions. Focus on improving diagnosis, treatment, accessibility, and data security in healthcare systems.',
            problems: [
                'Design a telemedicine platform that bridges the gap between rural patients and specialized medical care with minimal bandwidth requirements.',
                'Create a machine learning algorithm that detects early signs of chronic diseases using common health metrics accessible through smartphones or wearables.',
                'Develop a secure healthcare data exchange system that maintains patient privacy while allowing necessary information sharing between providers.',
                'Build an accessible digital solution for medication adherence targeting elderly patients or those with cognitive impairments.'
            ],
            link: 'challenges.php?domain=healthcare'
        },
        'iot-xr': {
            title: 'IoT & XR Technologies',
            description: 'Connect the physical and digital worlds through cutting-edge IoT and Extended Reality solutions. Create immersive and interactive experiences that solve real-world problems.',
            problems: [
                'Design a smart city solution using IoT sensors to optimize traffic flow, reduce congestion, and lower emissions in urban environments.',
                'Create an AR/VR training simulator for complex technical procedures or emergency response scenarios that improves learning outcomes.',
                'Develop a mixed reality interface for complex data visualization that enhances decision-making in business or scientific applications.',
                'Build an IoT system for real-time monitoring and maintenance prediction for industrial equipment to reduce downtime and costs.'
            ],
            link: 'challenges.php?domain=iot-xr'
        },
        'cybersecurity': {
            title: 'Cyber Security',
            description: 'Protect digital infrastructure and data in an increasingly connected world. Design innovative solutions to prevent, detect, and respond to cyber threats.',
            problems: [
                'Create an AI-powered threat detection system that identifies unusual patterns and potential security breaches in network traffic.',
                'Design a zero-trust architecture implementation that balances strong security with minimal user friction for remote work environments.',
                'Develop a secure authentication system for decentralized applications that doesn\'t rely on traditional password mechanisms.',
                'Build a security education platform that uses gamification to improve organizational security awareness and behavior.'
            ],
            link: 'challenges.php?domain=cybersecurity'
        },
        'open': {
            title: 'Open Innovation',
            description: 'Push the boundaries of technology with your unique ideas. This track is for innovative solutions that don\'t fit neatly into other categories but have significant potential impact.',
            problems: [
                'Design a solution that addresses climate change through innovative applications of technology to reduce carbon emissions or improve sustainability.',
                'Create an educational platform that makes technology learning accessible to underserved communities with limited resources.',
                'Develop a novel application of blockchain technology beyond cryptocurrency and financial services.',
                'Build a solution that bridges the digital divide for elderly or disabled populations using emerging technologies.'
            ],
            link: 'challenges.php?domain=open'
        }
    };
    
    // Add hover interactions for domain cards
    domainCards.forEach(card => {
        // Add non-touch device hover effects
        if (!('ontouchstart' in window)) {
            card.addEventListener('mouseenter', function() {
                this.classList.add('card-hover');
            });
            
            card.addEventListener('mouseleave', function() {
                this.classList.remove('card-hover');
            });
        }
        
        // Add click event to open modal
        card.addEventListener('click', function() {
            const domain = this.getAttribute('data-domain');
            const details = domainDetails[domain];
            
            if (details) {
                // Set modal content
                modalTitle.textContent = details.title;
                modalDescription.textContent = details.description;
                
                // Clear and add problem statements
                modalProblems.innerHTML = '';
                details.problems.forEach(problem => {
                    const li = document.createElement('li');
                    li.textContent = problem;
                    modalProblems.appendChild(li);
                });
                
                // Set link
                modalLink.href = details.link;
                
                // Show modal
                domainModal.style.display = 'flex';
                document.body.style.overflow = 'hidden'; // Prevent scrolling
                
                // Add fade-in animation
                setTimeout(() => {
                    domainModal.classList.add('active');
                }, 10);
            }
        });
    });
    
    // Close modal when clicking the close button
    if (modalClose) {
        modalClose.addEventListener('click', closeModal);
    }
    
    // Close modal when clicking outside the content
    if (domainModal) {
        domainModal.addEventListener('click', function(e) {
            if (e.target === domainModal) {
                closeModal();
            }
        });
    }
    
    // Close modal when pressing ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && domainModal.style.display === 'flex') {
            closeModal();
        }
    });
    
    function closeModal() {
        domainModal.classList.remove('active');
        setTimeout(() => {
            domainModal.style.display = 'none';
            document.body.style.overflow = ''; // Restore scrolling
        }, 300);
    }
    
    // Add animation on scroll for domain cards
    const animateOnScroll = () => {
        domainCards.forEach(card => {
            const cardTop = card.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (cardTop < windowHeight * 0.9) {
                card.classList.add('visible');
            }
        });
    };
    
    // Initial check for elements in viewport
    animateOnScroll();
    
    // Check on scroll
    window.addEventListener('scroll', animateOnScroll);
});