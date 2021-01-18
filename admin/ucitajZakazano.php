<?php
    if(isset($_POST['id'])){

        $id=$_POST['id'];
        $idadmina=$_POST['idadmina'];
         $parameters = '[{'.

'"id"'.':"'.$id.'"'
.'}]';

$curl_zahtev = curl_init("http://localhost/projekat/mojprojekat/rest/zakupca.json");
curl_setopt($curl_zahtev, CURLOPT_POST, TRUE);
curl_setopt($curl_zahtev, CURLOPT_POSTFIELDS, $parameters);
curl_setopt($curl_zahtev, CURLOPT_RETURNTRANSFER, 1);
$curl_odgovor = curl_exec($curl_zahtev);
$json_objekat2=json_decode($curl_odgovor, true);
curl_close($curl_zahtev);
        $json_objekat=$json_objekat2['zakazivanje'];




    ?>

        <link rel="stylesheet" href="../resources/webcss/forma.css">
     <div class="form-style-6">
        <form action="zakazi.php" method="post">

        <h1>Podaci o pacijentu </h1>
        <input type="text" name="idadmina" hidden="hidden" value="<?php echo $idadmina; ?>">
        <input type="text" name="idzak" hidden="hidden" value="<?php echo $json_objekat['idzak']; ?>">
        <label for="">Ime</label><input type="text" name="ime" value="<?php echo $json_objekat['ime']; ?>" />
        <label for="">Prezime</label><input type="text" name="prezime" value="<?php echo $json_objekat['prezime']; ?>" />
        <label for="">Grad</label><input type="text" name="grad" value="<?php echo $json_objekat['grad']; ?>" />
        <label for="">Adresa</label><input type="text" name="adresa" value="<?php echo $json_objekat['adresa']; ?>"  />
         <label for="">Poruka</label><textarea name="poruka"><?php echo $json_objekat['poruka']; ?></textarea>
        <label for="">Naziv usluge</label><input type="text" name="naziv" value="<?php echo $json_objekat['naziv']; ?>" />
        <label for="">Cena u RSD</label><input type="text" name="cena" value="<?php echo $json_objekat['cena']; ?>" />
        <input type="submit" name="obradi" value="POTVRDA ZAKAZIVANJA" />
        <input type="submit" name="obrisi" value="OBRIŠI"/>
        </form>
</div>

<?php
    }

?>
