<?php
	session_start();
	if (isset($_SESSION['zalogowany']))
	{
		header('Location: edytowanie.php');
		exit();
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
    <title>Logowanie</title>
</head>

<body>

	<br /><br />
	<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <h3 class="mb-4 text-center">Logowanie</h3>
                <div class="form-body bg-light p-4">
                    <form action="zaloguj.php" method="post">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="login" class="form-label">Login</label>
                                <input type="text" class="form-control" id="login" name="login">
                                
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="nazwisko" class="form-label">Hasło</label>
                                <input type="password" class="form-control" id="haslo" name="haslo">
                            
                            </div>
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary form-control" name="dodaj" value="Zaloguj">
                            </div>
							<div class="col-lg-6 mb-3">
							<a href="rejestracja.php">Zarejestruj się </a>
							<br />
							<a href="index.php">Wróć do strony głównej</a>
							</div>
							<div class="col-lg-6 mb-3">
							<?php

								if(isset($_SESSION['blad'])){


									echo $_SESSION['blad'];
									unset($_SESSION['blad']); //linijka która naprawiła logowanie
								}
							?>
							</div>
							
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
