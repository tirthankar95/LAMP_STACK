<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style_view.css">
    <title>View | Password Manager</title>
</head>
<body>
    <div class="element">
        <form action="view.php" method="post">
            <div class="element_inner">
                Enter details to view data
            </div>
            <div class="element_inner">
                <input type="text" name="username" placeholder="USERNAME">
            </div>
            <div class="element_inner">
                <input type="password" name="password" placeholder="PASSWORD">
            </div>
            <div class="element_inner">
                <button type="submit" class="bttn" name="submit">Submit</button>
                <button type="return" class="bttn" name="return">Return</button>
            </div>
        </form>
    </div>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(isset($_POST["submit"])){
                $username = $_POST["username"];
                $password = $_POST["password"];
                if(empty($username) OR empty($password)){
                    echo '<div class="err-msg">Entries are empty!!</div>';
                    exit();
                }
                try {
                    $password_hash = hash("sha256", $password);
                    require_once "db_inc.php";
                    $query = "SELECT url FROM password_manager WHERE 
                    username=:username AND password=:password;";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(":username", $username);
                    $stmt->bindParam(":password", $password_hash);
                    $stmt->execute();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if(empty($results)){
                        echo "<div class='msg'>No results.</div>";
                    }
                    else{
                        foreach($results as $row){
                           echo "<div class='msg'>";
                           echo htmlspecialchars($row['url']);
                           echo "</div>";
                        }
                    }
                    $pdo = null;
                    $stmt = null;
                } catch (PDOException $e) {
                    die("Query Failed: ".$e->getMessage());
                }
            }//end of submit.
            else if(isset($_POST["return"])){
                header("Location: ../index.html");
            }//end of return.
        }
    ?>
</body>
</html>