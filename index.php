<?php
require_once("headerFooter.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./CSS5/index.min.css">
    <link rel="stylesheet" href="./CSS5/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<img src="./immagini/sfondo.jpg" alt="Immagine di sfondo" class="sfondo">
        
    <!-- HEADER -->
    <header>
        <?php
        echo generateHeader();
        ?>
        <div class="banner">
            <ul>
  <li><h2>QUESTO È UN SITO DI PROVA.<br></h2></li>
  <li><p>Si prega di non inserire dati personali se non in accordo con il proprietario del sito.<br>Le policy sulla privacy e sui cookie sono solo temporanee, non siamo autorizzati al trattamento dei dati esterni.</p></li>
  <li><p>Cookie policy di prova</p></li>
  <li><a href="https://www.iubenda.com/privacy-policy/36114346/cookie-policy" class="iubenda-black iubenda-noiframe iubenda-embed iubenda-noiframe " title="Cookie Policy ">Cookie Policy</a><script>(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script></li>
  <li><p>Privacy policy di prova</p></li>
  <li><a href="https://www.iubenda.com/privacy-policy/36114346" class="iubenda-black iubenda-noiframe iubenda-embed iubenda-noiframe " title="Privacy Policy ">Privacy Policy</a><script>(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script></li>
    </ul>
  <button id="accetto">Accetto</button>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const banner = document.querySelector(".banner");
    const accettoButton = document.querySelector("#accetto");

    // Check if the user has already accepted the banner in this session
    if (sessionStorage.getItem("bannerAccepted") === "true") {
      banner.style.display = "none";
    } else {
      // Hide the banner initially
      banner.style.display = "none";

      // Add a 2-second delay before showing the banner
      setTimeout(function() {
        banner.style.display = "flex";
      }, 2000); // 2000ms = 2 seconds
    }

    accettoButton.addEventListener("click", function() {
      banner.style.display = "none";
      sessionStorage.setItem("bannerAccepted", "true");
    });
  });
</script>
        <div class="intro">
            <h1>Home Page</h1>
            
        </div>
    </header>
    <!-- MAIN -->
    <main>
        <div class="title">
            <h1>Esplora Insieme A Noi</h1>
        </div>
        <div class="Home">
            <div class="card">
                <h4>CHI SIAMO?</h4>
                <a href="./chiSiamo.php" title="paginaChiSiamo"><img src="./immagini/pagina-chi-siamo.jpg" alt="pagina-chi-siamo" title="pagina-chi-siamo"></a>
            </div>
            <div class="card">
                <h4>PORTFOLIO</h4>
                <a href="./elencoPortfolio.php" title="paginaPortfolio"><img src="./immagini/portfolio.jpg" alt="portfolio" title="portfolio"></a>
            </div>
            <div class="card">
                <h4>CONTATTI</h4>
                <a href="./contatti.php" title="paginaContatti"><img src="./immagini/contattaci.jpg" alt="contatti" title="contatti"></a>
            </div>
        </div>
    </main>
    <!-- FOOTER -->
    <?php
    echo generateFooter();
    ?>

</body>

</html>