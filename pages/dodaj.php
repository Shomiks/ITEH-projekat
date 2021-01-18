<?php
include "dtb.php";
if(isset($_POST['dodaj'])){
    $naziv=$_POST['naziv'];
    $kategorijaa=$_POST['kategorijaa'];
    $cena=$_POST['cena'];
    $opis=$_POST['opis'];

    $targetfolder ="../resources/img/slikeUsluga/";
    $targetfolder = $targetfolder . basename( $_FILES['file']['name']);
    $putanja=basename( $_FILES['file']['name']);
    $sql="INSERT INTO usluge (kategorija, naziv, opis, slika, cena) VALUES ('".$kategorijaa."','".$naziv."','".$opis."','".$putanja."','".$cena."')";

 $ok=1;

$file_type=$_FILES['file']['type'];

if ($file_type=="image/jpeg") {

 if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
 {
$conn->query($sql);
header('Location: ../index.php');

 }
}

}

$sql="SELECT slika FROM usluge";
$result=$conn->query($sql);
$br=0;
$slike=array();
?>
<div class="row" id="dod">
 <div class="col span-1-of-3">
     <?php while($row=$result->fetch_object()){
    if($br<3){
    $br=$br+1;

    ?>
    <img id="dodajslika" src="resources/img/slikeUsluga/<?php echo $row->slika; ?>" alt="">

<?php } else {$sl=$row->slika; array_push($slike, $sl);}
    }
     ?>

 </div>

 <div class="col span-1-of-3">
             <p>&nbsp;</p>
      <div class="form-style-6">

            <form action="pages/dodaj.php" method="post" enctype="multipart/form-data">
            <h1>Unesite podatke o usluzi koju želite da predložite</h1>
            <input type="text" name="naziv"  value="" placeholder="Unesi naziv">

            <select name="kategorijaa" id="kategorijaa">
                <option value="Oralna hirurgija">Oralna hirurgija</option>
                <option value="Protetika">Protetika</option>
                <option value="Bolesti zuba">Bolesti zuba</option>
                <option value="Paradontologija">Paradontologija</option>
                <option value="Dečija stomatologija">Dečija stomatologija</option>

            </select>
            <input type="text" name="cena" placeholder="Unesi cenu" />
            <textarea name="opis" placeholder="Unesite opis usluge"></textarea>
             <input type="file" name="file">
              <p>&nbsp;</p>
            <input type="submit" name="dodaj" value="DODAJ" />
            </form>
  </div>
 </div>
             <div class="col span-1-of-3">
                  <img src="resources/img/slikeUsluga/<?php echo $slike[0]; ?>" id="dodajslika2" alt="">
                  <img src="resources/img/slikeUsluga/<?php echo $slike[1]; ?>" id="dodajslika2" alt="">
                  <img src="resources/img/slikeUsluga/<?php echo $slike[2]; ?>" id="dodajslika2" alt="">
             </div>
</div>
