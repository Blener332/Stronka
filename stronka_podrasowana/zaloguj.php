<?php
	session_start();
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}
	
	$polaczenie = @new mysqli($host, $bd_uzytkownik, $bd_haslo, $bd_nazwa);
	require_once "polacz_uzytkownicy.php";
	
		$login=$_POST['login'];
		$haslo=$_POST['haslo'];
		
		$login=htmlentities($login, ENT_QUOTES, "UTF-8");
		
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM uzytkownicy WHERE uzytkownik_nick='%s'",
		mysqli_real_escape_string($polaczenie,$login))))
		{
			
			$ilu_uzytkownikow = $rezultat->num_rows;
			
			if($ilu_uzytkownikow>0)
			{
				$wiersz = $rezultat->fetch_assoc();
				if(password_verify($haslo, $wiersz['uzytkownik_haslo']))
				{
					$_SESSION['zalogowany']=true;
					$_SESSION['id']=$wiersz['uzytkownik_id'];
				
					$_SESSION['uzytkownik'] = $wiersz['uzytkownik_nick'];
					$_SESSION['email'] = $wiersz['uzytkownik_email'];
				
					unset($_SESSION['blad']);
				
					$rezultat->free_result();
					header('Location: index.php');
				}
				else
				{
					$_SESSION['blad'] = '<span style = "color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location: logowanie.php');
				}	
			}
			else
			{
				$_SESSION['blad'] = '<span style = "color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: logowanie.php');
			}
		}
		
		$polaczenie->close();	
?>
