<?php
require 'flight/Flight.php';
require 'jsonindent.php';

Flight::route('/', function(){
    die();
});

Flight::register('db', 'Database', array('stomatoloska_ordinacija'));

Flight::route('GET /zakazivanje.json', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$db->selectZakazi();

	$niz =  array();


	while ($row= $db->getResult()->fetch_object())
	{
		array_push($niz,$row);

	}

    $db->selectKorisnici();
	$niz2 =  array();

	while ($row= $db->getResult()->fetch_object())
	{
		array_push($niz2,$row);
	}
    $response= array();
    $response["zakazivanje"]= $niz;
     $response["korisnici"]= $niz2;

	echo indent(json_encode($response));
});

Flight::route('POST /zakupca.json', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$post_data = file_get_contents('php://input');
	$json_data = json_decode($post_data,true);
	$db->ucitajZakazano($json_data);
    $response=array();
	if($db->getZakazivanje())
	{
        $row=$db->getResult()->fetch_object();
		$response["zakazivanje"]=$row;

	}
	else
	{
		$response = "Zakazivanje nije pronadjeno!";

	}

	echo indent(json_encode($response));

});

Flight::route('POST /login.json', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$post_data = file_get_contents('php://input');
	$json_data = json_decode($post_data,true);
	$db->proveriLogin($json_data);
    $response=array();
	if($db->getAdmin())
	{
		$response["poruka"] = "Uspesno ste se ulogovali!";
        $row=$db->getResult()->fetch_object();
        $response["id"]=$row->id;
	}
	else
	{
		$response['poruka'] = "Administrator sa ovim podacima ne postoji u bazi!";

	}

	echo indent(json_encode($response));

});
Flight::route('POST /loginKorisnik.json', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$post_data = file_get_contents('php://input');
	$json_data = json_decode($post_data,true);
	$db->proveriLoginKorisnik($json_data);
    $response=array();
	if($db->getKorisnik())
	{
		$response["poruka"] = "Uspeno ste se ulogovali!";
        $row=$db->getResult()->fetch_object();
        $response["id"]=$row->id;
	}
	else
	{
		$response['poruka'] = "Korisnik sa ovim podacima ne postoji u bazi!";

	}

	echo indent(json_encode($response));

});

Flight::route('POST /imeIPrezime/@id', function($id)
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();

	$db->pronadjiImeiPrezime($id);
    $response=array();
    $row=$db->getResult()->fetch_object();
	$response["ime"]=$row->ime;
    $response["prezime"]=$row->prezime;


	echo indent(json_encode($response));

});
Flight::route('PUT /pacijentZakaz/@id', function($id)
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();

	$db->pacijentZakaz($id);
    $response=array();
    if($db->getResult()){
	$response["poruka"]="Uspesno obradjeno zakazivanja!";
        }else {
    $response["poruka"]="Neuspesna obrada zakazivanja!";
    }


	echo indent(json_encode($response));

});




Flight::route('POST /klijent.json', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$post_data = file_get_contents('php://input');
	$json_data = json_decode($post_data,true);
    $response=array();
    $neobradjeno=array();
    $obradjeno=array();
    $sumaO="";
    $sumaN="";
    $kupac="";
	$db->neobradjeniZakaziPacijenta($json_data);
	if($db->getZakaziPacijenta())
	{
        $result=$db->getResult();
		while($row=$result->fetch_object()){
             $kupac=$row->id;
            array_push($neobradjeno,$row);

        }
        $db->obradjeniZakaziPacijenta($json_data);
        if($db->getZakaziPacijenta()){
             $result=$db->getResult();
		  while($row=$result->fetch_object()){
              $kupac=$row->id;
            array_push($obradjeno,$row);

        }
            $db->sumaNeobradjenihZakazivanja($json_data);
            $row=$db->getResult()->fetch_object();
            $sumaN=$row->sumaNeobradjenih;
            $db->sumaObradjenihZakazivanja($json_data);
            $row=$db->getResult()->fetch_object();
            $sumaO=$row->sumaObradjenih;
            $response['kupac']=$kupac;
            $response['poruka']="Uspesno ispisana zakazivanja!";
            $response["obradjeno"]=$obradjeno;
            $response["neobradjeno"]=$neobradjeno;
            $response["sumaNeobradjenih"]=$sumaN;
            $response["sumaObradjenih"]=$sumaO;


        }else{
            $response['poruka'] = "Doslo je do greske pri ispisivanju zakazivanja!";
        }
	}
	else
	{
		$response['poruka'] = "Doslo je do greske pri ispisivanju zakazivanja!";
	}


	echo indent(json_encode($response));

});


Flight::route('PUT /obrada/@idzak', function($idzak)
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();


	$db->obradi($idzak);
    $response=array();
    if($db->getResult()){
    $response["poruka"]="Uspesno obradjeno zakazivanje!";
    }
    else {
        $response["poruka"]="Neuspeno obradjeno zakazivanje!";}
	echo indent(json_encode($response));

});
Flight::route('DELETE /obrisi/@idzak', function($idzak)
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();


	$db->obrisi($idzak);
    $response=array();
    if($db->getResult()){
    $response["poruka"]="Uspesno obrisano zakazivanje!";
    }
    else {
        $response["poruka"]="Neuspeno obrisano zakazivanje!";}
	echo indent(json_encode($response));

});



Flight::start();
?>
