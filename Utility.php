<?php
namespace MieClassi;
$counter = 0;
/**
 * questa classe contiene tutti i metodi utili
 * @author Mario Rossi
 * @copyright 2022
 * @license LGPL
 * @version 1.0.0
 */

class Utility
{
    public static function getProjectById($id) {
        $file = "progetti.json";
        $arr = json_decode(self::leggiTesto($file), true);
        return $arr[$id - 1];
    }
    /**
     * funzione per leggere del testo in un file
     * 
     * @param string $file Nome del file
     * @return boolean|string
     * 
     */
    public static function leggiTesto($file)
    {
        $rit = false;
        if (!$fp = fopen($file, 'r')) {
            echo "non posso aprire il file $file<br>";
        } else {
            if (is_readable($file) === false) {
                echo " il file $file non è leggibile<br>";
            } else {
                $rit = fread($fp, filesize($file));
            }
        }
        fclose($fp);
        return $rit;
    }
    /**
     * funzione per estrarre dal $_POST o dal $_GET la proprieta richiesta
     * 
     * @param string proprieta da ricercare 
     * @return string|null
     * 
     */
    public static function richiestaHTTP($str)
    {
        $rit = null;
        if ($str !== null) {
            if (isset($_POST[$str])) {
                $rit = $_POST[$str];
            } elseif (isset($_GET[$str])) {
                $rit = $_GET[$str];
            }
        }
        return $rit;
    }
}