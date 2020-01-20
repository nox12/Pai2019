<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employees</title>
    <link rel="Stylesheet" href="Style/parkingsstyle.css">
    <link rel="Stylesheet" href="Style/employeesstyle.css">
</head>
<body>
    <div class="menu">
        <button class="menubutton" id="parkings" style="border: 2px solid #8A8A8A" onClick="location.href='?page=parkings'">PARKINGS</button>
        <button class="menubutton" id="employees" style="border: 2px solid #CCCCCC" onClick="location.href='?page=employees'">EMPLOYEES</button>
        <button class="menubutton" id="business" style="border: 2px solid #8A8A8A" onClick="location.href='?page=business'">BUSINESS</button>
        <button class="menubutton" id="profile" style="border: 2px solid #8A8A8A"><img src="Style/img/profile.svg">
            <div id="dropdown">
            <a onClick="location.href='?page=settings'">Settings</a>
            <a onClick="location.href='?page=logout'">Log Out</a>
            </div>
        </button>
    </div>
    <div class="container">
        <button id="addnew" style="border: 2px solid #8F8F8F" onClick="location.href='?page=newEmployee'">Add New</button>
        <div class="list" id="list">
            <?php foreach($employees as $emp): ?>
                <div class="employee">
                    <img src="Style/img/person.png" alt="photo">
                    <div class="info">
                        <form action="?page=deleteEmployee" method="POST" id="deleteEmployeeform">
                        <input id="id_employee2" name="id_employee" type="hidden" value=<?= $emp->getId() ?>>
                        <button id="delete" style="border: 2px solid #5E5E5E; color:white">Delete</button>
                        </form>
                        <div class ="nazwa">
                            <text id="name"><strong><?= $emp->getName()." ".$emp->getSurname() ?></strong></text>
                            <text id="position"><?= $emp->getPosition() ?></text>
                        </div>
                        <div class="opis">
                            <text-field id="description"><?= $emp->getDescription() ?></text-field>
                        </div>
                        <form action="?page=newEmployee" method="POST" id="newEmployeeform">
                        <input id="id_employee" name="id_employee" type="hidden" value=<?= $emp->getId() ?>>
                        <button id="next" style="border: 2px solid #8F8F8F"><img src="Style/img/arrow.svg"></button>
                        </form>
                    </div>
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
        p = list.getElementsByClassName("employee");
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