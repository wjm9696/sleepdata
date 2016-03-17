<script>
	function toHourMin(time){
		result = time.split(":");
		hour = result[0];
		minute = result[1];
		hourSplit = hour.split("");
		if(hourSplit[0]=="0"){
			hour = hourSplit[1];
		}
		minSplit = minute.split("");
		if(minute=="00"){
			return hour+" hours";
		}
		if(minSplit[0]=="0"){
			minute = minSplit[1];
		}
		return hour+" hours and "+minute+"minutes";
	}
</script>