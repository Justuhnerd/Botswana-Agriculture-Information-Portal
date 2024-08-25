document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('header nav ul');

    menuToggle.addEventListener('click', function () {
        menuToggle.classList.toggle('active');
        navMenu.classList.toggle('showing');
    });

    // Close the menu when a link is clicked
    const navLinks = document.querySelectorAll('header nav ul li a');
    navLinks.forEach(link => {
        link.addEventListener('click', function () {
            menuToggle.classList.remove('active');
            navMenu.classList.remove('showing');
        });
    });
});







document.addEventListener('DOMContentLoaded', function() {
    // HashMap-like structure to store user data
    const users = new Map(); // Declare the users map only once

    // Signup function
    document.getElementById("signupForm").addEventListener("submit", function (event) {
        event.preventDefault();

        // Collect form data
        const fullName = document.getElementById("fullName").value;
        const email = document.getElementById("email").value;
        const phone = document.getElementById("phone").value;
        const streetAddress = document.getElementById("streetAddress").value;
        const city = document.getElementById("city").value;
        const state = document.getElementById("state").value;
        const zip = document.getElementById("zip").value;
        const country = document.getElementById("country").value;
        const username = document.getElementById("signupUsername").value;
        const password = document.getElementById("signupPassword").value;

        // Validate passwords
        const confirmPassword = document.getElementById("confirmPassword").value;
        if (password !== confirmPassword) {
            alert("Passwords do not match!");
            return;
        }

        // Add user to the HashMap
        if (users.has(username)) {
            alert("Username already exists!");
        } else {
            users.set(username, {
                fullName,
                email,
                phone,
                streetAddress,
                city,
                state,
                zip,
                country,
                password, // In a real application, you'd hash the password
            });
            alert("Signup successful! Redirecting to login page...");

            // Redirect to the login page
            window.location.href = 'login.html';
        }
    });

    // Login function
    document.getElementById("loginForm").addEventListener("submit", function (event) {
        event.preventDefault();

        // Collect form data
        const username = document.getElementById("loginUsername").value;
        const password = document.getElementById("loginPassword").value;

        // Validate login credentials
        if (users.has(username) && users.get(username).password === password) {
            alert("Login successful! Redirecting to the index page...");

            // Redirect to the index page
            window.location.href = 'index.html';
        } else {
            alert("Invalid username or password!");
        }
    });
});


//
// function toggleTheme() {
//     const body = document.body;
//     const button = document.getElementById('themeToggle');
//
//     // Toggle the dark-mode class on the body element
//     body.classList.toggle('dark-mode');
//
//     // Update the button text
//     if (body.classList.contains('dark-mode')) {
//         button.textContent = 'Switch to Light Mode';
//     } else {
//         button.textContent = 'Switch to Dark Mode';
//     }
// }
