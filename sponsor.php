<?php
// Page-specific variables
$pageTitle = 'Sponsorship | ByteVerse 1.0';
$loaderPrefix = 'ByteVerse Sponsors';
$loaderText = 'Loading sponsorship data...';
$currentPage = 'sponsor';

// Use link to external CSS instead of inline styles
$additionalStyles = '';

// Include header
require_once('components/header.php');

// Include navbar
require_once('components/navbar.php');
?>

<!-- In the header.php file, add this line below the main CSS file -->
<link rel="stylesheet" href="assets/css/sponsor.css">

<!-- Hero Section -->
<section class="min-h-[50vh] relative overflow-hidden flex items-center justify-center pt-24">
    <div class="container mx-auto px-4 py-20 relative z-10 text-center">
        <div class="grid-lines"></div>
        
        <h1 class="glitch-text text-4xl md:text-6xl mb-6" data-text="Sponsorship">Sponsorship</h1>
        <div class="max-w-3xl mx-auto">
            <p class="text-lg md:text-xl mb-10 text-gray-300 leading-relaxed">
                Partner with ByteVerse 1.0 to connect with the brightest minds in tech and showcase your brand
                at the forefront of innovation. Together, let's build the future.
            </p>
        </div>
        
       
    </div>
</section>



<!-- Our Sponsors Section -->


<style>
.scrollbar-thin::-webkit-scrollbar {
    height: 8px;
}

.scrollbar-thin::-webkit-scrollbar-track {
    background-color: rgba(31, 41, 55, 0.3);
    border-radius: 4px;
}

.scrollbar-thin::-webkit-scrollbar-thumb {
    background-color: rgba(6, 182, 212, 0.5);
    border-radius: 4px;
}

.scrollbar-thin::-webkit-scrollbar-thumb:hover {
    background-color: rgba(6, 182, 212, 0.7);
}

/* Custom animation for scroll indicator */
@keyframes gentle-pulse {
    0% { opacity: 0.6; }
    50% { opacity: 1; }
    100% { opacity: 0.6; }
}

.animate-pulse {
    animation: gentle-pulse 1.5s infinite ease-in-out;
}

/* Make sure the table is always centered */
table {
    margin: 0 auto;
    border-spacing: 0;
}

/* Ensure borders connect properly */
td, th {
    position: relative;
    border-collapse: collapse;
}

/* Add glow effect to borders on hover */
table:hover {
    box-shadow: 0 0 15px rgba(6, 182, 212, 0.3);
}

@media (max-width: 768px) {
    .scrollbar-thin {
        padding-bottom: 12px;
    }
}
</style>

<?php 
// Include terminal
require_once('components/terminal.php');

// Include footer
require_once('components/footer.php');
?>