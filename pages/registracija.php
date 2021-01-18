<?php
include "dtb.php";
    if(isset($_POST['potvrda'])){
        $ime=$_POST['ime'];
        $prezime=$_POST['prezime'];
        $email=$_POST['email'];
        $username=$_POST['username'];
        $password=$_POST['password'];

         $sql="INSERT INTO korisnik (ime, prezime, email, username, password) VALUES ('".$ime."','".$prezime."','".$email."','".$username."','".$password."')";
        $conn->query($sql);

        header("Location: /projekat/mojprojekat/admin/index.php?pocetna=1");


    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <link rel="stylesheet" href="css/style.css">
     <link rel="stylesheet" href="../resources/css/regcss.css">
     <link rel="stylesheet" href="../resources/css/style.css">
     <link rel="stylesheet" href="../resources/webcss/forma.css">
    <link rel="icon" type="image/png" href="../resources/img/icon.png"/>
    <title>Registracija</title>
</head>
<body>
         <div class="form-style-6">
            <form action="registracija.php" method="post">

            <h1>Unesite svoje podatke</h1>
         <div class="form__field">
            <input type="text" name="ime" placeholder="Ime" required />
        </div>
         <div class="form__field">
            <input type="text" name="prezime" placeholder="Prezime" required />
        </div>
         <div class="form__field">
            <input type="email" name="email" placeholder="Email" required />
        </div>
         <div class="form__field">
            <input type="text" name="username" placeholder="Username"  required />
        </div>
         <div class="form__field">
            <input type="text" name="password" placeholder="Password" required/>
        </div>
         <div class="form__field">
            <input type="submit" name="potvrda" value="POTVRDI" />
         </div>
            </form>
    </div>
</body>

</html>
