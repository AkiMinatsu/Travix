<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-image: url('Image/travitixbackground.png');
            background-size: cover;
            
        }

        form {
            text-align: center;
        }

        label {
            text-align: left;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 15px; /* Increased space between input fields */
            height: 40px; /* Adjusted height of textboxes */
        }

        input[type="submit"] {
            margin-top: 10px;
            height: 30px; /* Adjusted height of submit button */
            width: 150px;
            color: black;
        }

        .logo {
            width: 200px;
            height: auto;
            margin-bottom: 10px;
        }

        
    </style>
    <title>Login page</title>
</head>
<body>
    <form method="post" action="login_action.php">
        <img src="Image/travitixlogo.png" alt="Logo" class="logo">
        <label for="email">Email</label>
        <input type="text" name="email" id="email"><br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password"><br>
        <input type="submit" value="LOGIN"><br><br>
        Don't Have an account yet? <a href="signup.php">Sign up</a>
    </form>
</body>
</html>
