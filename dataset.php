<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agricultural Crop Recommendation System using IoT and Machine Learning</title>
    <style type="text/css">
        p {
            text-align: justify;
        }
    </style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body style="background: linear-gradient(0deg, #83ABD0, white);">
    <div style="background: linear-gradient(0deg, #83ABD0, white);">
        <br><br>
        <h2 align="center">Agricultural Crop Recommendation System using IoT and Machine Learning</h2>
        <br><br>
    </div>
    <div class="container">
        <hr>
        <center>
            <h4 align="center"><b><u>Prediction</u></b></h4>
            <form method="POST" action="http://127.0.0.1:5000/">
                <div class="row">
                    <table class="table table-bordered">
                        <tbody>
                            <?php
                            $temp = 0;
                            $humidity = 0;
                            $rain = 0;
                            $soilmoisture = 0;
                            $sunlightintensity = 0;
                            $count = 0;

                            $conn = mysqli_connect('localhost', 'root', '','acrs');

                            if (!$conn) {
                                die("Connection failed:  failed man " . mysqli_connect_error());
                            }

                            $sql = "SELECT * FROM dataset ORDER BY REFID DESC LIMIT 1";
                            $res = mysqli_query($conn, $sql);

                            if ($res) {
                                while ($rw = mysqli_fetch_assoc($res)) {
                                    $temp += $rw['TEMP'];
                                    $humidity += $rw['HUMIDITY'];
                                    $rain += $rw['RAINMETER'];
                                    $soilmoisture += $rw['SOILMOISTURE'];
                                    $sunlightintensity += $rw['SUNLIGHTINTENSITY'];
                                    $count++;
                                
                                }
                            
                                $temp = $temp / $count;
                                $humidity = $humidity / $count;
                                $rain = $rain / $count;
                                $soilmoisture = $soilmoisture / $count;
                                $sunlightintensity = $sunlightintensity / $count;
                            }else {
                                echo "Error executing query: " . mysqli_error($conn);
                            }

                            mysqli_close($conn);
                            ?>

                            <tr>
                                <td>
                                    <h4 style="color: darkblue"><b>TEMPERATURE:</b></h4>
                                    <input required="" type="hidden" value="<?php echo $temp ?>" name="temp">
                                    <?php echo $temp ?> Degree Celsius
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h4 style="color: darkblue"><b>HUMIDITY:</b></h4>
                                    <input required="" type="hidden" value="<?php echo $humidity ?>" name="humidity">
                                    <?php echo $humidity ?> grams per cubic meter (g/m3)
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h4 style="color: darkblue"><b>RAIN METER:</b></h4>
                                    <input required="" type="hidden" value="<?php echo $rain ?>" name="rain">
                                    <?php
                                    if ($rain < 3000) {
                                        echo 'SUFFICIENT RAINFALL';
                                    } else {
                                        echo 'LOW RAINFALL';
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h4 style="color: darkblue"><b>SOIL MOISTURE:</b></h4>
                                    <input required="" type="hidden" value="<?php echo $soilmoisture ?>" name="soilmoisture">
                                    <?php
                                    echo ($soilmoisture < 3000) ? 'SUFFICIENT MOISTURE' : 'LESS MOISTURE';
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h4 style="color: darkblue"><b>SUNLIGHT INTENSITY:</b></h4>
                                    <input required="" type="hidden" value="<?php echo $sunlightintensity ?>" name="sunlightintensity">
                                    <?php
                                    if ($sunlightintensity < 10000) {
                                        echo 'SUFFICIENT SUNLIGHT';
                                    } else {
                                        echo 'LOW SUNLIGHT';
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h4 style="color: darkblue"><b>Soil PH Value:</b></h4>
                                    <input type="number" require="" class="form-control" name="soilph">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h4 style="color: darkblue"><b>Soil Nutrients(NPK Concentration Avg):</b></h4>
                                    <input type="number" required="" class="form-control" name="soilnut">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2"><input type="submit" class="form-control btn btn-primary"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </center>
    </div>
</body>
</html>
