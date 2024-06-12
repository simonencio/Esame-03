<?php
require_once("headerFooter.php");
require_once("dati.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Sezioni</title>
    <link rel="stylesheet" href="./CSS5/all.min.css">
    <link rel="stylesheet" href="./CSS5/sezioni.min.css">
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
            <h1>Modifica Sezioni</h1>
        </div>
    </header>
    <main>
    <div class="title">
            <h1>Seleziona una sezione</h1>
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
    if (isset($_POST['titolo_link']) && isset($_POST['link']) && isset($_POST['img']) && isset($_POST['title_img'])) {
        $titolo_link = $_POST['titolo_link'];
        $link = $_POST['link'];
        $img = $_POST['img'];
        $title_img = $_POST['title_img'];
        

        // Insert the new project into the database
        $sql = 'INSERT INTO Sql1794998_1.sezioni (titolo_link, link, img, title_img, cancellato) VALUES (:titolo_link, :link, :img, :title_img, 0)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':titolo_link', $titolo_link);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':img', $img);
        $stmt->bindParam(':title_img', $title_img);
        
        $stmt->execute();

        // Display a confirmation message
        echo '<div class="message"><div class="background"><p>Sezione inserita con successo!</p></div></div>';

        // Hide the insert form
        echo '<script>document.getElementById("insert-form").style.display = "none";</script>';
    }

    // Handle the modify form submission
    if (isset($_POST['modify_titolo_link']) && isset($_POST['modify_link']) && isset($_POST['modify_img']) && isset($_POST['modify_title_img']) && isset($_POST['modify_project_id'])) {
        $modify_titolo_link = $_POST['modify_titolo_link'];
        $modify_link = $_POST['modify_link'];
        $modify_img = $_POST['modify_img'];
        $modify_title_img = $_POST['modify_title_img'];
        $modify_project_id = $_POST['modify_project_id'];

        // Update the project in the database
        $sql = 'UPDATE Sql1794998_1.sezioni SET titolo_link = :titolo_link, link = :link, img = :img, title_img = :title_img WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':titolo_link', $modify_titolo_link);
        $stmt->bindParam(':link', $modify_link);
        $stmt->bindParam(':img', $modify_img);
        $stmt->bindParam(':title_img', $modify_title_img);
        $stmt->bindParam(':id', $modify_project_id);
        $stmt->execute();

        // Display a confirmation message
        echo '<div class="message"><div class="background"><p>Sezione modificata con successo!</p></div></div>';

        // Hide the modify form
        echo'<script>document.getElementById("modify-form").style.display = "none";</script>';
    }

    // Handle the cancel button click
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Update the project's cancellato value to 1
        $sql = 'UPDATE Sql1794998_1.sezioni SET cancellato = 1 WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Display a confirmation message
        echo '<div class="message"><div class="background"><p>Sezione cancellata con successo!</p></div></div>';

        // Hide the cancel form
        echo '<script>document.getElementById("cancel-form").style.display = "none";</script>';
    }

    // Retrieve the list of projects
    $sql = 'SELECT * FROM Sql1794998_1.sezioni WHERE cancellato = 0';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the project list
    echo '<ul class="lista">';
    foreach ($projects as $project) {
        echo '<li><button class="project-button" data-project-id="'. $project['id']. '">'. htmlspecialchars($project['titolo_link']). '</button></li>';
   }
    echo '</ul>';

    // Display the selected project's details if an ID is provided
    if ($projectId > 0) {
        $sql = 'SELECT * FROM Sql1794998_1.sezioni WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $projectId);
        $stmt->execute();
        $project = $stmt->fetch(PDO::FETCH_ASSOC);

        // Display the project details
       
        echo '<div class="details"><div class="background2"><h2>'. htmlspecialchars($project['titolo_link']). '</h2>';
        echo "<h3>Link:</h3><p>". htmlspecialchars($project['link']). '</p>';
        echo "<h3>Link Immagine:</h3><p>". htmlspecialchars($project['img']). '</p>';
        echo "<h3>Titolo Sezione:</h3><p>". htmlspecialchars($project['title_img']). '</p>
        <div class="buttons"><button id="insert-button">Inserisci</button>
    <button id="modify-button">Modifica</button>
    <button id="cancel-button">Cancella</button></div></div></div>';
        
        // Display the modify form
        echo '<form id="modify-form" method="post" style="display:none;">
        <div class="background">
        <div class="titolo"><h1>Modifica Sezione</h1></div>
        <label for="modify_titolo_link">Titolo Link:</label>
        <input type="text" id="modify_titolo_link" name="modify_titolo_link" value="'. htmlspecialchars($project['titolo_link']). '" required>
        <br>
        <span class="error" id="modify_titolo_link_error"></span>
        <label for="modify_link">Link:</label>
        <input type="text" id="modify_link" name="modify_link" value="'. htmlspecialchars($project['link']). '" required>
        <br>
        <span class="error" id="modify_link_error"></span>
        <label for="modify_img">Link Immagine:</label>
        <input type="text" id="modify_img" name="modify_img" value="'. htmlspecialchars($project['img']). '" required>
        <label for="modify_title_img">Titolo Sezione:</label>
        <input type="text" id="modify_title_img" name="modify_title_img" value="'. htmlspecialchars($project['title_img']).'" required>
        <br>
        <br>
        <input type="hidden" name="modify_project_id" value="'. $projectId. '">
        <input type="submit" value="Modifica">
        </div>
        </form>';

        // Display the cancel form
        echo '<form id="cancel-form" method="post" style="display:none;">
        <input type="hidden" name="id" value="'. $projectId. '">
        <input type="submit" value="Cancella">
        </form>';
    }
  ?>


    <form id="insert-form" method="post" style="display:none;">
    <div class="background">
    <div class="titolo"><h1>Crea Nuova Sezione</h1></div>
        <label for="titolo_link">Titolo Link:</label>
        <input type="text" id="titolo_link" name="titolo_link" required>
        <br>
        <span class="error" id="titolo_link_error"></span>
        <label for="link">Link:</label>
        <input type="text" id="link" name="link" required>
        <br>
        <span class="error" id="link_error"></span>
        <label for="img">Link Immagine:</label>
        <input type="text" id="img" name="img" required>
        <label for="title_img">Titolo Sezione:</label>
        <input type="text" id="title_img" name="title_img" required>
        <br>
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
            alert('Seleziona una sezione per modificarlo');
        }
    });

    cancelButton.addEventListener('click', () => {
        if (confirm('Sei sicuro di voler cancellare questa sezione?')) {
            cancelForm.submit();
        }
    });

    // Client-side validation for the insert form
    const insertFormInputs = insertForm.querySelectorAll('input');
    insertForm.addEventListener('submit', (e) => {
        let isValid = true;
        insertFormInputs.forEach(input => {
            if (input.value.trim() === '') {
                isValid = false;
                input.nextElementSibling.textContent = 'Campo obbligatorio';
            } else {
                input.nextElementSibling.textContent = '';
            }
        });
        if (!isValid) {
            e.preventDefault();
        }
    });

    // Client-side validation for the modify form
    const modifyFormInputs = modifyForm.querySelectorAll('input');
    modifyForm.addEventListener('submit', (e) => {
        let isValid = true;
        modifyFormInputs.forEach(input => {
            if (input.value.trim() === '') {
                isValid = false;
                input.nextElementSibling.textContent = 'Campo obbligatorio';
            } else {
                input.nextElementSibling.textContent = '';
            }
        });
        if (!isValid) {
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