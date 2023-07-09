//void setup() {
//  // put your setup code here, to run once:
//  Serial.begin(9600);
//}
//
//void loop() {
//  // put your main code here, to run repeatedly:
//  char c[20];
//  while(!Serial.available())
//  {}
//  //String s = Serial.readStringUntil('\n');
//  Serial.readBytes(c,20);
//  for(int i=0;i<11;++i){
//    Serial.print(c[i]);
//  }
//  if(c[0] == '1')
//  {
//    Serial.write('1');
//  }
//  Serial.println();
//  delay(100);
//}

#include <SoftwareSerial.h>

#define RX_PIN D5    // Broche RX (Réception) du module récepteur connectée à la broche TX du module émetteur
#define TX_PIN D6    // Broche TX (Transmission) du module récepteur connectée à la broche RX du module émetteur

SoftwareSerial mySerial(RX_PIN, TX_PIN);  // Création d'une instance de la classe SoftwareSerial

void setup() {
  Serial.begin(9600);         // Initialisation de la communication série avec la console
  mySerial.begin(9600);         // Initialisation de la communication série avec l'autre module ESP8266
}

void loop() {
  // Vérification si des données sont disponibles
  // while(!mySerial.available())
  // {

  // }
  if (mySerial.available()) {
    // Lecture des données reçues via la communication série
    String data = mySerial.readString();

    // Traitement des données
    Serial.println("Données reçues : " + data);
  }
  delay(1000);
}
