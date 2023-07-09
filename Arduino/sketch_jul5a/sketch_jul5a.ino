#include <SoftwareSerial.h>
#include <Keypad.h>
#include <LiquidCrystal_I2C.h>
#include <Wire.h>

// Déclaration des broches pour l'écran LCD I2C
LiquidCrystal_I2C lcd(0x27, 16, 2);

// Déclaration du clavier
const byte ROW_NUM = 4; // Quatre lignes
const byte COLUMN_NUM = 4; // Quatre colonnes

char keys[ROW_NUM][COLUMN_NUM] = {
  {'1', '2', '3', 'A'},
  {'4', '5', '6', 'B'},
  {'7', '8', '9', 'C'},
  {'*', '0', '#', 'D'}
};

byte pin_rows[ROW_NUM] = {9, 8, 7, 6}; // Broches pour les lignes
byte pin_column[COLUMN_NUM] = {5, 4, 3, 2}; // Broches pour les colonnes

Keypad keypad = Keypad(makeKeymap(keys), pin_rows, pin_column, ROW_NUM, COLUMN_NUM);

// Variables de contrôle
char codeRetrait[5] = "ABCD"; // Code de retrait prédéfini (exemple)
char inputCode[5];
int tentative = 0;

char matriculeAttendu[6] = "12345"; // Matricule prédéfini (exemple)
char matriculeSaisi[6];
char numeroTelephone[11];

int serrurePin = 10;

int RXPin = 11;

int TXPin = 12;

SoftwareSerial mySerial(RXPin,TXPin);

void setup() {
  lcd.init();                      // initialize the lcd 
  lcd.init();
  // Print a message to the LCD.
  lcd.backlight();
  lcd.setCursor(3,0);
  lcd.print("Bienvenue !");
  pinMode(serrurePin,OUTPUT);
  mySerial.begin(115200);
}

void loop() {
  char key = keypad.getKey();

  if (key) {
    if (key == '1') {
      lcd.clear();
      lcd.setCursor(3,0);
      lcd.print("Matricule :");
      int i = 0;
      while (i < 5) {
        key = keypad.getKey();
        if(key) {
          matriculeSaisi[i] = key;
          lcd.setCursor(i, 1);
          lcd.print(key);
          i++;
        }
      }
      matriculeSaisi[5] = '\0';

      mySerial.print(matriculeSaisi);
      delay(1000);
      if(mySerial.available()){
        matriculeAttendu = mySerial.readString();
      }

      if (strcmp(matriculeAttendu, "OK") == 0) {
        lcd.clear();
        lcd.setCursor(0,0);
        lcd.print("Coord. dest.:");
        int i = 0;
        while (i < 9) {
        key = keypad.getKey();
        if(key) {
          numeroTelephone[i] = key;
          lcd.setCursor(i, 1);
          lcd.print(key);
          i++;
        }
        }
        numeroTelephone[9] = '\0';

        lcd.clear();
        lcd.setCursor(0,0);
        lcd.print("Deposez le colis");
        digitalWrite(serrurePin,HIGH);
        delay(5000);
        digitalWrite(serrurePin,LOW);
        lcd.clear();
        lcd.setCursor(0,0);
        lcd.print("Retour a l'accueil");
        delay(2000);
        lcd.clear();
        lcd.setCursor(3,0);
        lcd.print("Bienvenue !");
      }
      else {
        lcd.clear();
        lcd.setCursor(0,0);
        lcd.print("Matricule invalide !");
        delay(2000);
        lcd.clear();
        lcd.setCursor(0,0);
        lcd.print("Retour a l'accueil");
        delay(2000);
        lcd.clear();
        lcd.setCursor(3,0);
        lcd.print("Bienvenue !");
      }
    }
    else if (key == '2') {
      lcd.clear();
      lcd.setCursor(0,0);
      lcd.print("Code retrait :");

      int i = 0;
      while (i < 4) {
        key = keypad.getKey();
        if(key){
          inputCode[i] = key;
          lcd.setCursor(i, 1);
          lcd.print(key);
          i++;
        }
        
      }
      inputCode[4] = '\0';

      if(mySerial.available()){
        codeRetrait = mySerial.readString();
      }

      if (strcmp(inputCode, codeRetrait) == 0) {
        lcd.clear();
        lcd.setCursor(0,0);
        lcd.print("Veuillez retirer");
        digitalWrite(serrurePin,HIGH);
        delay(5000);
        digitalWrite(serrurePin,LOW);
        lcd.clear();
        lcd.setCursor(0,0);
        lcd.print("Retour a l'accueil");
        delay(2000);
        lcd.clear();
        lcd.setCursor(3,0);
        lcd.print("Bienvenue !");
        tentative = 0;
      }
      else {
        tentative++;

        if (tentative < 2) {
          lcd.clear();
          lcd.setCursor(0,0);
          lcd.print("Code incorrect !");
          delay(2000);
          lcd.clear();
          lcd.setCursor(0,0);
          lcd.print("Retapez le code");
          delay(2000);
          lcd.clear();
          lcd.setCursor(0,0);
          lcd.print("Code retrait :");

          int i = 0;
          while (i < 4) {
            key = keypad.getKey();
            if(key){
              inputCode[i] = key;
              lcd.setCursor(i, 1);
              lcd.print(key);
              i++;
            } 
          }
          inputCode[4] = '\0';

          if (strcmp(inputCode, codeRetrait) == 0) {
            lcd.clear();
            lcd.setCursor(0,0);
            lcd.print("Veuillez retirer");
            digitalWrite(serrurePin,HIGH);
            delay(5000);
            digitalWrite(serrurePin,LOW);
            lcd.clear();
            lcd.setCursor(0,0);
            lcd.print("Retour a l'accueil");
            delay(2000);
            lcd.clear();
            lcd.setCursor(3,0);
            lcd.print("Bienvenue !");
            tentative = 0;
          }
          else {
            tentative++;
          }
        }
        else {
          lcd.clear();
          lcd.setCursor(0,0);
          lcd.print("Code incorrect !");
          delay(2000);
          lcd.clear();
          lcd.setCursor(0,0);
          lcd.print("Retour a l'accueil");
          delay(2000);
          lcd.clear();
          lcd.setCursor(3,0);
          lcd.print("Bienvenue !");
          tentative = 0;
        }
      }
    }
  }
}
