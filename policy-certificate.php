<?php
session_start();
	$message="";	 
	if(isset($_POST['submit']))
	{
		require("includes/dbinfo.php");
		require("includes/functions.php");
		$name = $_POST["name"];
		$empnum = $_POST["employeeNumber"];

		$sql = "INSERT INTO certificates (Name, Employee_ID, Date_Reported)
		VALUES ('$name', '$empnum', NOW())";
		if (mysqli_query($conn, $sql)) {
			$message = "<hr><h4 style='color:#336699;'>Tasks Completed Successfully! Thank you!</h4>" ;
		} else {
			$message = "Error";
		}
		mysqli_close($conn);
		$_POST = array(); //empty form field
		session_destroy(); 
	}	
?> 
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Policies-certificates | City of Newton</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="css/jquery-ui.min.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="css/jquery-ui.min.js"></script>
   <script src="js/jquery-1.4.4.min.js"></script>

  <!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
	<style>
		#cer{display:block;position:relative;}
		#policies {padding:20px; border:1px solid #ccc;border-top:0;width:100%;}		
		p a{display:inline-block;padding-top:20px; margin:10px;width:24%;}
		.btn {text-align:left;}
		.not-active {
		   pointer-events: none;
		   cursor: default;		   
		}
		.not-active a{color:gray;}		
		#certificates{padding:20px; border:1px solid #ccc;border-top:0;width:100%;}
		#certificates form{width:98%;}
		form input{margin-bottom:8px;width:40%;}
		.btn-block {width:150px;text-align:center;display:inline-block;}
		.show{display:block !important;}
		.hidden{display:none !important;}
		.checkbox {display: inline-block;}
		.disabled_link{color:gray;}	
		.text-right{font-style: italic;}
	</style>
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
			}
			$(window).load(function() {
				parent.resizeIframe(getDocumentHeight());
			});
</script>
</head>
<body>
<div id="cert">  	
	<ul class="nav nav-tabs">
	<li class="active" id="policy"><a href="#" class="btn "><span class="glyphicon glyphicon-folder-open"></span>&nbsp;Step 1. Policy Section (PDFs)</a></li>
	<li id="certificate" class="not-active"><a href="#" class="btn " style="margin-left:5px;"><span class="glyphicon glyphicon-star"></span>&nbsp;Step 2. Identification</a></li>
	</ul>	
	<div class="article" id="policies">
		<p style="padding:10px 5px 0px 5px;">Step 1. Click each policy link below to read through. You must read each policy before entering Step 2.<br />Step 2. Enter your name and your employee ID (available on your pay-stubs), then click the Submit button.</p>
		<hr>
		<p>
		<a class="btn" href="#"><span class="glyphicon glyphicon-fire"></span> Domestic Violence</a>
		<a class="btn" href="#"><span class="glyphicon glyphicon-flash"></span> Sexual Harassment</a>
		<a class="btn" href="#"><span class="glyphicon glyphicon-eye-open"></span> Social Media Account Request Form</a>
		<a class="btn" href="#"><span class="glyphicon glyphicon-eye-close"></span> Social Media Policy</a>
		<a class="btn" href="#"><span class="glyphicon glyphicon-retweet"></span> Telecommunications Policy</a>
		<a class="btn" href="#"><span class="glyphicon glyphicon-leaf"></span> Vehicle Policy</a>
		<a class="btn" href="#"><span class="glyphicon glyphicon-adjust"></span> Whistleblower Policy</a>
		</p>
		<p>&nbsp;</p><div id="pdfDisplay"></div>
		<p><?php echo $message;  ?></p>
	</div>	
	<div id="certificates" class="hidden">						
		<form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
				<h4 class="form-signin-heading">Please fill in and submit (Your employee ID can be found on your pay-stubs):</h4>				
				<div style="width:40%"><label for="emp_name" class="sr-only">Your Name <span class="req">&nbsp;*</span></label>
				<input type="text" name="name" class="form-control" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" required autofocus />
				<label for="emp_id" class="sr-only">Employee ID Number</label>
				<input type="password" class="form-control"  placeholder="Your employee number" name="employeeNumber" />
				</div>
		        <div class="checkbox">
		          <strong>Disclaimer:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur aliquam condimentum imperdiet. Praesent pretium malesuada purus non scelerisque. Quisque ipsum est, dignissim at purus auctor, tempus imperdiet metus. Cras in mi nec arcu rutrum pharetra non nec nisi. 
		        </div>				
				<button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Submit</button>				
				<!--<input type="submit"  name="submit" value="Submit" />-->
				<div class"clear"></div>
		</form>
		<p>&nbsp;</p>
	</div>
	<div style="display:none;" id="success"><h3>Submitted Successfully! Thank you!</h3></div>
	<p class="text-right">Human Resources, City of Newton, <?php echo date("Y") ?></p>
</div>
<script>
 		count=0;
		  $( "div.article a" ).click( function(e) {		
			count=count+1;
			e.preventDefault();
			$(this).addClass("disabled_link");
			$(this).css({"pointer-events":"none"});
			var ind = $( this ).index();
			 console.log("index is" + ind + ", i is " + count);			 
			 if (count==7){
				$("#policies").addClass("hidden");
				$("#policy").removeClass("active").addClass("not-active");
				$("#certificate").removeClass("not-active").addClass("active");
				$("#certificates").removeClass("hidden").addClass("show");
			 };	
			if (ind==0){
			window.open("http://www.newtonma.gov/civicax/filebank/blobdload.aspx?BlobID=45972& title: Domestic Violence", "", "toolbar=0, width=1000");
			e.preventDefault();}
			if (ind==1){
			window.open("http://www.newtonma.gov/civicax/filebank/blobdload.aspx?BlobID=45974& title: Sexual Harassment", "", "toolbar=0, width=1000");
			e.preventDefault();}
			if (ind==2){
			window.open("http://www.newtonma.gov/civicax/filebank/blobdload.aspx?BlobID=56100& title: Social Media Account Request Form", "", "toolbar=0, width=1000");
			e.preventDefault();}
			if (ind==3){
			window.open("http://www.newtonma.gov/civicax/filebank/blobdload.aspx?BlobID=56479& title: Social Media Policy", "", "toolbar=0, width=1000");
			e.preventDefault();}
			if (ind==4){
			window.open("http://www.newtonma.gov/civicax/filebank/blobdload.aspx?BlobID=45993& title: Telecommunications Policy", "", "toolbar=0, width=1000");
			e.preventDefault();}
			if (ind==5){
			window.open("http://www.newtonma.gov/civicax/filebank/blobdload.aspx?BlobID=45973& title: Vehicle Policy", "", "toolbar=0, width=1000");
			e.preventDefault();}
			if (ind==6){
			window.open("http://www.newtonma.gov/civicax/filebank/blobdload.aspx?BlobID=53787& title: Whistleblower Policy", "", "toolbar=0, width=1000");
			e.preventDefault();}
		  });	 
</script>
</body>
</html>
