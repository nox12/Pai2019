<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parknet</title>
    <link rel="Stylesheet" href="Style/style.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="Style/img/iconcar_park.svg" alt="logo"> 
            <text id="napis" ><strong>parknet</strong></text>
        </div>
       <form action="?page=login" method="POST" id="loginform"> </form>
            <div class="input">
                <div class="messages">
                    <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <p>E-mail</p>
                <input class="field" name="email" type="email" form="loginform">
                <p>Password</p>
                <input class="field" id="password" name="password" type="password" form="loginform">
                <button class="field" id="login" type="submit" form="loginform"><text style="color:#ffffff; font:Bold 20px/10px Arial">Log In</text></button>
                <button class="field" id="signup" onClick="location.href='?page=signup'"><text style="color:#ffffff; font:Bold 20px/10px Arial">Sign Up</text></button>
            </div>
    </div>
</body>
</html>