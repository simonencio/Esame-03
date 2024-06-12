<?php
require_once("headerFooter.php");
require_once("dati.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Portfolio</title>
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
            <h1>Modifica Portfolio</h1>
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
    if (isset($_POST['nome']) && isset($_POST['elenco_image_url']) && isset($_POST['elenco_image_title'])) {
        $nome = $_POST['nome'];
        $elenco_image_url = $_POST['elenco_image_url'];
        $elenco_image_title = $_POST['elenco_image_title'];
        

        // Insert the new project into the database
        $sql = 'INSERT INTO Sql1794998_1.portfolio (nome, elenco_image_url, elenco_image_title, cancellato) VALUES (:nome, :elenco_image_url, :elenco_image_title, 0)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':elenco_image_url', $elenco_image_url);
        $stmt->bindParam(':elenco_image_title', $elenco_image_title);
        $stmt->execute();

        // Display a confirmation message
        echo '<div class="message"><div class="background2"><p>Progetto inserito nel portfolio con successo!</p></div></div>';

        // Hide the insert form
        echo '<script>document.getElementById("insert-form").style.display = "none";</script>';
    }

    // Handle the modify form submission
    if (isset($_POST['modify_nome']) && isset($_POST['modify_elenco_image_url']) && isset($_POST['modify_elenco_image_title']) && isset($_POST['modify_project_id'])) {
        $modify_nome = $_POST['modify_nome'];
        $modify_elenco_image_url = $_POST['modify_elenco_image_url'];
        $modify_elenco_image_title = $_POST['modify_elenco_image_title'];
        $modify_project_id = $_POST['modify_project_id'];

        // Update the project in the database
        $sql = 'UPDATE Sql1794998_1.portfolio SET nome = :nome, elenco_image_url = :elenco_image_url, elenco_image_title = :elenco_image_title WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $modify_nome);
        $stmt->bindParam(':elenco_image_url', $modify_elenco_image_url);
        $stmt->bindParam(':elenco_image_title', $modify_elenco_image_title);
        $stmt->bindParam(':id', $modify_project_id);
        $stmt->execute();

        // Display a confirmation message
        echo '<div class="message"><div class="background2"><p>Progetto modificato nel portfolio con successo!</p></div></div>';

        // Hide the modify form
        echo '<script>document.getElementById("modify-form").style.display = "none";</script>';
    }

    // Handlethe cancel button click
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Update the project's cancellato value to 1
        $sql = 'UPDATE Sql1794998_1.portfolio SET cancellato = 1 WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Display a confirmation message
        echo '<div class="message"><div class="background2"><p>Progetto cancellato dal portfolio con successo!</p></div></div>';

        // Hide the cancel form
        echo '<script>document.getElementById("cancel-form").style.display = "none";</script>';
    }

    // Retrieve the list of projects
    $sql = 'SELECT * FROM Sql1794998_1.portfolio WHERE cancellato = 0';
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
        $sql = 'SELECT * FROM Sql1794998_1.portfolio WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $projectId);
        $stmt->execute();
        $project = $stmt->fetch(PDO::FETCH_ASSOC);

        // Display the project details
        echo '<div class="details"><div class="background2"><h2>'. htmlspecialchars($project['nome']). '</h2>';
        echo "<h3>URL dell'immagine:</h3><p>". htmlspecialchars($project['elenco_image_url']). '</p>';
        echo "<h3>Titolo dell'immagine portfolio:</h3><p>". htmlspecialchars($project['elenco_image_title']). '</p>
        <div class="buttons"><button id="insert-button">Inserisci</button>
    <button id="modify-button">Modifica</button>
    <button id="cancel-button">Cancella</button></div></div></div>';

        // Display the modify form
        echo '<form id="modify-form" method="post" style="display:none;">
        <div class="background2">
        <div class="titolo">
        <h1>Modifica dati portfolio</h1></div>
        <label for="modify_nome">Nome:</label>
        <input type="text" id="modify_nome" name="modify_nome" value="'. htmlspecialchars($project['nome']). '" required>';
        echo '<br>';
        echo '<label for="modify_elenco_image_url">URL immagine per il portfolio:</label>
        <input type="text" id="modify_elenco_image_url" name="modify_elenco_image_url" value="'. htmlspecialchars($project['elenco_image_url']). '" required>';
        echo '<br>';
        echo '<label for="modify_elenco_image_title">Titolo per il portfolio:</label>
        <input type="text" id="modify_elenco_image_title" name="modify_elenco_image_title" value="'. htmlspecialchars($project['elenco_image_title']). '" required>';
        echo '<br>';
        echo '<br>';
        echo '<input type="hidden" name="modify_project_id" value="'. $projectId. '">
        <input type="submit" value="Modifica"></div>
        </form>';

        // Display the cancel form
        echo '<form id="cancel-form" method="post" style="display:none;">
        <input type="hidden" name="id" value="'. $projectId. '">
        <input type="submit" value="Cancella">
        </form>';
    }
   ?>

    <form id="insert-form" method="post" style="display:none;">
    <div class="background2">
        <div class="titolo">
    <h1>Inserisci nuovo progetto nel portfolio</h1>
        </div>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <label for="elenco_image_url">URL immagine per il portfolio:</label>
        <input type="text" id="elenco_image_url" name="elenco_image_url" required>
        <br>
        <label for="elenco_image_title">Titolo per il portfolio:</label>
        <input type="text" id="elenco_image_title" name="elenco_image_title" required>
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

    // Add client-side validation for the insert form
    insertForm.addEventListener('submit', (event) => {
        const nome = document.getElementById('nome');
        const elenco_image_url = document.getElementById('elenco_image_url');
        const elenco_image_title = document.getElementById('elenco_image_title');

        if (!nome.checkValidity()) {
            event.preventDefault();
            nome.reportValidity();
        }

        if (!elenco_image_url.checkValidity()) {
            event.preventDefault();
            elenco_image_url.reportValidity();
        }

        if (!elenco_image_title.checkValidity()) {
            event.preventDefault();
            elenco_image_title.reportValidity();
        }
    });

    // Add client-side validation for the modify form
    modifyForm.addEventListener('submit', (event) => {
        const modify_nome = document.getElementById('modify_nome');
        const modify_elenco_image_url = document.getElementById('modify_elenco_image_url');
        const modify_elenco_image_title = document.getElementById('modify_elenco_image_title');

        if (!modify_nome.checkValidity()) {
            event.preventDefault();
            modify_nome.reportValidity();
        }

        if (!modify_elenco_image_url.checkValidity()) {
            event.preventDefault();
            modify_elenco_image_url.reportValidity();
        }

        if (!modify_elenco_image_title.checkValidity()) {
            event.preventDefault();
            modify_elenco_image_title.reportValidity();
        }
    });

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
        if (<?php echo $projectId > 0 ? 'true' : 'false'; ?>) {
            closeAllForms();
            modifyForm.style.display = 'flex';
        } else {
            alert('Seleziona un progettoper modificarlo');
        }
    });

    cancelButton.addEventListener('click', () => {
        if (confirm('Sei sicuro di voler cancellare questo progetto?')) {
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