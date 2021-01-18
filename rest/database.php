<?php
class Database {
	private $hostname = "localhost";
	private $username = "root";
	private $password = "";
	private $dbname = "stomatoloska_ordinacija";
	private $dblink;
	private $result = true;
	private $records;
	private $affectedRows;
    private $admin=false;
    private $zakaziPacijenta=false;
    private $zakazivanje=false;
     private $korisnik=false;

 
	function __construct($dbname)
	{
		$this->$dbname = $dbname;
		$this->Connect();
	}

	public function getResult()
	{
		return $this->result;
	}
    public function getKorisnik()
	{
		return $this->korisnik;
	}
    public function getZakazivanje()
	{
		return $this->zakazivanje;
	}
    public function getAdmin()
	{
		return $this->admin;
	}
     public function getZakaziPacijenta()
	{
		return $this->zakaziPacijenta;
	}

	function __destruct()
	{
		$this->dblink->close();
	}


	function Connect()
	{
		$this->dblink = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
		if($this->dblink->connect_errno)
		{
			printf("Konekcija neuspesna: %s\n",  $mysqli->connect_error);
			exit();
		}
		$this->dblink->set_charset("utf8");
	}

	function selectUsluge() {

		$q = 'SELECT * FROM usluge';
        $this->ExecuteQuery($q);
	}
    function selectZakazi() {
         $status="neobradjeno";
		$q = "SELECT * FROM zakazivanje WHERE status='".$status."'";
        $this->ExecuteQuery($q);
	}
    function selectKorisnici() {
		$q = 'SELECT DISTINCT korisnik.ime, korisnik.prezime, korisnik.id FROM zakazivanje INNER JOIN korisnik ON zakazivanje.idkorisnika=korisnik.id';
        $this->ExecuteQuery($q);
	}


	function neobradjeniZakaziPacijenta($data) {
        $idkup=$data[0]['id'];
        $status="neobradjeno";

		$query = "SELECT korisnik.id ,korisnik.ime, korisnik.prezime, zakazivanje.idzak, zakazivanje.grad, zakazivanje.adresa, zakazivanje.poruka, usluge.naziv, usluge.cena FROM zakazivanje INNER JOIN korisnik ON zakazivanje.idkorisnika=korisnik.id INNER JOIN usluge ON zakazivanje.idusluge=usluge.id WHERE korisnik.id=$idkup AND zakazivanje.status='".$status."'";

		if( $this->ExecuteQuery($query))
		{
			$this ->zakaziPacijenta = true;
		}
		else
		{
			$this->zakaziPacijenta = false;
		}

	}
    function obradjeniZakaziPacijenta($data) {
        $idkup=$data[0]['id'];
        $status="obradjeno";
	$query = "SELECT korisnik.id, korisnik.ime, korisnik.prezime, zakazivanje.idzak, zakazivanje.grad, zakazivanje.adresa, zakazivanje.poruka, usluge.naziv, usluge.cena FROM zakazivanje INNER JOIN korisnik ON zakazivanje.idkorisnika=korisnik.id INNER JOIN usluge ON zakazivanje.idusluge=usluge.id WHERE korisnik.id=$idkup AND zakazivanje.status='".$status."'";

		if( $this->ExecuteQuery($query))
		{
			$this ->zakaziPacijenta = true;
		}
		else
		{
			$this->zakaziPacijenta = false;
		}

	}
      function sumaNeobradjenihZakazivanja($data) {

        $idkup=$data[0]['id'];
         $status="neobradjeno";

		$query = "SELECT SUM(usluge.cena) AS sumaNeobradjenih FROM zakazivanje INNER JOIN korisnik ON zakazivanje.idkorisnika=korisnik.id INNER JOIN usluge ON zakazivanje.idusluge=usluge.id WHERE korisnik.id=$idkup AND zakazivanje.status='".$status."'";


		$this->ExecuteQuery($query);



	}
     function sumaObradjenihZakazivanja($data) {

        $idkup=$data[0]['id'];
          $status="obradjeno";

		$query = "SELECT SUM(usluge.cena) AS sumaObradjenih FROM zakazivanje INNER JOIN korisnik ON zakazivanje.idkorisnika=korisnik.id INNER JOIN usluge ON zakazivanje.idusluge=usluge.id WHERE korisnik.id=$idkup AND zakazivanje.status='".$status."'";


		$this->ExecuteQuery($query);



	}

     function ucitajZakazano($data) {

        $id=$data[0]['id'];
         $status="neobradjeno";


		$query = "SELECT korisnik.ime, korisnik.prezime, zakazivanje.idzak, zakazivanje.grad, zakazivanje.adresa, zakazivanje.poruka, usluge.naziv, usluge.cena FROM zakazivanje INNER JOIN korisnik ON zakazivanje.idkorisnika=korisnik.id INNER JOIN usluge ON zakazivanje.idusluge=usluge.id WHERE zakazivanje.idzak=$id AND zakazivanje.status='".$status."'";


		if($this->ExecuteQuery($query)){ $this->zakazivanje =true; }
        else{$this->zakazivanje =false; }


	}

    function proveriLogin($data) {

        $username=$data[0]['username'];
        $password=$data[0]['password'];

		$query = "SELECT * FROM administratori WHERE username='".$username."' AND password='".$password."'";

		$this->ExecuteQuery($query);
		if($this->records==1){ $this->admin =true; }
        else{$this->admin =false; }


	}
    function proveriLoginKorisnik($data) {

        $username=$data[0]['username'];
        $password=$data[0]['password'];

		$query = "SELECT * FROM korisnik WHERE username='".$username."' AND password='".$password."'";

		$this->ExecuteQuery($query);
		if($this->records==1){ $this->korisnik =true; }
        else{$this->korisnik =false; }


	}
    function pronadjiImeiPrezime($id) {
		$query = "SELECT ime, prezime FROM administratori WHERE id=$id";

		$this->ExecuteQuery($query);

	}


     function pacijentZakaz($id){

         $status="obradjeno";

        $query="UPDATE zakazivanje SET status='".$status."' WHERE idkorisnika=$id";
        if($this->ExecuteQuery($query)){
             $this->result = true;
		}
		else
		{
			$this->result = false;
		}
     }
    function obradi($idzak){

         $status="obradjeno";

        $query="UPDATE zakazivanje SET status='".$status."' WHERE idzak=$idzak";
        if($this->ExecuteQuery($query)){
             $this->result = true;
		}
		else
		{
			$this->result = false;
		}

    }
     function obrisi($idzak){

        $query="DELETE FROM zakazivanje WHERE idzak=$idzak";
        if($this->ExecuteQuery($query)){
             $this->result = true;
		}
		else
		{
			$this->result = false;
		}

    }



	function ExecuteQuery($query)
	{
		if($this->result = $this->dblink->query($query)){
			if (isset($this->result->num_rows)) $this->records         = $this->result->num_rows;
				if (isset($this->dblink->affected_rows)) $this->affected        = $this->dblink->affected_rows;
					return true;
		}
		else{
			return false;
		}
	}
}
?>
