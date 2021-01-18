<?php

	include "dtb.php";
    $idkupc=-1;
if(isset($_POST['idkupca']))
  {$idkupc=$_POST['idkupca'];}
if(empty($idkupc)){$idkupc=0;}
  $sql2="SELECT DISTINCT kategorija FROM usluge";
    $result2=$conn->query($sql2);
   if(isset($_POST['odabranakateg'])){

     $k=$_POST['odabranakateg'];

?>
 <div id="funkc">
  <select name="kategsel" id="kategsel" onchange="kategorijaOrderAjax(<?php echo $idkupc; ?>)">
     <option value="">Izaberite kategoriju</option>
      <?php
      while($row2=$result2->fetch_object()){
          $odk=$row2->kategorija;
      ?>
      <option  value="<?php echo $row2->kategorija;?>" <?php if($odk==$k) echo "selected";?>  ><?php echo $row2->kategorija; ?></option>
      <?php } ?>
  </select>
  <select name="ordersel" id="ordersel" onchange="kategorijaOrderAjax(<?php echo $idkupc; ?>)">
      <option value="">Sortiraj po ceni</option>
      <option value="ASC">Rastući redosled</option>
      <option value="DESC">Opadajući redosled</option>
  </select>

  </div>
   <div id="usluge">
   <?php include "ucitajUsluge.php";?>
   <script>kategorijaOrderAjax(<?php echo $idkupc; ?>)</script>
</div>
 <?php
  }else {
       ?>
       <div id="funkc">
  <select name="kategsel" id="kategsel" onchange="kategorijaOrderAjax(<?php echo $idkupc; ?>)">
     <option value="">Izaberite kategoriju</option>
      <?php
      while($row2=$result2->fetch_object()){
      ?>
      <option  value="<?php echo $row2->kategorija;?>" ><?php echo $row2->kategorija; ?></option>
      <?php } ?>
  </select>
  <select name="ordersel" id="ordersel" onchange="kategorijaOrderAjax(<?php echo $idkupc; ?>)">
      <option value="">Sortiraj po ceni</option>
      <option value="ASC">Rastući redosled</option>
      <option value="DESC">Opadajući redosled</option>
  </select>

  </div>
   <div id="usluge">
   <?php include "ucitajUsluge.php"; ?>
</div>
<p>&nbsp;</p>
 <?php
  }
?>
