const buchstabenArray = [];
let myChartInstance; 
let firstPlaceOfWert;

function addWordToArray(){

    if(buchstabenArray.length === 0){
        errore()
        return;
    }
    var userInput = prompt("Welches Wort möchten sie hinzufügen?")
    buchstabenArray.push(userInput)
    document.getElementById("liste").innerHTML = buchstabenArray.join(", ")
}
function tellName(){
    
    var name = prompt("Wie heißt du?")
    document.getElementById("title").innerHTML = name
    alert("Der Titel der Seite ist jetzt " + name )
}
function switchNum(){
    let min = parseInt(prompt("Welchen Inhalt möchten Sie tauschen? Geben Sie die Nummer ein (Index beginnt bei 1):")) - 1;
    let max = parseInt(prompt("Welchen anderen Inhalt möchten Sie tauschen? Geben Sie die Nummer ein (Index beginnt bei 1):")) - 1;

    if (min >= 0 && max >= 0 && min < buchstabenArray.length && max < buchstabenArray.length) {
        
        let temp = buchstabenArray[min];
        buchstabenArray[min] = buchstabenArray[max];
        buchstabenArray[max] = temp;

        
        document.getElementById("liste").innerHTML = buchstabenArray.join(", ");
        alert("Der neue Array ist: " + buchstabenArray.join(", "));
    } else {
        alert("Falsche Eingabe! Bitte versuchen Sie es erneut.");
    }
}



function errore(){
    alert("Irgendwas ist schief gegangen!")
}


function summFromTo() {
    let min = parseInt(prompt("Bitte geben Sie die niedrigste Nummer ein (Index beginnt bei 1):")) - 1;
    let max = parseInt(prompt("Bitte geben Sie die höchste Nummer ein (Index beginnt bei 1):")) - 1;

    if (min > max || min < 0 || max >= buchstabenArray.length) {
        errore();
        return;
    }

    let sum = 0;
    for (let i = min; i <= max; i++) {
        sum += buchstabenArray[i];
    }

    alert("Die Summe der Werte von Index " + (min + 1) + " bis " + (max + 1) + " ist " + sum);
}

function datasArray(){
    let text = prompt("Geben Sie eine Liste von Zahlen ein, getrennt durch Kommas (z.B. 1,2,3,4):");
    
    if (text) {
        
        buchstabenArray.length = 0; 

        
        buchstabenArray.push(...text.split(",").map(Number));

        
        document.getElementById("liste").innerHTML = buchstabenArray.join(", ");
    } else {
        alert("Bitte geben Sie gültige Zahlen ein.");
    }
}


