#include <SPI.h>
#include <MFRC522.h>
#include <WiFi.h>
#include <DHT.h>
#include <HTTPClient.h>

const char* ssid = "Ryt";
const char* password = "15051970";
char server[] ="192.168.0.104";
WiFiClient client;

#define DHTPIN D18
#define DHTTYPE DHT11
DHT dht(DHTPIN,DHTTYPE);
float humidityData;
float temperatureData;
float soilMoistureData;
float rainData;
float LDRValue;

void setup(){
Serial.begin(115200);
delay(100);
Serial.print(ssid);
WiFi.begin(ssid,password);
while(WiFi.status() != WL_CONNECTED){
delay(500);
Serial.print(".");
    }

Serial.println("");
Serial.println("WiFi connected");
Serial.println("Server started");
Serial.print(WiFi.localIP());
delay(1000);

pinMode(D1,INPUT);//LIGHT INTENSITY
dht.begin();//HUMIDITY AND TEMPERATURE
delay(1000);
}

void loop(){
    humidityData = dht.readHumidity();
    Serial.print("HUMIDITY: ");
    Serial.println(humidityData);
    delay(1000);


    temperatureData= dht.readTemperature();
    Serial.print("TEMPERATURE: ");
    Serial.println(temperatureData);
    delay(1000);

    
    rainData = digitalRead(D5);
    Serial.print("Rain Meter: ");
    Serial.println(rainData);
    delay(1000);
    


    soilMoistureData = digitalRead(D21);
    Serial.print("Soil Moisture: ");
    Serial.println(soilMoistureData);
    delay(1000);

    LDRValue = digitalRead(D19);
    LDRValue = LDRValue * 5.0;
    Serial.print("LIGHT INTENSITY: ");
     Serial.println(LDRValue);
    delay(1000);

Sendint_To_phpmyadmindatabase();
delay(3000);
}

void Sendint_To_phpmyadmindatabase() {
  if (client.connect(server, 80)) {
    HTTPClient http;
    http.begin(client, "http://192.168.0.104/Project/insert.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    String httpRequestData = "humidity=" + String(humidityData) + "&temperature=" + String(temperatureData) + "&rain=" + String(rainData) + "&moisture=" + String(soilMoistureData) + "&intensity=" + String(LDRValue);
    Serial.print("httpRequestData: ");
    Serial.println(httpRequestData);
    int httpResponseCode = http.POST(httpRequestData);
    Serial.println(httpResponseCode);
    String payload = http.getString();
    Serial.println(payload);
    http.end();
  } else {
    Serial.println("connection failed");
  }
}