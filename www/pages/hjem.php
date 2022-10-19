<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'hybelprosjekt') or die("Kunne ikke koble til database.");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/CSS/hjemstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Hjemside</title>
</head>

<body>

    <div class="topnav">
        <a class="active" href="hjem.php">Hjem</a>
        <a href="utleie.php">Annonser din hybel</a>
        <a href="minSide.php">Min side</a>
        <a class="loggUt" href="../assets/lib/loggUt.php">Logg ut</a>
    </div>

    <p>Du er nå logget inn på brukeren <?php echo $_SESSION['brukernavn'] . "."; ?></p>

 
 <div class="flex-container">

    <a href="minSide.php">
        <card>
            <box1><img src="../assets/img/testbilde2.jpg" /></box1>
            <div class="tekstbox">
                <h2>Rom i kollektiv</h2>
                <p>Tjuvhelleren 93</p>
                <p>7 000,-</p>
            </div>
        </card>
        </a>
        
        <card>
            <box1><img src="../assets/img/testbilde.jpg" /></box1>
            <div class="tekstbox">
                <h2>Leilighet, 1 rom</h2>
                <p>Valhallagata 19</p>
                <p>8 000,-</p>
            </div>
        </card>
        <card>
            <box1><img src="../assets/img/testbilde3.jpg" /></box1>
            <div class="tekstbox">
                <h2>Leilighet, 2 rom</h2>
                <p>Gimleveien 42</p>
                <p>10 000,-</p>
            </div></card>
        <card>4</card>
        <card>5</card>
        <card>6</card>
        <card>7</card>
    </div>

<?php
include "../assets/inc/footer.php";
?>
</body>
</html>