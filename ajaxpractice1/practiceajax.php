<html>

<head>

	<title>Ajax</title>
	
	<script>
	
		function showChar(str){
		
			if(str == ""){
			
				document.getElementById("char_rec").innerHTML="";
			
			}else{
			
				if(window.XMLHttpRequest){
				
					xmlhttp = new XMLHttpRequest();
				
				}else{
					
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				
				}
			
				xmlhttp.onreadystatechange = function(){
					
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
					
						document.getElementById("char_rec").innerHTML = xmlhttp.responseText;
					
					}
				
				}
			
				xmlhttp.open("GET" , "getchar.php?test=" + str , true);
				xmlhttp.send(null);
			
			}
		
		
		}
	
	
	
	</script>
	
	

</head>



<body>
	
	<form>
	
		<select name="character" onchange="showChar(this.value)">
	
			<option value="">Select Character</option>
			<option value="1">Monkey D. Luffy</option>
			<option value="2">Trafalgar Law</option>
			<option value="3">Portgas D. Ace</option>
			<option value="4">Monkey D. Dragon</option>
			<option value="5">Monkey D. Garp</option>
		
		</select>
	
	
	</form>

	<br>
	
		<div id="char_rec"><b>This is where the info will be listed</b></div>

	

</body>




</html>