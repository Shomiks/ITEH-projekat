function uslugeAjax(idkupca) {
    var id=idkupca;
       $("#result").html("");
		$.post("pages/usluge.php", {idkupca: id}, function( data ) {
  $("#result").html(data);
});
 $('html, body').animate({
        scrollTop: $("#result").offset().top
    }, 2000);
}
function zakazivanjeForma(id,idkupca){
    var id1=id;
    if(idkupca!==-1){
     $("#result").html("");
		$.post("pages/zakazivanje.php", {id: id1, idkupca: idkupca}, function( data ) {
  $("#result").html(data);
});
 $('html, body').animate({
        scrollTop: $("#result").offset().top
    }, 2000);
    }else{
        alert("Morate se ulogovati da bi zakazali uslugu!");
    }
}
function kategorijaOrderAjax(idkupca){
   var sortiraj = $("#ordersel").val();
        var kategorijesel=$("#kategsel").val();


       $("#usluge").html("");


		$.post( "pages/ucitajUsluge.php", {ordersel: sortiraj, kategsel: kategorijesel, idkupca: idkupca}, function( data ) {
  $( "#usluge" ).html( data );
});
 $('html, body').animate({
        scrollTop: $("#usluge").offset().top
    }, 2000);

}
function ucitajKategorijuAjax(odabranakateg,idkupca) {
    var odabrana= odabranakateg.substring(1, odabranakateg.length-1);
       $("#result").html("");
		$.post("pages/usluge.php", {odabranakateg: odabrana, idkupca: idkupca}, function( data ) {
  $("#result").html(data);
});
 $('html, body').animate({
        scrollTop: $("#result").offset().top
    }, 2000);
}
function dodajAjaxx(){

       $("#result").html("");
		$.post("pages/dodaj.php", {}, function( data ) {
  $("#result").html(data);
});
 $('html, body').animate({
        scrollTop: $("#result").offset().top
    }, 2000);
}

function izmeniAjax(){

       $("#result").html("");
		$.post("pages/izmeni.php", {}, function( data ) {
  $("#result").html(data);
});
 $('html, body').animate({
        scrollTop: $("#result").offset().top
    }, 2000);
}
function izmeniUsluguAjax(id){
        var idforme=1;
        var idusluge=id;
       $("#result").html("");
		$.post("pages/ucitajFormu.php", {idforme: idforme, idusluge: idusluge}, function( data ) {
  $("#result").html(data);
});
 $('html, body').animate({
        scrollTop: $("#result").offset().top
    }, 2000);
}
function izbrisiUsluguAjax(id){
         var idforme=2;
         var idusluge=id;
       $("#result").html("");
		$.post("pages/ucitajFormu.php", {idforme: idforme, idusluge: idusluge}, function( data ) {
  $("#result").html(data);
});
 $('html, body').animate({
        scrollTop: $("#result").offset().top
    }, 2000);
}

function galerijaAjax() {

       $("#result").html("");
    $.post("pages/galerija.php", {}, function( data ) {
  $("#result").html(data);
});
 $('html, body').animate({
        scrollTop: $("#result").offset().top
    }, 2000);
}

function lokacijaAjax() {

       $("#result").html("");
		$.post("pages/lokacija.php", {}, function( data ) {
  $("#result").html(data);
});
 $('html, body').animate({
        scrollTop: $("#result").offset().top
    }, 2000);
}
