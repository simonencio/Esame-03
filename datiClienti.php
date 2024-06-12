<?php
require_once("headerFooter.php");
require_once("dati.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Dati Clienti</title>
    <link rel="stylesheet" href="./CSS5/all.min.css">
    <link rel="stylesheet" href="./CSS5/lavori.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header>
        <img src="./immagini/sfondo.jpg" alt="Immagine di sfondo" class="sfondo">
        
        <!-- HEADER -->
        <?php
        echo generateHeader2();
     ?>
        <div class="intro">
            <h1>Modifica Dati Clienti</h1>
        </div>
    </header>
    <main>
    <div class="title">
            <h1>Seleziona un Cliente</h1>
        </div>
    <?php
    $projectId = isset($_GET['id'])? (int)$_GET['id'] : 1;

    try {
        // Create a PDO instance
        $pdo = new PDO("mysql:host=". INDIRIZZO. ";dbname=". DB, UTENTE, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: ". $e->getMessage();
        exit();
    }

    // Handle the insert form submission
    if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email']) && isset($_POST['dati_personali']) && isset($_POST['messaggio'])) {
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $email = $_POST['email'];
        $dati_personali = $_POST['dati_personali'];
        $messaggio = $_POST['messaggio'];
        

        // Insert the new project into the database
        $sql = 'INSERT INTO Sql1794998_2.dati_clienti (nome, cognome, email,dati_personali, messaggio, cancellato) VALUES (:nome, :cognome, :email, :dati_personali, :messaggio, 0)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cognome', $cognome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':dati_personali', $dati_personali);
        $stmt->bindParam(':messaggio', $messaggio);
        
        $stmt->execute();

        // Display a confirmation message
        echo '<div class="message"><div class="background"><p>Cliente inserito con successo!</p></div></div>';

        // Hide the insert form
        echo '<script>document.getElementById("insert-form").style.display = "none";</script>';
    }

    // Handle the modify form submission
    if (isset($_POST['modify_nome']) && isset($_POST['modify_cognome']) && isset($_POST['modify_email']) && isset($_POST['modify_dati_personali']) && isset($_POST['modify_messaggio']) && isset($_POST['modify_project_id'])) {
        $modify_nome = $_POST['modify_nome'];
        $modify_cognome = $_POST['modify_cognome'];
        $modify_email = $_POST['modify_email'];
        $modify_dati_personali = $_POST['modify_dati_personali'];
        $modify_messaggio = $_POST['modify_messaggio'];
        $modify_project_id = $_POST['modify_project_id'];

        // Update the project in the database
        $sql = 'UPDATE Sql1794998_2.dati_clienti SET nome = :nome, cognome = :cognome, email = :email, dati_personali = :dati_personali, messaggio = :messaggio WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $modify_nome);
        $stmt->bindParam(':cognome', $modify_cognome);
        $stmt->bindParam(':email', $modify_email);
        $stmt->bindParam(':dati_personali', $modify_dati_personali);
        $stmt->bindParam(':messaggio', $modify_messaggio);
        $stmt->bindParam(':id', $modify_project_id);
        $stmt->execute();

        // Display a confirmation message
        echo '<div class="message"><div class="background"><p>Dati Cliente modificati con successo!</p></div></div>';

        // Hide the modify form
        echo '<script>document.getElementById("modify-form").style.display = "none";</script>';
    }

    // Handle the cancel button click
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Update the project's cancellato value to 1
        $sql = 'UPDATE Sql1794998_2.dati_clienti SET cancellato = 1 WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Display a confirmation message
        echo '<div class="message"><div class="background"><p>Cliente cancellato con successo!</p></div></div>';

        // Hide the cancel form
        echo '<script>document.getElementById("cancel-form").style.display = "none";</script>';
    }

    // Retrieve the list of projects
    $sql = 'SELECT * FROM Sql1794998_2.dati_clienti WHERE cancellato = 0';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the project list
    echo '<ul class="lista">';
    foreach ($projects as $project) {
        echo '<li><button class="project-button" data-project-id="'. $project['id']. '">'. htmlspecialchars($project['nome'])." ". htmlspecialchars($project['cognome']). '</button></li>';
   }
    echo '</ul>';

    // Display the selected project's details if an ID is provided
    if ($projectId > 0) {
        $sql = 'SELECT * FROM Sql1794998_2.dati_clienti WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $projectId);
        $stmt->execute();
        $project = $stmt->fetch(PDO::FETCH_ASSOC);

        // Display the project details
       
        echo '<div class="details"><div class="background2"><h2>'. htmlspecialchars($project['nome']). " ".  htmlspecialchars($project['cognome']). '</h2>';
        echo "<h3>Nome:</h3><p>". htmlspecialchars($project['nome']). '</p>';
        echo "<h3>Cognome:</h3><p>". htmlspecialchars($project['cognome']). '</p>';
        echo "<h3>Email:</h3><p>". htmlspecialchars($project['email']). '</p>';
        echo "<h3>Trattamento Dati Personali:</h3><p>". ($project['dati_personali'] == 0? 'SI' : 'NO'). '</p>';
        echo "<h3>Messaggio:</h3><p>". htmlspecialchars($project['messaggio']). '</p>
        <div class="buttons"><button id="insert-button">Inserisci</button>
    <button id="modify-button">Modifica</button>
    <button id="cancel-button">Cancella</button></div></div></div>';
        
        // Display the modify form
        echo '<form id="modify-form" method="post" style="display:none;"><div class="background2">';
        echo '<div class="titolo"><h1>Modifica Dati Cliente</h1></div>';
        echo '<label for="modify_nome">Nome:</label>';
        echo '<input type="text" id="modify_nome" name="modify_nome" value="'. htmlspecialchars($project['nome']). '" required pattern="[a-zA-Z ]+">';
        echo '<br>';
        echo '<label for="modify_cognome">Cognome:</label>';
        echo '<input type="text" id="modify_cognome" name="modify_cognome" value="'. htmlspecialchars($project['cognome']). '" required pattern="[a-zA-Z ]+">';
        echo '<br>';
        echo '<label for="modify_email">Email:</label>';
        echo '<input type="email" id="modify_email" name="modify_email" value="'. htmlspecialchars($project['email']). '" required>';
        echo '<label>Trattamento Dati Personali:</label>';
        echo '<label><input type="radio" value="0" name="modify_dati_personali" required>Acconsento</label>';
        echo '<label><input type="radio" value="1" name="modify_dati_personali" required>Non Acconsento</label>';
        echo '<label for="modify_messaggio">Messaggio:</label>';
        echo '<input type="text" id="modify_messaggio" name="modify_messaggio" value="'. htmlspecialchars($project['messaggio']). '" required>';
        echo '<br>';
        echo '<br>';
        echo '<input type="hidden" name="modify_project_id" value="'. $projectId. '">';
        echo '<input type="submit" value="Modifica"></div>';
        echo '</form>';

        // Display the cancel form
        echo '<form id="cancel-form" method="post" style="display:none;">';
        echo '<input type="hidden" name="id" value="'. $projectId. '">';
        echo '<input type="submit" value="Cancella">';
        echo '</form>';
    }
  ?>

    <form id="insert-form" method="post" style="display:none;">
    <div class="background2">
    <div class="titolo"><h1>Crea Nuovo Cliente</h1></div>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required pattern="[a-zA-Z ]+">
        <br>
        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" required pattern="[a-zA-Z ]+">
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label>Trattamento Dati Personali:</label>
        <label><input type="radio" value="0" name="dati_personali" required>Acconsento</label>
        <label><input type="radio" value="1" name="dati_personali" required>Non Acconsento</label>
        <label for="messaggio">Messaggio:</label>
        <input type="text" id="messaggio" name="messaggio" required>
        <br>
        <input type="submit" value="Inserisci">
        </div>
    </form>

    <script>
    const projectButtons = document.querySelectorAll('.project-button');
    const insertButton = document.getElementById('insert-button');
    const modifyButton = document.getElementById('modify-button');
    const cancelButton = document.getElementById('cancel-button');
    const insertForm = document.getElementById('insert-form');
    const modifyForm = document.getElementById('modify-form');
    const cancelForm = document.getElementById('cancel-form');

    projectButtons.forEach(button => {
        button.addEventListener('click', () => {
            const projectId = button.dataset.projectId;
            window.location.href = `?id=${projectId}`;
        });
    });

    function closeAllForms() {
        insertForm.style.display = 'none';
        modifyForm.style.display = 'none';
        cancelForm.style.display = 'none';
    }

    insertButton.addEventListener('click', () => {
        closeAllForms();
        insertForm.style.display = 'flex';
    });

    modifyButton.addEventListener('click', () => {
        if (<?php echo $projectId > 0? 'true' : 'false';?>) {
            closeAllForms();
            modifyForm.style.display = 'flex';
        } else {
            alert('Seleziona un Cliente per modificarlo');
        }
    });

    cancelButton.addEventListener('click', () => {
        if (confirm('Sei sicuro di voler eliminare questo Cliente?')) {
            cancelForm.submit();
        }
    });
</script>
</main>
    <!-- FOOTER -->
    <?php
    echo generateFooter();
?>
</body>


</html>