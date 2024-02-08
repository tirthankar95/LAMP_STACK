<?php
    session_start();
    require_once "db.inc.php";
    $search = strtolower($_SESSION["param1"]);
    $query = "SELECT name, category, created_on, report FROM report_db WHERE category=:category ORDER BY created_on DESC;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":category", $search);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>View | IncidentReporting</title>
</head>
<body class="view">
    <div class="elementView">
        <?php
            foreach($results as $row){
                echo '<div class="block"><p>Reported By: '.$row["name"]
                     .'</p><p>Category: '.$row["category"]
                     .'</p><p>Created On: '.$row["created_on"]
                     .'</p><p>Report: '.$row["report"].'</p></div>';
            }
        ?>    
    </div>
</body>
</html>