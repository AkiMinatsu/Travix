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
            background-image: url('travitixbackground.png');
            background-size: cover;
        }

        form {
            text-align: center;
        }

        h2 {
            margin-bottom: 20px; /* Add some space below the heading */
        }

        label {
            text-align: left;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 15px;
            height: 40px;
        }

        input[type="submit"] {
            margin-top: 10px;
            height: 30px; 
            width: 150px;
        }
        
    </style>
    <title>Sign up page</title>
</head>
<body>
    <form method="post" action="signup_action.php">
        <h2>SIGN UP FORM</h2><br>
        <label for="name">Full name</label>
        <input type="text" name="name" id="name"><br>
        <label for="email">Email</label>
        <input type="text" name="email" id="email"><br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password"><br>
        <input type="submit" value="SIGN UP"><br><br>
        Already have an account? <a href="login.php">Login</a>
    </form>
</body>
</html>
