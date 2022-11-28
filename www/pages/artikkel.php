<?php

include "../assets/inc/standar.include.php";
require_once "../assets/lib/endreStatus.php";
require_once "../assets/lib/slettArtikkel.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/CSS/artikkelstyle.css">
    <title>artikkel</title>
</head>

<body>

    <div class="topnav">
        <a href="hjem.php">Hjem</a>
        <a href="utleie.php">Annonser din hybel</a>
        <a href="minSide.php">Min side</a>
        <div style="position:absolute;right:185px;"><a href="../assets/lib/loggUt.php">Logg ut</a></div>
        <div style="position:absolute;right:0px;"><a href="minSide.php"><?php echo $_SESSION['brukernavn']; ?></a></div>
    </div>

    <p>
        <!--skjult mellomrom-->
    </p>

    <?php

    $sql = "SELECT * 
        FROM hybel WHERE hybel_id='" . $_GET['hybel_id'] . "'";



    $q = $pdo->prepare($sql);

    try {
        $q->execute();
    } catch (PDOException $e) {
        echo "Error querying database: " . $e->getMessage() . "<br>"; // Never do this in production
    }
    //$q->debugDumpParams();

    $hybler = $q->fetchAll(PDO::FETCH_OBJ);
    echo '<div class="flex-container">';
    if ($q->rowCount() > 0) {
        foreach ($hybler as $hybel) {

            echo '<box1> <img src="../assets/img/' . $hybel->bilde . '"</box1>';
            echo '<div class="tekstbox">';
            echo '<p>' . $hybel->navn . '</p>';
            echo '</div>';
            echo '<div class="overview">';
            echo '<ul class="no-bullets">';
            echo  '<li>Pris: <span>' . $hybel->pris . '</span></li>';
            echo  '<li>Depositum: <span>' . $hybel->depo . '</span></li>';
            echo    '<li>Adresse: <span>' . $hybel->adresse . '</span></li>';
            echo    '<li>Ledig fra:<span>' . $hybel->ledigFra . '</span></li>';
            echo  '</ul>';
            echo '</div>';

            echo '<div class="overview">';
            echo    '<ul class="no-bullets">';
            echo       '<li>Bolig type: <span>' . $hybel->btype . '</span></li>';

            //Printer boolean status som ja eller nei
            echo       '<li>Inkl. strøm: <span>';
            echo       $hybel->strom ? 'Ja' : 'Nei' . '</span></li>';

            echo        '<li>Inkl. internett: <span>';
            echo        $hybel->internett ? 'Ja' : 'Nei' . '</span></li>';

            echo        '<li>Inkl. tv: <span>';
            echo        $hybel->tv ? 'Ja' : 'Nei' . '</span></li>';

            $timeStamp = $hybel->opprettet;
            echo        '<li>Opprettet: <span>' . date('F Y', strtotime($timeStamp)) . '</span></li>';
            echo        '<li>Eier: <span>' . $hybel->eier . '</span></li>';

            $status = $hybel->status;

            if ($status <= 0) {
                echo        '<div class="status">IKKE TILGJENGLIG</div>';
            } else {
                echo "";
            }

            echo    '</ul>';
            echo '</div>';

            //Knapper
            //echo '<button class="button"><a href="">Send melding til utleier</a></button>';
            /*echo '<div class="container">';
            echo '<a href=""><button class="button"><a>Lei denne leigliheten / eller kontakt eier muligens </a></button></a>';
            echo '</div>';
            echo '</div>';*/




            //Sjekker at brukeren ikke er eier
            $eier = $hybel->eier;
            $eierSjekk = $_SESSION['brukernavn'];
            if ($eier != $eierSjekk) {
                echo '<div class="container">';
                echo '<a href=""><button class="button"><a>Kontakt utleier</a></button></a>';
                echo '</div>';
                echo '</div>';
            } else {

                //hvis innlogget bruker eier annonsen, gi brukeren andre alternativer 
                if ($status > 0) {
                    echo '<div class="container">';
                    echo '<form method="post" action="">';
                    echo '<input class="button" type="submit" name="endreStatusIkkeTilgjenglig" value="Endre status til ikke tilgjenlig"</input>';
                    echo '   ';
                    echo '<input class="button" type="submit" name="slettAnnonse" value="Slett annonsen for godt"</input>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                } else {
                    echo '<div class="container">';
                    echo '<form method="post" action="">';
                    echo '<input class="button" type="submit" name="endreStatusTilgjengelig" value="Endre status til tilgjengelig"</input>';
                    echo '   ';
                    echo '<input class="button" type="submit" name="slettAnnonse" value="Slett annonsen for godt"</input>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        }
    } else {
        echo "The query resulted in an empty result set.";
    }

    //Funksjoner, hentet fra slettArtikkel og endreStatus klassen
    if (isset($_POST['endreStatusTilgjengelig'])) {
        $endreStatus = new Status;
        $endreStatus->Tilgjenglig();
    }

    if (isset($_POST['endreStatusIkkeTilgjenglig'])) {
        $endreStatus = new Status;
        $endreStatus->IkkeTilgjenglig();
    }

    if (isset($_POST['slettAnnonse'])) {
        $slett = new slettArtikkel;
        $slett->fjernArtikkel();
    }

    ?>



    <?php
    include "../assets/inc/footer.php";
    ?>
</body>

</html>