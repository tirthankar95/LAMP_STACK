<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>IncidentReporting</title>
</head>
<body>
    <form action="report.php" method="post">
        <div class="element">
            <div class="element_inner">
                <input type="text" name="name" placeholder="NAME">
            </div>
            <div class="element_inner">
                <select name="category" id="category" class="category">
                    <option value="" disabled selected>SELECT CATEGORY</option>
                    <option value="malicious software">Malicious Software</option>
                    <option value="phising">Phising</option>
                    <option value="denial of service">Denial Of Service</option>
                    <option value="social engineering">Social Engineering</option>
                    <option value="insider threats">Insider Threats</option>
                    <option value="cross-site scripting">Cross-Site Scripting</option>  
                    <option value="sql injection">SQL Injection</option>
                    <option value="zero day exploits">Zero Day Exploits</option>
                    <option value="data breaches">Data Breaches</option>
                    <option value="man in the middle">Man-in-the-Middle</option>
                </select>
            </div>
            <div class="element_inner">
                <textarea name="textArea" id="textArea" cols="30" rows="10" placeholder="Enter Report..."></textarea>
            </div>
            <div class="element_inner">
                <button type="submit" id="bttn" name="submit">Submit</button>
            </div>
        </div>
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST" AND isset($_POST["submit"])){
            try {
                $name = $_POST["name"];
                $category = $_POST["category"];
                $report = $_POST["textArea"];
                if(empty($name) || empty($category) || empty($report)){
                    echo '<div class="err-msg">Entries are empty!!</div>';
                    exit();
                }
                require_once "db.inc.php";
                $query = "INSERT INTO report_db (name, category, report) VALUES (:name, :category, :report);";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":category", $category);
                $stmt->bindParam(":report", $report);
                $stmt->execute();
                $stmt = null;
                $pdo = null;
                sleep(1);
                header("Location: ../index.php");
            } catch (PDOException $e) {
                die("Query Failed: ".$e->getMessage());
            }
        }
    ?>
</body>
</html>