<?php
ob_start();
require_once 'includes/header.php';
require_once 'includes/sponsor-crud.php';

// Initialize CRUD handler
$sponsorCrud = new SponsorCrud($conn);

// Get sponsor if editing
$sponsor = null;
$isEdit = false;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $sponsorId = intval($_GET['id']);
    $sponsor = $sponsorCrud->getById($sponsorId);
    $isEdit = true;
    
    if (!$sponsor) {
        // Sponsor not found, redirect to sponsors list
        header('Location: sponsors.php');
        exit;
    }
}

// Handle form submission
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $sponsorData = [
        'name' => $_POST['name'] ?? '',
        'company' => $_POST['company'] ?? '',
        'website' => $_POST['website'] ?? '',
        'tier' => $_POST['tier'] ?? '',
        'contribution' => $_POST['contribution'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'description' => $_POST['description'] ?? '',
        'status' => $_POST['status'] ?? 'pending'
    ];
    
    // Validate required fields
    if (empty($sponsorData['name'])) {
        $errors[] = 'Contact person name is required';
    }
    
    if (empty($sponsorData['company'])) {
        $errors[] = 'Company name is required';
    }
    
    if (empty($sponsorData['email'])) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($sponsorData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address';
    }
    
    if (empty($sponsorData['tier'])) {
        $errors[] = 'Sponsorship tier is required';
    }
    
    if (empty($sponsorData['contribution'])) {
        $errors[] = 'Contribution amount is required';
    } elseif (!is_numeric($sponsorData['contribution'])) {
        $errors[] = 'Contribution must be a number';
    }
    
    // Handle logo upload
    if (isset($_FILES['logo']) && $_FILES['logo']['name']) {
        $logoFilename = $sponsorCrud->uploadLogo($_FILES['logo'], $sponsorData['company']);
        
        if ($logoFilename) {
            $sponsorData['logo'] = $logoFilename;
        } else {
            $errors[] = 'Error uploading logo. Please check file type and size.';
        }
    } elseif ($isEdit) {
        // Keep existing logo
        $sponsorData['logo'] = $sponsor['logo'];
    }
    
    // If no errors, save sponsor
    if (empty($errors)) {
        if ($isEdit) {
            // Update existing sponsor
            $result = $sponsorCrud->update($sponsorId, $sponsorData);
            
            if ($result) {
                $success = 'Sponsor updated successfully';
            } else {
                $errors[] = 'Error updating sponsor';
            }
        } else {
            // Create new sponsor
            $newId = $sponsorCrud->create($sponsorData);
            
            if ($newId) {
                // Redirect to sponsor list
                header('Location: sponsors.php?action=view&id=' . $newId);
                exit;
            } else {
                $errors[] = 'Error creating sponsor';
            }
        }
    }
}
?>

