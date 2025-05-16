<?php
// filepath: c:\xampp\htdocs\byteverse-admin\admin\components\admin-modals.php

// Modal for confirming deletion
function renderDeleteConfirmationModal($itemName) {
    ?>
    <div id="deleteConfirmationModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('deleteConfirmationModal')">&times;</span>
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete <?php echo htmlspecialchars($itemName); ?>?</p>
            <button class="btn btn-danger" onclick="confirmDeletion()">Delete</button>
            <button class="btn btn-secondary" onclick="closeModal('deleteConfirmationModal')">Cancel</button>
        </div>
    </div>
    <?php
}

// Modal for adding a new user
function renderAddUserModal() {
    ?>
    <div id="addUserModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('addUserModal')">&times;</span>
            <h2>Add New User</h2>
            <form id="addUserForm">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="admin">Admin</option>
                    <option value="editor">Editor</option>
                    <option value="viewer">Viewer</option>
                </select>
                
                <button type="submit" class="btn btn-primary">Add User</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal('addUserModal')">Cancel</button>
            </form>
        </div>
    </div>
    <?php
}

// Modal for editing user details
function renderEditUserModal($userData) {
    ?>
    <div id="editUserModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('editUserModal')">&times;</span>
            <h2>Edit User</h2>
            <form id="editUserForm">
                <input type="hidden" id="userId" name="userId" value="<?php echo htmlspecialchars($userData['id']); ?>">
                
                <label for="editUsername">Username:</label>
                <input type="text" id="editUsername" name="username" value="<?php echo htmlspecialchars($userData['username']); ?>" required>
                
                <label for="editEmail">Email:</label>
                <input type="email" id="editEmail" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                
                <label for="editRole">Role:</label>
                <select id="editRole" name="role" required>
                    <option value="admin" <?php echo $userData['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="editor" <?php echo $userData['role'] === 'editor' ? 'selected' : ''; ?>>Editor</option>
                    <option value="viewer" <?php echo $userData['role'] === 'viewer' ? 'selected' : ''; ?>>Viewer</option>
                </select>
                
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal('editUserModal')">Cancel</button>
            </form>
        </div>
    </div>
    <?php
}
?>