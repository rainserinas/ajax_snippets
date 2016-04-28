<html>

<head>
	<style type="text/css">
		body, table {font-size:14px; font-family:Arial; color:#333333;}
		h1, h2, h3 {margin:0 0 10px 0; padding:0;}
		h1 {font-size:18px;}
		p {margin:4px 0;}
	</style>
</head>

<body>
	<div style="width:600px; border: 1px solid gray; height: auto; float: left;">
		<h2><img src="<?php echo /*base_url().*/'http://www.designbluemanila.com/asianland/img/site/home/alsc.png'; ?>" alt="Asianland" /></h2>
		
		<div style="margin: 20px 0 0 0; padding: 0 20px; float: left; width: 100%;">
			<?php echo $param['message']; ?>
		</div>

		<div style='border-top: 1px solid #000; margin: 20px 0 0 0; padding: 5%; float:left; line-height: 1.5; width: 90%;'>
            To unsubscribe please visit: <a href=" . base_url('../home/unsubscribe/' . $param['id']) . ">Unsubscribe</a> <br/>
            Your email will unsubscribe automatically.
         </div>
	</div>
</body>
</html>