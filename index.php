<!DOCTYPE html>
<html>
<head>
	<title>Sleep Data Collection</title>
	<script src="Chart.js"></script>

	<script src="jquery.min.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <script src="http://malsup.github.com/jquery.form.js"></script> 
    <?php include 'toHourMin.php';?>
    <?php include 'pulldata.php';?>
    <?php include 'more_data.php';?>
    <?php include 'uploaddata_triggergraph.php';?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<script>
    //set the default value for theDate as yesterday
    function stringTodayDate(diff){
		var today = new Date();
		var dd = today.getDate()+diff;
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();
		if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} 
		return today = yyyy+'-'+mm+'-'+dd;
    }
    
    $(document).ready(function() { 
    	$('#theDate').val(stringTodayDate(-1));
	});
	</script>
	
</head>

<body class="body">
		<div class="main-body">
			<div class="input">
				<div class="form"><p class="form_text user">User name:</p><input type="text" id="username"></div>
				<div class="form"><p class="form_text">date:</p><input type="date" id="theDate"></div>
				<div class="form"><p class="form_text">time to bed:</p><input type="time" id="time_bed" value="22:00:00"></div>
				<div class="form"><p class="form_text">time gettng up:</p><input type="time" id="time_up" value="08:00:00"></div>
				<div class="submit_signup"><button class="submit buttom">Submit</button><button class="signuphint buttom">Sign up</button></div>
			</div>
			<div class = "signupdiv"><?php include 'signup.php';?></div>
		</div>

		<script>
		function formgraph(){

		
		var ctx = document.getElementById("myChart").getContext("2d");
		var data = {
		    labels: date,
		    datasets: [
		        {
		            label: "duration",
		            fillColor: "rgba(220,220,220,0.5)",
		            strokeColor: "rgba(220,220,220,1)",
		            pointColor: "rgba(220,220,220,1)",
		            pointStrokeColor: "#fff",
		            pointHighlightFill: "#fff",
		            pointHighlightStroke: "rgba(220,220,220,1)",
		            data: duration
		        },
		        
		    ]
		};
		console.log("formgraph");
		Chart.defaults.global.responsive = true;
		Chart.defaults.global.scaleLineColor="rgba(255,255,255, 0.3)";
		Chart.defaults.global.scaleFontColor= "white"
		var myNewChart = new Chart(ctx).Line(data);
		
	
		}
		</script>
		<script>
		$(document).ready(function() { 
        	$(".signuphint").click(function(){
        		$(".input").fadeOut( "fast", function() {
        			$(".signupdiv").fadeToggle("fast");
  					});
        		

	        	}); 
        });
			
		</script>
		<link rel="stylesheet" type="text/css" href="index.css">

	

</body>