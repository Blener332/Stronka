# Stronka

Jeśli będziesz chciał to odpalić na windowsie na szybkości, to trzeba się trochę pobawić:
1. Zainstaluj XAMPP, to takie środowisko co ma wszystko potrzebne do tworzenia stron.
2. W C:\xampp jest xampp-control.exe, trzeba go odpalić i wystartować Apache i MySQL.
3. Folder ze stronką (tam gdzie są wszystkie pliki php) trzeba wrzucić do C:\xampp\htdocs (nie może być podfolderów).
4. W przeglądarce wpisz localhost/myphpadmin , odpali się taki duży panel zarządzania wszystkim.
5. Musisz wrzucić tam wymagane bazy danych (są w folderze tej stronki, pliki to "uzytkownicy.sql" i "studenci.sql"). 
Po lewo "nowa", wykonaj, później na środku powyżej "import", wybierasz określony plik (np. uzytkownicy.sql) i wykonaj. I tak dwa razy dla obydwu baz.
6. I to w sumie wszystko, odpalasz stronkę poprzez "localhost/stronka/" w przeglądarce i się bawisz.


Rzeczy które zrobiłem:
1. Strona startowa, która wyświetla tablicę studentów.
2. Możliwość rejestracji na stronie.
3. Formularz rejestracji, który dodaje użytkowników do tablicy uzytkownicy. Formularz jest zabezpieczony przed wprowadzaniem pierdół typu znaki specjalne itd, sprawdza też czy nie ma już kogoś kto ma takie dane.
5. Hasła są haszowane w bazie danych tak aby nie można było ich podejrzeć.
6. Logowanie w celu możliwości edycji, do wcześniej utworzonych kont, również zabezpieczony przed włamami na konta oraz przed błędnymi danymi.
7. Po zalogowaniu istnieje możliwość usunięcia wiersza, dodania wiersza, edycji istniego wiersza, wylogowania.

dodaj.php - skrypt do dodawania wierszy w tablicy
edytowanie.php - strona, która odpala się jeśli się zalogujesz
edytuj.php - skrypt do edycji istniejącego wiersza
index.php - strona dla niezalogowanych
logowanie.php - strona logowania
polacz_studenci.php - skrypt do łączenia się z bazą "studenci"
polacz_uzytkownicy.php - skryptdo łączenia się z bazą "użytkownicy"
rejestracja.php - strona rejestracji
wyloguj.php - jak sama nazwa mówi
zaloguj.php - skrypt wykonujący zalogowanie po kliknięciu przycisku "Zaloguj" na stronie logowania


Generalnie to te kody są dość chaotyczne, trzeba będzie je tam kiedyś uporządkować żeby były bardziej zrozumiałe
