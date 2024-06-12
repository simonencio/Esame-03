<?php
require_once("headerFooter.php");
require_once("dati.php");

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=". INDIRIZZO. ";dbname=". DB, UTENTE, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: ". $e->getMessage();
    exit();
}

// Retrieve data from recapiti table
$stmt = $pdo->prepare("SELECT * FROM Sql1794998_1.recapiti WHERE cancellato = 0");
$stmt->execute();
$recapiti = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Retrieve data from social table
$stmt = $pdo->prepare("SELECT social, link FROM Sql1794998_1.social WHERE cancellato = 0");
$stmt->execute();
$social = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatti</title>
    <link rel="stylesheet" href="./CSS5/all.min.css">
    <link rel="stylesheet" href="./CSS5/contatti.min.css">
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
            <h1>Contattaci</h1>
        </div>
    </header>
    <?php if (isset($_GET['success']) && $_GET['success'] == 'true') {?>
            <div class="success-message"><div class="background"><p>Dati Inviati Correttamente!</p></div></div>
        <?php } elseif (isset($_GET['error']) && $_GET['error'] == 'true') {?>
            <div class="error-message">Error occurred while creating record.</div>
        <?php }?>
    <!-- MAIN -->
    <main>
    <div class="title">
            <h1>I Nostri Contatti:</h1>
        </div>
        <section class="all">
            <div class="contatti">
                <img src="./immagini/205440980-contattaci-o-la-hotline-dell-assistenza-clienti-le-persone-connettono-l-uomo-che-tocca-l-accesso-ai.jpg" alt="lavoro2" title="lavoro2">
            </div>
        <div class="contact">
                <div class="primo">
                    <address>
                        <ul>
                            <?php foreach ($recapiti as $r) {?>
                                <li>Indirizzo:<br><?php echo $r['indirizzo'];?></li>
                            <?php }?>
                        </ul>
                    </address>
                </div>
                <div class="secondo">
                    <p>Seguici su:</p>
                    <address>
                        <ul>
                            <?php foreach ($social as $s) {
                                echo '<li><a href="'. $s['link']. '" title="seguici su '. $s['social']. '">'. $s['social']. '</a></li>';
                            }?>
                        </ul>
                    </address>
                </div>
                <div class="terzo">
                    <p>Contattaci:</p>
                    <address>
                        <ul>
                            <?php foreach ($recapiti as $r) {?>
                                <li>
                                    <a href="mailto:<?php echo $r['email'];?>" title="scrivici una mail">
                                        <?php echo $r['email'];?>
                                    </a>
                                </li>
                                <li>
                                    <a href="tel:<?php echo $r['telefono'];?>" title="Telefonaci">
                                        <?php echo $r['telefono'];?>
                                    </a>
                                </li>
                            <?php }?>
                        </ul>
                    </address>
                </div>
        </div>
        </section>
    <section class="serious">
    <form id="form-01" action="invioForm.php" method="POST">
    <h3>Contattaci:</h3>
    <fieldset>
      <label>Dati anagrafici</label>
      <div class="etichetta"><label for="campoNome">Nome</label></div>
      <div><input type="text" name="nome" placeholder="nome" id="campoNome" value="<?php echo isset($_GET['nome']) ? htmlspecialchars($_GET['nome']) : ''; ?>" required></div>
      <?php if (isset($_GET['error']) && in_array('Il campo "Nome" è obbligatorio', explode(',', urldecode($_GET['error'])))) {?>
          <p class="error">Il campo "Nome" è obbligatorio</p>
      <?php } elseif (isset($_GET['error']) && in_array('Il campo "Nome" deve contenere solo lettere e spazi', explode(',', urldecode($_GET['error'])))) {?>
          <p class="error">Il campo "Nome" deve contenere solo lettere e spazi</p>
      <?php }?>
      <div class="etichetta"><label for="campoCognome">Cognome</label></div>
      <div><input type="text" name="cognome" placeholder="cognome" id="campoCognome" value="<?php echo isset($_GET['cognome']) ? htmlspecialchars($_GET['cognome']) : ''; ?>" required></div>
      <?php if (isset($_GET['error']) && in_array('Il campo "Cognome" è obbligatorio', explode(',', urldecode($_GET['error'])))) {?>
          <p class="error">Il campo "Cognome" è obbligatorio</p>
      <?php } elseif (isset($_GET['error']) && in_array('Il campo "Cognome" deve contenere solo lettere e spazi', explode(',', urldecode($_GET['error'])))) {?>
          <p class="error">Il campo "Cognome" deve contenere solo lettere e spazi</p>
      <?php }?>
      <div class="etichetta"><label for="campoEmail">E-Mail</label></div>
      <div><input type="email" name="email" placeholder="e-mail" id="campoEmail" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>" required></div>
      <?php if (isset($_GET['error']) && in_array('Il campo "E-Mail" è obbligatorio', explode(',', urldecode($_GET['error'])))) {?>
          <p class="error">Il campo "E-Mail" è obbligatorio</p>
      <?php } elseif (isset($_GET['error']) && in_array('Il campo "E-Mail" deve essere un indirizzo email valido', explode(',', urldecode($_GET['error'])))) {?>
          <p class="error">Il campo "E-Mail" deve essere un indirizzo email valido</p>
      <?php }?>
      <div class="dati">
        <label>Trattamento dati personali:</label>
        <div class="first">
        <label id="dati"><input type="radio" value="0" name="trattamentodatipersonali" required <?php echo isset($_GET['dati_personali']) && $_GET['dati_personali'] == '0' ? 'checked' : ''; ?>>Acconsento</label>
        <label id="dati1"><input type="radio" value="1" name="trattamentodatipersonali" required <?php echo isset($_GET['dati_personali']) && $_GET['dati_personali'] == '1' ? 'checked' : ''; ?>>Non acconsento</label>
        </div>
        <a href="https://www.iubenda.com/privacy-policy/36114346" class="iubenda-black iubenda-noiframe iubenda-embed iubenda-noiframe " title="Privacy Policy ">Privacy Policy</a><script>(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
    </div>
      <?php if (isset($_GET['error']) && in_array('Il campo "Trattamento dati personali" è obbligatorio', explode(',', urldecode($_GET['error'])))) {?>
          <p class="error">Il campo "Trattamento dati personali" è obbligatorio</p>
      <?php } elseif (isset($_GET['error']) && in_array('Il campo "Trattamento dati personali" deve essere "si" o "no"', explode(',', urldecode($_GET['error'])))) {?>
          <p class="error">Il campo "Trattamento dati personali" deve essere "si" o "no"</p>
      <?php }?>
      <div class="etichetta">
      <label>Messaggio:</label><br></div>
      <div><textarea placeholder="inserisci qui il tuo messaggio" id="campoMessaggio" name="messaggio" required><?php echo isset($_GET['messaggio']) ? htmlspecialchars($_GET['messaggio']) : ''; ?></textarea></div>
      <?php if (isset($_GET['error']) && in_array('Il campo "Messaggio" è obbligatorio', explode(',', urldecode($_GET['error'])))) {?>
          <p class="error">Il campo "Messaggio" è obbligatorio</p>
      <?php } elseif (isset($_GET['error']) && in_array('Il campo "Messaggio" deve contenere almeno 10 caratteri', explode(',', urldecode($_GET['error'])))) {?>
          <p class="error">Il campo "Messaggio" deve contenere almeno 10 caratteri</p>
      <?php }?>
      <div>
        <button type="reset" title="clicca per annullare" class="bottone">Annulla</button>
        <button type="submit" title="clicca per inviare" class="bottone">Invia</button>
      </div>
    </fieldset>
  </form>
  
    </section>
    </main>
    <!-- FOOTER -->
    <?php
    echo generateFooter();
    ?>

</body>

</html>