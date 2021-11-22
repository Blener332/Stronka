<?php
	session_start();
	if(isset($_POST['email']))
	{
		//udana walidacja danych
		$wszystko_OK=true;
		
		//sprawdzanie nazwy
		$nick = $_POST['nick'];
		//sprawdzenie długości nicka
		if((strlen($nick)<3)||(strlen($nick)>20))
		{
			$wszystko_OK=false;
			$_SESSION['blad_nick']="Nick musi posiadać od 3 do 20 znaków!";
			
		}
		
		if(ctype_alnum($nick)==false)
		{
			$wszystko_OK=false;
			$_SESSION['blad_nick']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)!";
		}
		
		
		//sprawdzanie adresu email
		$email=$_POST['email'];
		
		
		$emailbezpieczny=filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if(filter_var($emailbezpieczny, FILTER_VALIDATE_EMAIL)==false|| ($emailbezpieczny!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['blad_email']="Podaj poprawny adres email!";
		}
		
		
		//sprawdzanie poprawności hasła
		
		$haslo1=$_POST ['haslo1'];
		$haslo2=$_POST ['haslo2'];
		
		if((strlen($haslo1)<8)||(strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['blad_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
			
		}
		
		if($haslo1!=$haslo2){
			$wszystko_OK=false;
			$_SESSION['blad_haslo']="Podane hasła nie są identyczne";
		}
		
		$haslo_hash=password_hash($haslo1, PASSWORD_DEFAULT);
		
		require_once "polacz_uzytkownicy.php";
		
		//pamiętaj  wpisane dane
		$_SESSION['pamietaj_nick']=$nick;
		$_SESSION['pamietaj_email']=$email;
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try
		{
			$polaczenie = new mysqli($host, $bd_uzytkownik, $bd_haslo, $bd_nazwa);
			if($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//czy email juz istnieje
				$rezultat = $polaczenie->query("SELECT uzytkownik_id FROM uzytkownicy WHERE uzytkownik_email='$email'");

				if(!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				
				if($ile_takich_maili>0)
				{
					$wszystko_OK=false;
					$_SESSION['blad_email']="Istnieje już konto zapisane do tego adresu e-mail";
				}
				
				//czy login juz istnieje
				$rezultat = $polaczenie->query("SELECT uzytkownik_id FROM uzytkownicy WHERE uzytkownik_nick='$nick'");
				
				
				if(!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nickow= $rezultat->num_rows;
				
				if($ile_takich_nickow>0)
				{
					$wszystko_OK=false;
					$_SESSION['blad_nick']="Istnieje już użytkownik o takim nicku";
				}
				
				if($wszystko_OK==true)
				{
				//spox
				if($polaczenie->query("INSERT INTO uzytkownicy VALUES(NULL, '$nick','$haslo_hash', '$email')"))
				{
					$_SESSION['udanarejestracja']=true;
					header('Location: index.php');
					
				}
				else
				{
					throw new Exception($polaczenie->error);
				}
		
		
				}
				$polaczenie->close();
				
			}
		}
		
		catch(Exception $blad)
		{
			echo '<span style="color:red;">Błąd serwera</span>';
			//echo '<br /> Informacja deweloperska: '.$blad;
		}
	}
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>Rejestracja</title>
	
	<style>
	
	.error
	{
		color:red;
		margin-top: 10px;
		margin-bottom: 10px;
	}
	
	</style>
</head>
<body>
<br /><br />
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <h3 class="mb-4 text-center">Rejestracja</h3>
                <div class="form-body bg-light p-4">
                    <form method="post">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="login" class="form-label">Login</label>
                                <input type="text" class="form-control" id="nick" value="<?php
								if (isset($_SESSION['pamietaj_nick']))
								{
									echo $_SESSION['pamietaj_nick'];
									unset($_SESSION['pamietaj_nick']);
								} ?>" name="nick">
								<?php
								if(isset($_SESSION['blad_nick']))
								{
									echo '<div class="error">'.$_SESSION['blad_nick'].'</div>';
									unset($_SESSION['blad_nick']);
								}
								?>
								
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="text" class="form-control" id="email" value="<?php
								if (isset($_SESSION['pamietaj_email']))
								{
									echo $_SESSION['pamietaj_email'];
									unset($_SESSION['pamietaj_email']);
								} ?>" name="email">
                            <?php
							if(isset($_SESSION['blad_email']))
							{
								echo '<div class="error">'.$_SESSION['blad_email'].'</div>';
								unset($_SESSION['blad_email']);
							}
							?>
                            </div>
							<div class="col-lg-6 mb-3">
                                <label for="haslo1" class="form-label">Hasło</label>
                                <input type="password" class="form-control" id="haslo1" name="haslo1">
                            <?php
							if(isset($_SESSION['blad_haslo']))
							{
								echo '<div class="error">'.$_SESSION['blad_haslo'].'</div>';
								unset($_SESSION['blad_haslo']);
							}
							?>
                            </div>
							<div class="col-lg-6 mb-3">
                                <label for="haslo2" class="form-label">Powtórz hasło</label>
                                <input type="password" class="form-control" id="haslo2" name="haslo2">
                            
                            </div>
							
                                <input type="submit" class="btn btn-primary form-control" name="dodaj" value="Zarejestruj się">
                            </div>
							<div class="col-lg-12">
							<a href="logowanie.php">Wróć do strony logowania</a>
                            <div class="col-lg-12">
                        </div>
						
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>



