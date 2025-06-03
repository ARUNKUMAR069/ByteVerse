document.addEventListener("DOMContentLoaded", function() {
    const paymentForm = document.getElementById("payment-form");
    const teamSizeSelect = document.getElementById("team_size");
    const displayTeamSize = document.getElementById("display-team-size");
    const totalAmount = document.getElementById("total-amount");
    const paymentButton = document.getElementById('razorpay-payment-button');
    
    // Check if team ID is stored in localStorage
    const storedTeamId = localStorage.getItem('team_id');
    if (storedTeamId) {
        document.getElementById('team_id').value = storedTeamId;
    }
    
    // Calculate and update total amount when team size changes
    if (teamSizeSelect) {
        teamSizeSelect.addEventListener('change', function() {
            const teamSize = parseInt(this.value);
            displayTeamSize.textContent = teamSize;
            
            // Calculate total (₹500 per member)
            const total = teamSize * 500;
            totalAmount.textContent = `₹${total.toFixed(2)}`;
        });
    }
    
    if (paymentButton) {
        paymentButton.addEventListener('click', startPayment);
    }
    
    function startPayment() {
        // Get values from hidden fields
        const teamId = document.getElementById('team_id').value;
        const teamName = document.getElementById('team_name').value;
        const leaderName = document.getElementById('leader_name').value;
        const leaderEmail = document.getElementById('leader_email').value;
        const leaderPhone = document.getElementById('leader_phone').value;
        const amount = parseInt(document.getElementById('amount').value) * 100; // Convert to paise
        
        // Razorpay configuration
        const options = {
            key: 'rzp_test_K5mJncnzBlDKeY', // Replace with your actual Razorpay Key ID
            amount: amount,
            currency: 'INR',
            name: 'ByteVerse Hackathon',
            description: `Registration Fee for ${teamName}`,
            image: 'assets/images/logo.png',
            handler: function(response) {
                // Process the payment response
                completePayment(response);
            },
            prefill: {
                name: leaderName,
                email: leaderEmail,
                contact: leaderPhone
            },
            theme: {
                color: '#00D7FE'
            },
            modal: {
                ondismiss: function() {
                    // Handle when user closes the Razorpay payment window
                    showPaymentStatus('warning', 'Payment cancelled. Please try again to confirm your registration.');
                }
            }
        };
        
        try {
            const rzp = new Razorpay(options);
            rzp.open();
        } catch (error) {
            console.error('Razorpay initialization error:', error);
            showPaymentStatus('error', 'Unable to initialize payment gateway. Please try again later.');
        }
    }
    
    function completePayment(response) {
        const teamId = document.getElementById('team_id').value;
        const paymentData = new FormData();
        
        paymentData.append('team_id', teamId);
        paymentData.append('step', 5); // Step 5 is payment processing
        paymentData.append('payment_id', response.razorpay_payment_id);
        paymentData.append('payment_method', 'razorpay');
        
        // Show processing status
        showPaymentStatus('processing', 'Processing your payment...');
        
        // Send payment data to server
        fetch('backend/api/registration.php', {
            method: 'POST',
            body: paymentData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Payment successful
                showPaymentStatus('success', 'Payment successful! Your registration is now confirmed.');
                
                // Redirect to success page after a delay
                setTimeout(() => {
                    window.location.href = `payment-success.php?team_id=${teamId}&code=${document.getElementById('registration_code').value}`;
                }, 3000);
            } else {
                // Payment failed at server processing
                showPaymentStatus('error', data.message || 'Payment failed. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error processing payment:', error);
            showPaymentStatus('error', 'An error occurred while processing your payment. Please contact support.');
        });
    }
    
    function showPaymentStatus(type, message) {
        const statusDiv = document.getElementById('payment-status');
        if (!statusDiv) return;
        
        statusDiv.innerHTML = '';
        statusDiv.classList.remove('hidden');
        
        let bgColor, borderColor, textColor, icon;
        
        switch (type) {
            case 'success':
                bgColor = 'bg-green-900/50';
                borderColor = 'border-green-500/30';
                textColor = 'text-green-400';
                icon = '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                break;
            case 'error':
                bgColor = 'bg-red-900/50';
                borderColor = 'border-red-500/30';
                textColor = 'text-red-400';
                icon = '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
                break;
            case 'warning':
                bgColor = 'bg-yellow-900/50';
                borderColor = 'border-yellow-500/30';
                textColor = 'text-yellow-400';
                icon = '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>';
                break;
            case 'processing':
                bgColor = 'bg-blue-900/50';
                borderColor = 'border-blue-500/30';
                textColor = 'text-blue-400';
                icon = '<svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>';
                break;
            default:
                bgColor = 'bg-gray-900/50';
                borderColor = 'border-gray-500/30';
                textColor = 'text-gray-400';
                icon = '';
        }
        
        statusDiv.className = `${bgColor} ${textColor} p-3 rounded-lg border ${borderColor} flex items-center mt-4 mb-2`;
        statusDiv.innerHTML = `${icon}<span>${message}</span>`;
    }
});