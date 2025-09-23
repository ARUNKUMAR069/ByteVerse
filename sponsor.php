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
<section class="py-20 bg-gradient-to-b from-gray-900 to-black relative overflow-hidden">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold font-orbitron text-white mb-6">
                Our <span class="text-cyan-400">Sponsors</span>
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-blue-500 mx-auto mb-8"></div>
            <p class="text-lg text-gray-300 max-w-3xl mx-auto">
                We are grateful to our amazing sponsors who make ByteVerse 1.0 possible. 
                Their support drives innovation and empowers the next generation of developers.
            </p>
        </div>

        <!-- Title Sponsors -->
        <div class="mb-20">
           <div class="text-center mb-12">
                <div class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-amber-400 to-gray-400 rounded-full">
                    <h3 class="text-3xl font-bold font-orbitron text-white">Title Sponsors</h3>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <!-- Pearson -->
                <div class="group relative bg-white/95 rounded-2xl p-6 border-2 border-yellow-400 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-yellow-400/30">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-yellow-400 to-amber-500 text-white text-xs font-bold px-3 py-1 rounded-full">TITLE</div>
                    <div class="relative z-10 text-center">
                        <div class="w-64 h-64 mx-auto bg-white rounded-xl shadow-lg mb-6 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/Title1.png" alt="Pearson" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-2xl font-bold text-gray-800 font-orbitron">Pearson</h4>
                        <p class="text-sm text-gray-600 mt-1">Title Sponsor</p>
                    </div>
                </div>
                
                <!-- Grizon Tech -->
                <div class="group relative bg-white/95 rounded-2xl p-6 border-2 border-yellow-400 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-yellow-400/30">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-yellow-400 to-amber-500 text-white text-xs font-bold px-3 py-1 rounded-full">TITLE</div>
                    <div class="relative z-10 text-center">
                        <div class="w-64 h-64 mx-auto bg-white rounded-xl shadow-lg mb-6 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/Title2.png" alt="Grizon Tech" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-2xl font-bold text-gray-800 font-orbitron">Grizon Tech</h4>
                        <p class="text-sm text-gray-600 mt-1">Title Sponsor</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Premium Sponsors (Gold & Silver) -->
        <div class="mb-20">
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-amber-400 to-gray-400 rounded-full">
                    <h3 class="text-3xl font-bold font-orbitron text-white">Gold & Silver Sponsors</h3>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Gold Sponsor - Netpro -->
                <div class="group relative bg-white/95 rounded-xl p-6 border-2 border-yellow-500 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-yellow-500/30">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white text-xs font-bold px-3 py-1 rounded-full">GOLD</div>
                    <div class="text-center">
                        <div class="w-56 h-56 mx-auto bg-white rounded-lg shadow-md mb-4 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/Gold1.png" alt="Netpro" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 font-orbitron">Netpro</h4>
                        <p class="text-sm text-gray-600 mt-1">Gold Sponsor</p>
                    </div>
                </div>

                <!-- Silver Sponsor - Shanti Box Company -->
                <div class="group relative bg-white/95 rounded-xl p-6 border-2 border-gray-300 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-gray-300/30">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-gray-300 to-gray-400 text-white text-xs font-bold px-3 py-1 rounded-full">SILVER</div>
                    <div class="text-center">
                        <div class="w-56 h-56 mx-auto bg-white rounded-lg shadow-md mb-4 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/Silver1.png" alt="Shanti Box Company" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 font-orbitron">Shanti Box Company</h4>
                        <p class="text-sm text-gray-600 mt-1">Silver Sponsor</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Supporters -->
        <div class="mb-20">
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full">
                    <h3 class="text-2xl font-bold font-orbitron text-white">Supporters</h3>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <!-- Supporter 1 - Softcon -->
                <div class="group relative bg-white/95 rounded-lg p-4 border-2 border-cyan-400/30 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-cyan-400/20">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-cyan-400 to-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">SUPPORTER</div>
                    <div class="text-center">
                        <div class="w-40 h-40 mx-auto bg-white rounded-md shadow-sm mb-3 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/Supporter1.png" alt="Softcon" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-sm font-bold text-gray-800 font-orbitron">Softcon</h4>
                    </div>
                </div>

                <!-- Supporter 2 - Equitas Bank -->
                <div class="group relative bg-white/95 rounded-lg p-4 border-2 border-cyan-400/30 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-cyan-400/20">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-cyan-400 to-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">SUPPORTER</div>
                    <div class="text-center">
                        <div class="w-40 h-40 mx-auto bg-white rounded-md shadow-sm mb-3 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/Supporter2.png" alt="Equitas Bank" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-sm font-bold text-gray-800 font-orbitron">Equitas Bank</h4>
                    </div>
                </div>

                <!-- Supporter 3 - Techcadd -->
                <div class="group relative bg-white/95 rounded-lg p-4 border-2 border-cyan-400/30 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-cyan-400/20">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-cyan-400 to-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">SUPPORTER</div>
                    <div class="text-center">
                        <div class="w-40 h-40 mx-auto bg-white rounded-md shadow-sm mb-3 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/Supporter3.png" alt="Techcadd" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-sm font-bold text-gray-800 font-orbitron">Techcadd</h4>
                    </div>
                </div>

                <!-- Supporter 4 - Future Finders -->
                <div class="group relative bg-white/95 rounded-lg p-4 border-2 border-cyan-400/30 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-cyan-400/20">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-cyan-400 to-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">SUPPORTER</div>
                    <div class="text-center">
                        <div class="w-40 h-40 mx-auto bg-white rounded-md shadow-sm mb-3 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/Supporter4.png" alt="Future Finders" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-sm font-bold text-gray-800 font-orbitron">Future Finders</h4>
                    </div>
                </div>

                <!-- Supporter 5 - Solitaire Infosys -->
                <div class="group relative bg-white/95 rounded-lg p-4 border-2 border-cyan-400/30 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-cyan-400/20">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-cyan-400 to-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">SUPPORTER</div>
                    <div class="text-center">
                        <div class="w-40 h-40 mx-auto bg-white rounded-md shadow-sm mb-3 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/Supporter5.png" alt="Solitaire Infosys" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-sm font-bold text-gray-800 font-orbitron">Solitaire Infosys</h4>
                    </div>
                </div>

                <!-- Supporter 6 - Pisoft -->
                <div class="group relative bg-white/95 rounded-lg p-4 border-2 border-cyan-400/30 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-cyan-400/20">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-cyan-400 to-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">SUPPORTER</div>
                    <div class="text-center">
                        <div class="w-40 h-40 mx-auto bg-white rounded-md shadow-sm mb-3 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/Supporter6.png" alt="Pisoft" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-sm font-bold text-gray-800 font-orbitron">Pisoft</h4>
                    </div>
                </div>

                <!-- Supporter 7 - Novem Control -->
                <div class="group relative bg-white/95 rounded-lg p-4 border-2 border-cyan-400/30 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-cyan-400/20">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-cyan-400 to-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">SUPPORTER</div>
                    <div class="text-center">
                        <div class="w-40 h-40 mx-auto bg-white rounded-md shadow-sm mb-3 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/Supporter7.png" alt="Novem Control" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-sm font-bold text-gray-800 font-orbitron">Novem Control</h4>
                    </div>
                </div>

                <!-- Supporter 8 - O7 -->
                <div class="group relative bg-white/95 rounded-lg p-4 border-2 border-cyan-400/30 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-cyan-400/20">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-cyan-400 to-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">SUPPORTER</div>
                    <div class="text-center">
                        <div class="w-40 h-40 mx-auto bg-white rounded-md shadow-sm mb-3 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/Supporter8.png" alt="O7" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-sm font-bold text-gray-800 font-orbitron">O7</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- In Kind Partners -->
        <div class="mb-20">
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full">
                    <h3 class="text-2xl font-bold font-orbitron text-white">In Kind Partners</h3>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- IDP IELTS -->
                <div class="group relative bg-white/95 rounded-lg p-5 border-2 border-purple-400/30 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-purple-400/20">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-purple-400 to-pink-400 text-white text-xs font-bold px-2 py-1 rounded-full">PARTNER</div>
                    <div class="text-center">
                        <div class="w-48 h-48 mx-auto bg-white rounded-md shadow-md mb-4 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/InKind1.png" alt="IDP IELTS" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 font-orbitron">IDP IELTS</h4>
                        <p class="text-xs text-gray-600 mt-1">In Kind Partner</p>
                    </div>
                </div>

                <!-- Solitaire InfoTech -->
                <div class="group relative bg-white/95 rounded-lg p-5 border-2 border-purple-400/30 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-purple-400/20">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-purple-400 to-pink-400 text-white text-xs font-bold px-2 py-1 rounded-full">PARTNER</div>
                    <div class="text-center">
                        <div class="w-48 h-48 mx-auto bg-white rounded-md shadow-md mb-4 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/InKind2.png" alt="Solitaire InfoTech" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 font-orbitron">Solitaire InfoTech</h4>
                        <p class="text-xs text-gray-600 mt-1">In Kind Partner</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mission Go Green Sponsors -->
        <div class="mb-20">
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full">
                    <h3 class="text-2xl font-bold font-orbitron text-white">Mission Go Green Sponsors</h3>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- GTB -->
                <div class="group relative bg-white/95 rounded-lg p-5 border-2 border-green-400/30 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-green-400/20">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-green-400 to-emerald-500 text-white text-xs font-bold px-2 py-1 rounded-full">GO GREEN</div>
                    <div class="text-center">
                        <div class="w-48 h-48 mx-auto bg-white rounded-md shadow-md mb-4 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/MissionGoGreen1.png" alt="GTB" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 font-orbitron">GTB</h4>
                        <p class="text-xs text-gray-600 mt-1">Mission Go Green Sponsor</p>
                    </div>
                </div>

                <!-- Punjab Gov. Nursery -->
                <div class="group relative bg-white/95 rounded-lg p-5 border-2 border-green-400/30 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-green-400/20">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-green-400 to-emerald-500 text-white text-xs font-bold px-2 py-1 rounded-full">GO GREEN</div>
                    <div class="text-center">
                        <div class="w-48 h-48 mx-auto bg-white rounded-md shadow-md mb-4 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/MissionGoGreen2.png" alt="Punjab Gov. Nursery" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 font-orbitron">Punjab Gov. Nursery</h4>
                        <p class="text-xs text-gray-600 mt-1">Mission Go Green Sponsor</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sponsor Partners -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full">
                    <h3 class="text-2xl font-bold font-orbitron text-white">Sponsor Partners</h3>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Gem Pro Solutions -->
                <div class="group relative bg-white/95 rounded-lg p-5 border-2 border-blue-400/30 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-blue-400/20">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-blue-400 to-indigo-500 text-white text-xs font-bold px-2 py-1 rounded-full">PARTNER</div>
                    <div class="text-center">
                        <div class="w-48 h-48 mx-auto bg-white rounded-md shadow-md mb-4 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/Sponsor1.png" alt="Gem Pro Solutions" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 font-orbitron">Gem Pro Solutions</h4>
                        <p class="text-xs text-gray-600 mt-1">Sponsor Partner</p>
                    </div>
                </div>

                <!-- Innovative Solutions -->
                <div class="group relative bg-white/95 rounded-lg p-5 border-2 border-blue-400/30 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-blue-400/20">
                    <div class="absolute top-2 right-2 bg-gradient-to-r from-blue-400 to-indigo-500 text-white text-xs font-bold px-2 py-1 rounded-full">PARTNER</div>
                    <div class="text-center">
                        <div class="w-48 h-48 mx-auto bg-white rounded-md shadow-md mb-4 flex items-center justify-center overflow-hidden p-2">
                            <img src="assets/Images/sponsors/Sponsor2.png" alt="Innovative Solutions" class="max-w-full max-h-full object-contain">
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 font-orbitron">Innovative Solutions</h4>
                        <p class="text-xs text-gray-600 mt-1">Sponsor Partner</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thank You Section -->
        <div class="text-center mt-20">
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-cyan-400/20 max-w-3xl mx-auto">
                <h3 class="text-2xl font-bold font-orbitron text-white mb-4">Thank You</h3>
                <p class="text-gray-300 text-lg">
                    To all our sponsors for believing in ByteVerse 1.0 and supporting the future of technology.
                    Your partnership makes innovation possible.
                </p>
            </div>
        </div>
    </div>
</section>

<style>
/* Sponsor Card Enhancements */
.sponsor-card-title {
    transition: all 0.3s ease;
}

.sponsor-card:hover .sponsor-card-title {
    transform: translateY(-5px);
}

/* Consistent Image Container Styling */
.sponsor-image-container {
    background: linear-gradient(to bottom right, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
    transition: all 0.3s ease;
}

/* Custom animation for sponsor cards */
@keyframes gentle-float {
    0% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
    100% { transform: translateY(0); }
}

.animate-float {
    animation: gentle-float 3s infinite ease-in-out;
}

/* Make sure scrollbar styling is preserved */
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

/* Table styles preserved */
table {
    margin: 0 auto;
    border-spacing: 0;
}

td, th {
    position: relative;
    border-collapse: collapse;
}

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