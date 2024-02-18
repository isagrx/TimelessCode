document.addEventListener('DOMContentLoaded', function() {
    const signupForm = document.querySelector('.reg form');
    const loginForm = document.querySelector('.login form');

    signupForm.addEventListener('submit', function(event) {
        const name = this.elements['txt'].value.trim();
        const email = this.elements['email'].value.trim();
        const password = this.elements['pswd'].value.trim();

        // Per inpute te zbrazta
        if (name === '' || email === '' || password === '') {
            alert('Please fill in all fields');
            return;
        }

        // Validim i email
        if (!validateEmail(email)) {
            alert('Please enter a valid email address');
            return;
        }

        // Password strength validation (at least 8 characters including one uppercase, one lowercase, one number, and one special character)
        if (!validatePassword(password)) {
            alert('Please enter a password with at least 8 characters including one uppercase letter, one lowercase letter, one number, and one special character');
            return;
        }

        // Nese krejt kalojn mund te behet submit ne server
    });

    loginForm.addEventListener('submit', function(event) {
        
        const email = this.elements['emaill'].value.trim();
        const password = this.elements['pswdd'].value.trim();

        if (email === '' || password === '') {
            alert('Please fill in all fields');
            return;
        }

        if (!validateEmail(email)) {
            alert('Please enter a valid email address');
            return;
        }

    });

    function validateEmail(email) {
        // Per ta validuar email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function validatePassword(password) {
        // Kerkon nje shkronje te madhe dhe vogel, nje numer dhe 8 shkronja
        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        return passwordRegex.test(password);
    }
});
