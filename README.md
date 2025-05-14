
# Task 2: Login & Signup System using PHP & MySQL

This project provides a simple yet secure login and signup system that allows users to register, log in, and manage their sessions. It ensures that sensitive information, like passwords, is stored securely, and offers a smooth user experience with error handling and validation.

# Key Features:
# 1 Signup: 
Users can register with a unique username, email, and password.

# 2 Login: 
Authenticate users using their username or email and password.

# 3 Password Security:
Passwords are hashed for security using PHP's password_hash() function.

# 4 Error Handling: 
Clear error messages guide users when something goes wrong (like incorrect credentials or missing fields).

# 5 Session Management:
Keeps users logged in, allowing access to protected pages once authenticated.

# Technologies Used:
# 1 Frontend: 
HTML (for form structure) and CSS (for styling and responsiveness).

# 2 Backend: 
PHP (handles form submissions, user authentication, and session management).

# 3 Database:
MySQL (stores user data securely).

# Development Steps:

# Create MySQL Database: 
Set up a database (user_auth) with a users table to store user details.

# Signup & Login Forms: 
Easy-to-use forms with clear input fields and validation for a seamless experience.

# Handling Form Data in PHP:

1. Signup: Validates input, checks for existing usernames/emails, hashes passwords, and inserts data into the database.

2.Login: Verifies entered credentials, compares hashed passwords, and starts a user session.

# Security Measures:

1. Passwords are stored securely using password_hash().

2. Input validation to prevent SQL injection.


# Testing: 
Ensures that the signup and login functions work correctly and users can access protected pages after logging in.

# Error Handling:
The system displays helpful messages for errors like duplicate usernames, incorrect passwords, or missing information.
