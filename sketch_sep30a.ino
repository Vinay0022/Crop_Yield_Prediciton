#include <SPI.h>
#include <MFRC522.h>
#include <WiFi.h>
const char* ssid = "";
const char* password= "";
char server[] = "192.168.43.0";
WiFiClient client;

#define DHTPIN D2
#define DHTTYPE DHT11
DHT dht(DHTPIN,DHTTPYE);
float humidityData;
float temperatureData;
float soilMoistureData;
float rainData;
float LDRValue;

void setup(){
Serial.begin(115200);
delay(100);
Serial.print(ssid);
Wifi.begin(ssid,password);
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

    rainData= Serial.read();
    Serial.print("Rain Meter: ");
    Serial.println(rainData);
    delay(1000);

    soilMoistureData= Serial.read();
    Serial.print("Soil Moisture: ");
    Serial.println(soilMoistureData);
    delay(1000);

    LDRValue = digitalRead(D1);
    LDRValue = LDRValue * 5.0;
    Serial.print("LIGHT INTENSITY: ");
    delay(1000);

Sendint_To_phpmyadmindatabase();
delay(3000);
}

void Sendint_To_phpmyadmindatabase()
{
if (client.connect(server, B1)){
HTTPClient http;
http.begin(""); //our link
http.addHeader("Content-Type","application/x-www-form-urlencoded");
String httpRequestData = "humidity=" + String(humidityData)+ "&temperature=" + String(temperatureData)+"&rain=" + String(rainData)+"&moisture" + String(soilMoistureData)+ "&intensity=" + String(LDRValue);
Serial.print("httpRequestData: ");
Serial.print(httpRequestData);
int httpResponseCode = http.Post(httpRequestData);
Serial.println(httpResponseCode);
String payload = http.getString();
Serial.println(payload);
http.end();
}
else
{
Serial.println("connection failed");
    }

    }



