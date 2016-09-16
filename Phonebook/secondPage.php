<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
		<link rel="stylesheet" type="text/css" href="./CSS/Style.css">
</head>
<body>
<div class="wrapper">
<h1>File content</h1>
<div>
<div>
<button onclick="location.href='index.php'">
     Back</button>
<p  class="sp">
<?php 
session_start();
$var_value =$_SESSION["da"];
echo $var_value;
?>
</p>
</div>
</div>
</div>
</body>
</html>