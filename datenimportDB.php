<?php
require 'vendor/autoload.php';
require_once "config.php";



//Verbindung zur Datenbank herstellen
try {
    $verbindung = new PDO("sqlsrv:host=$host;Database =$datenbankname", $benutzername, $passwort);
    $verbindung->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Daten aus html abrufen

    $applikation = $_POST ['applikation'];
    $anzahlAccounts = $_POST ['anzahl_accounts'];

     // SQL-Abfrage vorbereiten und Daten einfügen
     $abfrage = $verbindung->prepare('INSERT INTO auswertung_fragebogen (applikation, anzahl_accounts) VALUES (?, ?)');
     $abfrage->execute([$applikation, $anzahlAccounts]);


    echo 'Verbindung zur Azure-Datenbank erfolgreich hergestellt!';
} catch (PDOException $e) {
    die('Verbindung fehlgeschlagen: ' . $e->getMessage());
}
sqlsrv_close($conn);    

?>