<div class="content">
    <div class="card-header">
        <h2>
            <i class="fas fa-handshake"></i> 
            <?php echo $isEdit ? 'Edit Sponsor' : 'Add New Sponsor'; ?>
        </h2>
    </div>
    
    <div class="content-card">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <p><strong>Error:</strong> Please fix the following issues:</p>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <div>
                    <p><?php echo htmlspecialchars($success); ?></p>
                </div>
            </div>
        <?php endif; ?>
        
        <form method="POST" enctype="multipart/form-data" class="form-card">
            <div class="form-grid">
                <div class="form-section">
                    <h3 class="section-title">Company Information</h3>
                    
                    <div class="form-group">
                        <label for="company" class="input-label field-required">Company Name</label>
                        <input type="text" class="form-input" id="company" name="company" value="<?php echo $isEdit ? htmlspecialchars($sponsor['company']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="website" class="input-label">Website URL</label>
                        <input type="url" class="form-input" id="website" name="website" value="<?php echo $isEdit ? htmlspecialchars($sponsor['website']) : ''; ?>">
                        <div class="form-hint">Include https:// in the URL</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="logo" class="input-label">Company Logo</label>
                        <input type="file" class="form-input" id="logo" name="logo" accept="image/*">
                        
                        <?php if ($isEdit && !empty($sponsor['logo'])): ?>
                            <div class="current-logo mt-2">
                                <div class="form-hint">Current logo:</div>
                                <img src="../assets/images/sponsors/<?php echo htmlspecialchars($sponsor['logo']); ?>" alt="Current logo" class="max-h-16 mt-2 border border-gray-700 rounded">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="form-section">
                    <h3 class="section-title">Contact Information</h3>
                    
                    <div class="form-group">
                        <label for="name" class="input-label field-required">Contact Person</label>
                        <input type="text" class="form-input" id="name" name="name" value="<?php echo $isEdit ? htmlspecialchars($sponsor['name']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="input-label field-required">Email Address</label>
                        <input type="email" class="form-input" id="email" name="email" value="<?php echo $isEdit ? htmlspecialchars($sponsor['email']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone" class="input-label">Phone Number</label>
                        <input type="tel" class="form-input" id="phone" name="phone" value="<?php echo $isEdit ? htmlspecialchars($sponsor['phone']) : ''; ?>">
                    </div>
                </div>
                
                <div class="form-section full-width">
                    <h3 class="section-title">Sponsorship Details</h3>
                    
                    <div class="form-group-row">
                        <div class="form-group flex-1">
                            <label for="tier" class="input-label field-required">Sponsorship Tier</label>
                            <select class="form-select" id="tier" name="tier" required>
                                <option value="">Select tier</option>
                                <option value="alpha_partner" <?php echo $isEdit && $sponsor['tier'] === 'alpha_partner' ? 'selected' : ''; ?>>Alpha Partner (₹1,00,000+)</option>
                                <option value="hype_sponsor" <?php echo $isEdit && $sponsor['tier'] === 'hype_sponsor' ? 'selected' : ''; ?>>Hype Sponsor (₹50,000)</option>
                                <option value="boost_sponsor" <?php echo $isEdit && $sponsor['tier'] === 'boost_sponsor' ? 'selected' : ''; ?>>Boost Sponsor (₹30,000)</option>
                                <option value="vibe_sponsor" <?php echo $isEdit && $sponsor['tier'] === 'vibe_sponsor' ? 'selected' : ''; ?>>Vibe Sponsor (₹20,000)</option>
                                <option value="crew_sponsor" <?php echo $isEdit && $sponsor['tier'] === 'crew_sponsor' ? 'selected' : ''; ?>>Crew Sponsor (₹10,000)</option>
                                <option value="green_soul" <?php echo $isEdit && $sponsor['tier'] === 'green_soul' ? 'selected' : ''; ?>>Green Soul (₹7,000)</option>
                                <option value="mystery_drop" <?php echo $isEdit && $sponsor['tier'] === 'mystery_drop' ? 'selected' : ''; ?>>Mystery Drop Partner</option>
                            </select>
                        </div>
                        
                        <div class="form-group flex-1">
                            <label for="contribution" class="input-label field-required">Contribution Amount (₹)</label>
                            <input type="number" class="form-input" id="contribution" name="contribution" step="0.01" min="0" value="<?php echo $isEdit ? htmlspecialchars($sponsor['contribution']) : ''; ?>" required>
                        </div>
                        
                        <div class="form-group flex-1">
                            <label for="status" class="input-label field-required">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pending" <?php echo $isEdit && $sponsor['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="active" <?php echo $isEdit && $sponsor['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo $isEdit && $sponsor['status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="description" class="input-label">Additional Information</label>
                        <textarea class="form-textarea" id="description" name="description" rows="4"><?php echo $isEdit ? htmlspecialchars($sponsor['description']) : ''; ?></textarea>
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <a href="sponsors.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancel
                </a>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> <?php echo $isEdit ? 'Update Sponsor' : 'Add Sponsor'; ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?php 
require_once 'includes/footer.php';
ob_end_flush();
?>
