<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use SQLite3;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $applikation = isset($_POST["applikation"]) ? $_POST["applikation"] : '';
    $anzahlAccounts = isset($_POST["anzahl_accounts"]) ? $_POST["anzahl_accounts"] : '';

    // SQLite-Verbindung herstellen
    $db = new SQLite3('/Users/lokilicious/Desktop/fragenbogen/FragebogenAuswertung.db');

    // Daten in die Datenbank einfügen
    $stmt = $db->prepare('INSERT INTO form_responses (applikation, form_responses.anzahl_accounts) VALUES (:id, :applikation)');
    $stmt->bindParam(':applikation', $applikation);
    $stmt->bindParam(':anzahl_accounts', $anzahlAccounts);

    $stmt->execute();

    // Excel-Datei wie zuvor erstellen und speichern
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'Applikationsname');
    $sheet->setCellValue('B1', 'Anzahl Accounts');

    $sheet->setCellValue('A2', $applikation);
    $sheet->setCellValue('B2', $anzahlAccounts);


    $writer = new Xlsx($spreadsheet);
    $excel_filename = '/Users/lokilicious/Desktop/fragenbogen/Antworten.xlsx';
    $writer->save($excel_filename);

    echo 'Daten erfolgreich in die Datenbank und Excel-Datei geschrieben!';
} else {
    echo 'Ungültige Anfrage.';
}
?>
