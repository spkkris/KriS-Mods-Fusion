<?php
//
$locale['400'] = "Rejestracja";
$locale['401'] = "Aktywacja konta";
// Registration Errors
$locale['402'] = "Musisz podaæ nazwê u¿ytkownika, has³o oraz adres e-mail.";
$locale['403'] = "Nazwa u¿ytkownika zawiera nieobs³ugiwane znaki.";
$locale['404'] = "Has³a u¿ytkownika nie pasuj± do siebie.";
$locale['405'] = "Nieprawid³owe has³o u¿ytkownika, proszê o korzystanie wy³±cznie ze znaków alfanumerycznych.<br />Has³o musi zawieraæ minimum 6 znaków.";
$locale['406'] = "Podany adres e-mail jest nieprawid³owy.";
$locale['407'] = "Niniejszy login (".(isset($_POST['username']) ? $_POST['username'] : "").") jest ju¿ w u¿yciu";
$locale['408'] = "Niniejszy adres e-mail (".(isset($_POST['email']) ? $_POST['email'] : "").") jest ju¿ w u¿yciu.";
$locale['409'] = "Nieaktywne konto jest ju¿ zarejestrowane na ten e-mail.";
$locale['410'] = "Nieprawid³owy kod potwierdzaj±cy.";
$locale['411'] = "Twój adres e-mail lub jego domena s± zablokowane.";
// Email Message
$locale['449'] = "Witaj na ".$settings['sitename'];
$locale['450'] = "Witaj ".(isset($_POST['username']) ? $_POST['username'] : "").",\n
Witaj na ".$settings['sitename'].". Oto Twoje dane do zalogowania:\n
Nazwa u¿ytkownika: ".(isset($_POST['username']) ? $_POST['username'] : "")."
Has³o: ".(isset($_POST['password1']) ? $_POST['password1'] : "")."\n
Aktywuj swoje konto klikaj±c na poni¿szy link:\n";
// Registration Success/Fail
$locale['451'] = "Rejestracja zakoñczona.";
$locale['452'] = "Teraz mo¿esz zalogowaæ siê.";
$locale['453'] = "Wkrótce Twoje konto zostanie aktywowane przez administratora.";
$locale['454'] = "Rejestracja zakoñczona. Za chwilê otrzymasz e-mail wraz z linkiem aktywuj±cym.";
$locale['455'] = "Konto zosta³o poprawnie zweryfikowane.";
$locale['456'] = "Rejestracja nie powiod³a siê.";
$locale['457'] = "Wys³anie e-maila z Twoimi danymi nie powiod³o siê, skontaktuj siê z <a href='mailto:".$settings['siteemail']."'>Administratorem strony</a>.";
$locale['458'] = "Rejestracja nie powiod³a siê.";
$locale['459'] = "Spróbuj jeszcze raz.";
// Register Form
$locale['500'] = "Wpisz poni¿ej swoje dane. ";
$locale['501'] = "Na podany adres e-mail zostanie wys³ana wiadomo¶æ weryfikacyjna. ";
$locale['502'] = "Pola oznaczone <span style='color:#ff0000;'>*</span> musz± byæ wype³nione.
Nazwa u¿ytkownika oraz has³o s± obowi±zkowe.";
$locale['503'] = " Po zalogowaniu siê przejd¼ do edycji profilu i uzupe³nij swoje dane.";
$locale['504'] = "Kod potwierdzaj±cy:";
$locale['505'] = "Wpisz kod potwierdzaj±cy:";
$locale['506'] = "Zarejestruj";
$locale['507'] = "System rejestracji zosta³ wy³±czony.";
$locale['508'] = "Akceptacja regulaminu";
$locale['509'] = "Akceptujê <a href='".BASEDIR."print.php?type=T' target='_blank'>regulamin</a> obowi±zuj±cy na ".$settings['sitename'].".";
// Validation Errors
$locale['550'] = "Nie podano nazwy u¿ytkownika.";
$locale['551'] = "Nie podano has³a.";
$locale['552'] = "Nie podano adresu e-mail.";
?>
