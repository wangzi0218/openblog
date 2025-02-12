document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const headerDrawer = document.getElementById('header-drawer');

    if (mobileMenuButton && headerDrawer) {
        mobileMenuButton.addEventListener('click', function() {
            // Toggle the translate-x-96 class
            headerDrawer.classList.toggle('translate-x-96');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInside = headerDrawer.contains(event.target) || 
                                mobileMenuButton.contains(event.target);

            if (!isClickInside && !headerDrawer.classList.contains('translate-x-96')) {
                headerDrawer.classList.add('translate-x-96');
            }
        });
    }
});
