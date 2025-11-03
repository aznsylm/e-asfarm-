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
