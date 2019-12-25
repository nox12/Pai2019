<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SignUp</title>
    <link rel="Stylesheet" href="Style/style.css">
    <link rel="Stylesheet" href="Style/signstyle.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="Style/img/iconcar_park.svg" alt="logo"> 
            <text id="napis" ><strong>parknet</strong></text>
        </div>
        <form action="?page=signup" method="POST" id="signupform"> </form>
            <div class="input" id="leftin">
            <div class="messages">
                    <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
            </div>
                <p>E-mail*</p>
                <input class="field" id="email" name="email" type="email" required form="signupform">
                <p>Password*</p>
                <input class="field" id="password" name="password" type="password" required form="signupform">
                <p>First Name*</p>
                <input class="field" id="name" name="name" type="text" required form="signupform">
                <p>Company Name</p>
                <input class="field" id="company" name="company" type="text" form="signupform">
                <p>City*</p>
                <input class="field" id="city" name="city" type="text" required form="signupform">
                <p>Product Key*</p>
                <input class="field" id="key" name="key" type="text" required form="signupform">
                <button class="field" id="signup" type="submit" form="signupform"><text style="color:#ffffff; font:Bold 20px/10px Arial">Sign Up</text></button>
            </div>
            <div class="input" id="rightin">
                <p>Confirm Password*</p>
                <input class="field" id="confirm" name="confirmpassword" type="password" required form="signupform">
                <p>Surname*</p>
                <input class="field" id="surname" name="surname" type="text" required form="signupform">
                <p>Address*</p>
                <input class="field" id="address" name="address" type="text" required form="signupform">
                <p>Zip Code*</p>
                <input class="field" id="zipcode" name="zipcode" type="text" required form="signupform">
            </div>
    </div>
</body>
</html>