<?php
require_once("headerFooter.php");
require_once("dati.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Recapiti</title>
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
            <h1>Modifica Recapiti</h1>
        </div>
    </header>
    <main>
    <div class="title">
            <h1>Seleziona un Recapito</h1>
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
    if (isset($_POST['nome']) && isset($_POST['indirizzo']) && isset($_POST['email']) && isset($_POST['telefono'])) {
        $nome = $_POST['nome'];
        $indirizzo = $_POST['indirizzo'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        

        // Insert the new project into the database
        $sql = 'INSERT INTO Sql1794998_1.recapiti (nome, indirizzo, email, telefono, cancellato) VALUES (:nome, :indirizzo, :email, :telefono, 0)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':indirizzo', $indirizzo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        
        $stmt->execute();

        // Display a confirmation message
        echo '<div class="message"><div class="background"><p>Recapito inserito con successo!</p></div></div>';

        // Hide the insert form
        echo '<script>document.getElementById("insert-form").style.display = "none";</script>';
    }

    // Handle the modify form submission
    if (isset($_POST['modify_nome']) && isset($_POST['modify_indirizzo']) && isset($_POST['modify_email']) && isset($_POST['modify_telefono']) && isset($_POST['modify_project_id'])) {
        $modify_nome = $_POST['modify_nome'];
        $modify_indirizzo = $_POST['modify_indirizzo'];
        $modify_email = $_POST['modify_email'];
        $modify_telefono = $_POST['modify_telefono'];
        $modify_project_id = $_POST['modify_project_id'];

        // Update the project in the database
        $sql = 'UPDATE Sql1794998_1.recapiti SET nome = :nome, indirizzo = :indirizzo, email = :email, telefono = :telefono WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $modify_nome);
        $stmt->bindParam(':indirizzo', $modify_indirizzo);
        $stmt->bindParam(':email', $modify_email);
        $stmt->bindParam(':telefono', $modify_telefono);
        $stmt->bindParam(':id', $modify_project_id);
        $stmt->execute();

        // Display a confirmation message
        echo '<div class="message"><div class="background"><p>Recapito modificato con successo!</p></div></div>';

        // Hide the modify form
        echo '<script>document.getElementById("modify-form").style.display = "none";</script>';
    }

    // Handle the cancel button click
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Update the project's cancellato value to 1
        $sql = 'UPDATE Sql1794998_1.recapiti SET cancellato = 1 WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Display a confirmation message
        echo '<div class="message"><div class="background"><p>Recapito cancellato con successo!</p></div></div>';

        // Hide the cancel form
        echo '<script>document.getElementById("cancel-form").style.display = "none";</script>';
    }

    // Retrieve the list of projects
    $sql = 'SELECT * FROM Sql1794998_1.recapiti WHERE cancellato = 0';
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
        $sql = 'SELECT * FROM Sql1794998_1.recapiti WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $projectId);
        $stmt->execute();
        $project = $stmt->fetch(PDO::FETCH_ASSOC);

        // Display the project details
       
        echo '<div class="details"><div class="background2"><h2>'. htmlspecialchars($project['nome']). '</h2>';
        echo "<h3>Indirizzo:</h3><p>". htmlspecialchars($project['indirizzo']). '</p>';
        echo "<h3>Email:</h3><p>". htmlspecialchars($project['email']). '</p>';
        echo "<h3>Telefono:</h3><p>". htmlspecialchars($project['telefono']). '</p>
        <div class="buttons"><button id="insert-button">Inserisci</button>
    <button id="modify-button">Modifica</button>
    <button id="cancel-button">Cancella</button></div></div></div>';
        
        // Display the modify form
        echo '<form id="modify-form" method="post" style="display:none;">';
        echo '<input type="hidden" name="modify_project_id" value="'. $projectId. '">';
        echo '<div class="background">';
        echo '<div class="titolo">
        <h1>Modifica Recapito</h1></div>';
        echo '<label for="modify_nome">Nome:</label>';
        echo '<input type="text" id="modify_nome" name="modify_nome" value="'. htmlspecialchars($project['nome']). '" required>';
        echo '<br>';
        echo '<label for="modify_indirizzo">Indirizzo:</label>';
        echo '<input type="text" id="modify_indirizzo" name="modify_indirizzo" value="'. htmlspecialchars($project['indirizzo']). '" required>';
        echo '<br>';
        echo '<label for="modify_email">Email:</label>';
        echo '<input type="email" id="modify_email" name="modify_email" value="'. htmlspecialchars($project['email']). '" required>';
        echo '<label for="modify_telefono">Telefono:</label>';
        echo '<input type="tel" id="modify_telefono" name="modify_telefono" pattern="[0-9]*" title="Inserisci solo numeri" value="'. htmlspecialchars($project['telefono']). '" required>';
        echo '<br>';
        echo '<br>';
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
    <div class="background">
    <div class="titolo"><h1>Crea Nuovo Recapito</h1></div>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <label for="indirizzo">Indirizzo:</label>
        <input type="text" id="indirizzo" name="indirizzo" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="telefono">Telefono:</label>
        <input type="tel" id="telefono" name="telefono" pattern="[0-9]*" title="Inserisci solo numeri" required>
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
            alert('Seleziona un recapito per modificarlo');
        }
    });

    cancelButton.addEventListener('click', () => {
        if (confirm('Sei sicuro di voler cancellare questo recapito?')) {
            cancelForm.submit();
        }
    });

    // Add client-side validation to the insert form
    const insertFormInputs = insertForm.querySelectorAll('input');
    insertForm.addEventListener('submit', (e) => {
        let isValid = true;
        insertFormInputs.forEach(input => {
            if (input.value.trim() === '') {
                isValid = false;
                input.style.border = '1px solid red';
            } else {
                input.style.border = '1px solid green';
            }
        });
        if (!isValid) {
            e.preventDefault();
            alert('Inserisci tutti i campi richiesti');
        }
    });

    // Add client-side validation to the modify form
    const modifyFormInputs = modifyForm.querySelectorAll('input');
    modifyForm.addEventListener('submit', (e) => {
        let isValid = true;
        modifyFormInputs.forEach(input => {
            if (input.value.trim() === '') {
                isValid = false;
                input.style.border = '1px solid red';
            } else {
                input.style.border = '1px solid green';
            }
        });
        if (!isValid) {
            e.preventDefault();
            alert('Inserisci tutti i campi richiesti');
        }
    });

    // Prevent non-numeric characters from being entered into the telefono input
    const telefonoInput = document.getElementById('telefono');
    const modifyTelefonoInput = document.getElementById('modify_telefono');

    telefonoInput.addEventListener('keydown', (e) => {
  if (e.keyCode!== 8 &&!/\d/.test(e.key)) {
    e.preventDefault();
  }
});

modifyTelefonoInput.addEventListener('keydown', (e) => {
  if (e.keyCode!== 8 &&!/\d/.test(e.key)) {
    e.preventDefault();
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