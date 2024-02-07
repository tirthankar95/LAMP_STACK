<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save | Password Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style_save.css">
</head>
<body>
    <div class="element">
        <form action="save.php" method="post">
            <div class="element_inner">
                <!-- <label for="URL" class="name"></label> -->
                <input type="text" name="url" id="URL" placeholder="URL">
            </div>
            <div class="element_inner">
                <input type="text" name="username" id="UserName" placeholder="USERNAME">
            </div>
            <div class="element_inner">
                <input type="password" name="password" placeholder="PASSWORD">
            </div>
            <div class="element_inner">
                <button type="submit" class="bttn" name="submit">Sumbit</button>
                <button type="submit" class="bttn" name="return">Return</button>
            </div>
        </form>
    </div>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["submit"]))
            {
                $url = htmlspecialchars($_POST["url"]); 
                //htmlspecialchars -> Required only when displaying user data
                // to prevent cross side scripting.
                $username = $_POST["username"];
                $password = $_POST["password"];
                if(empty($url) or empty($username) or empty($password)){
                    echo '<div class="err-msg">Entries are empty!!</div>';
                    exit();
                }
                try {
                    require_once "db_inc.php";
                    $query = "INSERT INTO password_manager (url, username, password) VALUES
                    (:url, :username, :password);";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(":username", $username);
                    $password_hash = hash('sha256', $password);
                    $stmt->bindParam(":password", $password_hash);
                    $stmt->bindParam(":url", $url);
                    $stmt->execute();
                    $pdo = null;
                    $stmt = null;
                    die();
                } catch (PDOException $e) {
                    die("Query Failed: ".$e->getMessage());
                }
                echo '<div class="msg">Data Submitted</div>';
            }
            else if(isset($_POST["return"])){
                header("Location: ../index.html");
            }
        }
    ?>
</body>

</html>