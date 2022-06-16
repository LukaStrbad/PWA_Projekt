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
    ?>

    <div class="container">
        <?php
        if (isset($_POST["register"])) {
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $username = $_POST["username"];
            $password = password_hash($_POST["password"], CRYPT_BLOWFISH);

            $query = "INSERT INTO users(name, surname, username, password) VALUES (?, ?, ?, ?);";
            $stmt = $dbc->prepare($query);
            $stmt->bind_param("ssss", $name, $surname, $username, $password);
            try {
                $stmt->execute();
                echo "<h1>Successfully registered";
                $_SESSION["name"] = $name;
                $_SESSION["surname"] = $surname;
                $_SESSION["username"] = $username;

                header("Location: administracija.php");
            } catch (Exception $e) {
                echo "There was an error when registering" . $e->getMessage();
            }
        }
        ?>
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name">
            <span id="name-error" class="error"></span>

            <label for="surname">Surname:</label>
            <input type="text" name="surname" id="surname">
            <span id="surname-error" class="error"></span>

            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
            <span id="username-error" class="error"></span>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <span id="password-error" class="error"></span>

            <label for="password2">Repeat password:</label>
            <input type="password" name="password2" id="password2">
            <span id="password2-error" class="error"></span>

            <input type="submit" class="button" name="register" value="Register" onclick="registerUser()">
        </form>
    </div>

    <script>
        function registerUser() {
            let send = true;

            let name = document.getElementById("name");

            if (name.value.trim().length == 0) {
                document.getElementById("name-error").innerHTML = "Name is required";
                name.classList.add("error");
                send = false;
            } else {
                document.getElementById("name-error").innerHTML = "";
                name.classList.remove("error");
            }

            let surname = document.getElementById("surname");

            if (surname.value.trim().length == 0) {
                document.getElementById("surname-error").innerHTML = "Surname is required";
                surname.classList.add("error");
                send = false;
            } else {
                document.getElementById("surname-error").innerHTML = "";
                surname.classList.remove("error");
            }

            let username = document.getElementById("username");

            if (username.value.trim().length == 0) {
                document.getElementById("username-error").innerHTML = "Username is required";
                username.classList.add("error");
                send = false;
            } else {
                document.getElementById("username-error").innerHTML = "";
                username.classList.remove("error");
            }

            let password = document.getElementById("password");

            if (password.value.trim().length < 8) {
                document.getElementById("password-error").innerHTML = "Password is required and must be at least 8 characters long";
                password.classList.add("error");
                send = false;
            } else {
                document.getElementById("password-error").innerHTML = "";
                password.classList.remove("error");
            }

            let password2 = document.getElementById("password2");

            if (password2.value != password.value) {
                document.getElementById("password2-error").innerHTML = "Passwords do not match";
                password2.classList.add("error");
                send = false;
            } else {
                document.getElementById("password2-error").innerHTML = "";
                password2.classList.remove("error");
            }

            if (!send) {
                event.preventDefault();
            }
        }
    </script>

    <?php
    include_once "footer.html";
    ?>
</body>

</html>