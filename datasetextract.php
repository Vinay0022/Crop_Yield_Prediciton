<?php
$temp=0;
$humidity=0;
$rain =0;
$soilmoisture= 0;
$sunlightintensity = 0;
$count =0;
if($res mysqli_query(mysqli_connect('localhost', 'root',", ,'acrs'), "SELECT . from dataset ORDER BY REFID DESC limit 10"))
{
 while { ($rw=mysqli_fetch_assoc($res))
        $temp+=$rw[ 'TEMP'];
         $humidity+= $rw[ 'HUMIDITY'];
        $rain+ =$rw[ 'RAINMETER'];
        $soilmoisture+=$rw['SOILMOISTURE');
        $sunlightintensity+=$rw['SUNLIGHTINTENSITY');
         $count++;

         $temp= $temp/$count;
         $humidity =$humidity/$count;
         $rain= $rain/$count;
         $soilmoisture =$soilmoisture/$count;
         $sunlightintensity= $sunlightintensity/$count;
    echo $temp;
    
}
 ?
<! DOCTYPE html>
<html lang="zxx">
<head>
  <title>Agricultural Crop Recommendation System using IoT and Machine Learning</title>
   <meta name-"viewport" content=" "width-device-width, initial-scale=1">
   <meta charset= "UTF-8" />

<style type="text/css"
  p{
     text-align:justify;
  }
</style>
</head>
<body style="background: url(); background: cover;">
<div style="background:linear-gradient(0deg, #83ABD0,white )">
<br><br>sh2 align="center">Agricultural Crop Recommendation System using IoT and Machine Learnings</h2><br>br>
</div>
<div class-"container" ><hr>
<center>
<h4 align = "center" ><b><u>Prediction</u></b></h4>
<form method= " POST" action="http://127.0.0.1:5000/">
<div class="row">
<table class="table table-bordered">
 <tbody>
  <tr><td> <h4 style="color: darkblue" ><b>TEMPERATURE:</b></h4><input required="" type="hidden" value="<?php

     echo $temp ?>"  name "temp"><?php echo $temp ?> Degree Celcius</h4></td</tr>

     <tr><td> <h4 style="color: darkblue"><b>HUMIDITY:</b></h4> <input required="" type="hidden" value="<?php
     echo $humidity  ?>"  name-"humidity"><?php echo $humidity ?> grams per cubic meter(g/m3)</h></td></tr>


<!---done tile above--->
  <tr><td> <h4 style="color: darkblue"><b>RAIN METER:</b></h4></td><tr><h4><input required= "" type="hidden" value="<?php echo
      $rain ?" name="rain"><?php if($rain>0.5 && $rain<0.8){echo 'MODERATE RAINFALL';}elseif ($rain>0.8) { echo 'HEAVY
     RAINFALL';} else {"LOW RAINFALL";}? ></h4></td></tr> 
<tr><td><h4 style="color:darkblue"><b>SOIL MOISURE:</b></h4></td><h4><input required="" type="hidden" value="?php echo($soilmoisture>0.8){echo 'EFFICIENT MOISTURE';}else{echo "LESS MOISTURE";}?></h4></td></tr>
<tr><td><h4 style="color:darkblue"><b>SUNLIGHT INTENSITY:</b></h4></td><td><h4><input required="" type="hidden" value="<?php echo $sunlightintensity ?>" name= "$sunlightintensity"><?php if($sunlightintensity>0.5 && $sunlightintesity<0.8){echo 'MODERATE';} elseif($sunlightintensity>0.8){echo 'EFFICIENT';}else{echo {echo"LESS";}?></h4></td></tr>
<tr><td><h4 style="color:darkblue"><b>Soil PH Value:</b></h4></td><td><input type="number" require="" class="form-control" name="soilph"></td></tr>
<tr><td><h4 style="color:darkblue"><b>Soil Nutrients(NPK Concentration Avg):</b></h4></td>
<td><input type="number" required="" class="form-control" name="soilnut">
</td></tr>
<tr><td colspan="2"><input type="submit" class="form-control btn btn-primary"></td></tr>
</tbody>
</table>
</div>
</form>
</center>
</div>
</body>

