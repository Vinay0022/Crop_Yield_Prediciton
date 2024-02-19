from flask import *
import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LinearRegression
from sklearn import metrics
from sklearn.metrics import r2_score
from sklearn.tree import DecisionTreeRegressor

dataset = pd.read_csv('dataset.csv')
dataset.isnull().any()
dataset = dataset.fillna(method='ffill')  # Corrected 'fillna' method

X = dataset.iloc[:, :-1].values  # Corrected variable name from 'x' to 'X'
y = dataset.iloc[:, -1].values

X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.1, random_state=0)  # Corrected parameters

regressor = DecisionTreeRegressor(random_state=0)
regressor.fit(X_train, y_train)
y_pred = regressor.predict(X_test)
accu = r2_score(y_test, y_pred)

app = Flask(__name__, static_folder='')

@app.route('/', methods=['GET', "POST"])
def processing():
    temps = ''
    humidity = ''
    rain = ''
    soilmoistures = ''
    sunlightintensity = ''
    soilph = ''
    soilnuts = ''
    y_test1 = ''
    if request.method == 'POST':
        temp = float(request.form['temp'])
        humidity = float(request.form['humidity'])
        rain = float(request.form['rain'])
        soilmoisture = float(request.form['soilmoisture'])
        sunlightintensity = float(request.form['sunlightintensity'])
        soilph = float(request.form['soilph'])
        soilnut = float(request.form['soilnut'])
        testdata1 = [[temp, humidity, rain, soilmoisture,soilph, sunlightintensity, soilnut]]
        y_test1 = regressor.predict(testdata1)
    return render_template("output.html", output=y_test1)  # Corrected variable name and added comma

if __name__ == '__main__':
    app.run()

