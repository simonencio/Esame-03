<?php
require_once("headerFooter.php");
require_once("dati.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./CSS5/all.min.css">
    <link rel="stylesheet" href="./CSS5/login.min.css">
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
    <h1>Login</h1>
</div>
</header>
<main>
<?php
try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=". INDIRIZZO. ";dbname=". DB, UTENTE, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the login form has been submitted
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare the query to check if username and password exist in database
        $query = "SELECT * FROM Sql1794998_1.users WHERE username=:username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Check if the query returned any rows
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();

            // Check if the user is cancelled
            if ($user['cancellato'] == 1) {
                $error = 'Utente Cancellato';
            } elseif (password_verify($password, $user['psw'])) {
                // Login successful, start session and redirect to areaRiservata1.php
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header('Location: areaRiservata1.php');
                exit;
            } else {
                // Invalid password
                $error = 'Invalid password';
            }
        } else {
            // User not found
            $error = 'User not found';
        }
    }
} catch (PDOException $e) {
    echo "<br><br>Error: ". $e->getMessage();
    die();
}

// Close connection
$pdo = null;
?>

<!-- Login form -->
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="login-form">
<fieldset>
    <div class="login">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <?php if (isset($error)) { echo '<p>'. $error. '</p>'; }?>
    <div>
        <button type="reset" title="clicca per annullare" class="bottone">Annulla</button>
        <input type="submit" name="login" value="Login" class="bottone">
      </div>
    
    </div>
    </fieldset>
</form>

<script>
    const form = document.getElementById('login-form');
    form.addEventListener('submit', (e) => {
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        if (username === '' || password === '') {
            alert('Please fill in both username and password');
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