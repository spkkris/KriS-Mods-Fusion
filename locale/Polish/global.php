<?php
/*English Language Fileset
Produced by Nick Jones (Digitanium)
Email: digitanium@php-fusion.co.uk
Web: http://www.php-fusion.co.uk

Language: Polish (iso-8859-2)
Translations and modifications:
Polish Official PHP-Fusion's Support
http://www.php-fusion.pl/
Main translator: Tomasz Jankowski (jantom)
Translators: Robert Gaudyn (Wooya), Bart�omiej Gajda (bartek124), sony

This program is released as free software under the
Affero GPL license.*/

$locale['global_000'] = "WERSJA BETA : BRAK OFICJALNEGO WSPARCIA";

// Locale Settings
setlocale(LC_TIME, "pl", "pl_PL", "polish"); // Linux Server (Windows may differ)
$locale['charset'] = "iso-8859-2";
$locale['xml_lang'] = "pl";
$locale['tinymce'] = "pl";
$locale['phpmailer'] = "pl";

// Full & Short Months
$locale['months'] = "&nbsp|stycze�|luty|marzec|kwiecie�|maj|czerwiec|lipiec|sierpie�|wrzesie�|pa�dziernik|listopad|grudzie�";
$locale['shortmonths'] = "&nbsp|st.|lt.|mar.|kwi.|maj|czer.|lip.|sier.|wrz.|pa�.|lis.|gru.";

