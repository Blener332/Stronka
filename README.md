# Stronka

Jeśli będziesz chciał to odpalić na windowsie na szybkości, to trzeba się trochę pobawić:
1. Zainstaluj XAMPP, to takie środowisko co ma wszystko potrzebne do tworzenia stron.
2. W C:\xampp jest xampp-control.exe, trzeba go odpalić i wystartować Apache i MySQL.
3. Folder ze stronką (tam gdzie są wszystkie pliki php) trzeba wrzucić do C:\xampp\htdocs (nie może być podfolderów).
4. W przeglądarce wpisz localhost/myphpadmin , odpali się taki duży panel zarządzania wszystkim.
5. Musisz wrzucić tam wymagane bazy danych (są w folderze tej stronki, pliki to "uzytkownicy.sql" i "studenci.sql"). 
Po lewo "nowa", wykonaj, później na środku powyżej "import", wybierasz określony plik (np. uzytkownicy.sql) i wykonaj. I tak dwa razy dla obydwu baz.
6. I to w sumie wszystko, odpalasz stronkę poprzez "localhost/stronka/" w przeglądarce i się bawisz.

Generalnie to te kody są dość chaotyczne, trzeba będzie je tam kiedyś uporządkować żeby były bardziej zrozumiałe
