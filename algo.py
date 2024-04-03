from flask import Flask, render_template, request
import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.tree import DecisionTreeClassifier
from sklearn.metrics import accuracy_score

# Load the dataset
dataset = pd.read_csv('dataset.csv')

# Handling missing values if any
dataset.fillna(method='ffill', inplace=True)

# Separate features and target variable
X = dataset.drop(columns=['CROP'])
y = dataset['CROP']

# Split dataset into train and test sets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.1, random_state=0)

# Train a decision tree classifier
classifier = DecisionTreeClassifier(random_state=0)
classifier.fit(X_train, y_train)

app = Flask(__name__, static_folder='')

@app.route('/', methods=['GET', 'POST'])
def processing():
    crop_prediction = ''
    if request.method == 'POST':
        # Get input values from the form
        temp = float(request.form['temp'])
        humidity = float(request.form['humidity'])
        rain = float(request.form['rain'])
        soil_moisture = float(request.form['soilmoisture'])
        sunlight_intensity = float(request.form['sunlightintensity'])
        soil_ph = float(request.form['soilph'])
        soil_nut = float(request.form['soilnut'])

        # Make a prediction using the trained model
        test_data = [[temp, humidity, rain, soil_moisture, sunlight_intensity, soil_ph, soil_nut]]
        crop_prediction = classifier.predict(test_data)[0]

    return render_template("output.html", output=crop_prediction)

if __name__ == '__main__':
    app.run(debug=True)
