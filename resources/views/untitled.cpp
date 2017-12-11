#include <QueueArray.h>

#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <NewPing.h>

#define TRIGGER_PIN  5 //D1
#define ECHO_PIN     4 //D2
#define MAX_DISTANCE 500

#define DETECTOR_LED 16 //D0
#define WIFI_LED 0 //D3
#define TIME_LED 2 

#define MIN_TIME_COUNT 150 //minimo de milisegundos para contar una pasada

/*
struct medida{
  int duracion;
  const char* source;
};

QueueArray <int> medidas;
*/
long time1=0,time2=0;
int send_interval=10000;

NewPing sonar(TRIGGER_PIN, ECHO_PIN, MAX_DISTANCE);

const char* ssid = "PANCHO";//nombre wifi
const char* password = "789632541";//clave wifi

const char* server_address = "fr4j4.pro";//direccion del servidor
const char* server_port = "83";//puerto del servidor


bool b=true;
int wconnected=-1;

long medicion_inicio=0,medicion_fin=0;
bool medicion_estado=false;

void setup() {
  //Serial.begin(9600);
  pinMode(DETECTOR_LED,OUTPUT);
  pinMode(WIFI_LED,OUTPUT);
  pinMode(TIME_LED,OUTPUT);
  WiFi.begin(ssid, password);
}

void wifi_status(){
  wconnected=WiFi.status();
  if (wconnected != WL_CONNECTED) {
    digitalWrite(WIFI_LED,LOW);
  }else{
    digitalWrite(WIFI_LED,HIGH);
  }
}

void send_data(long duracion){
/*
http://www.fr4j4.pro:83/pushLecture?parametro1=valor1&parametro2=valor2
*/

  HTTPClient http;
  char buffer[200];
  
  sprintf(buffer,"http://%s:%s/pushLecture?duracion=%lu",server_address,server_port,duracion);
  //sprintf(buffer,"http://192.168.1.25:8000/pushLecture?duracion=%lu",duracion);
  //Serial.println(buffer);
  //Serial.println("send");
  //http.begin("http://192.168.1.25:8000/pushLecture");
  http.begin(buffer);
  int httpCode = http.GET();//Send the request
    if (httpCode > 0) { //Check the returning code
      String payload = http.getString();//Get the request response payload
      //Serial.println(payload);//Print the response payload
    }
    http.end();   //Close connection
    time1=millis();
}



void loop() {
  time2=millis();

  if(time2-time1>=send_interval){
    if(b){
      digitalWrite(TIME_LED,HIGH);
    }else{
      digitalWrite(TIME_LED,LOW);
    }
    b=!b;
    time1=millis();
  }
  
  delay(50);
  int dist=sonar.ping_cm();
  if(dist<50){
    if(medicion_estado==false){
      medicion_estado=true;
      medicion_inicio=millis();
      medicion_fin=millis();
    }
    else{
      medicion_fin=millis();
    }
    digitalWrite(DETECTOR_LED,HIGH);
  }else{
    if(medicion_estado==true){
      medicion_estado=false;
      if(medicion_fin-medicion_inicio>=MIN_TIME_COUNT){
        //Serial.print("SEND SEND SEND SEND SEND SEND SEND SEND SEND SEND ");
        send_data(medicion_fin-medicion_inicio);
      }
      medicion_inicio=millis();
      medicion_fin=millis();
    }
    digitalWrite(DETECTOR_LED,LOW);
  }

  if(medicion_estado==true){
    //Serial.print("midiendo: ");
    //Serial.println(medicion_fin-medicion_inicio);
  }
  wifi_status();
}