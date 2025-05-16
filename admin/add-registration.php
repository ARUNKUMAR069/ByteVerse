<?php
ob_start();
require_once 'includes/header.php';

// Check if form was submitted
$success = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $team_name = $_POST['team_name'] ?? '';
    $team_size = $_POST['team_size'] ?? '';
    $institution = $_POST['institution'] ?? '';
    $challenge_track = $_POST['challenge_track'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $role = $_POST['role'] ?? '';
    $project_title = $_POST['project_title'] ?? '';
    $project_description = $_POST['project_description'] ?? '';
    $technologies = isset($_POST['technologies']) ? json_encode($_POST['technologies']) : '[]';
    $status = $_POST['status'] ?? 'pending';
    
    // Basic validation
    if (empty($team_name)) {
        $errors[] = 'Team name is required';
    }
    if (empty($team_size)) {
        $errors[] = 'Team size is required';
    }
    if (empty($institution)) {
        $errors[] = 'Institution is required';
    }
    if (empty($name)) {
        $errors[] = 'Team leader name is required';
    }
    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is not valid';
    }
    if (empty($phone)) {
        $errors[] = 'Phone number is required';
    }
    
    // If no errors, save to database
    if (empty($errors)) {
        $sql = "INSERT INTO registrations (team_name, team_size, institution, challenge_track, name, email, 
                phone, role, project_title, project_description, technologies, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sissssssssss', $team_name, $team_size, $institution, $challenge_track, 
                         $name, $email, $phone, $role, $project_title, $project_description, 
                         $technologies, $status);
        
        if ($stmt->execute()) {
            $registration_id = $conn->insert_id;
            
            // Log the action
            $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                           VALUES (?, 'create_registration', ?, ?)";
            $activity_stmt = $conn->prepare($activity_sql);
            $description = "Added new registration: $team_name (ID: $registration_id)";
            $ip = $_SERVER['REMOTE_ADDR'];
            $activity_stmt->bind_param("iss", $_SESSION['admin_id'], $description, $ip);
            $activity_stmt->execute();
            
            $success = true;
        } else {
            $errors[] = 'Error adding registration: ' . $stmt->error;
        }
    }
}
?>

