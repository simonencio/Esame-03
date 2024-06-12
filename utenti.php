<?php
require_once("headerFooter.php");
require_once("dati.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Utenti</title>
    <link rel="stylesheet" href="./CSS5/all.min.css">
    <link rel="stylesheet" href="./CSS5/utenti.min.css">
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
    <h1>Modifica Utenti</h1>
</div>
</header>
<main>
<?php
session_start();

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=". INDIRIZZO. ";dbname=". DB, UTENTE, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form has been submitted
    if (isset($_POST['Registra'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Hash the password using bcrypt
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare the query to insert the new user
        $query = "INSERT INTO Sql1794998_1.users (username, psw, cancellato) VALUES (:username, :password, 0)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();

        $_SESSION['message'] = 'Utente creato con successo!';
        header('Location: '.$_SERVER['PHP_SELF']);
        exit;
    }

    // Check if the cancel button has been clicked
    if (isset($_POST['Cancella'])) {
        $username = $_POST['username_to_cancel'];

        // Prepare the query to update the user's cancellato field
        $query = "UPDATE Sql1794998_1.users SET cancellato = 1 WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $_SESSION['message'] = 'Utente cancellato con successo!';
        header('Location: '.$_SERVER['PHP_SELF']);
        exit;
    }
} catch (PDOException $e) {
    echo "<br><br>Error: ". $e->getMessage();
    die();
}

// Close connection
$pdo = null;
?>

<!-- Login form -->
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="insert-form">
<fieldset>
<?php if (isset($_SESSION['message'])) { echo '<p style="color: green;">'.$_SESSION['message'].'</p>'; unset($_SESSION['message']); }?>
<div class="login">
        <h2>Crea Nuovo Utente</h2><br>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    
    <div>
        <button type="reset" title="clicca per annullare" class="bottone">Annulla</button>
        <input type="submit" name="Registra" value="Registra" class="bottone"><br><br>
        </div>
    </div>
    </fieldset>
</form>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="cancel-form">
<fieldset>
<div class="login">
<h2>Elimina Utente</h2><br>
<label for="username_to_cancel">Seleziona utente da cancellare:</label>
        <select id="username_to_cancel" name="username_to_cancel">
            <?php
            try {
                $pdo = new PDO("mysql:host=". INDIRIZZO. ";dbname=". DB, UTENTE, PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Prepare the query to select all users with cancellato = 0
                $query = "SELECT * FROM Sql1794998_1.users WHERE cancellato = 0";
                $stmt = $pdo->prepare($query);
                $stmt->execute();

                // Loop through the results and display each user as an option
                while($user = $stmt->fetch()) {
                    echo '<option value="'.$user['username'].'">'.$user['username'].'</option>';
                }
            } catch (PDOException $e) {
                echo "<br><br>Error: ". $e->getMessage();
                die();
            }
          ?>
        </select>
        <button type="submit" name="Cancella" value="Cancella" class="bottone">Cancella</button>
        </div>
    </fieldset>
</form>
<script>
    const form = document.getElementById('insert-form');

    form.addEventListener('submit', (e) => {
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        if (username === '' || password === '') {
            alert('Inserisci username e password!');
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