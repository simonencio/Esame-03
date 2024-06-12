<?php
require_once("headerFooter.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Siamo</title>
    <link rel="stylesheet" href="./CSS5/all.min.css">
    <link rel="stylesheet" href="./CSS5/chiSiamo.min.css">
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
        <h1>Chi Siamo?
        </h1>
        </div>
    </header>
    <!-- MAIN -->
    <main>
        <section class="about">
            <img src="./immagini/diventare-ux-designer.jpg" alt="codici" title="codici">
            <div class="text">
                <h2>About Us</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
        </section>
        <section class="servizi">
            <h2>
                I Nostri Servizi
            </h2>
            <br>
            <img src="./immagini/schermata-webdesigner.jpg" alt="webdesign" title="webdesign">
            <div class="servizi2">
            <div>
                <h6>Web design</h6>
                    <p>There are many variations of passages of Lorem Ipsum available, <br>but the majority have suffered alteration in some form, by injected humour, <br>or randomised words which don't look even slightly believable</p>
            </div>
            <div>
                <h6>Web design</h6>
                    <p>There are many variations of passages of Lorem Ipsum available, <br>but the majority have suffered alteration in some form, by injected humour, <br>or randomised words which don't look even slightly believable</p>
            </div>
            <div>
                <h6>Web design</h6>
                    <p>There are many variations of passages of Lorem Ipsum available, <br>but the majority have suffered alteration in some form, by injected humour, <br>or randomised words which don't look even slightly believable</p>
            </div>
</div>
        </section>
    </main>
     <!-- FOOTER -->
     <?php
    echo generateFooter();
    ?>

</body>

</html>