#include <LiquidCrystal_I2C.h>
#include <SPI.h>
#include <SD.h>
#include <Arduino.h>
#include <OneWire.h>

#define portSM A4 
#define portPH A2 
#define portST 7 
#define resetAll 5
#define save 10

LiquidCrystal_I2C lcd(0x27, 16, 2);
File myFile;

int samples = 10;
float resolution = 1024.0;


float temperature;
float value;
int measure;
float volt;

/* Code de retour de la fonction getTemperature() */
enum DS18B20_RCODES {
  READ_OK,  // Lecture ok
  NO_SENSOR_FOUND,  // Pas de capteur
  INVALID_ADDRESS,  // Adresse reçue invalide
  INVALID_SENSOR  // Capteur invalide (pas un DS18B20)
};


/* Création de l'objet OneWire pour manipuler le bus 1-Wire */
OneWire ds(portST);

void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);
  lcd.init();
  lcd.backlight();
  lcd.setCursor(6, 0);
  lcd.print("START");
  if (!SD.begin(4)) {
    Serial.println("initialization failed!");
    return;
  }
  Serial.println("initialization done.");
}

void loop() {
  // put your main code here, to run repeatedly:
  value = analogRead(portSM);
  value = map(value, 0, 1023, 0, 100);
  Serial.println(value);

  delay(1000);

  measure=0;
  for(int i=0;i<samples;i++) {
    measure += analogRead(portPH);
    delay(10);
  }
  volt = 5/resolution * measure/samples;
  Serial.println("pH=");
  Serial.println(ph(volt));

  delay(1000);
   
  /* Lit la température ambiante à ~1Hz */
  if (getTemperature(&temperature, true) != READ_OK) {
    Serial.println(F("Erreur de lecture du capteur"));
    return;
  }

  /* Affiche la température */
  Serial.print(F("Temperature : "));
  Serial.print(temperature, 2);
  Serial.write(176); // Caractère degré
  Serial.write('C');
  Serial.println();

  delay(1000);

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("SM:");
  lcd.setCursor(4, 0);
  lcd.print(value);
  lcd.setCursor(9, 0);
  lcd.print("PH:");
  lcd.setCursor(12, 0);
  lcd.print(ph(volt));
  lcd.setCursor(0, 1);
  lcd.print("Temp:");
  lcd.setCursor(6, 1);
  lcd.print(temperature);

  delay(1000);
  if(digitalRead(save) == HIGH){
    myFile = SD.open("file.txt", FILE_WRITE);
    if (myFile) {
      Serial.print("Writing to test.txt...");
      myFile.println(value);
      myFile.println(ph(volt));
      myFile.println(temperature);
      // close the file:
      myFile.close();
      Serial.println("done.");
    } else {
      // if the file didn't open, print an error:
      Serial.println("error opening file.txt");
    }
    myFile.close();

    if(value == 75 && ph(volt) >= 5 && ph(volt) <= 7,5 && temperature == 11) {
      lcd.clear();
      lcd.setCursor(3, 0);
      lcd.print("Culture:");
      lcd.setCursor(5, 1);
      lcd.print("Tomate");
    } else if(value == 70 && ph(volt) >= 6,5 && ph(volt) <= 7 && temperature == 25){
      lcd.clear();
      lcd.setCursor(3, 0);
      lcd.print("Culture:");
      lcd.setCursor(5, 1);
      lcd.print("Piment");
    } else if(value == 9 && temperature == 25){
      lcd.clear();
      lcd.setCursor(3, 0);
      lcd.print("Culture:");
      lcd.setCursor(5, 1);
      lcd.print("Haricot");
    } else if(value >= 12 && value <= 14 && ph(volt) >= 6 && ph(volt) <= 7,5 && temperature >= 8 && temperature <= 10){
      lcd.clear();
      lcd.setCursor(3, 0);
      lcd.print("Culture:");
      lcd.setCursor(5, 1);
      lcd.print("Maïs");
    } else if(value == 80 && ph(volt) >= 5 && ph(volt) <= 7,5 && temperature >= 18 && temperature <= 32){
      lcd.clear();
      lcd.setCursor(3, 0);
      lcd.print("Culture:");
      lcd.setCursor(5, 1);
      lcd.print("Cacao");
    }
  }
  
  if(digitalRead(resetAll) == HIGH){
    SD.remove("file.txt");
  }

  delay(1000);
}

/**
* Fonction de calcul du niveau de pH à une tension de 2.5
**/
float ph(float voltage){
  return 7+((2.5-voltage)/0.18);
}

/**
 * Fonction de lecture de la température via un capteur DS18B20.
 */
byte getTemperature(float *temperature, byte reset_search) {
  byte data[9], addr[8];
  // data[] : Données lues depuis le scratchpad
  // addr[] : Adresse du module 1-Wire détecté
  
  /* Reset le bus 1-Wire ci nécessaire (requis pour la lecture du premier capteur) */
  if (reset_search) {
    ds.reset_search();
  }
 
  /* Recherche le prochain capteur 1-Wire disponible */
  if (!ds.search(addr)) {
    // Pas de capteur
    return NO_SENSOR_FOUND;
  }
  
  /* Vérifie que l'adresse a été correctement reçue */
  if (OneWire::crc8(addr, 7) != addr[7]) {
    // Adresse invalide
    return INVALID_ADDRESS;
  }
 
  /* Vérifie qu'il s'agit bien d'un DS18B20 */
  if (addr[0] != 0x28) {
    // Mauvais type de capteur
    return INVALID_SENSOR;
  }
 
  /* Reset le bus 1-Wire et sélectionne le capteur */
  ds.reset();
  ds.select(addr);
  
  /* Lance une prise de mesure de température et attend la fin de la mesure */
  ds.write(0x44, 1);
  delay(800);
  
  /* Reset le bus 1-Wire, sélectionne le capteur et envoie une demande de lecture du scratchpad */
  ds.reset();
  ds.select(addr);
  ds.write(0xBE);
 
 /* Lecture du scratchpad */
  for (byte i = 0; i < 9; i++) {
    data[i] = ds.read();
  }
   
  /* Calcul de la température en degré Celsius */
  *temperature = (int16_t) ((data[1] << 8) | data[0]) * 0.0625; 
  
  // Pas d'erreur
  return READ_OK;
}
