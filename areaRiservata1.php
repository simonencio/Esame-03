<?php
require_once("headerFooter.php");
require_once("dati.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Riservata</title>
    <link rel="stylesheet" href="./CSS5/all.min.css">
    <link rel="stylesheet" href="./CSS5/areaRiservata.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<img src="./immagini/sfondo.jpg" alt="Immagine di sfondo" class="sfondo">
        
    <!-- HEADER -->
    <header>
    <?php
echo generateHeader2();
?>
<div class="intro">
    <h1>Area Riservata</h1>
</div>
</header>
<main>
<div class="Home">
    <?php
    $counter = 0;
    try {
        // Create a PDO instance
        $pdo = new PDO("mysql:host=". INDIRIZZO. ";dbname=". DB, UTENTE, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: ". $e->getMessage();
        exit();
    }

    // Query the database to retrieve the sections
    $stmt = $pdo->prepare("SELECT * FROM Sql1794998_1.sezioni WHERE cancellato = 0");
    $stmt->execute();

    // Fetch the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Loop through the results and display the sections
    foreach ($results as $row) {
        if ($counter % 3 == 0) {
            echo '<div class="divisione">';
        }
        ?>
        <div class="card">
            <h4><?= $row['titolo_link']?></h4>
            <a href="<?= $row['link']?>" title="<?= $row['titolo_link']?>"><img src="<?= $row['img']?>" title="<?= $row['title_img']?>"></a>
        </div>
        <?php
        $counter++;
        if ($counter % 3 == 0) {
            echo '</div>';
        }
    }
    if ($counter % 3 != 0) {
        echo '</div>';
    }

    // Close the PDO connection (not necessary, but a good practice)
    $pdo = null;
    ?>
</div>
</main>
<!-- FOOTER -->
<?php
    echo generateFooter();
   ?>

</body>

</html>