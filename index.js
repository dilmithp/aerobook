// index.js

document.addEventListener("DOMContentLoaded", () => {
    // Smooth Scrolling for Navigation Links
    const navLinks = document.querySelectorAll("a[href^='#']");
    navLinks.forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const target = document.querySelector(link.getAttribute("href"));
            if (target) {
                target.scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });
            }
        });
    });

    // Flight Search Button Interaction
    const searchBtn = document.getElementById("search-btn");
    if (searchBtn) {
        searchBtn.addEventListener("click", (e) => {
            alert("Redirecting to the flight search page! Happy travels!");
        });
    }

    // Learn More Button Smooth Scroll
    const learnMoreBtn = document.getElementById("learn-more-btn");
    if (learnMoreBtn) {
        learnMoreBtn.addEventListener("click", (e) => {
            e.preventDefault();
            document.querySelector("#about").scrollIntoView({
                behavior: "smooth",
                block: "start"
            });
        });
    }

    // Featured Section Click Handlers
    const featuredItems = document.querySelectorAll(".featured-item");
    featuredItems.forEach(item => {
        item.addEventListener("click", () => {
            const destination = item.id;
            alert(`Looking for flights to ${destination.charAt(0).toUpperCase() + destination.slice(1)}? Check our offers!`);
        });
    });

    // Promotional Section Highlight on Hover
    const promoItems = document.querySelectorAll(".promo-item");
    promoItems.forEach(item => {
        item.addEventListener("mouseover", () => {
            item.style.transform = "scale(1.05)";
            item.style.boxShadow = "0 8px 16px rgba(0,0,0,0.3)";
        });

        item.addEventListener("mouseout", () => {
            item.style.transform = "scale(1)";
            item.style.boxShadow = "none";
        });
    });
});
