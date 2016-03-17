
	<div class="form">Intended user name:<input type="text" class="username"></div>

	<div class="two_buttom_signup"><button class="signupbuttom buttom">Submit</button><buttom class="buttom back">Log in</buttom></div>
	<p class="return_info"></p>
	<script src="jquery.min.js"></script>

	<script> 
        $(document).ready(function() { 

        	$(".signupbuttom").click(function(){
        		

        		$.ajax({
	        		url: "signup_base.php",
	        		dataType: "json",
	        		type: "post",
	        		data: {
	        			"username":$(".username").val(),	
	        		},
	        		success: function(data){
	        			
	        			$(".return_info").text(data["info"]);

	      			}});

	        	}); 
        });
        $(document).ready(function() { 

        	$(".back").click(function(){
        		$(".signupdiv").fadeOut( "fast", function() {
        			$(".input").fadeToggle("fast");
  					});

	        	}); 
        });
    </script>
    
