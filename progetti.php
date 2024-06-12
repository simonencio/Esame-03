<?php
require_once("headerFooter.php");
require_once("dati.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Progetti</title>
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
            <h1>Modifica Progetti</h1>
        </div>
    </header>
    <main>
    <div class="title">
            <h1>Seleziona un Progetto</h1>
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
    if (isset($_POST['nome']) && isset($_POST['progetto_img']) && isset($_POST['progetto_title']) && isset($_POST['descrizione'])) {
        $nome = $_POST['nome'];
        $progetto_img = $_POST['progetto_img'];
        $progetto_title = $_POST['progetto_title'];
        $descrizione = $_POST['descrizione'];
        

        // Insert the new project into the database
        $sql = 'INSERT INTO Sql1794998_1.progetti (nome, progetto_img, progetto_title, descrizione, cancellato) VALUES (:nome, :progetto_img, :progetto_title, :descrizione, 0)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':progetto_img', $progetto_img);
        $stmt->bindParam(':progetto_title', $progetto_title);
        $stmt->bindParam(':descrizione', $descrizione);
        
        $stmt->execute();

        // Display a confirmation message
        echo '<div class="message"><div class="background2"><p>Progetto inserito con successo!</p></div></div>';

        // Hide the insert form
        echo '<script>document.getElementById("insert-form").style.display = "none";</script>';
    }

    // Handle the modify form submission
    if (isset($_POST['modify_nome']) && isset($_POST['modify_progetto_img']) && isset($_POST['modify_progetto_title']) && isset($_POST['modify_descrizione']) && isset($_POST['modify_project_id'])) {
        $modify_nome = $_POST['modify_nome'];
        $modify_progetto_img = $_POST['modify_progetto_img'];
        $modify_progetto_title = $_POST['modify_progetto_title'];
        $modify_descrizione = $_POST['modify_descrizione'];
        $modify_project_id = $_POST['modify_project_id'];

        // Update the project in the database
        $sql = 'UPDATE Sql1794998_1.progetti SET nome = :nome, progetto_img = :progetto_img, progetto_title = :progetto_title, descrizione = :descrizione WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $modify_nome);
        $stmt->bindParam(':progetto_img', $modify_progetto_img);
        $stmt->bindParam(':progetto_title', $modify_progetto_title);
        $stmt->bindParam(':descrizione', $modify_descrizione);
        $stmt->bindParam(':id', $modify_project_id);
        $stmt->execute();

        // Display a confirmation message
        echo '<div class="message"><div class="background2"><p>Progetto modificato con successo!</p></div></div>';

        // Hide the modify form
        echo '<script>document.getElementById("modify-form").style.display = "none";</script>';
    }

    // Handle the cancel button click
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Update the project's cancellato value to 1
        $sql = 'UPDATE Sql1794998_1.progetti SET cancellato = 1 WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Display a confirmation message
        echo '<div class="message"><div class="background2"><p>Progetto cancellato con successo!</p></div></div>';

        // Hide the cancel form
        echo '<script>document.getElementById("cancel-form").style.display = "none";</script>';
    }

    // Retrieve the list of projects
    $sql = 'SELECT * FROM Sql1794998_1.progetti WHERE cancellato = 0';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the project list
    echo '<ul class="lista">';
    foreach ($projects as $project) {
        echo '<li><button class="project-button" data-project-id="'. $project['id']. '">'. htmlspecialchars($project['nome']). '</button></li>';
   }
    echo '</ul>';

    // Display the selected project's details if an ID is provided
    if ($projectId > 0) {
        $sql = 'SELECT * FROM Sql1794998_1.progetti WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $projectId);
        $stmt->execute();
        $project = $stmt->fetch(PDO::FETCH_ASSOC);

        // Display the project details
       
        echo '<div class="details"><div class="background2"><h2>'. htmlspecialchars($project['nome']). '</h2>';
        echo "<h3>URL dell'immagine:</h3><p>". htmlspecialchars($project['progetto_img']). '</p>';
        echo "<h3>Titolo Progetto:</h3><p>". htmlspecialchars($project['progetto_title']). '</p>';
        echo "<h3>Descrizione Progetto:</h3><p>". htmlspecialchars($project['descrizione']). '</p>
        <div class="buttons"><button id="insert-button">Inserisci</button>
    <button id="modify-button">Modifica</button>
    <button id="cancel-button">Cancella</button></div></div></div>';
        
        // Display the modify form
        echo '<form id="modify-form" method="post" style="display:none;">';
        echo '<div class="background">';
        echo '<div class="titolo">
        <h1>Modifica Progetto</h1></div>';
        echo '<label for="modify_nome">Nome:</label>';
        echo '<input type="text" id="modify_nome" name="modify_nome" value="'. htmlspecialchars($project['nome']). '" required>';
        echo '<br>';
        echo '<label for="modify_progetto_img">URL immagine progetto:</label>';
        echo '<input type="text" id="modify_progetto_img" name="modify_progetto_img" value="'. htmlspecialchars($project['progetto_img']). '" required>';
        echo '<br>';
        echo '<label for="modify_progetto_title">Titolo progetto:</label>';
        echo '<input type="text" id="modify_progetto_title" name="modify_progetto_title" value="'. htmlspecialchars($project['progetto_title']). '" required>';
        echo '<label for="modify_descrizione">Descrizione Progetto:</label>';
        echo '<input type="text" id="modify_descrizione" name="modify_descrizione" value="'. htmlspecialchars($project['descrizione']). '" required>';
        echo '<br>';
        echo '<br>';
        echo '<input type="hidden" name="modify_project_id" value="'. $projectId. '">';
        echo '<input type="submit" value="Modifica">';
        echo '</div>';
        echo '</form>';

        // Display the cancel form
        echo '<form id="cancel-form" method="post" style="display:none;">';
        echo '<input type="hidden" name="id" value="'. $projectId. '">';
        echo '<input type="submit" value="Cancella">';
        echo '</form>';
    }
  ?>


    <form id="insert-form" method="post" style="display:none;">
    <div class="background">
    <div class="titolo">
        <h1>Crea Nuovo Progetto</h1></div>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <label for="progetto_img">URL immagine Progetto:</label>
        <input type="text" id="progetto_img" name="progetto_img" required>
        <br>
        <label for="progetto_title">Titolo Progetto:</label>
        <input type="text" id="progetto_title" name="progetto_title" required>
        <label for="descrizione">Descrizione Progetto:</label>
        <input type="text" id="descrizione" name="descrizione" required>
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
            alert('Seleziona un progetto per modificarlo');
        }
    });

    cancelButton.addEventListener('click', () => {
        if (confirm('Sei sicuro di voler cancellare questo progetto?')) {
            cancelForm.submit();
        }
    });

    // Add client-side validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', (e) => {
            const nome = form.nome.value.trim();
            const progetto_img = form.progetto_img.value.trim();
            const progetto_title = form.progetto_title.value.trim();
            const descrizione = form.descrizione.value.trim();

            if (nome === '' || progetto_img === '' || progetto_title === '' || descrizione === '') {
                alert('Tutti i campi sono obbligatori');
                e.preventDefault();
            }
        });
    });
</script>
</main>
    <!-- FOOTER -->
    <?php
    echo generateFooter();
?>
</body>


</html>