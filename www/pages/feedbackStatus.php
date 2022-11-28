<?php

include "../assets/inc/standar.include.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/CSS/hjemstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Status endret</title>
</head>
<body>
<div class="topnav">
        <a href="hjem.php">Hjem</a>
        <a href="utleie.php">Annonser din hybel</a>
        <a href="minSide.php">Min side</a>
        <div style="position:absolute;right:185px;"><a href="../assets/lib/loggUt.php">Logg ut</a></div>
        <div style="position:absolute;right:0px;"><a href="minSide.php"><?php echo $_SESSION['brukernavn']; ?></a></div>

    </div>
    <br><br>
    <div class="overskrift">
    Velykket endring av annonse-status!</div>
    <a href="hjem.php"><div class="link">Klikk her for å komme tilbake til hjem</div></a>

<?php
    include "../assets/inc/footer.php";
    ?>
</body>
</html>