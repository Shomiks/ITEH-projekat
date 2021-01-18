<?php
        if(isset($_POST['id']) and isset($_POST['idadmina'])){
            $id=$_POST['id'];
            $idadmina=$_POST['idadmina'];
            if(!empty($id)){


             $parameters = '[{'.

		'"id"'.':"'.$id.'"'
		.'}]';
		    
    $curl_zahtev = curl_init("http://localhost/projekat/mojprojekat/rest/klijent.json");
		curl_setopt($curl_zahtev, CURLOPT_POST, TRUE);
		curl_setopt($curl_zahtev, CURLOPT_POSTFIELDS, $parameters);
		curl_setopt($curl_zahtev, CURLOPT_RETURNTRANSFER, 1);
		$curl_odgovor = curl_exec($curl_zahtev);
		$json_objekat=json_decode($curl_odgovor, true);
		curl_close($curl_zahtev);

            ?>
            <table class="table-fill">
<thead>
<tr>
<th class="text-left">Redni broj zakazivanja</th>
<th class="text-left">ID pacijenta</th>
<th class="text-left">Ime</th>
<th class="text-left">Prezime</th>
<th class="text-left">Grad</th>
<th class="text-left">Adresa</th>
<th class="text-left">Poruka</th>
<th class="text-left">Naziv usluge</th>
<th class="text-left">Cena</th>
</tr>
</thead>
<tbody class="table-hover">

<?php


      if($json_objekat['poruka']=="Uspesno ispisana zakazivanja!"){
          if(!empty($json_objekat['obradjeno'])){
    foreach($json_objekat['obradjeno'] as $obradjena){
    ?>

<tr>
<td class="text-left"><?php echo $obradjena['idzak']; ?></td>
<td class="text-left"><?php echo $obradjena['id']; ?></td>
<td class="text-left"> <?php echo $obradjena['ime']; ?></td>
<td class="text-left"><?php echo $obradjena['prezime']; ?></td>
<td class="text-left"><?php echo $obradjena['grad']; ?></td>
<td class="text-left"><?php echo $obradjena['adresa']; ?></td>
<td class="text-left"><?php echo $obradjena['poruka']; ?></td>
<td class="text-left"><?php echo $obradjena['naziv']; ?></td>
<td class="text-left"><?php echo $obradjena['cena']; ?></td>

</tr>
<?php }
          ?>
<th class="text-left">Do sada potrošio (RSD)</th>
<td class="text-left"></td>
<td class="text-left"></td>
<td class="text-left"></td>
<td class="text-left"></td>
<td class="text-left"></td>
<td class="text-left"></td>
<td class="text-left"></td>
<td class="text-left"><?php echo $json_objekat['sumaObradjenih']; ?></td>
          <?php
          }
         if(!empty($json_objekat['neobradjeno'])){
     foreach($json_objekat['neobradjeno'] as $neobradjena){
    ?>
<tr>
<td class="text-left"><?php echo $neobradjena['idzak']; ?></td>
<td class="text-left"><?php echo $neobradjena['id']; ?></td>
<td class="text-left"> <?php echo $neobradjena['ime']; ?></td>
<td class="text-left"><?php echo $neobradjena['prezime']; ?></td>
<td class="text-left"><?php echo $neobradjena['grad']; ?></td>
<td class="text-left"><?php echo $neobradjena['adresa']; ?></td>
<td class="text-left"><?php echo $neobradjena['poruka']; ?></td>
<td class="text-left"><?php echo $neobradjena['naziv']; ?></td>
<td class="text-left"><?php echo $neobradjena['cena']; ?></td>

</tr>
<?php }
          ?>
<th class="text-left">Za naplatu (RSD)</th>
<td class="text-left"></td>
<td class="text-left"></td>
<td class="text-left"></td>
<td class="text-left"></td>
<td class="text-left"></td>
<td class="text-left"></td>
<td class="text-left"></td>
<td class="text-left"><?php echo $json_objekat['sumaNeobradjenih']; ?></td>
          <?php
         }
         }?>
</tbody>
</table>

<p>&nbsp;</p>
     <p>
    <a href="/projekat/mojprojekat" id="poc">Početna</a>
    </p>
<p>&nbsp;</p>

<?php if(!empty($json_objekat['neobradjeno'])){
          ?>
<a href="zakazi.php?id=<?php echo $idadmina; ?>&idkupca=<?php echo $neobradjena['id']; ?>" id="obradaU">Obradi zakazane termine</a>
<p>&nbsp;</p>

    <?php  } ?>

<style type="text/css">
#obradaU{
    width: 200px;
    padding: 10px;
    color: white;
    background-color: #350b60;
    font-size: 18px;
    border-radius: 20px;
    border: 3px solid #140529;
    text-decoration: none;
    margin-left: 20%;
}

#poc{
    width: 200px;
    padding: 10px;
    color: white;
    background-color: #350b60;
    font-size: 18px;
    border-radius: 20px;
    border: 3px solid #140529;
    text-decoration: none;
    margin-left: 20%;
}
</style>




            <?php
                }
        }




?>
