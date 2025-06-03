
<?php
// Page-specific variables
$pageTitle = 'Payment Successful | ByteVerse 1.0';
$loaderPrefix = 'ByteVerse';
$loaderText = 'Loading confirmation...';
$currentPage = 'payment-success';

// Get team ID and registration code from URL
$team_id = filter_input(INPUT_GET, 'team_id', FILTER_SANITIZE_NUMBER_INT);
$registration_code = filter_input(INPUT_GET, 'code', FILTER_SANITIZE_STRING);

// Check if the necessary info is present
$valid_request = !empty($team_id) && !empty($registration_code);

// Additional scripts
$additionalScripts = '';

// Include header
require_once('components/header.php');

// Include navbar
require_once('components/navbar.php');

// Connect to database to verify team info
$team_info = null;
if ($valid_request) {
    require_once('backend/api/db.php');
    $conn = getDbConnection();
    
    if ($conn) {
        $stmt = $conn->prepare("SELECT t.*, tm.full_name, tm.email, 
                              p.payment_status, p.amount, p.payment_id, p.payment_date
                              FROM teams t 
                              JOIN team_members tm ON t.id = tm.team_id
                              LEFT JOIN payments p ON t.id = p.team_id
                              WHERE t.id = :team_id AND t.registration_code = :reg_code
                              AND tm.is_leader = 1");
        
        $stmt->bindParam(':team_id', $team_id);
        $stmt->bindParam(':reg_code', $registration_code);
        $stmt->execute();
        
        $team_info = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

<!-- Success Hero Section -->
<section class="min-h-[40vh] relative overflow-hidden flex items-center justify-center pt-24">
    <div class="container mx-auto px-4 py-10 relative z-10 text-center">
        <div class="grid-lines"></div>
        
        <h1 class="glitch-text text-4xl md:text-6xl mb-6" data-text="Registration Complete">Registration Complete</h1>
        <div class="max-w-3xl mx-auto">
            <p class="text-gray-300 text-lg mb-8">Your spot at ByteVerse Hackathon is now confirmed!</p>
        </div>
    </div>
</section>

<!-- Success Content Section -->
<section class="py-12 relative">
    <div class="container mx-auto px-4">
        <div class="circuit-dots"></div>
        
        <?php if (!$valid_request || !$team_info || $team_info['payment_status'] !== 'completed'): ?>
            <div class="text-center p-8 bg-gray-900/80 rounded-xl border border-cyan-900/50 shadow-glow max-w-2xl mx-auto">
                <svg class="mx-auto mb-6 w-16 h-16 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <h2 class="text-2xl font-bold text-white mb-4">Invalid Request</h2>
                <p class="text-gray-300 mb-6">We couldn't find the registration or payment information you're looking for.</p>
                <div class="mt-8">
                    <a href="index.php" class="cyber-button bg-gradient-to-r from-blue-600 to-blue-500">
                        <span>Return to Home</span>
                        <i></i>
                    </a>
                </div>
            </div>
        
        <?php else: ?>
            <div class="success-container max-w-4xl mx-auto">
                <!-- Success Animation -->
                <div class="text-center mb-10">
                    <div class="success-checkmark mx-auto">
                        <div class="check-icon">
                            <span class="icon-line line-tip"></span>
                            <span class="icon-line line-long"></span>
                            <div class="icon-circle"></div>
                            <div class="icon-fix"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Success Message -->
                <div class="text-center p-8 bg-gray-900/80 rounded-xl border border-green-500/30 shadow-glow-success mb-8">
                    <h2 class="text-3xl font-bold text-white mb-4">Thank You!</h2>
                    <p class="text-xl text-green-400 mb-6">Your payment has been successfully processed</p>
                    
                    <div class="max-w-md mx-auto">
                        <p class="text-gray-300 mb-4">Your team's participation in ByteVerse Hackathon is now confirmed. We're excited to have you join us!</p>
                    </div>
                </div>
                
                <!-- Registration Details -->
                <div class="p-6 bg-gray-900/50 rounded-xl border border-gray-800 mb-8">
                    <h3 class="text-xl font-semibold text-white mb-4">Registration Details</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-4">
                                <p class="text-gray-400 text-sm">Team Name</p>
                                <p class="text-white font-medium"><?php echo htmlspecialchars($team_info['team_name']); ?></p>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-gray-400 text-sm">Registration Code</p>
                                <p class="text-cyan-400 font-bold tracking-wider"><?php echo htmlspecialchars($team_info['registration_code']); ?></p>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-gray-400 text-sm">Team Leader</p>
                                <p class="text-white"><?php echo htmlspecialchars($team_info['full_name']); ?></p>
                            </div>
                        </div>
                        
                        <div>
                            <div class="mb-4">
                                <p class="text-gray-400 text-sm">Payment Status</p>
                                <p class="text-green-400 font-medium">✓ Completed</p>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-gray-400 text-sm">Payment ID</p>
                                <p class="text-white font-mono"><?php echo htmlspecialchars($team_info['payment_id']); ?></p>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-gray-400 text-sm">Payment Date</p>
                                <p class="text-white"><?php echo date('F j, Y, g:i a', strtotime($team_info['payment_date'])); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- What's Next -->
                <div class="p-6 bg-indigo-900/20 rounded-xl border border-indigo-500/20 mb-8">
                    <h3 class="text-xl font-semibold text-white mb-4">What's Next?</h3>
                    
                    <ol class="space-y-4 pl-3">
                        <li class="flex items-start">
                            <div class="flex-shrink-0 flex items-center justify-center h-8 w-8 rounded-full bg-indigo-700 text-white font-bold mr-3">1</div>
                            <div>
                                <p class="text-white font-medium">Check your email</p>
                                <p class="text-gray-300">We've sent a confirmation email to <?php echo htmlspecialchars($team_info['email']); ?> with all the details.</p>
                            </div>
                        </li>
                        
                        <li class="flex items-start">
                            <div class="flex-shrink-0 flex items-center justify-center h-8 w-8 rounded-full bg-indigo-700 text-white font-bold mr-3">2</div>
                            <div>
                                <p class="text-white font-medium">Mark your calendar</p>
                                <p class="text-gray-300">The ByteVerse Hackathon will take place on May 25-27, 2025.</p>
                            </div>
                        </li>
                        
                        <li class="flex items-start">
                            <div class="flex-shrink-0 flex items-center justify-center h-8 w-8 rounded-full bg-indigo-700 text-white font-bold mr-3">3</div>
                            <div>
                                <p class="text-white font-medium">Join our Discord community</p>
                                <p class="text-gray-300">Connect with other participants and stay updated through our <a href="https://discord.gg/byteverse" class="text-indigo-400 hover:text-indigo-300">Discord server</a>.</p>
                            </div>
                        </li>
                        
                        <li class="flex items-start">
                            <div class="flex-shrink-0 flex items-center justify-center h-8 w-8 rounded-full bg-indigo-700 text-white font-bold mr-3">4</div>
                            <div>
                                <p class="text-white font-medium">Prepare with your team</p>
                                <p class="text-gray-300">Start brainstorming ideas and preparing for the hackathon challenges.</p>
                            </div>
                        </li>
                    </ol>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col md:flex-row justify-center gap-4 mt-8">
                    <a href="index.php" class="cyber-button bg-gradient-to-r from-purple-600 to-purple-500">
                        <span>Return to Home</span>
                        <i></i>
                    </a>
                    
                    <a href="dashboard.php" class="cyber-button-primary bg-gradient-to-r from-cyan-600 to-blue-600">
                        <span>Go to Dashboard</span>
                        <i></i>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
/* Success Checkmark Animation */
.success-checkmark {
    width: 80px;
    height: 80px;
    position: relative;
}
.success-checkmark .check-icon {
    width: 80px;
    height: 80px;
    position: relative;
    border-radius: 50%;
    box-sizing: content-box;
    border: 4px solid #00D7FE;
}
.success-checkmark .check-icon::before {
    top: 3px;
    left: -2px;
    width: 30px;
    transform-origin: 100% 50%;
    border-radius: 100px 0 0 100px;
}
.success-checkmark .check-icon::after {
    top: 0;
    left: 30px;
    width: 60px;
    transform-origin: 0 50%;
    border-radius: 0 100px 100px 0;
    animation: rotate-circle 4.25s ease-in infinite;
}
.success-checkmark .check-icon::before, .success-checkmark .check-icon::after {
    content: '';
    height: 100px;
    position: absolute;
    background: transparent;
    transform: rotate(-45deg);
}
.success-checkmark .check-icon .icon-line {
    height: 5px;
    background-color: #00D7FE;
    display: block;
    border-radius: 2px;
    position: absolute;
    z-index: 10;
}
.success-checkmark .check-icon .icon-line.line-tip {
    top: 46px;
    left: 14px;
    width: 25px;
    transform: rotate(45deg);
    animation: icon-line-tip 0.75s forwards, pulse 2s ease-in-out 1s infinite;
}
.success-checkmark .check-icon .icon-line.line-long {
    top: 38px;
    right: 8px;
    width: 47px;
    transform: rotate(-45deg);
    animation: icon-line-long 0.75s forwards, pulse 2s ease-in-out 1s infinite;
}
.success-checkmark .check-icon .icon-circle {
    top: -4px;
    left: -4px;
    z-index: 10;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    position: absolute;
    box-sizing: content-box;
    border: 4px solid rgba(0, 215, 254, 0.3);
}
.success-checkmark .check-icon .icon-fix {
    top: 8px;
    width: 5px;
    left: 26px;
    z-index: 1;
    height: 85px;
    position: absolute;
    transform: rotate(-45deg);
    background-color: transparent;
}

@keyframes rotate-circle {
    0% {
        transform: rotate(-45deg);
    }
    5% {
        transform: rotate(-45deg);
    }
    12% {
        transform: rotate(-405deg);
    }
    100% {
        transform: rotate(-405deg);
    }
}
@keyframes icon-line-tip {
    0% {
        width: 0;
        left: 1px;
        top: 19px;
    }
    54% {
        width: 0;
        left: 1px;
        top: 19px;
    }
    70% {
        width: 50px;
        left: -8px;
        top: 37px;
    }
    84% {
        width: 17px;
        left: 21px;
        top: 48px;
    }
    100% {
        width: 25px;
        left: 14px;
        top: 45px;
    }
}
@keyframes icon-line-long {
    0% {
        width: 0;
        right: 46px;
        top: 54px;
    }
    65% {
        width: 0;
        right: 46px;
        top: 54px;
    }
    84% {
        width: 55px;
        right: 0px;
        top: 35px;
    }
    100% {
        width: 47px;
        right: 8px;
        top: 38px;
    }
}
@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(0, 215, 254, 0.4);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(0, 215, 254, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(0, 215, 254, 0);
    }
}
</style>

<?php
// Include terminal
require_once('components/terminal.php');

// Include footer
require_once('components/footer.php');
?>