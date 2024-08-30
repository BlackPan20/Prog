<?php
// save_sportarten.php

header('Content-Type: application/json');

// Datenbankkonfiguration
$servername = "localhost";
$username = "root"; // Dein MySQL-Benutzername
$password = ""; // Dein MySQL-Passwort
$dbname = "sportarten_db";

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung prüfen
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Datenbankverbindung fehlgeschlagen: ' . $conn->connect_error]));
}

// JSON-Daten aus der Anfrage lesen
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['username']) && isset($data['nachname']) && isset($data['einzelsport']) && isset($data['gemeinschaftssport'])) {
    // Sicherstellen, dass alle erforderlichen Daten vorhanden sind
    $username = $conn->real_escape_string($data['username']);
    $nachname = $conn->real_escape_string($data['nachname']);
    $einzelsport = $conn->real_escape_string($data['einzelsport']);
    $gemeinschaftssport = $conn->real_escape_string($data['gemeinschaftssport']);
    $leichtathletiklauf = isset($data['leichtathletiklauf']) ? $conn->real_escape_string($data['leichtathletiklauf']) : null;
    $leichtathletiksprung = isset($data['leichtathletiksprung']) ? $conn->real_escape_string($data['leichtathletiksprung']) : null;
    $leichtathletikwurf = isset($data['leichtathletikwurf']) ? $conn->real_escape_string($data['leichtathletikwurf']) : null;
    $leichtathletikpf = isset($data['leichtathletikpf']) ? $conn->real_escape_string($data['leichtathletikpf']) : null;

    // Überprüfen, ob der Benutzername bereits existiert
    $checkUserSql = "SELECT COUNT(*) as count FROM sportarten WHERE username = '$username'";
    $result = $conn->query($checkUserSql);
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        echo json_encode(['success' => false, 'message' => 'Der Benutzername existiert bereits.']);
    } else {
        // SQL-Abfrage zum Einfügen der Daten
        $sql = "INSERT INTO sportarten (username, nachname, einzelsport, gemeinschaftssport, leichtathletiklauf, leichtathletiksprung, leichtathletikwurf, leichtathletikpf)
                VALUES ('$username', '$nachname', '$einzelsport', '$gemeinschaftssport', '$leichtathletiklauf', '$leichtathletiksprung', '$leichtathletikwurf', '$leichtathletikpf')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(['success' => true, 'message' => 'Daten erfolgreich gespeichert.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Fehler: ' . $conn->error]);
        }
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Fehlende Daten.']);
}
?>
