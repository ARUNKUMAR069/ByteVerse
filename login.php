<?php
// Page-specific variables
$pageTitle = 'Mentor Login | ByteVerse 1.0';
$loaderPrefix = 'ByteVerse Portal';
$loaderText = 'Initializing login portal...';
$currentPage = 'login';

// Include header
require_once('components/header.php');
?>
<!-- Add the login CSS after header -->
<link rel="stylesheet" href="assets/css/login.css">
<?php
// Include navbar
require_once('components/navbar.php');
?>

<!-- Login Hero Section -->
<section class="min-h-[40vh] relative overflow-hidden flex items-center justify-center pt-24">
    <div class="container mx-auto px-4 py-16 relative z-10 text-center">
        <h1 class="glitch-text text-4xl md:text-6xl mb-6" data-text="Mentor Login">Mentor Login</h1>
        <div class="max-w-3xl mx-auto">
            <p class="text-lg md:text-xl mb-10 text-gray-300 leading-relaxed">
                Access the ByteVerse mentor portal to manage your sessions and connect with participants.
            </p>
        </div>
    </div>
</section>

<!-- Login Content Section -->
<section class="py-12 relative">
    <div class="container mx-auto px-4">
        <div class="circuit-dots"></div>
        <div class="max-w-md mx-auto">
            <!-- Login Form -->
            <div class="bg-opacity-10 backdrop-blur-md bg-gray-800 border border-cyan-900/30 rounded-lg p-8">
                <div id="login-error" class="mb-6 p-4 bg-red-900/20 border border-red-500/30 rounded-lg text-red-400 text-center hidden">
                    <p>Invalid email or password. Please try again.</p>
                </div>
                <form id="login-form" class="space-y-6">
                    <div class="form-group">
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="input-wrapper">
                            <input type="email" id="email" name="email" placeholder="Email Address" required class="form-control">
                            <label for="email">Email Address</label>
                            <div class="input-line"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password" placeholder="Password" required class="form-control">
                            <label for="password">Password</label>
                            <div class="input-line"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="checkbox-item">
                            <input type="checkbox" class="checkbox-control" id="remember" name="remember">
                            <label class="checkbox-label" for="remember">Remember me</label>
                        </div>
                        <a href="#" class="text-cyan-400 hover:underline text-sm">Forgot Password?</a>
                    </div>
                    
                    <button type="submit" class="cyber-button primary w-full">
                        <span>Login</span>
                        <i></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Firebase SDK -->
<script src="https://www.gstatic.com/firebasejs/11.6.1/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/11.6.1/firebase-auth-compat.js"></script>

<!-- Firebase Config -->
<script src="firebase-config.js"></script>

<!-- Login Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    const loginError = document.getElementById('login-error');
    
    // Check if user is already logged in
    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
            // Check if this is admin email
            if (user.email === 'singhkashish364@gmail.com') {
                window.location.href = 'admin.php';
            } else {
                // For all other users, go to mentor dashboard
                window.location.href = 'mentor.php';
            }
        }
    });
    
    // Login form submission
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        
        // Show loading state
        const submitBtn = loginForm.querySelector('button[type="submit"]');
        const originalContent = submitBtn.innerHTML;
        submitBtn.innerHTML = `
            <div class="loader-dots">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
            <span style="margin-left: 8px;">Authenticating...</span>
        `;
        submitBtn.disabled = true;
        
        // Sign in with email and password
        firebase.auth().signInWithEmailAndPassword(email, password)
            .then((userCredential) => {
                // Check if this is admin email
                if (email === 'singhkashish364@gmail.com') {
                    window.location.href = 'admin.php';
                } else {
                    // For all other users, go to mentor dashboard
                    window.location.href = 'mentor.php';
                }
            })
            .catch((error) => {
                // Handle errors
                console.error("Login error:", error.code, error.message);
                loginError.classList.remove('hidden');
                
                // Reset button
                submitBtn.innerHTML = originalContent;
                submitBtn.disabled = false;
            });
    });
});
</script>

<?php 
// Include terminal
require_once('components/terminal.php');

// Include footer
require_once('components/footer.php');
?>