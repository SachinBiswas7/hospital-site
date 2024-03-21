function handleLogin() {
    var emailValue = document.getElementById('email').value;
    var passwordValue = document.getElementById('password').value;

    // Add your login logic here (e.g., authentication, redirection, etc.)

    // Optional: You can clear the input fields after handling the login
    document.getElementById('email').value = '';
    document.getElementById('password').value = '';

    // Prevent the form from submitting in the traditional way
    return false;
}
