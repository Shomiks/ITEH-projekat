<?php
session_start();
if(isset($_POST['dugme1'])){
     $username=$_POST['username'];
    $password=$_POST['password'];

    // To protect MySQL injection
$username=stripcslashes($username);
/*$username=mysql_real_escape_string($username);*/
$username=htmlspecialchars($username);

 $password=stripcslashes($password);
 /*$password=mysql_real_escape_string($password);*/
 $password=htmlspecialchars($password);
  /*echo $username ." : ".$password;*/

    $parameters = '[{'.

		'"username"'.':"'.$username.'"'.",".
		'"password"'.':"'.$password.'"'

		.'}]';


    $curl_zahtev = curl_init("http://localhost/projekat/mojprojekat/rest/loginKorisnik.json");
		curl_setopt($curl_zahtev, CURLOPT_POST, TRUE);
		curl_setopt($curl_zahtev, CURLOPT_POSTFIELDS, $parameters);
		curl_setopt($curl_zahtev, CURLOPT_RETURNTRANSFER, 1);
		$curl_odgovor = curl_exec($curl_zahtev);
		$json_objekat=json_decode($curl_odgovor, true);
		curl_close($curl_zahtev);

		if($json_objekat['poruka'] =="Uspeno ste se ulogovali!") {
            $id=$json_objekat['id'];
			header("Location: ../index.php?idkupca=$id");
		}
    else if($json_objekat['poruka'] == "Korisnik sa ovim podacima ne postoji u bazi!"){
      $curl_zahtev = curl_init("http://localhost/projekat/mojprojekat/rest/login.json");
  		curl_setopt($curl_zahtev, CURLOPT_POST, TRUE);
  		curl_setopt($curl_zahtev, CURLOPT_POSTFIELDS, $parameters);
  		curl_setopt($curl_zahtev, CURLOPT_RETURNTRANSFER, 1);
  		$curl_odgovor = curl_exec($curl_zahtev);
  		$json_objekat=json_decode($curl_odgovor, true);
  		curl_close($curl_zahtev);
  		if($json_objekat['poruka'] =="Uspesno ste se ulogovali!") {
              $id=$json_objekat['id'];
  			header("Location: zakazi.php?id=$id");
  		}else{
          echo "<script>alert('Logovanje nije uspesno!');document.location='/projekat/mojprojekat/admin/index.php?pocetna=1'</script>";

      }
    }




}

if(isset($_GET['pocetna'])){
    ?>
     <!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link rel="icon" type="image/png" href="../resources/img/icon.png"/>
  </head>

  <body class="align">

    <div class="grid">

      <form action="index.php" method="post" class="form login">

        <div class="form__field">
          <label for="login__username"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg><span class="hidden">Username</span></label>
          <input id="login__username" type="text" name="username" class="form__input" placeholder="Username" required>
        </div>

        <div class="form__field">
          <label for="login__password"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use></svg><span class="hidden">Password</span></label>
          <input id="login__password" type="password" name="password" class="form__input" placeholder="Password" required>
        </div>

        <div class="form__field">
          <input type="submit" name="dugme1" value="Ulogujte se">
        </div>

      </form>

      <p class="text--center">Niste član? <a href="../pages/registracija.php">Registrujte se odmah!</a> <svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="assets/images/icons.svg#arrow-right"></use></svg></p>

    </div>

    <svg xmlns="http://www.w3.org/2000/svg" class="icons"><symbol id="arrow-right" viewBox="0 0 1792 1792"><path d="M1600 960q0 54-37 91l-651 651q-39 37-91 37-51 0-90-37l-75-75q-38-38-38-91t38-91l293-293H245q-52 0-84.5-37.5T128 1024V896q0-53 32.5-90.5T245 768h704L656 474q-38-36-38-90t38-90l75-75q38-38 90-38 53 0 91 38l651 651q37 35 37 90z"/></symbol><symbol id="lock" viewBox="0 0 1792 1792"><path d="M640 768h512V576q0-106-75-181t-181-75-181 75-75 181v192zm832 96v576q0 40-28 68t-68 28H416q-40 0-68-28t-28-68V864q0-40 28-68t68-28h32V576q0-184 132-316t316-132 316 132 132 316v192h32q40 0 68 28t28 68z"/></symbol><symbol id="user" viewBox="0 0 1792 1792"><path d="M1600 1405q0 120-73 189.5t-194 69.5H459q-121 0-194-69.5T192 1405q0-53 3.5-103.5t14-109T236 1084t43-97.5 62-81 85.5-53.5T538 832q9 0 42 21.5t74.5 48 108 48T896 971t133.5-21.5 108-48 74.5-48 42-21.5q61 0 111.5 20t85.5 53.5 62 81 43 97.5 26.5 108.5 14 109 3.5 103.5zm-320-893q0 159-112.5 271.5T896 896 624.5 783.5 512 512t112.5-271.5T896 128t271.5 112.5T1280 512z"/></symbol></svg>

  </body>

</html>



    <?php
}else{

?>

  <!DOCTYPE html>
<html lang="en">

  <head>
   <link rel="stylesheet" href="css/style.css">
     <link rel="icon" type="image/png" href="..resources/img/icon.png"/>
    <meta charset="utf-8">

    <title>Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link rel="icon" type="image/png" href="resources/img/icon.png"/>
  </head>

  <body class="align">

    <div class="grid">

      <form action="index.php" method="post" class="form login">

        <div class="form__field">
          <label for="login__username"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg><span class="hidden">Username</span></label>
          <input id="login__username" type="text" name="username" class="form__input" placeholder="Username" required>
        </div>

        <div class="form__field">
          <label for="login__password"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use></svg><span class="hidden">Password</span></label>
          <input id="login__password" type="password" name="password" class="form__input" placeholder="Password" required>
        </div>

        <div class="form__field">
          <input type="submit" name="dugme" value="Ulogujte se">
        </div>

      </form>



    </div>

    <svg xmlns="http://www.w3.org/2000/svg" class="icons"><symbol id="arrow-right" viewBox="0 0 1792 1792"><path d="M1600 960q0 54-37 91l-651 651q-39 37-91 37-51 0-90-37l-75-75q-38-38-38-91t38-91l293-293H245q-52 0-84.5-37.5T128 1024V896q0-53 32.5-90.5T245 768h704L656 474q-38-36-38-90t38-90l75-75q38-38 90-38 53 0 91 38l651 651q37 35 37 90z"/></symbol><symbol id="lock" viewBox="0 0 1792 1792"><path d="M640 768h512V576q0-106-75-181t-181-75-181 75-75 181v192zm832 96v576q0 40-28 68t-68 28H416q-40 0-68-28t-28-68V864q0-40 28-68t68-28h32V576q0-184 132-316t316-132 316 132 132 316v192h32q40 0 68 28t28 68z"/></symbol><symbol id="user" viewBox="0 0 1792 1792"><path d="M1600 1405q0 120-73 189.5t-194 69.5H459q-121 0-194-69.5T192 1405q0-53 3.5-103.5t14-109T236 1084t43-97.5 62-81 85.5-53.5T538 832q9 0 42 21.5t74.5 48 108 48T896 971t133.5-21.5 108-48 74.5-48 42-21.5q61 0 111.5 20t85.5 53.5 62 81 43 97.5 26.5 108.5 14 109 3.5 103.5zm-320-893q0 159-112.5 271.5T896 896 624.5 783.5 512 512t112.5-271.5T896 128t271.5 112.5T1280 512z"/></symbol></svg>

  </body>

</html>
<?php
}
    ?>
