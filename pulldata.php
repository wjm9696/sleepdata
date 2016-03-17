<script type="text/javascript">
function pulldata(){
        	//grab data from sql
        		$.ajax({
	        		url: "sql_down.php",
	        		dataType: "json",
	        		type: "post",
	        		data: {
	        			"username":$("#username").val(),
	        		},
	        		success: function(data){
	        			$("#myChart").remove();
	        			$(".signuphint").after("<br><canvas id='myChart' style='width=90%'></canvas>");
	        			date = [];
	        			duration = [];
	        			function timeStringToFloat(time) {
								  var hoursMinutes = time.split(/[.:]/);
								  var hours = parseInt(hoursMinutes[0], 10);
								  var minutes = hoursMinutes[1] ? parseInt(hoursMinutes[1], 10) : 0;
								  return Math.round((hours + minutes / 60) * 10) / 10;
								}
						function dateStringToWords(date){
							result = date.split("-");
							month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
							day = result[2];
							if((day.split(''))[0]=="0"){
								day=day[1];
							}
							return month[result[1]-1]+" "+day;
						}
	        				for (var key in data) {
 								if (data.hasOwnProperty(key)) {
    								date.push(dateStringToWords(key));
    								duration.push(timeStringToFloat(data[key][0]));
  								}
							}
							formgraph();
	      			}});
	        	} 
</script>