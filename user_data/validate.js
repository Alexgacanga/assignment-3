document.getElementById('registerForm').addEventListener('submit', function(e) {
    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    if (username.length < 3) {
        alert("Username must be at least 3 characters long.");
        e.preventDefault();
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters long.");
        e.preventDefault();
    }
});
