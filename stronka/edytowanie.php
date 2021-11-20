<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>Strona - edycja</title>
</head>

<body>

    <div class="container mt-5">
        <a href="dodaj.php" class="btn btn-secondary"><i class="fas fa-plus-circle"></i> Add Record</a>
        <table class="table table-bordered table-striped mt-4">
            <caption>Lista studentów</caption>
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
                    <th>Operacje</th>
                </tr>
            </thead>

            <tbody>
			
                <?php
				if (!isset($_SESSION['zalogowany']))
				{
					header('Location: index.php');
					
                }
				else
				{	
					echo "<p>Zalogowany: ".$_SESSION['uzytkownik'].' [ <a href="wyloguj.php">Wyloguj się!</a> ]</p>';
                
				}
				
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
                            <td>
                                <a href="edytuj.php?id=<?= $wiersz['student_id']; ?>" class="btn btn-primary"><i class="far fa-edit"></i> Edytuj</a>&nbsp;
                                <a href="usun.php?id=<?= $wiersz["student_id"]; ?>" class=" btn btn-danger" onclick="return PopUpUsun();"><i class="far fa-trash-alt"></i> Usuń</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                mysqli_close($polaczenie);
                ?>
            </tbody>
        </table>
    </div>
    <script>
        function PopUpUsun() {
            return confirm("Czy na pewno chcesz usunąć ten wiersz?");
        }
    </script>
</body>

</html>