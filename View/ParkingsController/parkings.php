<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parkings</title>
    <link rel="Stylesheet" href="Style/parkingsstyle.css">
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
        <button id="addnew" style="border: 2px solid #8F8F8F" onClick="location.href='?page=newParking'">Add New</button>
        <div class="list" id="list">
        <?php foreach($parkings as $parking): ?>
            <div class="parking">
                <form action="?page=deleteParking" method="POST" id="deleteParkingform">
                <input id="id_parking2" name="id_parking" type="hidden" value=<?= $parking->getId() ?>>
                <button id="delete" style="border: 2px solid #5E5E5E; color:white">Delete</button>
                </form>
                <div class ="nazwa">
                    <text id="name"><strong><?= $parking->getName() ?></strong></text>
                    <text id="address"><?= $parking->getAddress().", ".$parking->getCity() ?></text>
                </div>
                <div class="opis">
                    <text-field id="description"><?= $parking->getDescription() ?></text-field>
                </div>
                <form action="?page=newParking" method="POST" id="newParkingform">
                <input id="id_parking" name="id_parking" type="hidden" value=<?= $parking->getId() ?>>
                <button id="next" type="submit" style="border: 2px solid #8F8F8F"><img src="Style/img/arrow.svg"></button>
                </form>
            </div>
        <?php endforeach ?>
        </div>
        <div class="searchdiv">
            <input class="searchinput" id="input">
            <button class="search" onClick="searchF()"><img src="Style/img/Search.svg"></button>
        </div>
    </div>

    <script>
    function searchF() {
        var input, filter, list,p,i,a,txtValue;
        input = document.getElementById("input");
        filter = input.value.toUpperCase();
        list = document.getElementById("list");
        p = list.getElementsByClassName("parking");
        for (i = 0; i < p.length; i++) {
            a= p[i];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                p[i].style.display = "flex";
            } else {
                p[i].style.display = "none";
            }
        }
    }
    </script>
</body>
</html>