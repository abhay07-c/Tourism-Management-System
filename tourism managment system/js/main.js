// Navbar toggle
document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.querySelector(".navbar-toggle");
    const navMenu = document.querySelector(".navbar-nav");

    if (toggleBtn && navMenu) {
        toggleBtn.addEventListener("click", () => {
            navMenu.classList.toggle("active");
        });
    }
});



