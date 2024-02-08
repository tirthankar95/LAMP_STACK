<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>IncidentReporting</title>
</head>
<body>
    <form action="index.php" method="post">
        <div class="element">
            <div class="element_inner">
                <input type="search" name= "searchTxt" id="searchQuery" placeholder="Search by category...">
                <button type="submit" id="bttn" name="search">Search</button>
            </div>    
            <div class="element_inner">
                <button type="submit" id="bttn" name="report">Report Incident</button>
            </div>
        </div>
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(isset($_POST["report"])){
                header("Location: include/report.php");
            }
            if(isset($_POST["search"])){
                session_start();
                $_SESSION['param1'] = $_POST["searchTxt"];
                header("Location: include/display.php");
            }
        }
    ?>
</body>
</html>