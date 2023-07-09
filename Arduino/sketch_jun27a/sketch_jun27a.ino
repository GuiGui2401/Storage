/*
  Démonstration d'écran tactile à deux "boutons"
  TFT SPI 2.4" 320 X 240 pixels
  Plus d'infos:
  https://electroniqueamateur.blogspot.com/2021/04/utilisation-dun-ecran-tactile-tft-spi.html
*/

#include <SPI.h>
#include <TFT_eSPI.h>

TFT_eSPI tft = TFT_eSPI(); // https://github.com/Bodmer/TFT_eSPI

// Création de 2 objets boutons
#define NOMBRE_BOUTONS 2
TFT_eSPI_Button bouton[NOMBRE_BOUTONS];

void setup() {
  Serial.begin(9600);
  tft.init();
  tft.setRotation(3);  // portrait: 0 ou 2, paysage: 1 ou 3.

  touch_calibrate();  // procédure de calibration de l'écran tactile

  // affichage d'un message à l'écran:
  tft.fillScreen(TFT_BLACK); // on efface tout (fond noir)
  tft.setFreeFont(&FreeSansOblique12pt7b); // police de caractère
  tft.setCursor(20, 70); // position du début du message
  tft.setTextSize(1);
  tft.setTextColor(TFT_WHITE, TFT_BLACK);
  tft.println("Choisissez la forme desiree");

  // création de deux boutons

  // premier bouton: son centre est positionné à x = 80 et y = 200, largeur 120, 
  // hauteur 50, contour en noir, remplissage rouge, texte en blanc, taille de texte 1.
  bouton[0].initButton(&tft, 80, 200, 120, 50, TFT_BLACK, TFT_RED, TFT_WHITE, "rectangle", 1);
  bouton[0].drawButton();

  // deuxième bouton: son centre est positionné à x = 250 et y = 200, largeur 120, 
  // hauteur 50, contour en noir, remplissage vert, texte en noir, taille de texte 1.
  bouton[1].initButton(&tft, 250, 200, 120, 50, TFT_BLACK, TFT_GREEN, TFT_BLACK, "cercle", 1);
  bouton[1].drawButton();
}

//------------------------------------------------------------------------------------------

void loop(void) {

  uint16_t t_x = 0, t_y = 0; // coordonnées touchées par l'utilisateur

  boolean pressed = tft.getTouch(&t_x, &t_y); // vrai si contact avec l'écran
  if(pressed){
    Serial.println("toucher");
  }
  // On vérifie si la position du contact correspond à celle d'un bouton
  for (uint8_t numero = 0; numero < NOMBRE_BOUTONS; numero++) {
    if (pressed && bouton[numero].contains(t_x, t_y)) {
      bouton[numero].press(true);  
    } else {
      bouton[numero].press(false);  
    }
  }

  // Vérifions maintenant si l'état d'un des boutons a changé
  for (uint8_t numero = 0; numero < NOMBRE_BOUTONS; numero++) {

    // si le bouton vient d'être relâché, on le redessine avec sa forme normale
    if (bouton[numero].justReleased()) {
      bouton[numero].drawButton();    
    }

    // si le bouton vient d'être pressé...
    if (bouton[numero].justPressed()) {
      bouton[numero].drawButton(true);  // on le redessine avec les couleurs inversées

      // ...puis on fait ce que l'utilisateur a demandé:

      switch (numero) {
        case 0:    // premier bouton
          tft.fillRect(0, 0, 320, 160, TFT_BLACK); // pour effacer le dessin précédent
          tft.fillRect(60, 30, 200, 100, TFT_CYAN); // rectangle 200 de largeur et 100 de hauteur
          break;
        case 1:    // deuxième bouton
          tft.fillRect(0, 0, 320, 160, TFT_BLACK); // pour effacer le dessin précédent
          tft.fillCircle(160, 80, 50, TFT_YELLOW); // cercle centré à x = 160 et y = 80
          break;
      }
      delay(10); // anti-rebond
    }
  }
}

// procédure de calibration de l'écran tactile
void touch_calibrate()
{
  uint16_t calData[5];
  uint8_t calDataOK = 0;

  tft.fillScreen(TFT_BLACK);
  tft.setCursor(25, 70);
  tft.setTextFont(2);
  tft.setTextSize(2);
  tft.setTextColor(TFT_WHITE, TFT_BLACK);
  tft.println("Touchez l'ecran a ");
  tft.setCursor(15, 110);
  tft.println("chaque coin indique.");
  tft.setTextFont(1);
  tft.println();
  tft.calibrateTouch(calData, TFT_YELLOW, TFT_BLACK, 20);
  tft.setTextColor(TFT_GREEN, TFT_BLACK);
  tft.println("Calibration terminee!");
}
