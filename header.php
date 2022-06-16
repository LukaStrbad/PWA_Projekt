<header id="header">
    <div id="logo">
        <img src="img/logo.png" alt="logo">
    </div>
    <nav id="nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php
            include_once "connection.php";
            $query = "SELECT * FROM category;";
            $result = $dbc->query($query);

            while ($cateogry = $result->fetch_assoc()) {
                echo '<li><a href="index.php?category=' . $cateogry['id'] . '">' . $cateogry['name'] . '</a></li>';
            }
            ?>
            <!-- <li><a href="index.php?filter=1">Berlin-sport</a></li>
            <li><a href="index.php?filter=2">Kultur und show</a></li> -->
            <li><a href="login.php">Administracija</a></li>
        </ul>
    </nav>
</header>