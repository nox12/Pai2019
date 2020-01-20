<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parking Info</title>
    <link rel="Stylesheet" href="Style/parkingsstyle.css">
    <link rel="Stylesheet" href="Style/parkinginfostyle.css">
    <link rel="Stylesheet" href="Style/employeesstyle.css">
</head>
<body>
    <div class="menu">
        <button class="menubutton" id="parkings" style="border: 2px solid #8A8A8A" onClick="location.href='?page=parkings'">PARKINGS</button>
        <button class="menubutton" id="employees" style="border: 2px solid #8A8A8A" onClick="location.href='?page=employees'">EMPLOYEES</button>
        <button class="menubutton" id="business" style="border: 2px solid #8A8A8A" onClick="location.href='?page=business'">BUSINESS</button>
        <button class="menubutton" id="profile" style="border: 2px solid #8A8A8A"><img src="Style/img/profile.svg">
            <div id="dropdown">
            <a onClick="location.href='?page=settings'">Settings</a>
            <a onClick="location.href='?page=logout'">Log Out</a>
            </div>
        </button>
    </div>
    
    <div class="container">
        <div class="parking">
            <div class="top">
                <div class ="nazwa">
                    <?php $name1=$user->getName()." ".$user->getSurname() ?>
                    <text id="name"><strong><?= $name1 ?></strong></text>
                </div>
            </div> 
            <text style="margin-left:1em;margin-right:1em;color:#CCCCCC"><hr></text>
            <form action="?page=settings" method="POST" id="settingsform">
                <p>E-mail*</p>
                <?php $email=$user->getEmail() ?>
                <input class="field" id="email" name="email" required type="text" value="<?= $email ?>">
                <p>Name*</p>
                <?php $name=$user->getName() ?>
                <input class="field" id="name1" name="name" required type="text" value="<?= $name ?>">
                <p>Surname*</p>
                <?php $surname=$user->getSurname() ?>
                <input class="field" id="surname" name="surname" required type="text" value="<?= $surname ?>">
                <p>Address*</p>
                <?php $address=$user->getAddress() ?>
                <input class="field" id="address" name="address" required type="text" value="<?= $address ?>">
                <p>City*</p>
                <?php $city=$user->getCity()?>
                <input class="field" id="city" name="city" required type="text" value="<?= $city ?>">
                <p>Zip Code*</p>
                <?php $zip=$user->getZip() ?>
                <input class="field" id="zip_code" name="zip_code" required type="text" value="<?= $zip ?>">
                <p>Company</p>
                <?php $company=$user->getCompany()?>
                <input class="field" id="company" name="company" required type="text" value="<?= $company ?>">
                <button class="field" id="save" type="submit"><text style="color:#ffffff; font:Bold 20px/10px Arial">Save</text></button>
            </form>
        </div>
    </div>
</body>
</html>