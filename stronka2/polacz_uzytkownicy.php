<?php

$host="localhost";
$bd_uzytkownik="root";
$bd_haslo="";
$bd_nazwa="uzytkownicy";

$polaczenie = mysqli_connect($host, $bd_uzytkownik, $bd_haslo, $bd_nazwa);

if (!$polaczenie) {
    die("Blad :" . mysqli_connect_error());
}
?>