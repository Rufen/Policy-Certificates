<?php
	require_once("includes/functions.php");
	$message="";
	if(isset($_POST['submit'])){ 
		//form was submitted
		$hrname = $_POST["hrname"];
		$hrpassword = $_POST["hrpassword"];
		if ($hrname == "" && $hrpassword == ""){
			//successful login
			$hrname = $_POST["hrname"] = "";
			$hrpassword = $_POST["hrpassword"] = "";
			redirect_to("includes/download.php");
		} else {
			$message = "There is an error.";			
		}

	}	else {
		$hrname="";
		$message = "Please log in.";
	}
?> 
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Policies-certificates | Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="css/jquery-ui.min.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript">
			function getDocumentHeight() {
				if ($.browser.msie) {
					var $temp = $("<div>").css("position", "absolute").css("left", "-10000px").append($("body").html());

					$("body").append($temp);
					var h = $temp.height();
					$temp.remove();
					return h + 50;
				}
				return $(document).height() + 50;
				var g = $(document).height();
				console.log (g);
			}
			$(window).load(function() {
				parent.resizeIframe(getDocumentHeight());
			});
</script>
</head>
<body>
<div class="container">
	<?php echo $message ?>
	<form action="download_login.php" method="post">
		Name: <input type="text" name="hrname" value="<?php echo htmlspecialchars($hrname); ?>" /><br />
		Password: <input type="password" name="hrpassword" value="" /><br />
		<br />
		<input type="submit" name="submit" value="Submit" />
	</form>
</div>
</body>
</html>