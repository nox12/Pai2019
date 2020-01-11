<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Business</title>
    <link rel="Stylesheet" href="Style/parkingsstyle.css">
    <link rel="Stylesheet" href="Style/businessstyle.css">
</head>
<body>
    <div class="menu">
        <button class="menubutton" id="parkings" style="border: 2px solid #8A8A8A" onClick="location.href='?page=parkings'">PARKINGS</button>
        <button class="menubutton" id="employees" style="border: 2px solid #8A8A8A" onClick="location.href='?page=employees'">EMPLOYEES</button>
        <button class="menubutton" id="business" style="border: 2px solid #CCCCCC" onClick="location.href='?page=business'">BUSINESS</button>
        <button class="menubutton" id="profile" style="border: 2px solid #8A8A8A"><img src="Style/img/profile.svg">
            <div id="dropdown">
            <a href="#">Settings</a>
            <a onClick="location.href='?page=logout'">Log Out</a>
            </div>
        </button>
    </div>
    <div class="container">
        <div class="opcje">
            <button class="opcjeButton" style="border: 2px solid #8D8D8D" onClick="earn()">Earnings</button>
            <button class="opcjeButton" style="border: 2px solid #8D8D8D" onClick="park()">Parkings</button>
        </div>
        <div class="dane">
            <img id="stonks" src="Style/img/stonks.png" alt="" style="width:30em; margin-left:18em; margin-top:10em;">
            <table id="table" style="display:none; margin-left:25em; margin-top:5em;">
                <tr>
                    <th>No.</th>
                    <th></th>
                    <th>Name</th>
                    <th></th>
                    <th>Total Earnings</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th></th>
                    <th>Super Parking</th>
                    <th></th>
                    <th>14 356</th>
                </tr>
                <tr>
                    <th>2</th>
                    <th></th>
                    <th>Test Parking</th>
                    <th></th>
                    <th>9 865</th>
                </tr>
            </table>
        </div>
    </div>

    <script>
    function earn() {
        var a = document.getElementById("stonks");
        a.style.display="flex";
        a= document.getElementById("table");
        a.style.display="none";
    }
    function park() {
        var a = document.getElementById("stonks");
        a.style.display="none";
        a= document.getElementById("table");
        a.style.display="flex";
    }
    </script>
</body>
</html>