<div class="content">
    <div class="card-header">
        <h2><i class="fas fa-plus-circle"></i> Add New Registration</h2>
    </div>
    
    <div class="content-card">
        <?php if ($success): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <div>
                    <p>Registration added successfully!</p>
                    <p>
                        <a href="registrations.php" class="alert-link">View all registrations</a> or 
                        <a href="add-registration.php" class="alert-link">add another</a>
                    </p>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <p><strong>Please fix the following errors:</strong></p>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        
        <form method="post" class="form-card">
            <div class="form-section">
                <h3 class="section-title">Team Information</h3>
                
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="team_name" class="input-label field-required">Team Name</label>
                        <input type="text" class="cyber-input" id="team_name" name="team_name" value="<?php echo isset($_POST['team_name']) ? htmlspecialchars($_POST['team_name']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="team_size" class="input-label field-required">Team Size</label>
                        <select class="cyber-input" id="team_size" name="team_size">
                            <option value="">Select team size</option>
                            <option value="3" <?php echo isset($_POST['team_size']) && $_POST['team_size'] == '3' ? 'selected' : ''; ?>>3 Members</option>
                            <option value="4" <?php echo isset($_POST['team_size']) && $_POST['team_size'] == '4' ? 'selected' : ''; ?>>4 Members</option>
                            <option value="5" <?php echo isset($_POST['team_size']) && $_POST['team_size'] == '5' ? 'selected' : ''; ?>>5 Members</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="institution" class="input-label field-required">Institution</label>
                        <input type="text" class="cyber-input" id="institution" name="institution" value="<?php echo isset($_POST['institution']) ? htmlspecialchars($_POST['institution']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="challenge_track" class="input-label field-required">Challenge Track</label>
                        <select class="cyber-input" id="challenge_track" name="challenge_track">
                            <option value="">Select challenge track</option>
                            <option value="ai_ml" <?php echo isset($_POST['challenge_track']) && $_POST['challenge_track'] == 'ai_ml' ? 'selected' : ''; ?>>AI/ML Solutions</option>
                            <option value="blockchain" <?php echo isset($_POST['challenge_track']) && $_POST['challenge_track'] == 'blockchain' ? 'selected' : ''; ?>>Blockchain Innovation</option>
                            <option value="ar_vr" <?php echo isset($_POST['challenge_track']) && $_POST['challenge_track'] == 'ar_vr' ? 'selected' : ''; ?>>AR/VR Experiences</option>
                            <option value="iot" <?php echo isset($_POST['challenge_track']) && $_POST['challenge_track'] == 'iot' ? 'selected' : ''; ?>>IoT & Hardware</option>
                            <option value="open_innovation" <?php echo isset($_POST['challenge_track']) && $_POST['challenge_track'] == 'open_innovation' ? 'selected' : ''; ?>>Open Innovation</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="form-section">
                <h3 class="section-title">Team Leader Information</h3>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name" class="input-label field-required">Full Name</label>
                        <input type="text" class="cyber-input" id="name" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="input-label field-required">Email</label>
                        <input type="email" class="cyber-input" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="phone" class="input-label field-required">Phone</label>
                        <input type="text" class="cyber-input" id="phone" name="phone" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="role" class="input-label field-required">Role</label>
                        <select class="cyber-input" id="role" name="role">
                            <option value="">Select role</option>
                            <option value="fullstack" <?php echo isset($_POST['role']) && $_POST['role'] == 'fullstack' ? 'selected' : ''; ?>>Full Stack Developer</option>
                            <option value="frontend" <?php echo isset($_POST['role']) && $_POST['role'] == 'frontend' ? 'selected' : ''; ?>>Frontend Developer</option>
                            <option value="backend" <?php echo isset($_POST['role']) && $_POST['role'] == 'backend' ? 'selected' : ''; ?>>Backend Developer</option>
                            <option value="ui_ux" <?php echo isset($_POST['role']) && $_POST['role'] == 'ui_ux' ? 'selected' : ''; ?>>UI/UX Designer</option>
                            <option value="ml_engineer" <?php echo isset($_POST['role']) && $_POST['role'] == 'ml_engineer' ? 'selected' : ''; ?>>ML Engineer</option>
                            <option value="project_manager" <?php echo isset($_POST['role']) && $_POST['role'] == 'project_manager' ? 'selected' : ''; ?>>Project Manager</option>
                            <option value="other" <?php echo isset($_POST['role']) && $_POST['role'] == 'other' ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="form-section">
                <h3 class="section-title">Project Details</h3>
                
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="project_title" class="input-label">Project Title</label>
                        <input type="text" class="cyber-input" id="project_title" name="project_title" value="<?php echo isset($_POST['project_title']) ? htmlspecialchars($_POST['project_title']) : ''; ?>">
                        <span class="form-help">Can be updated later</span>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="project_description" class="input-label">Project Description</label>
                        <textarea class="cyber-input" id="project_description" name="project_description" rows="4"><?php echo isset($_POST['project_description']) ? htmlspecialchars($_POST['project_description']) : ''; ?></textarea>
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="input-label">Technologies</label>
                        <div class="checkbox-grid">
                            <div class="checkbox-item">
                                <input type="checkbox" class="checkbox-control" id="tech_react" name="technologies[]" value="react">
                                <label for="tech_react" class="checkbox-label">React</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" class="checkbox-control" id="tech_node" name="technologies[]" value="node">
                                <label for="tech_node" class="checkbox-label">Node.js</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" class="checkbox-control" id="tech_python" name="technologies[]" value="python">
                                <label for="tech_python" class="checkbox-label">Python</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" class="checkbox-control" id="tech_ai_ml" name="technologies[]" value="ai_ml">
                                <label for="tech_ai_ml" class="checkbox-label">AI/ML</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" class="checkbox-control" id="tech_blockchain" name="technologies[]" value="blockchain">
                                <label for="tech_blockchain" class="checkbox-label">Blockchain</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" class="checkbox-control" id="tech_ar_vr" name="technologies[]" value="ar_vr">
                                <label for="tech_ar_vr" class="checkbox-label">AR/VR</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" class="checkbox-control" id="tech_other" name="technologies[]" value="other">
                                <label for="tech_other" class="checkbox-label">Other</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="status" class="input-label">Status</label>
                        <select class="cyber-input" id="status" name="status">
                            <option value="pending" <?php echo isset($_POST['status']) && $_POST['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="active" <?php echo isset($_POST['status']) && $_POST['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                            <option value="rejected" <?php echo isset($_POST['status']) && $_POST['status'] == 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <a href="registrations.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Add Registration
                </button>
            </div>
        </form>
    </div>
</div>

<?php 
require_once 'includes/footer.php';
ob_end_flush();
?>
