// Function for Tambah Admin
function tambahAdmin() {
    // Reset form completely
    $('#formPengguna')[0].reset();
    $('#penggunaId').val('');
    $('#titlePengguna').text('Tambah Admin');
    
    // Clear all inputs
    $('#usernameInput').val('');
    $('#emailInput').val('');
    $('#phone_number').val('');
    $('#password').val('');
    $('#padukuhan_id').val('');
    
    // Set role to admin for kelola-admin page
    if ($('[name="role"]').length) {
        $('[name="role"]').val('admin');
    }
    
    // Show add password field, hide edit password field
    $('#passwordFieldAdd').show();
    $('#password').attr('disabled', false).attr('required', 'required');
    
    $('#passwordFieldEdit').hide();
    $('#password_edit').attr('disabled', true).removeAttr('required').val('');
    $('#resetPasswordCheck').prop('checked', false);
    $('#passwordResetField').hide();
    
    // Clear error messages and helper texts
    $('.error-message').hide().text('');
    $('.form-control, .form-select').removeClass('is-invalid');
    $('.helper-text').hide();
    
    // Show modal
    $('#modalPengguna').modal('show');
}

// Handle tab switching from sidebar
function showTab(tabId) {
    // Remove active class from all tabs
    document.querySelectorAll('.nav-link').forEach(tab => {
        tab.classList.remove('active');
    });
    document.querySelectorAll('.tab-pane').forEach(pane => {
        pane.classList.remove('show', 'active');
    });
    
    // Activate the target tab
    const targetTab = document.getElementById(tabId + '-tab');
    const targetPane = document.getElementById(tabId);
    
    if (targetTab && targetPane) {
        targetTab.classList.add('active');
        targetPane.classList.add('show', 'active');
    }
    
    return false;
}

// Handle hash on page load
document.addEventListener('DOMContentLoaded', function() {
    const hash = window.location.hash.substring(1);
    if (hash) {
        showTab(hash);
    }
});
