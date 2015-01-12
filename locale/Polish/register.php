<?php
//
$locale['400'] = "Rejestracja";
$locale['401'] = "Aktywacja konta";
// Registration Errors
$locale['402'] = "Musisz poda� nazw� u�ytkownika, has�o oraz adres e-mail.";
$locale['403'] = "Nazwa u�ytkownika zawiera nieobs�ugiwane znaki.";
$locale['404'] = "Has�a u�ytkownika nie pasuj� do siebie.";
$locale['405'] = "Nieprawid�owe has�o u�ytkownika, prosz� o korzystanie wy��cznie ze znak�w alfanumerycznych.<br />Has�o musi zawiera� minimum 6 znak�w.";
$locale['406'] = "Podany adres e-mail jest nieprawid�owy.";
$locale['407'] = "Niniejszy login (".(isset($_POST['username']) ? $_POST['username'] : "").") jest ju� w u�yciu";
$locale['408'] = "Niniejszy adres e-mail (".(isset($_POST['email']) ? $_POST['email'] : "").") jest ju� w u�yciu.";
$locale['409'] = "Nieaktywne konto jest ju� zarejestrowane na ten e-mail.";
$locale['410'] = "Nieprawid�owy kod potwierdzaj�cy.";
$locale['411'] = "Tw�j adres e-mail lub jego domena s� zablokowane.";
// Email Message
$locale['449'] = "Witaj na ".$settings['sitename'];
$locale['450'] = "Witaj ".(isset($_POST['username']) ? $_POST['username'] : "").",\n
Witaj na ".$settings['sitename'].". Oto Twoje dane do zalogowania:\n
Nazwa u�ytkownika: ".(isset($_POST['username']) ? $_POST['username'] : "")."
Has�o: ".(isset($_POST['password1']) ? $_POST['password1'] : "")."\n
Aktywuj swoje konto klikaj�c na poni�szy link:\n";
// Registration Success/Fail
$locale['451'] = "Rejestracja zako�czona.";
$locale['452'] = "Teraz mo�esz zalogowa� si�.";
$locale['453'] = "Wkr�tce Twoje konto zostanie aktywowane przez administratora.";
$locale['454'] = "Rejestracja zako�czona. Za chwil� otrzymasz e-mail wraz z linkiem aktywuj�cym.";
$locale['455'] = "Konto zosta�o poprawnie zweryfikowane.";
$locale['456'] = "Rejestracja nie powiod�a si�.";
$locale['457'] = "Wys�anie e-maila z Twoimi danymi nie powiod�o si�, skontaktuj si� z <a href='mailto:".$settings['siteemail']."'>Administratorem strony</a>.";
$locale['458'] = "Rejestracja nie powiod�a si�.";
$locale['459'] = "Spr�buj jeszcze raz.";
// Register Form
$locale['500'] = "Wpisz poni�ej swoje dane. ";
$locale['501'] = "Na podany adres e-mail zostanie wys�ana wiadomo�� weryfikacyjna. ";
$locale['502'] = "Pola oznaczone <span style='color:#ff0000;'>*</span> musz� by� wype�nione.
Nazwa u�ytkownika oraz has�o s� obowi�zkowe.";
$locale['503'] = " Po zalogowaniu si� przejd� do edycji profilu i uzupe�nij swoje dane.";
$locale['504'] = "Kod potwierdzaj�cy:";
$locale['505'] = "Wpisz kod potwierdzaj�cy:";
$locale['506'] = "Zarejestruj";
$locale['507'] = "System rejestracji zosta� wy��czony.";
$locale['508'] = "Akceptacja regulaminu";
$locale['509'] = "Akceptuj� <a href='".BASEDIR."print.php?type=T' target='_blank'>regulamin</a> obowi�zuj�cy na ".$settings['sitename'].".";
// Validation Errors
$locale['550'] = "Nie podano nazwy u�ytkownika.";
$locale['551'] = "Nie podano has�a.";
$locale['552'] = "Nie podano adresu e-mail.";
?>
