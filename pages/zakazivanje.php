<?php
include "dtb.php";
$idkupca="";
if(isset($_POST['idkupca'])){
    $idkupca=$_POST['idkupca'];
    if($idkupca!=="0"){

if(isset($_POST['prodaja'])){
    $idusluge=$_POST['idusluge'];
    $idk=$_POST['idkupca'];
    $grad=$_POST['grad'];
    $adresa=$_POST['adresa'];
    $poruka=$_POST['poruka'];
    $status="neobradjeno";

    $sql="INSERT INTO zakazivanje (idkorisnika, grad, adresa, poruka, idusluge, status) VALUES ( $idk,'".$grad."','".$adresa."','".$poruka."',$idusluge,'".$status."')";
    $conn->query($sql);
     $conn->close();
header('Location:../index.php?idkupca=$id');



}
if(isset($_POST['id'])){

    $id=$_POST['id'];
    $sql="SELECT * FROM usluge WHERE id=$id";
    $result=$conn->query($sql);
    $row=$result->fetch_object();


?>
        <p>&nbsp;</p>

   <div class="row" id="prodaja" style="width: 80%; margin-left: 10%;">
    <div class="col span-1-of-2">
        <img src="<?php echo $row->slika ?>" alt="" id="slikapro" style="width: 500px; height: 500px; border-radius: 0.35rem;">
    </div>
    <div class="col span-1-of-2">

          <h4 id="naz" style="text-align: center; color: #7b1484;"><?php echo $row->naziv; ?></h4>
          <br>
            <p><?php echo $row->opis;?></p> <br>
            <p class="cena" style="color: #7b1484; width: 200px;"><b>Cena: <?php echo $row->cena; ?> RSD</b></p> <br>
               <div class="form-style-6">
            <form action="pages/zakazivanje.php" method="post">

            <h1>Unesite podatke za zakazivanje</h1>
            <input type="text" name="idkupca" hidden="hidden" value="<?php echo $idkupca; ?>">
            <input type="text" name="idusluge" hidden="hidden" value="<?php echo $row->id; ?>">
            <input type="text" name="grad" placeholder="Grad" />
            <input type="text" name="adresa" placeholder="Adresa" />
            <textarea name="poruka" placeholder="Unesite poruku za nas"></textarea>
            <input type="submit" name="prodaja" value="POTVRDI" />
            </form>
            </div>
            </div>
</div>
<p>&nbsp;</p>

<?php }
    }else{
        ?>

    <script type="text/javascript"> alert("Morate se ulogovati da bi mogli da zakazujete usluge!")</script>

    <?php
         }
}
?>
