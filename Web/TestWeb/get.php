<?php
// Simulation de récupération des données depuis un serveur
$value = rand(0, 200);
$data = array('value' => $value);
header('Content-Type: application/json');
echo json_encode($data);
?>


Oui, il est possible de connecter deux modules ESP8266 en utilisant une connexion série pour envoyer des données d'un module à l'autre. Les modules ESP8266 disposent d'une interface UART (Universal Asynchronous Receiver/Transmitter) intégrée qui permet la communication série.

Pour établir la communication série entre deux modules ESP8266, vous pouvez suivre les étapes suivantes :

1. Configurez le module émetteur (ESP8266-1) pour envoyer les données. Vous pouvez utiliser la bibliothèque de communication série intégrée (Serial) pour cela. Par exemple, vous pouvez utiliser la fonction `Serial.begin()` pour initialiser la communication série avec une certaine vitesse (baud rate), puis utiliser `Serial.print()` ou `Serial.write()` pour envoyer les données.

2. Connectez les broches de communication série des deux modules ESP8266. Les broches RX (Réception) du module émetteur doivent être connectées à la broche TX (Transmission) du module récepteur, et vice versa. Assurez-vous également de connecter les broches de mise à la terre (GND) des deux modules entre elles pour un référencement commun.

3. Configurez le module récepteur (ESP8266-2) pour lire les données. De manière similaire au module émetteur, vous pouvez utiliser la bibliothèque de communication série (Serial) pour initialiser la communication série et lire les données entrantes. Vous pouvez utiliser la fonction `Serial.begin()` pour configurer la communication série, puis utiliser `Serial.available()` pour vérifier si des données sont disponibles et `Serial.read()` pour les lire.

4. Téléversez les codes appropriés sur les deux modules ESP8266 et assurez-vous qu'ils sont correctement alimentés.

Une fois que vous avez effectué ces étapes, les deux modules ESP8266 devraient pouvoir communiquer entre eux via une connexion série. Lorsque le module émetteur envoie des données, le module récepteur devrait être en mesure de les lire et de les traiter en conséquence.

Assurez-vous de consulter la documentation et les exemples de code fournis avec votre plateforme de développement ESP8266 pour plus de détails sur la configuration de la communication série et l'utilisation des broches appropriées.

#include <SoftwareSerial.h>

#define RX_PIN 2    // Broche RX (Réception) du module émetteur connectée à la broche TX du module récepteur
#define TX_PIN 3    // Broche TX (Transmission) du module émetteur connectée à la broche RX du module récepteur

SoftwareSerial mySerial(RX_PIN, TX_PIN);  // Création d'une instance de la classe SoftwareSerial

void setup() {
  Serial.begin(115200);         // Initialisation de la communication série avec la console
  mySerial.begin(9600);         // Initialisation de la communication série avec l'autre module ESP8266
}

void loop() {
  // Envoi des données via la communication série
  mySerial.print("Données à envoyer");

  // Attente d'une certaine période de temps
  delay(1000);
}

#include <SoftwareSerial.h>

#define RX_PIN 2    // Broche RX (Réception) du module récepteur connectée à la broche TX du module émetteur
#define TX_PIN 3    // Broche TX (Transmission) du module récepteur connectée à la broche RX du module émetteur

SoftwareSerial mySerial(RX_PIN, TX_PIN);  // Création d'une instance de la classe SoftwareSerial

void setup() {
  Serial.begin(115200);         // Initialisation de la communication série avec la console
  mySerial.begin(9600);         // Initialisation de la communication série avec l'autre module ESP8266
}

void loop() {
  // Vérification si des données sont disponibles
  if (mySerial.available()) {
    // Lecture des données reçues via la communication série
    String data = mySerial.readString();

    // Traitement des données
    Serial.println("Données reçues : " + data);
  }
}
