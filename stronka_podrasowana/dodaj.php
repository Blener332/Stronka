<?php
// include connection
require_once 'polacz_studenci.php';
session_start();
$blad_imie = $blad_nazwisko = $blad_email = $blad_kierunek = $blad_rok = $blad_miasto = $blad_kraj = "";
$imie = $nazwisko = $email = $kierunek = $rok = $miasto = $kraj = "";

// processing form data when form is submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["imie"])) {
        $blad_imie = "To pole jest wymagane";
    } else {
        $imie = test_input($_POST["imie"]);
        // check if imie contains only letters
        if (!ctype_alpha($imie)) {
            $blad_imie = "Imie powinno zawierać tylko litery";
        }
    }

    if (empty($_POST["nazwisko"])) {
        $blad_nazwisko = "To pole jest wymagane";
    } else {
        $nazwisko = test_input($_POST["nazwisko"]);
        // check if nazwisko contains only letters
        if (!ctype_alpha($nazwisko)) {
            $blad_nazwisko = "Nazwisko powinno zawierać tylko litery";
        }
    }

    if (empty($_POST["email"])) {
        $blad_email = "To pole jest wymagane";
    } else {
        $email = test_input($_POST["email"]);
        // check e-mail address is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Niepoprawny adres e-mail";
        }
    }

    if (empty($_POST["kierunek"])) {
        $blad_kierunek = "To pole jest wymagane";
    } else {
        $kierunek = test_input($_POST["kierunek"]);
    }

    if (empty($_POST["rok"])) {
        $blad_rok = "To pole jest wymagane";
    } else {
        $rok = test_input($_POST["rok"]);
        /* check if rok contains numbers only, also 
        check min and max value to be entered */
        if (!ctype_digit($rok)) {
            $blad_rok = "Rok musi być wartością liczbową";
        } elseif ($rok < 2013) {
            $blad_rok = "Rok musi być większy lub równy od 2013";
        } elseif ($rok > 2021) {
            $blad_rok = "Rok musi być mniejszy lub równy od 2021";
        } else {
            // no code will execute
        }
    }

    if (empty($_POST["miasto"])) {
        $blad_miasto = "To pole jest wymagane";
    } else {
        $miasto = test_input($_POST["miasto"]);
    }

    if (empty($_POST["kraj"])) {
        $blad_kraj = "To pole jest wymagane";
    } else {
        $kraj = test_input($_POST["kraj"]);
    }

    // if no errors then insert data into databse
    if (empty($blad_imie) && empty($blad_nazwisko) && empty($blad_email) && empty($blad_kierunek) && empty($blad_rok) && empty($blad_miasto) && empty($blad_kraj)) {

        $sql = "INSERT INTO studenci (imie, nazwisko, email, kierunek, rok, miasto, kraj) VALUES ('$imie', '$nazwisko', '$email', '$kierunek', '$rok' , '$miasto', '$kraj')";

        if (mysqli_query($polaczenie, $sql)) {
            echo "<script>alert('Nowy wiersz został pomyślnie dodany');</script>";
            header('Location: edytowanie.php');
            exit();
        }
    }
    mysqli_close($polaczenie);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
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
   
  </head>
  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    
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
    <!-- submit form -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <h3 class="mb-4 text-center">Dodaj</h3>
                <div class="form-body bg-light p-4">
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="imie" class="form-label">Imie*</label>
                                <input type="text" class="form-control" id="imie" name="imie" value="<?= $imie; ?>">
                                <small class="text-danger"><?= $blad_imie; ?></small>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="nazwisko" class="form-label">Nazwisko*</label>
                                <input type="text" class="form-control" id="nazwisko" name="nazwisko" value="<?= $nazwisko; ?>">
                                <small class="text-danger"><?= $blad_nazwisko; ?></small>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="email" class="form-label">Adres e-mail*</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>">
                                <small class="text-danger"><?= $blad_email; ?></small>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="kierunek" class="form-label">Kierunek*</label>
                                <input type="text" class="form-control" id="kierunek" name="kierunek" value="<?= $kierunek; ?>">
                                <small class="text-danger"><?= $blad_kierunek; ?></small>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="rok" class="form-label">Rok*</label>
                                <input type="text" class="form-control" id="rok" name="rok" value="<?= $rok; ?>">
                                <small class="text-danger"><?= $blad_rok; ?></small>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="miasto" class="form-label">Miasto*</label>
                                <input type="text" class="form-control" id="miasto" name="miasto" value="<?= $miasto; ?>">
                                <small class="text-danger"><?= $blad_miasto; ?></small>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="kraj" class="form-label">Kraj*</label>
                                <input type="text" class="form-control" id="kraj" name="kraj" value="<?= $kraj; ?>">
                                <small class="text-danger"><?= $blad_kraj; ?></small>
                            </div>
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-dark form-control" name="dodaj" value="Dodaj">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
	
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
</body>

</html>