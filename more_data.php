<script>
	function more_data(username){
		$.ajax({
	        	url: "sql_more_data.php",
	        	dataType: "json",
	        	type: "post",
	        	data: {
	        		"username":username
	        	},
	        	success: function(data){
	        		$(".min_max").remove();
	        		$(".rank").remove();
	        		console.log(data["rank"]);
	        		console.log(data["total"]);
	        		$("#myChart").after("<div class='min_max'>You max sleep is "+ toHourMin(data["max"])+ ", minis "+ toHourMin(data["min"])+ "</div>")
	        		$("#myChart").after("<div class='rank'>"+ 100*data["percentage"]+"% of total days you sleepreach seven hours, rank " +data["rank"]+ " out of "+ data["total"]+" participants</div>";
	        	}
	        })
	}
</script>