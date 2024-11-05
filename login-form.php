
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>
<body>
<form action="/login.php" method="GET"></form>
<section class="section">
    <div class="container">
        <h1 class="title has-text-centered">Login</h1>
        
       
        <div class="box" style="max-width: 400px; margin: auto;">
            <form id="loginForm" action="login.php" method="POST">
                
                <div class="field">
                    <label class="label">Email Address</label>
                    <div class="control">
                        <input class="input" type="email" name="email" placeholder="example@gmail.com" required>
                    </div>
                </div>
                
                <div class="field">
                    <label class="label">Password</label>
                    <div class="control">
                        <input class="input" type="password" name="password" required placeholder="Enter your password">
                    </div>
                </div>
                
               


                <form id="loginForm" action="welcome.php" method="POST" onsubmit="return validateForm()">

    <button type="submit" class="button is-primary is-fullwidth">Login</button>
            </form>
          
            <?php if (isset($errors)) { ?>
                <ul style="color: red; margin-top: 10px;">
                    <?php foreach ($errors as $error) { echo "<li>$error</li>"; } ?>
                </ul>
            <?php } ?>
        </div>

    </div>
</section>

</body>
</html>
