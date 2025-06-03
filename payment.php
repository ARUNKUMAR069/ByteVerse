<?php
// Page-specific variables
$pageTitle = 'Complete Payment | ByteVerse 1.0';
$loaderPrefix = 'ByteVerse Payment';
$loaderText = 'Initializing payment gateway...';
$currentPage = 'payment';

// Get team ID and registration code from URL
$team_id = filter_input(INPUT_GET, 'team_id', FILTER_SANITIZE_NUMBER_INT);
$registration_code = filter_input(INPUT_GET, 'code', FILTER_SANITIZE_STRING);

// Check if the necessary info is present
$valid_request = !empty($team_id) && !empty($registration_code);

// Additional scripts
$additionalScripts = '
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="assets/js/payment.js"></script>
';

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
        $stmt = $conn->prepare("SELECT t.*, tm.full_name, tm.email, tm.phone,
                              p.payment_status, p.amount, p.payment_id
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

<!-- Payment Hero Section -->
<section class="min-h-[30vh] relative overflow-hidden flex items-center justify-center pt-24">
    <div class="container mx-auto px-4 py-10 relative z-10 text-center">
        <div class="grid-lines"></div>
        
        <h1 class="glitch-text text-4xl md:text-6xl mb-6" data-text="Complete Payment">Complete Payment</h1>
        <div class="max-w-3xl mx-auto">
            <p class="text-gray-300 text-lg mb-8">Secure your spot at ByteVerse Hackathon by completing your payment</p>
        </div>
    </div>
</section>

<!-- Payment Content Section -->
<section class="py-12 relative">
    <div class="container mx-auto px-4">
        <div class="circuit-dots"></div>
        
        <?php if (!$valid_request || !$team_info): ?>
            <div class="payment-container">
                <div class="text-center p-8 bg-gray-900/80 rounded-xl border border-cyan-900/50 shadow-glow max-w-2xl mx-auto">
                    <svg class="mx-auto mb-6 w-16 h-16 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <h2 class="text-2xl font-bold text-white mb-4">Invalid Payment Request</h2>
                    <p class="text-gray-300 mb-6">We couldn't find the registration information you're looking for. This may be because:</p>
                    <ul class="text-left text-gray-300 mb-6 mx-auto max-w-md">
                        <li class="mb-2">• The payment link is incomplete or incorrect</li>
                        <li class="mb-2">• This registration has already been paid for</li>
                        <li class="mb-2">• The registration was canceled or expired</li>
                    </ul>
                    <div class="mt-8">
                        <a href="registration.php" class="cyber-button bg-gradient-to-r from-blue-600 to-blue-500">
                            <span>Return to Registration</span>
                            <i></i>
                        </a>
                    </div>
                </div>
            </div>
        
        <?php elseif ($team_info['payment_status'] === 'completed'): ?>
            <!-- Already Paid -->
            <div class="payment-container">
                <div class="text-center p-8 bg-gray-900/80 rounded-xl border border-green-700/50 shadow-glow-success max-w-2xl mx-auto">
                    <svg class="mx-auto mb-6 w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h2 class="text-2xl font-bold text-white mb-4">Payment Already Completed</h2>
                    <p class="text-green-400 mb-6">Good news! Your team's payment has already been processed successfully.</p>
                    
                    <div class="bg-green-900/30 p-4 rounded-lg border border-green-700/30 mb-6">
                        <h3 class="text-white text-lg mb-2">Registration Details</h3>
                        <p class="text-gray-300 mb-1"><strong>Team:</strong> <?php echo htmlspecialchars($team_info['team_name']); ?></p>
                        <p class="text-gray-300 mb-1"><strong>Registration Code:</strong> <?php echo htmlspecialchars($team_info['registration_code']); ?></p>
                        <p class="text-gray-300 mb-1"><strong>Status:</strong> <span class="text-green-400">Confirmed</span></p>
                        <?php if (!empty($team_info['payment_id'])): ?>
                            <p class="text-gray-300 mb-1"><strong>Payment ID:</strong> <?php echo htmlspecialchars($team_info['payment_id']); ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <p class="text-gray-300 mb-6">We're excited to have you at ByteVerse Hackathon! Please keep your registration code handy for check-in.</p>
                    
                    <div class="mt-8">
                        <a href="dashboard.php" class="cyber-button bg-gradient-to-r from-green-600 to-green-500">
                            <span>View Your Dashboard</span>
                            <i></i>
                        </a>
                    </div>
                </div>
            </div>
            
        <?php else: ?>
            <!-- Ready for Payment -->
            <div class="payment-container">
                <div class="payment-form-wrapper p-8 bg-gray-900/80 rounded-xl border border-cyan-900/50 shadow-glow max-w-2xl mx-auto">
                    <h2 class="text-2xl font-bold text-white mb-6 text-center">Complete Your Registration</h2>
                    
                    <div class="mb-8 p-4 bg-blue-900/20 rounded-lg border border-blue-900/40">
                        <h3 class="text-xl text-white mb-3">Team Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-400 text-sm">Team Name</p>
                                <p class="text-white"><?php echo htmlspecialchars($team_info['team_name']); ?></p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Registration Code</p>
                                <p class="text-white"><?php echo htmlspecialchars($team_info['registration_code']); ?></p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Team Leader</p>
                                <p class="text-white"><?php echo htmlspecialchars($team_info['full_name']); ?></p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Team Size</p>
                                <p class="text-white"><?php echo htmlspecialchars($team_info['team_size']); ?> Members</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-8">
                        <h3 class="text-xl text-white mb-4">Registration Includes</h3>
                        <ul class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <li class="flex items-start mb-2">
                                <svg class="w-5 h-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-300">Three meals per day</span>
                            </li>
                            <li class="flex items-start mb-2">
                                <svg class="w-5 h-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-300">Technical workshops</span>
                            </li>
                            <li class="flex items-start mb-2">
                                <svg class="w-5 h-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-300">Fun games & activities</span>
                            </li>
                            <li class="flex items-start mb-2">
                                <svg class="w-5 h-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-300">DJ night event</span>
                            </li>
                            <li class="flex items-start mb-2">
                                <svg class="w-5 h-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-300">Event merchandise</span>
                            </li>
                            <li class="flex items-start mb-2">
                                <svg class="w-5 h-5 text-cyan-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-300">Certificate of participation</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="mb-8 p-4 bg-indigo-900/20 rounded-lg border border-indigo-500/20">
                        <h3 class="text-xl text-white mb-3">Payment Summary</h3>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-300">Registration Fee</span>
                            <span class="text-white">₹500 per person</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-300">Team Size</span>
                            <span class="text-white"><?php echo htmlspecialchars($team_info['team_size']); ?> members</span>
                        </div>
                        <div class="border-t border-indigo-500/20 my-2 pt-2 flex justify-between">
                            <span class="text-lg text-white font-bold">Total Amount</span>
                            <span class="text-lg text-white font-bold">₹<?php echo 500 * intval($team_info['team_size']); ?></span>
                        </div>
                    </div>
                    
                    <div class="flex flex-col items-center">
                        <button id="razorpay-payment-button" class="cyber-button-primary bg-gradient-to-r from-purple-600 to-blue-600 w-full">
                            <span>Pay Now</span>
                            <i></i>
                        </button>
                        
                        <div id="payment-status" class="mt-6 w-full hidden"></div>
                        
                        <!-- Hidden fields for the payment data -->
                        <input type="hidden" id="team_id" value="<?php echo htmlspecialchars($team_id); ?>">
                        <input type="hidden" id="registration_code" value="<?php echo htmlspecialchars($team_info['registration_code']); ?>">
                        <input type="hidden" id="team_name" value="<?php echo htmlspecialchars($team_info['team_name']); ?>">
                        <input type="hidden" id="leader_name" value="<?php echo htmlspecialchars($team_info['full_name']); ?>">
                        <input type="hidden" id="leader_email" value="<?php echo htmlspecialchars($team_info['email']); ?>">
                        <input type="hidden" id="leader_phone" value="<?php echo htmlspecialchars($team_info['phone']); ?>">
                        <input type="hidden" id="amount" value="<?php echo 500 * intval($team_info['team_size']); ?>">
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
// Include terminal
require_once('components/terminal.php');

// Include footer
require_once('components/footer.php');
?>