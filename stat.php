<html>
<head>
    <title>Hotspot statistics</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!--- https://eternicode.github.io/bootstrap-datepicker/ --->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.standalone.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.ru.min.js"></script>

<script>
function refresh() {
    location.reload();
}
setInterval("refresh()",60000);
</script>

</head>
<body style="padding: 5px;">
<div class="container">

какой-то текст

<?php 
session_start();
 if(!isset($_SESSION['access']) || $_SESSION['access']!=true && $_COOKIE["login"]=="true"){

//if($_COOKIE["login"]!=true){
	$errors['msg'] = 'Не введен логин или пароль! <br> ('.date('d.m.Y H:i:s').') <br>';
    $_SESSION['errors'] = $errors;
	header("Location: index.php");
} else {

// if password ok
$date = date('d.m.Y');

	if (isset($_GET['date'])) {
		$date = htmlspecialchars(trim($_GET['date']));

		if ($_GET['date'] == 0) {
			$date = date('d.m.Y');
		} elseif (date('d.m.Y') == $_GET['date']) {
			header('Location: /stat.php');
		}

	} else {
		$date = date('d.m.Y');
	}
}
?>

всё на bootstrap (getbootstrap.com)

</div>
</body>
</html>
