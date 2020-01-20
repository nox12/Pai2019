<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parking Info</title>
    <link rel="Stylesheet" href="Style/parkingsstyle.css">
    <link rel="Stylesheet" href="Style/parkinginfostyle.css">
    <link rel="Stylesheet" href="Style/bookingstyle.css">
</head>
<body>
    <div class="menu">
        <button class="menubutton" id="parkings" style="border: 2px solid #CCCCCC" onClick="location.href='?page=parkings'">PARKINGS</button>
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
                    <?php $parking !== NULL ? $name1=$parking->getName() : $name1 ="New Parking" ?>
                    <text id="name"><strong><?= $name1 ?></strong></text>
                    <?php $parking !== NULL ? $address1=$parking->getAddress().", ".$parking->getCity() : $address1 ="Address" ?>
                    <text id="address"><?= $address1 ?></text>
                </div>
                <div class="przyciski">
                    <form action="?page=newParking" method="POST" id="newParkingform">
                        <input id="id_parking" name="id_parking" type="hidden" value=<?= $parking->getId() ?>>
                        <button id="info" type="submit" style="border: 2px solid #CCCCCC; border-radius: 4px">info</button>
                    </form>
                    <form action="?page=booking" method="POST" id="bookingform">
                        <?php $parking !== NULL ? $id=$parking->getId() : $id =NULL ?>
                        <input id="id_parking" name="id_parking" type="hidden" value=<?= $id ?>>
                        <button id="booking" type="submit" style="<?=($id === NULL || $id ==="") ? "border: 2px solid #CCCCCC; border-radius: 4px;display:none" : "border: 2px solid #CCCCCC; border-radius: 4px;" ?>">booking</button>
                    </form>
                </div>
            </div> 
            <text style="margin-left:1em;margin-right:1em;color:#CCCCCC"><hr></text>
            <form action="?page=showBooking" method="POST" id="showBookingform"></form>
            <div class="menusub">
                <div class="select_booking">
                    <select class="field" id="selectSub" name ="selectSub" form="showBookingform" onchange="showBookingform.submit()">
                        <option value="">Select Subscription</option>
                        <?php foreach($subscription as $subsc): ?>
                            <option value=<?= $subsc->getID()?>><?=$subsc->getName()?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <form action="?page=newBooking" method="POST" id="newBookingform">
                    <?php $parking !== NULL ? $id=$parking->getId() : $id =NULL ?>
                    <input id="id_sub" name="id_sub" type="hidden" value=<?=NULL ?>>
                    <input id="id_parking" name="id_parking" type="hidden" value=<?= $id ?>>
                    <button class="field" id="new" type="submit"><text style="color:#ffffff;">Add New</text></button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>