function createCanva(){



    
    document.body.style.backgroundColor = "white";
    document.body.style.Color = "black";
    const ctx = document.getElementById('myChart').getContext('2d');
    
    if (buchstabenArray.length === 0) {
        alert("Das Array ist leer! Bitte zuerst Zahlen eingeben.");
        return;
    }

    const labels = buchstabenArray.map((_, index) => index + 1); 

    myChartInstance = new Chart(ctx, {
        type: 'line', // Diagrammtyp
        data: {
            labels: labels,
            datasets: [{
                label: 'Eingegebene Daten',
                data: buchstabenArray,  
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
}


function randomNum(){
    //const numArray = []

    buchstabenArray.length = 0
    for(let i = 0; i<30; i++){

        const randomInt = Math.floor(Math.random() * 100);
        buchstabenArray.push(randomInt)
        
    }
    alert(buchstabenArray)
    document.getElementById("liste").innerHTML = buchstabenArray.join(", ")
    
    


}

function aadition(){
    let userInOne = prompt("Welche Nummer aus dem Array möchten Sie addieren? (Geben Sie den Index an, beginnend bei 1)");
    let userInTo = prompt("Welche andere Nummer aus dem Array möchten Sie addieren? (Geben Sie den Index an, beginnend bei 1)");

    
    let us1 = parseInt(userInOne) - 1;
    let us2 = parseInt(userInTo) - 1;

    
    if (us1 >= 0 && us1 < buchstabenArray.length && us2 >= 0 && us2 < buchstabenArray.length) {
        let erg = buchstabenArray[us1] + buchstabenArray[us2];
        alert("Das Ergebnis ist " + erg);
    } else {
        alert("Ungültige Indizes! Bitte versuchen Sie es erneut.");
    }
}




function clearArray() {
    buchstabenArray.length = 0;
    document.getElementById("liste").innerHTML = buchstabenArray;

    if (myChartInstance) {
        myChartInstance.data.labels = []; 
        myChartInstance.data.datasets.forEach(dataset => {
            dataset.data = []; 
        });
        myChartInstance.update(); 
    }
}


function clearLastEntry(){
    
    testLast()
    buchstabenArray.pop()
    
    document.getElementById("liste").innerHTML = buchstabenArray.join(", ")
    lastNum()
}
function clearFirstNum(){
    
    testLast();
   
    buchstabenArray.shift()
    document.getElementById("liste").innerHTML = buchstabenArray.join(", ")
    lastNum();
}

function lastNum(){
    if(buchstabenArray > 1){
        alert("Sie haben jetzt alle Zahlen im Array gelöscht,bis auf eine.")
    }
}
function testLast(){
    if(buchstabenArray == 0){
        errore();
    }
}

function randomFact(){

    buchstabenArray.length = 0;
  document.getElementById("liste").innerHTML = buchstabenArray

   
const apiUrl = 'https://uselessfacts.jsph.pl/api/v2/facts/random';


fetch(apiUrl)
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    console.log(data.text);
    document.getElementById("liste").innerHTML = data.text
  })
  .catch(error => {
    console.error('Error:', error);
  });

  
  
}

function postPap(){
    var userAnswer = prompt("Sie möchten einen Brief schreiben, ist das Korrekt?")
    if(userAnswer == "ja" || userAnswer == "Ja" || userAnswer == "JA" ){
        alert("Ok weiter gehts")
        chapOne()
    }
    else{
        alert("OK, dann villeicht wann anders!")
    }

}
function chapOne(){
    var listItem = document.createElement('div');
    listItem.classList.add('item');
    
    
    listItem.innerHTML = `
      <p>Dies ist ein neuer Brief:</p>
      <textarea id="poste" placeholder="Gib deinen Text hier ein..."></textarea><br>
      <button class="title-rDZ" onclick="sendPost(this)">Absenden</button>
    `;

    // Füge das neue Element in den DOM ein
    document.body.appendChild(listItem);
}

function sendPost(element) {
    var text = document.getElementById("poste").value;
    var words = text.split(/\s+ /);
  
    element.parentElement.remove();
   
    alert(words)
}

async function timer(){
    var userAnswer = prompt("Wie lange soll der Timer gehen bitte in ms angeben!")

    alert("Warte auf " + userAnswer + " ms")
    await count(userAnswer);
    alert("Zeit ist rum")
}

function count(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
        
    
}

function msToSek(){
    var use1 = prompt("Bitte geben sie ein Wie viel Sekunden sie in ms Umwandeln wollen")
    let ergebnis = use1 * 1000
    alert(ergebnis + " ist das Ergebnis und wird jetzt in die Zwischenablage kopiert")
    inZwischenablageKopieren(ergebnis);
    function inZwischenablageKopieren(text) {
    
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text)
            .then(() => {
                console.log("Text erfolgreich in die Zwischenablage kopiert!");
            })
            .catch(err => {
                console.error("Fehler beim Kopieren in die Zwischenablage: ", err);
            });
    } else {
        console.warn("Die Clipboard API wird nicht unterstützt.");
    }
}



}


function switchToDatastructure(){
    buchstabenArray.length = 0
    window.location.href = "Data.html"


}

function saveAllDatas(){
    var counter = buchstabenArray.length
    for(let i = 0; i > counter; i++){
        
    }
}

function addArray(){
    var userIn = prompt("Wie lautet der Name der Liste?")
    document.getElementById("namelist").innerHTML = userIn
    buchstabenArray = []
}
function addList(){
    var userIn = prompt("Was möchten sie hinzufügen?")
    buchstabenArray.push(userIn)
    document.getElementById("liste").innerHTML = buchstabenArray.join(", ")
}
function lenghtOfArray(){
    alert(buchstabenArray.length)
}

function elePosList(){
    var userIn = prompt("Welche Nummer aus der Liste möchten sie bekommen?") -1
    alert(buchstabenArray[userIn])


}

function deletePos(){
    var userIn = prompt("Welche Nummer aus der Liste möchten sie löschen?") -1
    buchstabenArray.splice(userIn, 1)
    document.getElementById("liste").innerHTML = buchstabenArray.join(", ")
}

function addInputToArray(){
    var userIn = prompt("Was möchten sie hinzufügen?") 
    var userIn2 = prompt("Welche Stelle möchten sie hinzufügen?") -1
    buchstabenArray.splice(userIn2, 0, userIn)
    document.getElementById("liste").innerHTML = buchstabenArray.join(", ")
}

function changeElemntToWert(){
    var userIn = "Wert"
    var userIn2 = prompt("Welche Stelle möchten sie ersetzen?") -1
    buchstabenArray[userIn2] = userIn
    document.getElementById("liste").innerHTML = buchstabenArray.join(", ")
    firstPlaceOfWert = buchstabenArray.length 
}

function checkIfWertinTheArray(){
    var userIn = "Wert"
    var check = buchstabenArray.includes(userIn)
    alert(check)
}

function checkTheFirstPositionOfWert(){
    
   
    var check = buchstabenArray.indexOf("Wert") + 1
    if(firstPlaceOfWert === check){
        alert(check)
    }
    
}




