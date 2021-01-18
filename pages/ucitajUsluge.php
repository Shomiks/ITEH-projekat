<?php
	include "dtb.php";
        $idkupc=-1;
        if(isset($_POST['idkupca'])){$idkupc=$_POST['idkupca'];}
          if(isset($_POST['ordersel'])){
          $sortiraj=$_POST['ordersel'];
           if(!empty($sortiraj)){
           $part1=" ORDER BY cena $sortiraj";
           }else {$part1="";}
       }else{ $part1="";}


        if(isset($_POST['kategsel'])){
            $kate=$_POST['kategsel'];
            if(!empty($kate)){
                $part2="SELECT * FROM usluge WHERE `kategorija`='".$kate."'";
            }else{
                $part2="SELECT * FROM usluge";
            }

        }else{$part2="SELECT * FROM usluge"; }

            if(isset($_POST['search'])){
            $srch=$_POST['search'];
            if(!empty($srch)){
                if(empty($kate)){ $part3=" WHERE `IME` LIKE '$srch%'";}
               else{$part3=" AND `IME` LIKE '$srch%'";}
            }else{
                $part3="";
            }

        }else{$part3=""; }

 $sql=$part2.$part3.$part1;
    $sql1="SELECT COUNT(*) AS REDOVA FROM usluge";
$result=$conn->query($sql);
    $result1=$conn->query($sql1);
 $row1=$result1->fetch_object();
    $br=0;
    $br1=0;
?>

   <?php

	 while($row=$result->fetch_object()){
         $br++;
         $br1++;
         if($br>3){$br=1;}
         if($br!==1){
         ?>

         <div class="col span-1-of-3" >
         	<img  src="resources/img/slikeUsluga/<?php echo $row->slika; ?>" class="profil" alt="" id="sl">
         	<br>
         	<h4 id="naz"><?php echo $row->naziv ?></h4>
         	<br>
                    <p id="kateg"><i class="ion-ios-pricetags-outline"> </i><i> Kategorija: <?php echo $row->kategorija ?></i></p>
                <br>
                    <p id="opis"><?php echo $row->opis ?></p>
                    <br>

         	<p class="cena"><b>Cena: <?php echo $row->cena; ?> RSD</b></p>
           <a href="#" id="porudzbina" onclick="zakazivanjeForma(<?php echo $row->id; ?>,<?php echo $idkupc; ?>)">Zakaži</a>

            </div>


	<?php } else{ ?>
 <script src="resources/js/functions.js" type="text/javascript"></script>
             <div class="row">

             <div class="col span-1-of-3">
         	<img  src="resources/img/slikeUsluga/<?php echo $row->slika; ?>" class="profil" alt="" id="sl">
         	<br>
         	<h4 id="naz"><?php echo $row->naziv ?></h4>
         	<br>
                    <p id="kateg"><i class="ion-ios-pricetags-outline"> </i><i> Kategorija: <?php echo $row->kategorija ?></i></p>
                <br>
                    <p id="opis"><?php echo $row->opis ?></p>
                    <br>

         	<p class="cena"><b>Cena: <?php echo $row->cena; ?> RSD</b></p>
        <a href="#" id="porudzbina" onclick="zakazivanjeForma(<?php echo $row->id; ?>,<?php echo $idkupc; ?>)">Zakaži</a>
            </div>

            <style type="text/css">
                #result{
                  width: 80%;
                  margin-left: 5%;
                        }
                #opis{ text-align: justify;
                padding-left: 10px;
                padding-right: 10px;
                    font-size: 80%;
                }
                .cena{
                    padding-top: 5px;
                     padding-left: 10px;
                      color: #7b1484;
                    float: left;
                   width: 200px;

                }
                #sl{
                    padding-left: 15%;
                    width: 250px;
                    height: 200px;
                }
                #kateg{
                    text-align: center;
                    padding: auto;
                    font-size: 90%;
                    color: #b620c3;
                }
                #naz{
                    text-align: center;
                    padding: auto;
                    color: #7b1484;

                }
                #porudzbina{
                    float: right;
                    text-decoration: none;
                    display: block;
                    padding: 5px 20px;
                    margin-left: 10px;
                    color: #fff;
                    background-color: #712777;
                    border-radius: 5px;
                    transition: background-color 0.3s;
                }
                #porudzbina:hover{
                     background-color: #b235bc;

                }
                #funkc{
                    width: 80%;
                    margin-left: 10%;
                    margin-bottom: 5%;
                    padding-top: 50px;
                }
                #funkc select{
                    color: #fff;
                    width: 200px;
                    height: 30px;
                    font-size: 80%;
                    background-color: #b235bc;
                    border-radius: 10px;
                }

                #kategsel{
                    margin-left: 10%;

                }
                #ordersel{
                    float: right;
                    margin-right: 10%;
                }


            </style>

        <?php }
         if($br==3 or $br1==$row1->REDOVA){
             ?>
                </div>
         <?php }


     } ?>

     <?php
    $conn->close();
?>
