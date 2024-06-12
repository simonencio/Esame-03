<?php
require_once("headerFooter.php");
require_once("dati.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Social</title>
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
            <h1>Modifica Social</h1>
        </div>
    </header>
    <main>
<div class="title">
            <h1>Seleziona un Social</h1>
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
    if (isset($_POST['social']) && isset($_POST['link']) && isset($_POST['title'])) {
        $social = $_POST['social'];
        $link = $_POST['link'];
        $title = $_POST['title'];
        
        

        // Insert the new project into the database
        $sql = 'INSERT INTO Sql1794998_1.social (social, link, title, cancellato) VALUES (:social, :link, :title, 0)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':social', $social);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':title', $title);
        
        
        $stmt->execute();

        // Display a confirmation message
        echo '<div class="message"><div class="background"><p>Social inserito con successo!</p></div></div>';

        // Hide the insert form
        echo '<script>document.getElementById("insert-form").style.display = "none";</script>';
    }

    // Handle the modify form submission
    if (isset($_POST['modify_social']) && isset($_POST['modify_link']) && isset($_POST['modify_title']) && isset($_POST['modify_project_id'])) {
        $modify_social = $_POST['modify_social'];
        $modify_link = $_POST['modify_link'];
        $modify_title = $_POST['modify_title'];
        
        $modify_project_id = $_POST['modify_project_id'];

        // Update the project in the database
        $sql = 'UPDATE Sql1794998_1.social SET social = :social, link = :link, title = :title WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':social', $modify_social);
        $stmt->bindParam(':link', $modify_link);
        $stmt->bindParam(':title', $modify_title);
        $stmt->bindParam(':id', $modify_project_id);
        $stmt->execute();

        // Display a confirmation message
        echo '<div class="message"><div class="background"><p>social modificato con successo!</p></div></div>';

        // Hide the modify form
        echo '<script>document.getElementById("modify-form").style.display = "none";</script>';
    }

    // Handle the cancel button click
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Update the project's cancellato value to 1
        $sql = 'UPDATE Sql1794998_1.social SET cancellato = 1 WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Display a confirmation message
       echo '<div class="message"><div class="background"><p>Social cancellato con successo!</p></div></div>';

        // Hide the cancel form
        echo '<script>document.getElementById("cancel-form").style.display = "none";</script>';
    }

    // Retrieve the list of projects
    $sql = 'SELECT * FROM Sql1794998_1.social WHERE cancellato = 0';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the project list
    echo '<ul class="lista">';
    foreach ($projects as $project) {
        echo '<li><button class="project-button" data-project-id="'. $project['id']. '">'. htmlspecialchars($project['social']). '</button></li>';
   }
    echo '</ul>';

    // Display the selected project's details if an ID is provided
    if ($projectId > 0) {
        $sql = 'SELECT * FROM Sql1794998_1.social WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $projectId);
        $stmt->execute();
        $project = $stmt->fetch(PDO::FETCH_ASSOC);

        // Display the project details
       
        echo '<div class="details"><div class="background2"><h2>'. htmlspecialchars($project['social']). '</h2>';
        echo "<h3>Collegamento al social:</h3><p>". htmlspecialchars($project['link']). '</p>';
        echo "<h3>Titolo:</h3><p>". htmlspecialchars($project['title']). '</p>
        <div class="buttons"><button id="insert-button">Inserisci</button>
    <button id="modify-button">Modifica</button>
    <button id="cancel-button">Cancella</button></div></div></div>';
        
        // Display the modify form
        echo '<form id="modify-form" method="post" style="display:none;">';
        echo '<input type="hidden" name="modify_project_id" value="'. $projectId. '">';
        echo '<div class="background">';
        echo '<div class="titolo"><h1>Modifica Social</h1></div>';
        echo '<label for="modify_social">Nome:</label>';
        echo '<input type="text" id="modify_social" name="modify_social" value="'. htmlspecialchars($project['social']). '" required>';
        echo '<span id="modify_social_error" class="error"></span><br>';
        echo '<label for="modify_link">Collegamento al social:</label>';
        echo '<input type="text" id="modify_link" name="modify_link" value="'. htmlspecialchars($project['link']). '" required>';
        echo '<span id="modify_link_error" class="error"></span><br>';
        echo '<label for="modify_title">Titolo:</label>';
        echo '<input type="text" id="modify_title" name="modify_title" value="'. htmlspecialchars($project['title']). '" required>';
        echo '<span id="modify_title_error" class="error"></span><br>';
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
    <div class="titolo"><h1>Crea Nuovo Social</h1></div>
        <label for="social">Nome:</label>
        <input type="text" id="social" name="social" required>
        <span id="social_error" class="error"></span><br>
        <label for="link">Collegamento al social:</label>
        <input type="text" id="link" name="link" required>
        <span id="link_error" class="error"></span><br>
        <label for="title">Titolo:</label>
        <input type="text" id="title" name="title" required>
        <span id="title_error" class="error"></span><br>
        <input type="submit" value="Inserisci">
        </div>
    </form>

    <script>
   

    const projectButtons2 = document.querySelectorAll('.project-button');
    const insertButton2 = document.getElementById('insert-button');
    const modifyButton2 = document.getElementById('modify-button');
    const cancelButton2 = document.getElementById('cancel-button');
    const insertForm2 = document.getElementById('insert-form');
    const modifyForm2 = document.getElementById('modify-form');
    const cancelForm2 = document.getElementById('cancel-form');

    projectButtons2.forEach(button => {
        button.addEventListener('click', () => {
            const projectId = button.dataset.projectId;
            window.location.href = `?id=${projectId}`;
        });
    });

    function closeAllForms() {
        insertForm2.style.display = 'none';
        modifyForm2.style.display = 'none';
        cancelForm2.style.display = 'none';
    }

    insertButton2.addEventListener('click', () => {
        closeAllForms();
        insertForm2.style.display = 'flex';
    });

    modifyButton2.addEventListener('click', () => {
        if (<?php echo $projectId > 0? 'true' : 'false';?>) {
            closeAllForms();
            modifyForm2.style.display = 'flex';
        } else {
            alert('Seleziona un social per modificarlo');
        }
    });

    cancelButton2.addEventListener('click', () => {
        if (confirm('Sei sicuro di voler cancellare questo social?')) {
            cancelForm2.submit();
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