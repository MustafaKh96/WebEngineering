<!DOCTYPE html>
<html lang="en">
<head>
    <!--Start-->
    <!--https://www.w3schools.com/w3css/tryit.asp?filename=tryw3css_icons_awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--End-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
    <link rel="stylesheet" href="../Exercise 1/Exrcise_1.css">
    <style>
        table{
            border-style: double;
            width: 100%;
        }
        th, td{
            border: 1px solid black;
            box-shadow: 0 1px 1px black;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <div class="Header">
        <div id="hOmE">
            <a href="../AppExercise/AppExercise.html"><i class="fa fa-home" style="font-size:60px;color:rgb(143, 143, 143)"></i></a>
        </div>
        <div id="Links">
            <a href="./Exercise_12_2.html">
            <i class="fa fa-arrow-left" style="font-size:57px;color:rgb(143, 143, 143)"></i></a>
        </div>
        </a>
        <div class="Uebung" id="U11">
            <h3> 12.3 WWW-Navigator zum Content-Editor ausbauen</h3>
        </div>
        <div id="rechts"> 
            <a href="./login.php"><i class="fa fa-arrow-right" style="font-size:57px;color:rgb(143, 143, 143)"></i></a>
        </div>
        <div id="abc">
            <i class="fa fa-bars" style="font-size:57px;color:rgb(143, 143, 143)"></i>
            <div class="Index" style="right:0;">
            <a href="./Exercise_12_1.html">12.1 Registrierung mit PHP</a>
            <a href="./Exercise_12_2.html">12.2 Login mit PHP</a>
            <a href="./Exercise_12_3.php">12.3 WWW-Navigator zum Content-Editor ausbauen</a>
            </div>
        </div>
    </div>
    <div class="Loesung"> 
        <h2 class="question">
        Bauen Sie Ihren WWW-Navigator zum Content-Editor aus, mit dem Sie weitere Inhalte hinzu fügen können, die persistent auf dem Server mittels PHP gespeichert werden. Schreiben Sie Ihre PHP-Scripte so, dass es zu keinen Nebenläufigkeitsartefakten kommen kann, egal wie viele Nutzer gleichzeitig editieren und speichern. <br>
        Speichern Sie die Inhalte Ihres WWW-Navigators auf dem Server www2.inf.h-brs.de. Erweitern Sie Ihren WWW-Navigator um eine Edit-Funktionalität, so dass Inhalte editiert und ergänzt werden können. Vermeiden Sie die Lost Update-Anomalie. <br>
        Schützen Sie Ihre Inhalte mit einem Login.
        </h2>
        <form method="post">
            <fieldset>
                <legend>registrieren:</legend>
                Benutzername:<br>
                <input type="text" name="Benutzername">
                <br>
                Passwort:<br>
                <input type="password" name="Passwort">
                <br><br>
                <input type="submit" value="registrieren">
            </fieldset>
        </form>

        <form method="post">
            <fieldset>
                <legend>einlogen:</legend>
                Benutzername:<br>
                <input type="text" name="BenutzernameEinlogen">
                <br>
                Passwort:<br>
                <input type="password" name="PasswortEinlogen">
                <br><br>
                <input type="submit" value="einlogen">
            </fieldset>
        </form>

        <?PHP
        if (isset($_POST['Benutzername']) && isset($_POST['Passwort']) ){

            $name = $_POST['Benutzername'];
            $paswt = $_POST[ 'Passwort' ];
            $SALT = "asdf yxcv ertz hjkl iopo vbmn ,.";
            $Benutzername = hash("sha384", $_POST['Benutzername'].SALT);
            $Passwort = hash("sha384", $_POST[ 'Passwort' ].SALT);
            $Datei_CSV = './Benutzerdaten.csv';
            $Datensatz = $Benutzername . ',' . $Passwort . "\n";

            if($name == "" || $paswt ==""){
                echo "<script>alert('Geben Sie bitte alle Angaben an!')</script>";
            }            
            else{
                
                if (($Daten = fopen("Benutzerdaten.csv", "r")) !== FALSE) {
                    while (($Daten2 = fgetcsv($Daten, 1000, ",")) !== FALSE) {
                        for($c=0; $c < 1; $c++){
                            if($Benutzername === $Daten2[$c]){
                                echo "<script>alert('Dein Benutzername existiert schon :(')</script>";
                                return;
                            }
                        }  
                        
                    }
                    fclose($Daten);
                }
                if (file_put_contents($Datei_CSV, $Datensatz, FILE_APPEND | LOCK_EX ) ){
                    echo "<script>alert('Erfolgreich registriert :)')</script>";
                }
                else{
                    echo "<script>alert('NICHT Erfolgreich registriert :(')</script>";
                }
            }    
        }


        if (isset($_POST['BenutzernameEinlogen']) && isset($_POST['PasswortEinlogen']) ){
            $SALT = "asdf yxcv ertz hjkl iopo vbmn ,.";
            $BenutzernameEinlogen = hash("sha384", $_POST['BenutzernameEinlogen'].SALT);
            $PasswortEinlogen = hash("sha384", $_POST[ 'PasswortEinlogen' ].SALT);
            if (($Daten = fopen("Benutzerdaten.csv", "r")) !== FALSE) {
                while (($Daten2 = fgetcsv($Daten, 1000, ",")) !== FALSE) {
                    for ($c=0; $c < 2; $c++) {
                        if($BenutzernameEinlogen === $Daten2[0] && $PasswortEinlogen === $Daten2[1]){
                            echo "<script>alert('Sie sind eingelogt :)')</script>";
                            return;
                        }  
                    }
                }
                echo "<script>alert('Einlogen ist fehlgeschlagen :(')</script>";
            }
        }
        ?>
        </div>
        
