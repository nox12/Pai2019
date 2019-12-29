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
        <button class="menubutton" id="employees" style="border: 2px solid #CCCCCC" onClick="location.href='?page=employees'">EMPLOYEES</button>
        <button class="menubutton" id="business" style="border: 2px solid #8A8A8A" onClick="location.href='?page=business'">BUSINESS</button>
        <button class="menubutton" id="profile" style="border: 2px solid #8A8A8A"><img src="Style/img/profile.svg">
            <div id="dropdown">
            <a href="#">Settings</a>
            <a onClick="location.href='?page=logout'">Log Out</a>
            </div>
        </button>
    </div>
    
    <div class="container">
        <div class="parking">
            <div class="top">
                <div class ="nazwa">
                    <?php $employee !== NULL ? $name1=$employee->getName()." ".$employee->getSurname() : $name1 ="New Employee" ?>
                    <text id="name"><strong><?= $name1 ?></strong></text>
                </div>
            </div> 
            <text style="margin-left:1em;margin-right:1em;color:#CCCCCC"><hr></text>
            <form action="?page=employeeinfo" method="POST" id="employeeform">
                <p>E-mail*</p>
                <?php $employee !== NULL ? $email=$employee->getEmail() : $email =NULL ?>
                <input class="field" id="email" name="email" required type="text" value="<?= $email ?>">
                <p><?=($employee === NULL || $employee ==="") ? 'Password*':''?></p>
                <input class="field" id="password" name="password" required type="<?=($employee === NULL || $employee ==="") ? 'password':'hidden'?>">
                <p><?=($employee === NULL || $employee ==="") ? 'Confirm Password*':''?></p>
                <input class="field" id="confirm" name="confirm" required type="<?=($employee === NULL || $employee ==="") ? 'password':'hidden'?>">
                <p>Name*</p>
                <?php $employee !== NULL ? $name=$employee->getName() : $name =NULL ?>
                <input class="field" id="name1" name="name" required type="text" value="<?= $name ?>">
                <p>Surname*</p>
                <?php $employee !== NULL ? $surname=$employee->getSurname() : $surname =NULL ?>
                <input class="field" id="surname" name="surname" required type="text" value="<?= $surname ?>">
                <p>Address*</p>
                <?php $employee !== NULL ? $address=$employee->getAddress() : $address =NULL ?>
                <input class="field" id="address" name="address" required type="text" value="<?= $address ?>">
                <p>City*</p>
                <?php $employee !== NULL ? $city=$employee->getCity() : $city =NULL ?>
                <input class="field" id="city" name="city" required type="text" value="<?= $city ?>">
                <p>Zip Code*</p>
                <?php $employee !== NULL ? $zip=$employee->getZip() : $zip =NULL ?>
                <input class="field" id="zip_code" name="zip_code" required type="text" value="<?= $zip ?>">
                <p>Position*</p>
                <?php $employee !== NULL ? $position=$employee->getPosition() : $position =NULL ?>
                <input class="field" id="position" name="position" required type="text" value="<?= $position ?>">
                <p>Description</p>
                <?php $employee !== NULL ? $des=$employee->getDescription() : $des =NULL ?>
                <textarea class="field" id="description" name="description" maxlength="60"><?= $des ?></textarea>
                <?php $employee !== NULL ? $id=$employee->getId() : $id =NULL ?>
                <input id="id_employee" name="id_employee" type="hidden" value=<?= $id ?>>
                <button class="field" id="save" type="submit"><text style="color:#ffffff; font:Bold 20px/10px Arial">Save</text></button>
            </form>
        </div>
    </div>
</body>
</html>