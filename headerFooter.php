<?php
require_once("dati.php");
function generateHeader() {
    $html = '
    <nav>
    <div class="nav-bar2">
    <input type="checkbox" id="check">
    <div class="menu">
    <ul class="nav-bar">
    <li class="logo"><a href="./index.php"><img src="./immagini/verologo.jpg" alt="logo"></a></li>
                <li><a href="./index.php">HOME PAGE</a></li>
                <li><a href="./chiSiamo.php">CHI SIAMO?</a></li>
                <li><a href="./elencoPortfolio.php">PORTFOLIO</a></li>
                <li><a href="./contatti.php">CONTATTI</a></li>
                <li><a href="./login.php">LOGIN</a></li>
                </ul>
                <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
            </div>
            <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
    </div>
            </nav>
    ';

    return $html;
}
function generateHeader2() {
    $html = '
    <nav>
    <div class="nav-bar2">
    <input type="checkbox" id="check">
    <div class="menu">
    <ul class="nav-bar">
    <li class="logo"><a href="./areaRiservata1.php"><img src="./immagini/verologo.jpg" alt="logo"></a></li>
    ';

    // Connect to database using PDO
    try {
        // Create a PDO instance
        $pdo = new PDO("mysql:host=". INDIRIZZO. ";dbname=". DB, UTENTE, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: ". $e->getMessage();
        exit();
    }
    // Query to retrieve data from sezioni table
    $stmt = $pdo->prepare("SELECT * FROM Sql1794998_1.sezioni WHERE cancellato = 0");
    $stmt->execute();

    // Display data
    while ($row = $stmt->fetch()) {
        $html .= '<li><a href="' . $row['link'] . '">' . $row['titolo_link'] . '</a></li>';
    }

    $html .= '
                <li><a href="./login.php">LOGOUT</a></li>
                </ul>
                <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
            </div>
            <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
    </div>
            </nav>
    ';

    // Close database connection
    $pdo = null;

    return $html;
}


function generateFooter() {
    $html = '
    <footer class="footer">
        <div class="rigaFooter">
            <div class="colonnaFooter">
            <ul>
            <li>
                <p>vienici a trovare in:</p>
                <address>
                Via di casa, 1<br>58100 Grosseto (GR)<br> Italia
                </address>
            </li>
        </ul>
        </div>
        <div class="colonnaFooter">
            <ul>
                <li>
                    <p>Contattaci:</p>
                    <address>
                        <ul>
                            <li>
                                <a href="mailto:miosito@gmail.com" title="scrivici una mail">miosito@gmail.com</a>
                            </li>
                            <li>
                                <a href="tel:1234567890" title="Telefonaci">+39 1234567890</a>
                            </li>
                        </ul>
                    </address>
                </li>
            </ul>
        </div>
        </div>
    </footer>
    ';

    return $html;
}

?>