<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Calculator</title>
</head>
<body>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="text" name="num1" placeholder="NUM1" class="num">
            <select name="operator">
                <option value="def"> </option>
                <option value="add">+</option>
                <option value="sub">-</option>
                <option value="mul">*</option>
                <option value="div">/</option>
            </select>
            <input type="text" name="num2" placeholder="NUM2" class="num">
            <button class="calc-bttn">Calculate</button>
        </form>
    </div>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $num1 = filter_input(INPUT_POST, "num1", FILTER_SANITIZE_NUMBER_FLOAT);
            $num2 = filter_input(INPUT_POST, "num2", FILTER_SANITIZE_NUMBER_FLOAT);
            $operator = htmlspecialchars($_POST["operator"]);

            $errors = false;
            if($num2 == 0 && $operator == "div"){
                echo '<div class="calc-error">Division by zero.</div>';
                $errors = true;
            }
            else if(empty($num1) || empty($num2) || empty($operator)){
                echo "<div class='calc-error'>Empty Parameters.</div>";
                $errors = true;
            }
            else if(!is_numeric($num1) || !is_numeric($num2)){
                echo "<div class='calc-error'>Input numbers.</div>";
                $errors = true;               
            }
            if(!$errors){
                $value = 0;
                switch($operator){
                    case "add":
                        $value = $num1 + $num2;
                        break;
                    case "sub":
                        $value = $num1 - $num2;
                        break;
                    case "mul":
                        $value = $num1 * $num2;
                        break;
                    case "div":
                        $value = $num1 / $num2;
                        break;
                    case "def":
                        break;
                    default:
                        echo "<p class='calc-error'>Something went wrong!!</p>";
                        exit();
                }
                if($operator != "def")
                    echo '<div class="calc-result">Result: '.$value.'</div>';
            }
        }
    ?>
</body>
</html>