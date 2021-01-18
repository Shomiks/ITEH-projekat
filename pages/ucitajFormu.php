<?php
if(isset($_POST['idforme']) and isset($_POST['idusluge'])){

        $idforme=$_POST['idforme'];
         $idusluge=$_POST['idusluge'];
        include "dtb.php";
        $sql="SELECT * FROM usluge WHERE id=$idusluge";
        $result=$conn->query($sql);
        $row=$result->fetch_object();

        if($idforme==1){
            ?>
                <p>&nbsp;</p>
            <div class="form-style-6">
            <form action="pages/izmeni.php" method="post" enctype="multipart/form-data">

            <h1>Izmeni podatke o usluzi</h1>
            <img id="izmizb" src="resources/img/slikeUsluga/<?php echo $row->slika; ?>" alt="" style="width: 200px; height: 200px; margin-left: auto; margin-right: auto; display: block; ">
            <input type="text" name="idusluge" value="<?php echo $row->id; ?>" hidden="hidden">
            <input type="text" name="naziv"  value="<?php echo $row->naziv; ?>" placeholder="Unesi naziv" required>
            <select name="kategorijaa" id="kategorijaa" required>
                <option value="Oralna hirurgija" <?php if($row->kategorija=="Oralna hirurgija"){echo "selected";} ?>>Oralna hirurgija</option>
                <option value="Protetika" <?php if($row->kategorija=="Protetika"){echo "selected";} ?> >Protetika</option>
                <option value="Bolesti zuba" <?php if($row->kategorija=="Bolesti zuba"){echo "selected";} ?>>Bolesti zuba</option>
                <option value="Paradontologija" <?php if($row->kategorija=="Paradontologija"){echo "selected";} ?>>Paradontologija</option>
                <option value="Dečija stomatologija" <?php if($row->kategorija=="Dečija stomatologija"){echo "selected";} ?>>Dečija stomatologija</option>

            </select>
            <input type="text" name="cena" value="<?php echo $row->cena; ?>" placeholder="Unesi cenu" required />
            <textarea name="opis" placeholder="Unesite opis usluge" required><?php echo $row->opis; ?></textarea>

            <input type="submit" name="izmeni" value="IZMENI" />
            </form>
            </div>
                   <p>&nbsp;</p>

            <?php
        }else if($idforme==2){
            ?>
                <p>&nbsp;</p>
            <div class="form-style-6">
            <form action="pages/izmeni.php" method="post">

            <h1>Izbriši uslugu</h1>
             <img id="izmizb" src="<?php echo $row->slika; ?>" alt=""  style="width: 200px; height: 200px; margin-left: auto; margin-right: auto; display: block; ">
             <input type="text" name="idusluge" value="<?php echo $row->id; ?>" hidden="hidden">
            <input type="text" name="naziv"  value="<?php echo $row->naziv; ?>" placeholder="Unesi naziv" readonly>
            <select name="kategorijaa" id="kategorijaa" disabled >
                <option value="Oralna hirurgija" <?php if($row->kategorija=="Oralna hirurgija"){echo "selected";} ?>>Oralna hirurgija</option>
                <option value="Protetika" <?php if($row->kategorija=="Protetika"){echo "selected";} ?> >Protetika</option>
                <option value="Bolesti zuba" <?php if($row->kategorija=="Bolesti zuba"){echo "selected";} ?>>Bolesti zuba</option>
                <option value="Paradontologija" <?php if($row->kategorija=="Paradontologija"){echo "selected";} ?>>Paradontologija</option>
                <option value="Dečija stomatologija" <?php if($row->kategorija=="Dečija stomatologija"){echo "selected";} ?>>Dečija stomatologija</option>

            </select>
            <input type="text" name="cena" value="<?php echo $row->cena; ?>" placeholder="Unesi cenu" readonly />
            <textarea name="opis" placeholder="Unesite opis usluge" readonly><?php echo $row->opis; ?></textarea>
            <input type="submit" name="izbrisi" value="IZBRIŠI" />
            </form>
            </div>
                   <p>&nbsp;</p>

            <?php

        }



}


?>