// Standard User Levels
$locale['user0'] = "Go��";
$locale['user1'] = "U�ytkownik";
$locale['user2'] = "Administrator";
$locale['user3'] = "G��wny administrator";
$locale['user4'] = "Vip";
// Forum Moderator Level(s)
$locale['userf1'] = "Moderator";
// Navigation
$locale['global_001'] = "Nawigacja";
$locale['global_002'] = "Brak link�w\n";
// Users Online
$locale['global_010'] = "Aktualnie online";
$locale['global_011'] = "Go�ci online";
$locale['global_012'] = "U�ytkownik�w online";
$locale['global_013'] = "Brak u�ytkownik�w online";
$locale['global_014'] = "��cznie u�ytkownik�w";
$locale['global_015'] = "Nieaktywnych u�ytkownik�w";
$locale['global_016'] = "Najnowszy u�ytkownik";
// Forum Side panel
$locale['global_020'] = "Ostatnio na forum";
$locale['global_021'] = "Najnowsze tematy";
$locale['global_022'] = "Najciekawsze tematy";
$locale['global_023'] = "Brak temat�w na forum";
// Articles Side panel
$locale['global_030'] = "Ostatnie artyku�y";
$locale['global_031'] = "Brak artyku��w";
// Welcome panel
$locale['global_035'] = "Powitanie";
// Latest Active Forum Threads panel
$locale['global_040'] = "Ostatnio poruszane tematy";
$locale['global_041'] = "Moje ostatnie tematy";
$locale['global_042'] = "Moje ostatnie posty";
$locale['global_043'] = "Nowe posty";
$locale['global_044'] = "Temat";
$locale['global_045'] = "Obejrze�";
$locale['global_046'] = "Odpowiedzi";
$locale['global_047'] = "Ostatni post";
$locale['global_048'] = "Forum";
$locale['global_049'] = "Napisane przez";
$locale['global_050'] = "Autor";
$locale['global_051'] = "Ankieta";
$locale['global_052'] = "Przesuni�ty";
$locale['global_053'] = "Brak rozpocz�tych przez Ciebie temat�w.";
$locale['global_054'] = "Brak napisanych przez Ciebie post�w.";
$locale['global_055'] = "Nowych post�w od Twojej ostatniej wizyty: %u";
$locale['global_056'] = "Moje obserwowane tematy";
$locale['global_057'] = "Opcje";
$locale['global_058'] = "Przesta� <br /> obserwowa�";
$locale['global_059'] = "Brak obserwowanych przez Ciebie temat�w.";
$locale['global_060'] = "Przesta� obserwowa� temat?";
// News & Articles
$locale['global_070'] = "Napisane przez ";
$locale['global_071'] = "dnia ";
$locale['global_072'] = "Czytaj wi�cej";
$locale['global_073'] = " komentarzy";
$locale['global_073b'] = " komentarz";
$locale['global_074'] = " czyta�";
$locale['global_075'] = "Drukuj";
$locale['global_076'] = "Edytuj";
$locale['global_077'] = "News";
$locale['global_078'] = "Brak opublikowanych news�w";
// Page Navigation
$locale['global_090'] = "Poprzednia";
$locale['global_091'] = "Nast�pna";
$locale['global_092'] = "Strona ";
$locale['global_093'] = " z ";
// Guest User Menu
$locale['global_100'] = "Logowanie";
$locale['global_101'] = "Nazwa u�ytkownika";
$locale['global_102'] = "Has�o";
$locale['global_103'] = "Zapami�taj mnie";
$locale['global_104'] = "Zaloguj";
$locale['global_105'] = "Nie masz jeszcze konta? <br /><a href='".BASEDIR."register.php' class='side'>Zarejestruj si�</a>";
$locale['global_106'] = "Nie mo�esz si� zalogowa�?<br /> Popro� o <a href='".BASEDIR."lostpassword.php' class='side'>nowe has�o</a>";
$locale['global_107'] = "Rejestracja";
$locale['global_108'] = "Zapomniane has�o";
// Member User Menu
$locale['global_120'] = "Centrum u�ytkownika";
$locale['global_121'] = "Prywatne wiadomo�ci";
$locale['global_122'] = "Lista kont";
$locale['global_123'] = "Panel administratora";
$locale['global_124'] = "Wyloguj";
$locale['global_125'] = "Nieprzeczytanych wiadomo�ci: %u";
$locale['global_126'] = "";
$locale['global_127'] = "";
//dodano
$locale['global_128'] = " nades�any materia�";
$locale['global_129'] = " nades�ane materia�y";
//koniec
// Poll
$locale['global_130'] = "Ankieta";
$locale['global_131'] = "Zag�osuj";
$locale['global_132'] = "Musisz zalogowa� si�, aby m�c zag�osowa�.";
$locale['global_133'] = "g�os";
$locale['global_134'] = "g�os�w";
$locale['global_135'] = "Og�em g�os�w: ";
$locale['global_136'] = "Rozpocz�to: ";
$locale['global_137'] = "Zako�czono: ";
$locale['global_138'] = "Archiwum ankiet";
$locale['global_139'] = "Wybierz ankiet� z listy:";
$locale['global_140'] = "Zobacz wyniki";
$locale['global_141'] = "Wyniki ankiety";
$locale['global_142'] = "Brak przeprowadzanych ankiet.";
// Shoutbox
$locale['global_150'] = "Shoutbox";
$locale['global_151'] = "Nick:";
$locale['global_152'] = "Wiadomo��:";
$locale['global_153'] = "Wy�lij";
$locale['global_154'] = "Musisz zalogowa� si�, aby m�c doda� wiadomo��.";
$locale['global_155'] = "Archiwum shoutboksa";
$locale['global_156'] = "Brak wiadomo�ci. Mo�e czas doda� w�asn�?";
$locale['global_157'] = "Usu�";
$locale['global_158'] = "Kod potwierdzaj�cy:";
$locale['global_159'] = "Wpisz kod potwierdzaj�cy:";
// Footer Counter
$locale['global_170'] = "unikalna wizyta";
$locale['global_171'] = "Unikalnych wizyt";
$locale['global_172'] = "Wygenerowano w sekund: %s";
// Admin Navigation
$locale['global_180'] = "Powr�� do panelu administracyjnego";
$locale['global_181'] = "Powr�� do strony g��wnej";
$locale['global_182'] = "<strong>Uwaga:</strong> Nie podano has�a Administratora, lub podane jest b��dne.";
// Miscellaneous
$locale['global_190'] = "Aktywowano tryb prac na serwerze.";
$locale['global_191'] = "Twoje IP jest zablokowane.";
$locale['global_192'] = "Wylogowuj� jako: ";
$locale['global_193'] = "Loguj� jako: ";
$locale['global_194'] = "Konto zosta�o zablokowane.";
$locale['global_195'] = "Konto nie jest aktywne.";
$locale['global_196'] = "Nieprawid�owa nazwa u�ytkownika lub has�o.";
$locale['global_197'] = "Prosz� czeka� na przekierowanie...<br /><br />
[ <a href='".(isset($_GET['redirect']) ? stripinput(urldecode($_GET['redirect'])) : "index.php")."'>Nie chc� czeka�</a> ]";
$locale['global_198'] = "<strong>Ostrze�enie:</strong> Wykryto plik setup.php. Prosz�, usu� go natychmiast.";
$locale['global_199'] = "<strong>Ostrze�enie:</strong> Nie ustawiono has�a administratora, <a href='".BASEDIR."user_center/edit_profile.php'>ustaw je</a> natychmiast.";
//Titles
$locale['global_200'] = " - ";
$locale['global_201'] = ": ";
$locale['global_202'] = $locale['global_200']."Szukaj";
$locale['global_203'] = $locale['global_200']."FAQ";
$locale['global_204'] = $locale['global_200']."Forum";
//Themes
$locale['global_210'] = "Przejd� do tre�ci";
// No themes found
$locale['global_300'] = "nie znaleziono sk�rki.";
$locale['global_301'] = "Nie mo�na wy�wietli� strony. Jest to spowodowane brakiem plik�w odpowiadaj�cych za wygl�d strony. Je�li jeste� administratorem strony, uruchom swojego klienta FTP i wgraj do katalogu <em>/themes</em> jak�kolwiek sk�rk� zaprojektowan� dla <em>PHP-Fusion v7</em>. Nast�pnie sprawd� w <em>G��wnych ustawieniach</em> w <em>Panelu administratora</em> oraz upewnij si�, �e wybrana tam sk�rka jest w Twoim katalogu <em>/themes</em>. Je�li tak nie jest, sprawd�, czy wgrana sk�rka ma tak� sam� nazw� (wliczaj�c w to wielko�� znak�w, wa�ne na serwerach uniksowych) jak ta wybrana w <em>G��wnych ustawieniach</em>.<br /><br />Je�li jeste� u�ytkownikiem tej strony, skontaktuj si� z administracj� strony poprzez wys�anie e-maila na adres ".hide_email($settings['siteemail'])." oraz poinformuj o istniej�cym problemie.";
$locale['global_302'] = "Wybrana przez Ciebie sk�rka nie istnieje lub jest niekompletna!";

?>
