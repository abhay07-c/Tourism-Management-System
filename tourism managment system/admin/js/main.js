
        document.addEventListener('DOMContentLoaded', function() {

            // Toggle Sidebar
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
            });

            // Toggle Dropdown Menu
            const userProfile = document.getElementById('userProfile');
            const dropdownMenu = document.getElementById('dropdownMenu');

            userProfile.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
            });

            // Close dropdown if clicked outside
            document.addEventListener('click', function(e) {
                if (!userProfile.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.style.display = 'none';
                }
            });

            // Toggle Submenu for Tour Packages
            const tourPackageItem = document.querySelector('.sidebar-menu li:nth-child(2) > a');
            const submenu = tourPackageItem.nextElementSibling;

            tourPackageItem.addEventListener('click', function(e) {
                e.preventDefault();
                const parentLi = this.parentElement;
                parentLi.classList.toggle('active');
            });

        });
