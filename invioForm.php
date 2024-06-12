<?php
require_once("dati.php");
try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=". INDIRIZZO. ";dbname=". DB, UTENTE, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: ". $e->getMessage();
    exit();
}

// Get the form data
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['email'];
$trattamentodatipersonali = $_POST['trattamentodatipersonali'];
$messaggio = $_POST['messaggio'];

// Insert the data into the dati_clienti table
$sql = "INSERT INTO Sql1794998_2.dati_clienti (nome, cognome, email, dati_personali, messaggio, cancellato)
VALUES (:nome, :cognome, :email, :trattamentodatipersonali, :messaggio, 0)";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':cognome', $cognome);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':trattamentodatipersonali', $trattamentodatipersonali);
$stmt->bindParam(':messaggio', $messaggio);

if ($stmt->execute()) {
    // New record created successfully, redirect to contatti.php with a success message
    header('Location: contatti.php?success=true');
    exit;
} else {
    // Error occurred, redirect to contatti.php with an error message
    header('Location: contatti.php?error=true');
    exit;
}

// Close the database connection
$pdo = null;
?>