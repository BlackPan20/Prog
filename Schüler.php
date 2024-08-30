<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sportarten Auswahl</title>
    <link rel="stylesheet" href="styleschüler.css"> 
</head>
<body>
<div class="container">
    <h2>Sportarten Auswahl</h2>

    <label for="username">Benutzername:</label>
    <input type="text" id="username" name="username" required>

    <label for="nachname">Nachname:</label>
    <input type="text" id="nachname" name="nachname" required>

    <label for="einzelsport">Einzelsportart:</label>
    <select id="einzelsport">
        <option value="" selected>Wähle</option>
    </select>

    <label for="gemeinschaftssport">Gemeinschaftssportart:</label>
    <select id="gemeinschaftssport">
        <option value="" selected>Wähle</option>
    </select>

    <div id="leichtathletiklauf-container" style="display: none;">
        <label for="leichtathletiklauf">Leichtathletik Lauf Disziplin:</label>
        <select id="leichtathletiklauf">
            <option value="" selected>Wähle</option>
        </select>
    </div>
    <div id="leichtathletiksprung-container" style="display: none;">
        <label for="leichtathletiksprung">Leichtathletik Sprung Disziplin:</label>
        <select id="leichtathletiksprung">
            <option value="" selected>Wähle</option>
        </select>
    </div>
    <div id="leichtathletikwurf-container" style="display: none;">
        <label for="leichtathletikwurf">Leichtathletik Wurf Disziplin:</label>
        <select id="leichtathletikwurf">
            <option value="" selected>Wähle</option>
        </select>
    </div>
    <div id="leichtathletikpf-container" style="display: none;">
        <label for="leichtathletikpf">Leichtathletik Wahlpflichtbereichdisziplin:</label>
        <select id="leichtathletikpf">
            <option value="" selected>Wähle</option>
        </select>
    </div>

    <button id="submit-button">Daten absenden</button>
    <div id="error-message" class="error-message" style="display: none;">Bitte wählen Sie eine Option für jedes Dropdown-Menü aus.</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Funktion zum Anzeigen der Sportarten
    function loadSportarten() {
        fetch('sportarten.json')
            .then(response => response.json())
            .then(data => {
                const einzelsportSelect = document.getElementById('einzelsport');
                const gemeinschaftssportSelect = document.getElementById('gemeinschaftssport');

                data.Einzelsportarten.forEach(sport => {
                    const option = document.createElement('option');
                    option.text = sport;
                    einzelsportSelect.add(option);
                });

                data.Gemeinschaftssportarten.forEach(sport => {
                    const option = document.createElement('option');
                    option.text = sport;
                    gemeinschaftssportSelect.add(option);
                });

                einzelsportSelect.addEventListener('change', function() {
                    const selectedSport = this.value;
                    if (selectedSport === 'Leichtathletik') {
                        document.getElementById('leichtathletiklauf-container').style.display = 'block';
                        document.getElementById('leichtathletiksprung-container').style.display = 'block';
                        document.getElementById('leichtathletikwurf-container').style.display = 'block';
                        document.getElementById('leichtathletikpf-container').style.display = 'block';

                        // Füge Optionen für Lauf-Disziplinen hinzu
                        data.Laufdisziplinen.forEach(disziplin => {
                            const option = document.createElement('option');
                            option.text = disziplin;
                            document.getElementById('leichtathletiklauf').add(option);
                        });

                        // Füge Optionen für Sprung-Disziplinen hinzu
                        data.Sprungdisziplinen.forEach(disziplin => {
                            const option = document.createElement('option');
                            option.text = disziplin;
                            document.getElementById('leichtathletiksprung').add(option);
                        });

                        // Füge Optionen für Wurf-Disziplinen hinzu
                        data.Wurfdisziplinen.forEach(disziplin => {
                            const option = document.createElement('option');
                            option.text = disziplin;
                            document.getElementById('leichtathletikwurf').add(option);
                        });

                        // Füge Optionen für Wahlpflichtbereich-Disziplinen hinzu
                        data.Wahlpflichtbereichdisziplinen.forEach(disziplin => {
                            const option = document.createElement('option');
                            option.text = disziplin;
                            document.getElementById('leichtathletikpf').add(option);
                        });
                    } else {
                        // Verstecke alle Dropdown-Menüs für Leichtathletik-Disziplinen, wenn eine andere Sportart ausgewählt ist
                        document.getElementById('leichtathletiklauf-container').style.display = 'none';
                        document.getElementById('leichtathletiksprung-container').style.display = 'none';
                        document.getElementById('leichtathletikwurf-container').style.display = 'none';
                        document.getElementById('leichtathletikpf-container').style.display = 'none';

                        // Setze alle Dropdown-Menüs zurück
                        document.getElementById('leichtathletiklauf').innerHTML = '<option value="" selected>Wähle</option>';
                        document.getElementById('leichtathletiksprung').innerHTML = '<option value="" selected>Wähle</option>';
                        document.getElementById('leichtathletikwurf').innerHTML = '<option value="" selected>Wähle</option>';
                        document.getElementById('leichtathletikpf').innerHTML = '<option value="" selected>Wähle</option>';
                    }
                });
            })
            .catch(error => console.error('Fehler beim Laden der Sportarten:', error));
    }

    // Funktion zum Absenden der Daten
    function submitData() {
        // Benutzerdaten aus den Formularfeldern holen
        const username = document.getElementById('username').value;
        const nachname = document.getElementById('nachname').value;
        const einzelsport = document.getElementById('einzelsport').value;
        const gemeinschaftssport = document.getElementById('gemeinschaftssport').value;
        const leichtathletiklauf = document.getElementById('leichtathletiklauf').value;
        const leichtathletiksprung = document.getElementById('leichtathletiksprung').value;
        const leichtathletikwurf = document.getElementById('leichtathletikwurf').value;
        const leichtathletikpf = document.getElementById('leichtathletikpf').value;

        // Bestätigungsdialog anzeigen
        var prompter = prompt("Die Daten werden an den Lehrer gesendet, sie haben nun noch einmal die Möglichkeit das Senden zu wiederrufen. Nachdem sie die Daten gesendet haben, wird ihr Account gesperrt. Möchten sie es Senden? J/N");
        if (prompter === "J" || prompter === "j") {
            // Überprüfen, ob alle erforderlichen Felder ausgefüllt sind
            if (username === '' || nachname === '' || einzelsport === '' || gemeinschaftssport === '' || (einzelsport === 'Leichtathletik' && (leichtathletiklauf === '' || leichtathletiksprung === '' || leichtathletikwurf === '' || leichtathletikpf === ''))) {
                document.getElementById('error-message').style.display = 'block';
                return;
            } else {
                // Daten an den Server senden
                fetch('save_sportarten.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        username: username,
                        nachname: nachname,
                        einzelsport: einzelsport,
                        gemeinschaftssport: gemeinschaftssport,
                        leichtathletiklauf: leichtathletiklauf,
                        leichtathletiksprung: leichtathletiksprung,
                        leichtathletikwurf: leichtathletikwurf,
                        leichtathletikpf: leichtathletikpf
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Die Daten wurden an deinen Lehrer weitergegeben!");
                        window.location.href = 'login.php';
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Fehler beim Senden der Daten:', error);
                    alert("Es gab einen Fehler beim Senden der Daten.");
                });
            }
        } else {
            return;
        }
    }

    // Event-Listener für den Absenden-Button
    document.querySelector('button').addEventListener('click', submitData);

    // Sportarten beim Laden der Seite laden
    loadSportarten();
});
</script>
</body>
</html>
