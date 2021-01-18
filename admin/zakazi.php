<?php

if(isset($_POST['obradi'])){
    $idzak=$_POST['idzak'];
    $idadmina=$_POST['idadmina'];

        $curl_zahtev2 = curl_init("http://localhost/projekat/mojprojekat/rest/obrada/$idzak");
		curl_setopt($curl_zahtev2, CURLOPT_PUT, TRUE);
		curl_setopt($curl_zahtev2, CURLOPT_RETURNTRANSFER, 1);
		$curl_odgovor2 = curl_exec($curl_zahtev2);
		$json_objekat2=json_decode($curl_odgovor2, true);
		curl_close($curl_zahtev2);
        if($json_objekat2['poruka']=="Uspesno obradjeno zakazivanje!"){
            header("Location: zakazi.php?id=".$idadmina);
        }
}
if(isset($_POST['obrisi'])){
     $idzak=$_POST['idzak'];
    $idadmina=$_POST['idadmina'];

        $curl_zahtev2 = curl_init("http://localhost/projekat/mojprojekat/rest/obrisi/$idzak");
		curl_setopt($curl_zahtev2, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($curl_zahtev2, CURLOPT_RETURNTRANSFER, 1);
		$curl_odgovor2 = curl_exec($curl_zahtev2);
		$json_objekat2=json_decode($curl_odgovor2, true);
		curl_close($curl_zahtev2);
        if($json_objekat2['poruka']=="Uspesno obrisano zakazivanje!"){
            header("Location: zakazi.php?id=".$idadmina);
        }


}

    if(isset($_GET['id'])){

        $idadmina=$_GET['id'];

        $curl_zahtev = curl_init("http://localhost/projekat/mojprojekat/rest/imeIPrezime/$idadmina");
		curl_setopt($curl_zahtev, CURLOPT_POST, TRUE);
		curl_setopt($curl_zahtev, CURLOPT_RETURNTRANSFER, 1);
		$curl_odgovor = curl_exec($curl_zahtev);
		$json_objekat=json_decode($curl_odgovor, true);
		curl_close($curl_zahtev);
        if(isset($_GET['idkupca'])){
            $idkupcaa=$_GET['idkupca'];
        $curl_zahtev = curl_init("http://localhost/projekat/mojprojekat/rest/pacijentZakaz/$idkupcaa");
		curl_setopt($curl_zahtev, CURLOPT_PUT, TRUE);
		curl_setopt($curl_zahtev, CURLOPT_RETURNTRANSFER, 1);
		$curl_odgovor = curl_exec($curl_zahtev);
		$json_objekat2=json_decode($curl_odgovor, true);
		curl_close($curl_zahtev);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="../resources/webcss/tabela.css">
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <link rel="icon" type="image/png" href="..resources/img/icon.png"/>
    <title>Dentologie</title>
</head>
<body>
  <h2>Administrator: <?php echo $json_objekat['ime']." ".$json_objekat['prezime']  ?></h2>

<h2>Zakazane usluge</h2>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">Redni broj</th>
<th class="text-left">ID pacijenta</th>
<th class="text-left">ID usluge</th>
<th class="text-left">Grad</th>
<th class="text-left">Adresa</th>
<th class="text-left">Poruka</th>
<th class="text-left">Obradi</th>

</tr>
</thead>
<tbody class="table-hover">

<?php
    $curl_zahtev = curl_init("http://localhost/projekat/mojprojekat/rest/zakazivanje.json");
						curl_setopt($curl_zahtev, CURLOPT_RETURNTRANSFER, 1);
						$curl_odgovor = curl_exec($curl_zahtev);
						$json_objekat=json_decode($curl_odgovor, true);
						curl_close($curl_zahtev);
      if(!empty($json_objekat['zakazivanje'])){
    foreach($json_objekat['zakazivanje'] as $zakaz){
    ?>
<tr>
<td class="text-left"><?php echo $zakaz['idzak']; ?></td>
<td class="text-left"> <?php echo $zakaz['idkorisnika']; ?></td>
<td class="text-left"><?php echo $zakaz['idusluge']; ?></td>
<td class="text-left"><?php echo $zakaz['grad']; ?></td>
<td class="text-left"><?php echo $zakaz['adresa']; ?></td>
<td class="text-left"><?php echo $zakaz['poruka']; ?></td>
<td class="text-left"><input type="radio" onchange="zakazAjax(<?php echo $zakaz['idzak']; ?>)"
  value="<?php echo $zakaz['idzak']; ?>"></td>

</tr>
<?php }

    }?>
</tbody>
</table>
<p>&nbsp;</p>

   <div id="funkcije">
   <select name="narucioci" id="narucioci" onchange="naruciocAjax()">
       <option value="">Trenutni naručioci</option>
       <?php
            foreach($json_objekat["korisnici"] as $json){
                ?>
                <option value="<?php echo $json['id'] ?>"><?php echo $json['id']." ".$json['ime']." ".$json['prezime'] ?></option>
                <?php
                }
       ?>
   </select>
    </div>
    <div id="result">
    </div>


</body>
<script type="text/javascript">
    function naruciocAjax() {
        var id=$("#narucioci").val();
       $("#result").html("");
		$.post("ucitajPacijenta.php", {id: id, idadmina: <?php echo $idadmina;?>}, function( data ) {
  $("#result").html(data);
});
 $('html, body').animate({
        scrollTop: $("#result").offset().top
    }, 2000);
}
      function zakazAjax(idz) {
        var id=idz;
       $("#result").html("");
		$.post("ucitajZakazano.php", {id: id, idadmina: <?php echo $idadmina;?> }, function( data ) {
  $("#result").html(data);
});
 $('html, body').animate({
        scrollTop: $("#result").offset().top
    }, 2000);
}

    </script>
</html>
