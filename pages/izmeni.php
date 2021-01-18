<?php
include "dtb.php";
if(isset($_POST['izmeni'])){
    $idusluge=$_POST['idusluge'];
    $naziv=$_POST['naziv'];
$kategorijaa=$_POST['kategorijaa'];
$cena=$_POST['cena'];
$opis=$_POST['opis'];

     $sql="UPDATE usluge SET naziv='".$naziv."',kategorija='".$kategorijaa."',opis='".$opis."',cena='".$cena."' WHERE id='".$idusluge."'";
        $conn->query($sql);


   header('Location: ../index.php');


}
if(isset($_POST['izbrisi'])){
     $idusluge=$_POST['idusluge'];
    $sql="DELETE FROM usluge WHERE id='".$idusluge."'";
    $conn->query($sql);
       header('Location: ../index.php');
}





$sql="SELECT * FROM usluge";
$result=$conn->query($sql);


?>


  <p>&nbsp;</p>
<table class="table-fill">
<thead>
<tr style="height: 3em;">
<th class="text-left">Usluga</th>
<th class="text-left">Slika</th>
<th class="text-left">Izmeni</th>
<th class="text-left">Izbriši</th>
</tr>
</thead>
<tbody class="table-hover">
<?php
    while($row=$result->fetch_object()){
    ?>
<tr>
<td class="text-left"><?php echo $row->naziv; ?></td>
<td class="text-left"> <img src="resources/img/slikeUsluga/<?php echo $row->slika; ?>" alt=""></td>
<td class="text-left"><input type="radio" name="radiob" value="<?php echo $row->id; ?>" onchange="izmeniUsluguAjax(<?php echo $row->id; ?>)"></td>
<td class="text-left"><input type="radio" name="radiob" value="<?php echo $row->id; ?>" onchange="izbrisiUsluguAjax(<?php echo $row->id; ?>)"></td>
</tr>
<?php } ?>
</tbody>
</table>
<p>&nbsp;</p>
