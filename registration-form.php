<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>
<body>

<section class="section">
    <div class="container">
        <h1 class="title has-text-centered">Registration</h1>
        
  
        <div class="box" style="max-width: 500px; margin: auto;">
            <form id="registrationForm" action="register.php" method="POST" onsubmit="return validateForm()">
                
                <div class="field">
                    <label class="label">UserName</label>
                    <div class="control">
                        <input class="input" type="text" name="username" placeholder="User Name" required>
                        <span id="usernameMessage" style="color: red;"></span>
                    </div>
                </div>
                
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input class="input" name="email" type="email" placeholder="example@gmail.com" required>
                        <span id="emailMessage" style="color: red;"></span>
                    </div>
                </div>
                
                <div class="field">
                    <label class="label">First Name</label>
                    <div class="control">
                        <input class="input" type="text" name="first_name" placeholder="First Name">
                    </div>
                </div>
                
                <div class="field">
                    <label class="label">Last Name</label>
                    <div class="control">
                        <input class="input" type="text" name="last_name" placeholder="Last Name">
                    </div>
                </div>
                
                <div class="field">
                    <label class="label">Password</label>
                    <div class="control">
                        <input 
                            class="input" 
                            id="password" 
                            name="password" 
                            type="password" 
                            required 
                            placeholder="Enter your password"
                        />
                    </div>
                    <p id="password-message" style="color: red; display: none;"></p>
                </div>
                
                <div class="field">
                    <label class="label">Confirm Password</label>
                    <div class="control">
                        <input class="input" id="confirm_password" name="confirm_password" type="password" required>
                    </div>
                    <p id="confirm-message" style="color: red; display: none;">
                        Passwords do not match
                    </p>
                </div>
                <form id="registrationForm" action="register.php" method="POST" onsubmit="return validateForm()">
  
    <button type="submit" class="button is-primary is-fullwidth">Register</button>
</form>

            
           
            <?php if (isset($errors)) { ?>
                <ul style="color: red; margin-top: 10px;">
                    <?php foreach ($errors as $error) { echo "<li>$error</li>"; } ?>
                </ul>
            <?php } ?>
        </div>
      
    </div>
</section>

 <script>
        $(document).ready(function() {
           
            $('#username').on('input', function() {
                const username = $(this).val();
                if (username.length > 0) {
                    $.ajax({
                        url: 'check-duplicate.php',
                        type: 'POST',
                        data: { username: username },
                        success: function(response) {
                            if (response === 'exists') {
                                $('#usernameMessage').text('Username is already taken');
                            } else {
                                $('#usernameMessage').text('');
                            }
                        }
                    });
                } else {
                    $('#usernameMessage').text('');
                }
            });

            $('#email').on('input', function() {
                const email = $(this).val();
                if (email.length > 0) {
                    $.ajax({
                        url: 'check-duplicate.php',
                        type: 'POST',
                        data: { email: email },
                        success: function(response) {
                            if (response === 'exists') {
                                $('#emailMessage').text('Email is already registered');
                            } else {
                                $('#emailMessage').text('');
                            }
                        }
                    });
                } else {
                    $('#emailMessage').text('');
                }
            });

           
            $('#registrationForm').on('submit', function(event) {
                if ($('#usernameMessage').text() !== '' || $('#emailMessage').text() !== '') {
                    event.preventDefault();
                    alert("Please resolve the issues in the form before submitting.");
                }
            });
        });
    </script>
</body>
</html>
