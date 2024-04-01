<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Crop Yield Prediction</title>

    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- Font Awesome JS -->
    <script src="https://kit.fontawesome.com/728d1d3dec.js" crossorigin="anonymous"></script>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</head>

<body>
    <div class="svgs">
        <img src="imgs/bg_svg.svg">
    </div>
    <div class="page" id="part1">
        <div class="info">
            <div class="heading">
                <div class="title text-primary">Crop Yield Prediction</div>
                <div class="title-support">using Machine Learning</div>
            </div>
            <div class="dev">
                <div class="text-primary">
                    <i class="far fa-file-code"></i>&nbsp;Developed by:
                </div>
                <ul class="developer">
                    <li>Vaibhav Ambati</li>    
                    <li>Vinay Bait</li>
                    <li>Swayam Thanekar</li>
                </ul>
            </div>



<?php
    // Check if the button is clicked
    if(isset($_POST['submit'])) {
        // Redirect to another PHP file
        header('Location: dataset.php');
        exit(); // Ensure that script execution stops after redirection
    }
?>

<form method="post" action="" >
    <input style="
    display: inline-block;
    text-decoration: none;
    color: white;
        sans-serif;
    font-weight: bold;
    padding: 0.6em 2em;
    margin-right: 2em;
    font-size: 1.4em;
    border: none;
    border-radius: 40px;
    background-image: linear-gradient(to right, #1cd8d2, #93edc7);
    box-shadow: 4px 4px 10px #81ecec;
    transition: 0.3s;
cursor:pointer;
"

  type="submit" name="submit" value="Try it">
</form>

        </div>
        <div class="imgContainer">
            <!-- <img src="imgs/farm1.jpg" alt=""> -->
            <img src="imgs/flowers.svg" alt="">
        </div>
        <div class="scrollIndicator"></div>
    </div>
    <div class="page" id="part2">
        <div class="card myCard">
            <div class="myCard-img">
                <img src="imgs/input.svg" alt="">
            </div>
            <div class="myCard-title text-blue">Enter details</div>
            <div class="myCard-body ">Provide information for the crop like its type, the area of the farm, the soil category and the district in which it is to be grown</div>
        </div>
        <div class="card myCard">
            <div class="myCard-img">
                <img src="imgs/weather.svg" alt="">
            </div>
            <div class="myCard-title text-green">Live Sensors Data Fetch</div>
            <div class="myCard-body ">Current weather details like the temperature, humidity, rain , soil moisture , light intensity are fetched automatically from the sensors to be used for prediction</div>
        </div>
        <div class="card myCard">
            <div class="myCard-img">
                <img src="imgs/model.svg" alt="">
            </div>
            <div class="myCard-title text-orange">Prediction</div>
            <div class="myCard-body ">It uses Decision tree algorithm. This algorithm uses historical data to create the tree and then applies it to current conditions to estimate crop yields.</div>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(()=>{
            $('#submit').prop('disabled', true);
            $('#prediction').hide();
            var input_lists;
            $.get('input_lists.txt', (data, status)=>{
                input_lists = JSON.parse(data);
            }).done(()=>{
                let opts = '<option value="" selected hidden disabled>Select district</option>';
                let dists = input_lists['districts'];
                for(let i=0; i<dists.length; i++)
                    opts += '<option value="'+dists[i]+'">'+dists[i]+'</option>';
                $('#district').html(opts);

                opts = '<option value="" selected hidden disabled>Select crop</option>';
                let crops = input_lists['crops'];
                for(let i=0; i<crops.length; i++)
                    opts += '<option value="'+crops[i]+'">'+crops[i]+'</option>';
                $('#crop').html(opts);

                opts = '<option value="" selected hidden disabled>Select soil type</option>';
                let soils = input_lists['soils'];
                for(let i=0; i<soils.length; i++)
                    opts += '<option value="'+soils[i]+'">'+soils[i]+'</option>';
                $('#soil').html(opts);
                
            });
        });
        $('select').change(()=>{
            var flag = 0;
            if(!$('#district').val()){ flag = 1; }
            if(!$('#crop').val()){ flag = 1; }
            if($('#area').val() == ""){ flag = 1; }
            if(!$('#soil').val()){ flag = 1; }
            $('#submit').prop('disabled', flag);
        })
        $('input').keyup(()=>{
            var flag = 0;
            if(!$('#district').val()){ flag = 1; }
            if(!$('#crop').val()){ flag = 1; }
            if($('#area').val() == ""){ flag = 1; }
            if(!$('#soil').val()){ flag = 1; }
            $('#submit').prop('disabled', flag);
        })
        
        $('#submit').click(()=>{
            var paras = 'district='+$('#district').val()+ '&crop='+$('#crop').val() + '&area='+$('#area').val() + '&soil='+$('#soil').val();
            var res;
            $.get('predict.php?'+paras, (data, status)=>{
                // alert(data);
                res = data;
            }).done(()=>{
                $('#prediction').html(res);
                $('#prediction').show();
            });
        })
    </script>
</body>

</html>
