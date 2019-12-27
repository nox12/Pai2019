<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parking Info</title>
    <link rel="Stylesheet" href="Style/parkingsstyle.css">
    <link rel="Stylesheet" href="Style/parkinginfostyle.css">
</head>
<body>
    <div class="menu">
        <button class="menubutton" id="parkings" style="border: 2px solid #CCCCCC" onClick="location.href='?page=parkings'">PARKINGS</button>
        <button class="menubutton" id="employees" style="border: 2px solid #8A8A8A" onClick="location.href='?page=employees'">EMPLOYEES</button>
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
                    <?php $parking !== NULL ? $name1=$parking->getName() : $name1 ="New Parking" ?>
                    <text id="name"><strong><?= $name1 ?></strong></text>
                    <?php $parking !== NULL ? $address1=$parking->getAddress().", ".$parking->getCity() : $address1 ="Address" ?>
                    <text id="address"><?= $address1 ?></text>
                </div>
                <div class="przyciski">
                    <button id="info" style="border: 2px solid #CCCCCC; border-radius: 4px">info</button>
                    <button id="booking" style="border: 2px solid #CCCCCC; border-radius: 4px">booking</button>
                </div>
            </div> 
            <text style="margin-left:1em;margin-right:1em;color:#CCCCCC"><hr></text>
            <form action="?page=parkinginfo" method="POST" id="parkingform">
                <p>Name*</p>
                <?php $parking !== NULL ? $name=$parking->getName() : $name =NULL ?>
                <input class="field" id="name1" name="name" required type="text" value="<?= $name ?>">
                <p>Tags</p>
                <?php $parking !== NULL ? $tags=$parking->getTags() : $tags =NULL ?>
                <input class="field" id="tags" name="tags" type="text" value="<?= $tags ?>">
                <div class="manyfields">
                    <div class="smallfield">
                        <p>Spaces*</p>
                        <?php $parking !== NULL ? $spaces=$parking->getSpaces() : $spaces =NULL ?>
                        <input class="field" id="spaces" name="spaces" required type="text" value="<?= $spaces ?>">
                    </div>
                    <div class="smallfield">
                        <p>Hours*</p>
                        <?php $parking !== NULL ? $hours=$parking->getHours() : $hours =NULL ?>
                        <input class="field" id="hours" name="hours" required type="text" value="<?= $hours ?>">
                    </div>
                    <div class="smallfield">
                        <p>Price(per hour)*</p>
                        <?php $parking !== NULL ? $price=$parking->getPrice() : $price =NULL ?>
                        <input class="field" id="price" name="price" required type="text" value="<?= $price ?>">
                    </div>
                </div>
                <p>Address*</p>
                <?php $parking !== NULL ? $address=$parking->getAddress() : $address =NULL ?>
                <input class="field" id="address" name="address" required type="text" value="<?= $address ?>">
                <p>City*</p>
                <?php $parking !== NULL ? $city=$parking->getCity() : $city =NULL ?>
                <input class="field" id="city" name="city" required type="text" value="<?= $city ?>">
                <p>Description*</p>
                <?php $parking !== NULL ? $des=$parking->getDescription() : $des =NULL ?>
                <textarea class="field" id="description" name="description" maxlength="60"><?= $des ?></textarea>
                <?php $parking !== NULL ? $id=$parking->getId() : $id =NULL ?>
                <input id="id_parking" name="id_parking" type="hidden" value=<?= $id ?>>
                <button class="field" id="save" type="submit"><text style="color:#ffffff; font:Bold 20px/10px Arial">Save</text></button>
            </form>
        </div>
    </div>
</body>
</html>