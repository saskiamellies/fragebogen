<?php
require 'vendor/autoload.php';
require_once "config.php";


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


try {
    $verbindung = new PDO("mysql:host=$host;dbname=$datenbankname", $benutzername, $passwort);
    $verbindung->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL-Abfrage vorbereiten und Daten abrufen
    $abfrage = $verbindung->query('SELECT * FROM auswertung_fragebogen');
    $daten = $abfrage->fetchAll(PDO::FETCH_ASSOC);

    // Excel-Datei erstellen
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Überschriften einfügen
    $header = array_keys($daten[0]);
    $sheet->fromArray([$header], NULL, 'A1');

    // Daten in Excel einfügen
    $sheet->fromArray($daten, NULL, 'A2');

    // Excel-Datei speichern
    $excel_filename = 'exported_data.xlsx';
    $writer = new Xlsx($spreadsheet);
    $writer->save($excel_filename);

    echo 'Daten erfolgreich in die Excel-Datei exportiert: ' . $excel_filename;
} catch (PDOException $e) {
    die('Verbindung fehlgeschlagen: ' . $e->getMessage());
}
?>
