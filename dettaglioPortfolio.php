<?php
ini_set("auto_detect_line_endings", true);
require_once('Utility.php');
require_once("headerFooter.php");
require_once("dati.php");
use MieClassi\Utility as UT;



try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=". INDIRIZZO. ";dbname=". DB, UTENTE, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: ". $e->getMessage();
    exit();
}

// Retrieve the project data from the progetti table
$selezionato = UT::richiestaHTTP("id");
$selezionato = ($selezionato == null)? 1 : $selezionato;

$stmt = $pdo->prepare("SELECT * FROM Sql1794998_1.progetti WHERE id = :id");
$stmt->bindParam(':id', $selezionato);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $project = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Progetto non trovato.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $project['nome'];?></title>
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
        <h1><?php echo $project['nome'];?></h1>
        </div>
    </header>
    <!-- MAIN -->
    <main>
    <section class="progetto">
            <div class="project-title">
        <h2><?php echo $project['progetto_title'];?></h2>
            </div>
            <div class="project-image">
                <img src="<?php echo $project['progetto_img'];?>" alt="<?php echo $project['nome'];?>">
            </div>
            <div class="project-description">
    <p><?php echo $project['descrizione'];?></p>
</div>
        </section>
        <div class="project-title">
            <h3>Lavori</h3>
        </div>
        <section class="fotolavori">
  <ul class="lavori">
    <?php
    $count = 0;
    $elencoPortfolio = [];

   // Retrieve all projects from the progetti table
   $stmt = $pdo->prepare("SELECT * FROM Sql1794998_1.portfolio WHERE cancellato = 0");
   $stmt->execute();

   while ($link = $stmt->fetch(PDO::FETCH_ASSOC)) {
       $elencoPortfolio[] = [
           'id' => $link['id'],
           'nome' => $link['nome'],
           'elenco_image_url' => $link['elenco_image_url'], // You didn't have an 'elenco_image_url' column in your table, so I left this empty
           'elenco_image_title' => $link['elenco_image_title'] // You didn't have an 'elenco_image_title' column in your table, so I left this empty
       ];
   }

    $selezionato = UT::richiestaHTTP("selezionato");
    $selezionato = ($selezionato == null)? 1 : $selezionato;

    foreach ($elencoPortfolio as $link) {
        $n = $link['id'];
        $classeSelezionato = ($n == $selezionato)? 'class="selezionato"' : '';
        $elenco_image_url = isset($link['elenco_image_url'])? $link['elenco_image_url'] : '';
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