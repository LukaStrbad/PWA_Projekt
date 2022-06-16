<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BZ Berlin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style/shared.css">

</head>

<body>
    <?php
    session_start();
    include_once "header.php";
    include_once "connection.php";

    if (isset($_SESSION["username"])) {
        header("Location: administracija.php");
    }
    ?>

    <div class="container">
        <?php
        if (isset($_POST["login"])) {
            if (empty($_POST["username"]) || empty($_POST["password"])) {
                echo "<h1>Enter username and password</h1>";
            }

            $username = $_POST["username"];
            $password = $_POST["password"];

            $query = "SELECT * FROM users WHERE username = ?;";
            $stmt = $dbc->prepare($query);
            $stmt->bind_param("s", $username);
            try {
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if ($row) {

                    if (password_verify($password, $row["password"])) {
                        $_SESSION["username"] = $username;
                        $_SESSION["access_level"] = $row["access_level"];
                        header("Location: administracija.php");
                    } else {
                        echo "<h1>Wrong username or password</h1>";
                    }
                } else {
                    echo "<h1>Wrong username or password</h1>";
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        ?>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
            <span id="username-error" class="error"></span>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <span id="password-error" class="error"></span>

            <input type="submit" class="button" name="login" value="Login" onclick="loginUser()">
        </form>

        <a href="register.php">Create a new account</a>

        <script>
            function loginUser() {
                let send = true;

                let username = document.getElementById("username");
                if (username.value.trim().length == 0) {
                    document.getElementById("username-error").innerHTML = "Enter a username";
                    username.classList.add("error");
                    send = false;
                } else {
                    document.getElementById("username-error").innerHTML = "";
                    username.classList.remove("error");
                }

                let password = document.getElementById("password");
                if (password.value.trim().length == 0) {
                    document.getElementById("password-error").innerHTML = "Enter a password";
                    password.classList.add("error");
                    send = false;
                } else {
                    document.getElementById("password-error").innerHTML = "";
                    password.classList.remove("error");
                }

                if (!send) {
                    event.preventDefault();
                }
            }
        </script>
    </div>

    <?php
    include_once "footer.html";
    ?>
</body>

</html>