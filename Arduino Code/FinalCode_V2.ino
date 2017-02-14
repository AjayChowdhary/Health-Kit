// include the library code:
#include <LiquidCrystal.h>
#include<SoftwareSerial.h>
#include<stdlib.h>
float tem;
int buttonState = 0;  
const int  buttonPin = 2;       
int lastButtonState = 0;
int heart_rate;
// initialize the library with the numbers of the interface pins
LiquidCrystal lcd(12,11,3,5,7,9);
char gender='M';
SoftwareSerial wifi(2, 3);
void setup() {
  pinMode(A1,INPUT);
  pinMode(A0,INPUT);
  pinMode(2,INPUT);
  // set up the LCD's number of columns and rows:
  lcd.begin(16, 2);
  lcd.clear();
  lcd.print("Health Kit");
  delay(1000);
  wifi.begin(115200);
   wifi.println("AT+RST");
  delay(10000);
  String conn = "AT+CWJAP=\"DTU-WiFI\",\"";
  wifi.println(conn);
  wifi.println("AT+CIPMUX=0");
  delay(2000);
  lcd.clear();
}

void loop() {
  buttonState = digitalRead(buttonPin); 
  tem=analogRead(A1);
  tem = (tem*900/1023);
  tem = tem + 32; 
  if (buttonState == LOW) { 
    if( gender =='F' )
     gender = 'M' ; 
    else 
    {
     if(gender== 'M')
      {
       gender ='F'; 
      }
    }
   }
  delay(50); 
  heart_rate = analogRead(A0); 
  Serial.begin(9600);
  Serial.println(digitalRead(2));
  //Serial.println(heart_rate);
  delay(100);
  heart_rate = heart_rate-1000;
  if(heart_rate > 18)
    heart_rate = 0;
  else
    heart_rate = heart_rate + 55;
  lcd.setCursor(0,0);
  lcd.print("Temp=");
  delay(50);
  lcd.setCursor(5,0);
  lcd.print(tem,0);
  delay(50);
  lcd.setCursor(7,0);
  lcd.print('F');
  delay(50);
  lcd.setCursor(10,0);
  lcd.print(" Sex=");
  delay(50);
  lcd.print(gender);
  delay(50);
  lcd.setCursor(0,1);
  lcd.print("HeartRate=");
  delay(50);
  lcd.setCursor(10,1);
  lcd.println(heart_rate); 
  delay(50);
  String getStr =  "GET /update?api_key=";
   getStr += "EDNBYFSJ1CJ46QEV";
   getStr += "&field1=";
   getStr += 24;
   getStr += "&field2=";
   getStr += 45;
   delay(100);
   String cmd = "AT+CIPSTART=\"TCP\",\"";
   cmd += "api.thingspeak.com"; //  184.106.153.149
   cmd += "\",80";
   wifi.println(cmd);
   delay(300);
   cmd = "AT+CIPSEND=";
    cmd += String(getStr.length());
   wifi.println(cmd);
   delay(300);
   wifi.print(getStr);

}

  
  
