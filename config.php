<?php

// Verbindungszeichenfolge zur Azure SQL-Datenbank
$server = "tcp:fragebogentest.database.windows.net,1433";
$database = "fragebogen-test";
$username = "s54177@teams.bht-berlin.de";
$password = "wATER6WINE20131";
$options = array(
    "Database" => $database,
    "Uid" => $username,
    "PWD" => $password,
    "MultipleActiveResultSets" => false,
    "Encrypt" => true,
    "TrustServerCertificate" => false,
    "Authentication" => "ActiveDirectoryPassword"
);

// Verbindung herstellen
$conn = sqlsrv_connect($server, $options);

// Überprüfen der Verbindung
if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

// Excel-Konfiguration
$excel_config = array(
    'excel_filename' => 'exported_data.xlsx'
);
$db_config = [
    'host' =>  'tcp:fragebogentest.database.windows.net,1433',
    'dbname' => 'fragebogen-test',
    'username' => 's54177@teams.bht-berlin.de',
    'password' => 'wATER6WINE20131'
];

?>
