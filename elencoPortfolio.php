<?php
ini_set("auto_detect_line_endings", true);

require_once('Utility.php');
require_once("headerFooter.php");
require_once("dati.php");

use MieClassi\Utility as UT;

// Connect to the database


try {
    $pdo = new PDO("mysql:host=". INDIRIZZO. ";dbname=". DB, UTENTE, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query the database for the project data
    $stmt = $pdo->prepare('SELECT id, nome, elenco_image_url, elenco_image_title, cancellato FROM Sql1794998_1.portfolio');
    $stmt->execute();

    // Fetch the project data as an associative array
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the database connection
    $pdo = null;
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$selezionato = UT::richiestaHTTP("selezionato");
$selezionato = ($selezionato == null) ? 1 : $selezionato;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="./CSS5/all.min.css">
    <link rel="stylesheet" href="./CSS5/Portfolio-Progetti.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<img src="./immagini/sfondo.jpg" alt="Immagine di sfondo" class="sfondo">

    <!-- HEADER -->
    <header>
        <?php
        echo generateHeader();
        ?>
        <div class="intro">
            <h1>I Nostri Progetti</h1>
        </div>
    </header>
    <!-- MAIN -->
    <main>
        <div class="title">
            <h1>Lavori</h1>
        </div>
        <section class="fotolavori">
  <ul class="lavori">
    <?php
    $count = 0;
    $elencoPortfolio = [];
    $dettaglioPortfolio = [];

    foreach ($arr as $link) {
        if ($link['cancellato'] == 0) {
        $elencoPortfolio[] = [
            'id' => $link['id'],
            'nome' => $link['nome'],
            'elenco_image_url' => $link['elenco_image_url'],
            'elenco_image_title' => $link['elenco_image_title']
        ];
    }
}

    $selezionato = UT::richiestaHTTP("selezionato");
    $selezionato = ($selezionato == null) ? 1 : $selezionato;

    foreach ($elencoPortfolio as $link) {
        $n = $link['id'];
        $classeSelezionato = ($n == $selezionato) ? 'class="selezionato"' : '';
        $elenco_image_url = isset($link['elenco_image_url']) ? $link['elenco_image_url'] : '';
        printf('<li %s><a href="dettaglioPortfolio.php?id=%d" title="%s"><img src="%s" alt="%s"><div class="numero"><h2>%s</h2></div></a></li>', $classeSelezionato, $n, $link['elenco_image_title'], $elenco_image_url, $link['nome'], $link['nome']);
        $count++;
        if ($count % 3 == 0) {
            echo '</ul></section><section class="fotolavori"><ul class="lavori">';
        }
    }
    ?>
  </ul>
</section>
    </main>
    <!-- FOOTER -->
    <?php
    echo generateFooter();
    ?>

</body>

</html>