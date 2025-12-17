// Form Guard - Prevent data loss on navigation
let formChanged = false;
let formSubmitted = false;

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('monitoringForm');
    
    if (!form) return;
    
    // Track form changes
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('change', function() {
            formChanged = true;
        });
        input.addEventListener('input', function() {
            formChanged = true;
        });
    });
    
    // Mark as submitted when form is submitted
    form.addEventListener('submit', function() {
        formSubmitted = true;
    });
    
    // Browser native warning (for external navigation, refresh, close tab)
    window.addEventListener('beforeunload', function(e) {
        if (formChanged && !formSubmitted) {
            e.preventDefault();
            e.returnValue = 'Data yang sudah diisi akan hilang. Yakin ingin meninggalkan halaman ini?';
            return e.returnValue;
        }
    });
    
    // Custom confirmation for internal links
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        
        if (!link) return;
        if (!formChanged || formSubmitted) return;
        
        // Skip if it's a # link or javascript:void
        const href = link.getAttribute('href');
        if (!href || href === '#' || href.startsWith('javascript:')) return;
        
        // Show confirmation
        e.preventDefault();
        
        if (confirm('Data yang sudah diisi akan hilang. Yakin ingin meninggalkan halaman ini?')) {
            formSubmitted = true; // Prevent double confirmation
            window.location.href = href;
        }
    });
});
