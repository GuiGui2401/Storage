//bool b=false;
//
//void setup() {
//  // put your setup code here, to run once:
//  Serial.begin(9600);
//}
//
//void loop() {
//  // put your main code here, to run repeatedly:
//  if(b)
//  {
//    Serial.write("12.45.78.36\n",11);
//    b = false;
//  }
//  char c[1];
//  while(!Serial.available())
//  {}
//  //String s = Serial.readStringUntil('\n');
//  Serial.readBytes(c,1);
//  if(c[0] == '1')
//  {
//    b = true;
//  }
//  
//  delay(10000);
//  
//}

#include <SoftwareSerial.h>

#define RX_PIN D7    // Broche RX (Réception) du module émetteur connectée à la broche TX du module récepteur
#define TX_PIN D8    // Broche TX (Transmission) du module émetteur connectée à la broche RX du module récepteur

SoftwareSerial mySerial(RX_PIN, TX_PIN);  // Création d'une instance de la classe SoftwareSerial

void setup() {
  Serial.begin(115200);         // Initialisation de la communication série avec la console
  mySerial.begin(9600);         // Initialisation de la communication série avec l'autre module ESP8266
}

void loop() {
  // Envoi des données via la communication série
  mySerial.print("01");
  Serial.println("i send");
  // Attente d'une certaine période de temps
  delay(5000);
}
