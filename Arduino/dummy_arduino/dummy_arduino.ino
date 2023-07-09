#include  <SoftwareSerial.h>
SoftwareSerial Ss(5,6);
void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  Ss.begin(9600);
}

void loop() {
  // put your main code here, to run repeatedly:
  Ss.println("hey there");
  Serial.println("J envoie");
  String msg = Ss.readString();
  Serial.println(msg);
}
