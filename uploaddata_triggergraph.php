    <script> 
    	var date =[];
    	var sleep = [];
    	var up = [];
    	var duration = [];
        $(document).ready(function() { 
  			//upload form data
        	$(".submit").click(function(){
        		$(".signupdiv").hide();
        		
        		if($("#theDate").val()>stringTodayDate(0)){
        			$("#theDate").val(stringTodayDate(0));
        			console.log($("#theDate").val())
        		}
        		$.ajax({
	        		url: "sql.php",
	        		dataType: "json",
	        		type: "post",
	        		data: {
	        			"username":$("#username").val(),
	        			"time_bed":$("#time_bed").val(),
	        			"time_up":$("#time_up").val(),
	        			"theDate":$("#theDate").val()
	        		},
	        		success: function(data){
	        			if(data["boolean"]){
	        				$(".check").text('');
	        				$(".check").remove();
	        			}
	        			else{
	        				$(".check").remove();
	        				$("#time_up").after("<p class='check'></p>");

	        				$(".check").text(data["warn"]);
	        				$(".check").fadeIn("fast");

	        			}
	        			pulldata();
	        			more_data($("#username").val());
	      			}});

	        	}); 

        	

        	});
    </script> 