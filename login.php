<html>
<head>
	<title>Оптовий склад BUTALEX</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/template/css/login_page_style.css">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<?php
ini_set("display_errors",1);
error_reporting(E_ALL);
include 'engine/class/database.php';
$errors = array();
$db = new Database(array(
                'host' => '94.244.128.42',
                'username' => 'but', 
                'password' => '3105044',
                'db'=> 'cw',
                'charset' => 'utf8'));

$admins = $db->getOne("admins");
session_start();
if(isset($_POST['pwd']) && isset($_POST['login']))
{
    if(md5($_POST['pwd']) == $admins['password'])
	{
		setcookie ("login", true, time()+3600);
		$_SESSION['access'] = true;
		header("Location: index.php");
    } else {
		$errors['msg'] = 'Неверный логин или пароль! <br> ('.date('d.m.Y H:i:s').')<br>';
		$_SESSION['errors'] = $errors;
		header("Location: login.php");
    }
} else {
	if(isset($_SESSION['access']) && $_SESSION['access'] == true)
	{
    	$errors['msg'] = 'Не введен логин или пароль! <br> ('.date('d.m.Y H:i:s').') <br>';
	    $_SESSION['errors'] = $errors;
    	header("Location: index.php");
	}


?>

<body>
<div class="spss-pp">
  <div class="container">
    <h1>Оптовий склад BUTALEX</h1>
	<h2>Введіть логін та пароль</h2>
	<h6><span style="color: #E76163;"> <?php if (isset($_SESSION['errors'])) { echo $_SESSION['errors']['msg']; } ?></span></h6>
<form name="loginform" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <fieldset class="form-fieldset ui-input __first">
      <input type="text" id="username" name="login" placeholder="login" required/>
      <label for="login">
        <span data-text="Логин">Логін</span>
      </label>
    </fieldset>

    <fieldset class="form-fieldset ui-input __second">
      <input type="password" id="password" name="pwd" required/>
      <label for="pwd">
        <span data-text="Пароль">Пароль</span>
      </label>
    </fieldset>

    <div class="form-footer">
      <input type="submit" class="btn" value="Войти" />
    </div>
</form>
  </div>
</div>
<?php
}

if (isset($_GET['exit'])) {
	$_COOKIE["login"]=false;
	session_destroy();
	header('Location: login.php');
}
?>
</body>
</html>