<?php

	session_start();
	//$_SESSION['zalogowany']=false;
	
?>



<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8">
    <title>Nasza stronka</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- BOOTSTRAP 4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script type="text/javascript" src="jawa.js"></script>
  </head>
  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark"  id="naglowek">
    
    <div class="mx-5 order-0">
        <a class="navbar-brand mx-auto" href="index.php">Nasza strona</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav mr-5">
            <li class="nav-item">
                <a class="nav-link" 
				<?php
				if(isset($_SESSION['zalogowany'])) 
				{
					echo "href='wyloguj.php' >Wyloguj";
				} 
				else 
				{
					echo "href='logowanie.php'>Zaloguj";
				} 
				?></a>
            </li>
			
            <li class="nav-item">
                <a class="nav-link" href="rejestracja.php">Zarejestruj</a>
            </li>
			<li class="nav-item">
                <a 
				<?php
				if(isset($_SESSION['zalogowany'])) 
				{
					echo "class='nav-link'";
				} 
				else 
				{
					echo "class='nav-link disabled'";
				} 
				?>
				 href="edytowanie.php">Edytuj</a>
            </li>
        </ul>
    </div>
</nav>

    <div class="container mt-5">
        <h1>Lista studentów</h1> <br />
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>Lp.</th>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Adres e-mail</th>
                    <th>Kierunek</th>
                    <th>Data rozpoczęcia</th>
                    <th>Miasto</th>
                    <th>Kraj</th>
                    
                </tr>
            </thead>

            <tbody>
			
                <?php
				
		
				// include connection
                require_once 'polacz_studenci.php';

                $rezultat = mysqli_query($polaczenie, "SELECT * FROM studenci");
                $ile_wynikow = mysqli_num_rows($rezultat);

                if ($ile_wynikow > 0) {
                    $wiersz = mysqli_fetch_all($rezultat, MYSQLI_ASSOC);
                    $licznik = 1;
                    foreach ($wiersz as $wiersz) { ?>
                        <tr>
                            <td><?= $licznik++; ?></td>
                            <td class="text-capitalize"><?= $wiersz["imie"]; ?></td>
                            <td class="text-capitalize"><?= $wiersz["nazwisko"]; ?></td>
                            <td><?= $wiersz["email"]; ?></td>
                            <td class="text-uppercase"><?= $wiersz["kierunek"]; ?></td>
                            <td><?= $wiersz["rok"]; ?></td>
                            <td class="text-capitalize"><?= $wiersz["miasto"]; ?></td>
                            <td class="text-capitalize"><?= $wiersz["kraj"]; ?></td>
                        </tr>
                <?php
                    }
                }
                mysqli_close($polaczenie);
                ?>
            </tbody>
        </table>
    </div>
   
	<!-- Footer -->
<footer class="page-footer font-small blue pt-4">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">
  <?php
  if (isset($_SESSION['zalogowany']))
	{
		
		echo "Zalogowany jako: ". $_SESSION['uzytkownik']; 
	}
	
  ?>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
	
	
	
	<script>
        function PopUpUsun() {
            return confirm("Czy na pewno chcesz usunąć ten wiersz?");
        }
    </script>
	
</body>

</html>