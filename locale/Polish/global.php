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
Translators: Robert Gaudyn (Wooya), Bart³omiej Gajda (bartek124), sony

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
$locale['months'] = "&nbsp|styczeñ|luty|marzec|kwiecieñ|maj|czerwiec|lipiec|sierpieñ|wrzesieñ|pa¼dziernik|listopad|grudzieñ";
$locale['shortmonths'] = "&nbsp|st.|lt.|mar.|kwi.|maj|czer.|lip.|sier.|wrz.|pa¼.|lis.|gru.";

// Standard User Levels
$locale['user0'] = "Go¶æ";
$locale['user1'] = "U¿ytkownik";
$locale['user2'] = "Administrator";
$locale['user3'] = "G³ówny administrator";
$locale['user4'] = "Vip";
// Forum Moderator Level(s)
$locale['userf1'] = "Moderator";
// Navigation
$locale['global_001'] = "Nawigacja";
$locale['global_002'] = "Brak linków\n";
// Users Online
$locale['global_010'] = "Aktualnie online";
$locale['global_011'] = "Go¶ci online";
$locale['global_012'] = "U¿ytkowników online";
$locale['global_013'] = "Brak u¿ytkowników online";
$locale['global_014'] = "£±cznie u¿ytkowników";
$locale['global_015'] = "Nieaktywnych u¿ytkowników";
$locale['global_016'] = "Najnowszy u¿ytkownik";
// Forum Side panel
$locale['global_020'] = "Ostatnio na forum";
$locale['global_021'] = "Najnowsze tematy";
$locale['global_022'] = "Najciekawsze tematy";
$locale['global_023'] = "Brak tematów na forum";
// Articles Side panel
$locale['global_030'] = "Ostatnie artyku³y";
$locale['global_031'] = "Brak artyku³ów";
// Welcome panel
$locale['global_035'] = "Powitanie";
// Latest Active Forum Threads panel
$locale['global_040'] = "Ostatnio poruszane tematy";
$locale['global_041'] = "Moje ostatnie tematy";
$locale['global_042'] = "Moje ostatnie posty";
$locale['global_043'] = "Nowe posty";
$locale['global_044'] = "Temat";
$locale['global_045'] = "Obejrzeñ";
$locale['global_046'] = "Odpowiedzi";
$locale['global_047'] = "Ostatni post";
$locale['global_048'] = "Forum";
$locale['global_049'] = "Napisane przez";
$locale['global_050'] = "Autor";
$locale['global_051'] = "Ankieta";
$locale['global_052'] = "Przesuniêty";
$locale['global_053'] = "Brak rozpoczêtych przez Ciebie tematów.";
$locale['global_054'] = "Brak napisanych przez Ciebie postów.";
$locale['global_055'] = "Nowych postów od Twojej ostatniej wizyty: %u";
$locale['global_056'] = "Moje obserwowane tematy";
$locale['global_057'] = "Opcje";
$locale['global_058'] = "Przestañ <br /> obserwowaæ";
$locale['global_059'] = "Brak obserwowanych przez Ciebie tematów.";
$locale['global_060'] = "Przestaæ obserwowaæ temat?";
// News & Articles
$locale['global_070'] = "Napisane przez ";
$locale['global_071'] = "dnia ";
$locale['global_072'] = "Czytaj wiêcej";
$locale['global_073'] = " komentarzy";
$locale['global_073b'] = " komentarz";
$locale['global_074'] = " czytañ";
$locale['global_075'] = "Drukuj";
$locale['global_076'] = "Edytuj";
$locale['global_077'] = "News";
$locale['global_078'] = "Brak opublikowanych newsów";
// Page Navigation
$locale['global_090'] = "Poprzednia";
$locale['global_091'] = "Nastêpna";
$locale['global_092'] = "Strona ";
$locale['global_093'] = " z ";
// Guest User Menu
$locale['global_100'] = "Logowanie";
$locale['global_101'] = "Nazwa u¿ytkownika";
$locale['global_102'] = "Has³o";
$locale['global_103'] = "Zapamiêtaj mnie";
$locale['global_104'] = "Zaloguj";
$locale['global_105'] = "Nie masz jeszcze konta? <br /><a href='".BASEDIR."register.php' class='side'>Zarejestruj siê</a>";
$locale['global_106'] = "Nie mo¿esz siê zalogowaæ?<br /> Popro¶ o <a href='".BASEDIR."lostpassword.php' class='side'>nowe has³o</a>";
$locale['global_107'] = "Rejestracja";
$locale['global_108'] = "Zapomniane has³o";
// Member User Menu
$locale['global_120'] = "Centrum u¿ytkownika";
$locale['global_121'] = "Prywatne wiadomo¶ci";
$locale['global_122'] = "Lista kont";
$locale['global_123'] = "Panel administratora";
$locale['global_124'] = "Wyloguj";
$locale['global_125'] = "Nieprzeczytanych wiadomo¶ci: %u";
$locale['global_126'] = "";
$locale['global_127'] = "";
//dodano
$locale['global_128'] = " nades³any materia³";
$locale['global_129'] = " nades³ane materia³y";
//koniec
// Poll
$locale['global_130'] = "Ankieta";
$locale['global_131'] = "Zag³osuj";
$locale['global_132'] = "Musisz zalogowaæ siê, aby móc zag³osowaæ.";
$locale['global_133'] = "g³os";
$locale['global_134'] = "g³osów";
$locale['global_135'] = "Ogó³em g³osów: ";
$locale['global_136'] = "Rozpoczêto: ";
$locale['global_137'] = "Zakoñczono: ";
$locale['global_138'] = "Archiwum ankiet";
$locale['global_139'] = "Wybierz ankietê z listy:";
$locale['global_140'] = "Zobacz wyniki";
$locale['global_141'] = "Wyniki ankiety";
$locale['global_142'] = "Brak przeprowadzanych ankiet.";
// Shoutbox
$locale['global_150'] = "Shoutbox";
$locale['global_151'] = "Nick:";
$locale['global_152'] = "Wiadomo¶æ:";
$locale['global_153'] = "Wy¶lij";
$locale['global_154'] = "Musisz zalogowaæ siê, aby móc dodaæ wiadomo¶æ.";
$locale['global_155'] = "Archiwum shoutboksa";
$locale['global_156'] = "Brak wiadomo¶ci. Mo¿e czas dodaæ w³asn±?";
$locale['global_157'] = "Usuñ";
$locale['global_158'] = "Kod potwierdzaj±cy:";
$locale['global_159'] = "Wpisz kod potwierdzaj±cy:";
// Footer Counter
$locale['global_170'] = "unikalna wizyta";
$locale['global_171'] = "Unikalnych wizyt";
$locale['global_172'] = "Wygenerowano w sekund: %s";
// Admin Navigation
$locale['global_180'] = "Powróæ do panelu administracyjnego";
$locale['global_181'] = "Powróæ do strony g³ównej";
$locale['global_182'] = "<strong>Uwaga:</strong> Nie podano has³a Administratora, lub podane jest b³êdne.";
// Miscellaneous
$locale['global_190'] = "Aktywowano tryb prac na serwerze.";
$locale['global_191'] = "Twoje IP jest zablokowane.";
$locale['global_192'] = "Wylogowujê jako: ";
$locale['global_193'] = "Logujê jako: ";
$locale['global_194'] = "Konto zosta³o zablokowane.";
$locale['global_195'] = "Konto nie jest aktywne.";
$locale['global_196'] = "Nieprawid³owa nazwa u¿ytkownika lub has³o.";
$locale['global_197'] = "Proszê czekaæ na przekierowanie...<br /><br />
[ <a href='".(isset($_GET['redirect']) ? stripinput(urldecode($_GET['redirect'])) : "index.php")."'>Nie chcê czekaæ</a> ]";
$locale['global_198'] = "<strong>Ostrze¿enie:</strong> Wykryto plik setup.php. Proszê, usuñ go natychmiast.";
$locale['global_199'] = "<strong>Ostrze¿enie:</strong> Nie ustawiono has³a administratora, <a href='".BASEDIR."user_center/edit_profile.php'>ustaw je</a> natychmiast.";
//Titles
$locale['global_200'] = " - ";
$locale['global_201'] = ": ";
$locale['global_202'] = $locale['global_200']."Szukaj";
$locale['global_203'] = $locale['global_200']."FAQ";
$locale['global_204'] = $locale['global_200']."Forum";
//Themes
$locale['global_210'] = "Przejd¼ do tre¶ci";
// No themes found
$locale['global_300'] = "nie znaleziono skórki.";
$locale['global_301'] = "Nie mo¿na wy¶wietliæ strony. Jest to spowodowane brakiem plików odpowiadaj±cych za wygl±d strony. Je¶li jeste¶ administratorem strony, uruchom swojego klienta FTP i wgraj do katalogu <em>/themes</em> jak±kolwiek skórkê zaprojektowan± dla <em>PHP-Fusion v7</em>. Nastêpnie sprawd¼ w <em>G³ównych ustawieniach</em> w <em>Panelu administratora</em> oraz upewnij siê, ¿e wybrana tam skórka jest w Twoim katalogu <em>/themes</em>. Je¶li tak nie jest, sprawd¼, czy wgrana skórka ma tak± sam± nazwê (wliczaj±c w to wielko¶æ znaków, wa¿ne na serwerach uniksowych) jak ta wybrana w <em>G³ównych ustawieniach</em>.<br /><br />Je¶li jeste¶ u¿ytkownikiem tej strony, skontaktuj siê z administracj± strony poprzez wys³anie e-maila na adres ".hide_email($settings['siteemail'])." oraz poinformuj o istniej±cym problemie.";
$locale['global_302'] = "Wybrana przez Ciebie skórka nie istnieje lub jest niekompletna!";

?>
