<html>
<head>
<script src="http://code.jquery.com/jquery-1.10.1.min.js">
</script>

	<script>
			$(document).ready(function(){
				$("#loaddata").click(function(){
					txtname=$("#txtinput").val();
					txtlocation=$("#txtlocation").val();
				$.get("part_two.php",{ name:txtname, location: txtlocation },function(ajax_result){
				$("#postrequest").html(ajax_result);
				});
			});
		});
	</script>
</head>
<body>
<div id="postrequest"></div>
Enter Name: <input type="text" id="txtinput"><br />
Enter Location: <input type="text" id="txtlocation"><br />
<button id="loaddata">Click to send request to post_test.php</button>
</body>
</html>