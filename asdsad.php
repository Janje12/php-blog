<?php
session_start();

$_SESSION['username'] = $_GET['username'];
$_SESSION['password'] = $_GET['password'];

?>


<html>

<head>
    <meta charset="Utf-8" />
    <title> Podaci o studentima</title>
</head>

<body style="background-color: #83677B">

    <h2 style="font-family: Arial, Helvetica, sans-serif; color:white">
        Unos-azuriranje podataka o studentima
    </h2>
    <form method="post" action="index.php">
        <?php

        print "<p> broj sesije: " . session_id() . "</p>\n\n";

        print "<p> Ulogovan je korisnik sa usernamom:" . $_SESSION['username'] . " i passwordom:" . $_SESSION['password'] . " </p> \n\n";
        print session_save_path();



        //Konektovanje na MySQL
        if (!($DB = mysqli_connect("localhost", "user", "root", "StudentiDB")))
            die("Ne moze da se izvrsi konekcija na MYSQL server");
        mysqli_set_charset($DB, "utf8");
        //deklarisanje i incijalizovanje promeljivih
        $BRIND = "";
        $PREZIME = "";
        $IME = "";
        $STATUS = "";
        $SIFRA = "";
        //ako je korisnik kliknuo dugme "Trazi po prezimenu"
        if (isset($_POST['TRAZI'])) {
            $upit = "SELECT * FROM student WHERE prezime LIKE '" . $_POST['PREZIME'] . "'";
            if (!($rezultat = mysqli_query($DB, $upit))) {
                print("Ne moze se izbrsiti upit! <br/>");
                die(mysqli_error($DB));
            }
            if (!($RED = mysqli_fetch_assoc($rezultat))) {
                print("Nema trazenog studenta");
                die(mysqli_error($DB));
            } else {
                $PREZIME = $RED['prezime'];
                $IME = $RED['ime'];
                $BRIND = $RED['broj_indeksa'];
                $SIFRA = $RED['sifra'];
                $STATUS = $RED['status'];
            }
        } elseif (isset($_POST['TRAZI2'])) {
            //Ako je korisnik kliknuo na dugme "Trazi po broju indeksa"

            $upit2 = "SELECT * FROM student WHERE broj_indeksa LIKE '" . $_POST['BRIND'] . "'";
            if (!($rezultat2 = mysqli_query($DB, $upit2))) {
                print("Ne moze se izvrsiti upit! <br/>");
                die(mysqli_error($DB));
            }
            if (!($RED = mysqli_fetch_assoc($rezultat2))) {
                print("Nema trazenog studenta! <br/>");
            } else {
                $PREZIME = $RED['prezime'];
                $IME = $RED['ime'];
                $BRIND = $RED['broj_indeksa'];
                $SIFRA = $RED['sifra'];
                $STATUS = $RED['status'];
            }
        } elseif (isset($_POST['DODAJ'])) {
            //Ako je korisnik kliknuo na dugme "DODAJ"
            if ((!$_POST['PREZIME']) || (!$_POST['IME']) || (!$_POST['STATUS']) || (!$_POST['BRIND']) || (!$_POST['SIFRA'])) {
                echo "Mora biti uneto prezime, ime, broj indeksa, status i sifra!";
            } else {
                $upitdodaj = "INSERT INTO student(prezime, ime, broj_indeksa, status, sifra) VALUES('" . $_POST['PREZIME'] . "', '" . $_POST['IME'] . "',  '" . $_POST['BRIND'] . "', '" . $_POST['STATUS'] . "', '" . $_POST['SIFRA'] . "')";
                if (!($rezultatD = mysqli_query($DB, $upitdodaj))) {
                    print("Ne moze se izvrsiti upit! <br/>");
                    die(mysqli_error($DB));
                }
                $MESSAGE = "SLOG DODAT";
            }
        } elseif (isset($_POST['AZURIRAJ'])) {
            //Ako je korisnik kliknuo na dugme "AZURIRAJ"
            if ((!$_POST['PREZIME']) || (!$_POST['IME']) || (!$_POST['STATUS']) || (!$_POST['BRIND']) || (!$_POST['SIFRA'])) {
                echo "Mora biti uneto prezime, ime, broj indeksa, status i sifra!";
            } else {
                $upitazuriraj = "UPDATE student SET prezime = '" . $_POST['PREZIME'] . "', ime = '" . $_POST['IME'] . "', sifra = '" . $_POST['SIFRA'] . "', status = '" . $_POST['STATUS'] . "'
                WHERE broj_indeksa = '" . $_POST['BRIND'] . "'";
                if (!($rezultatz = mysqli_query($DB, $upitazuriraj))) {
                    print("Ne moze se izvrsiti AZURIRANJE u tabeli student! <br/>");
                    die(mysqli_error($DB));
                }
                $MESSAGE = "SLOG AZURIRAN";
            }
            $PREZIME = $_POST['PREZIME'];
            $IME = $_POST['IME'];
            $BRIND = $_POST['BRIND'];
            $SIFRA = $_POST['SIFRA'];
            $STATUS = $_POST['STATUS'];
        } elseif (isset($_POST['OBRISI'])) {
            //Ako je korisnik kliknuo na dugme "OBRISI"
            $upitBrisanje = "DELETE FROM student WHERE broj_indeksa = '" . $_POST['BRIND'] . "'";

            if (!($rezultatBrisanja = mysqli_query($DB, $upitBrisanje))) {
                print("Ne moze se izbrisiti brisanje <br/>");
                die(mysqli_error($DB));
            }

            //Brisanje selektovanih podataka sa ekrana
            //za slog koji je obrisan

            $PREZIME = "";
            $IME = "";
            $SIFRA =  "";
            $STATUS = "";
            $BRIND = "";
            $MESSAGE = "SLOG OBRISAN";
        }

        $PREZIME = trim($PREZIME);
        $IME = trim($IME);
        $SIFRA = trim($SIFRA);
        $STATUS = trim($STATUS);
        $BRIND = trim($BRIND);
        ?>

        <table>
            <col span="1" align="center">
            <tr>
                <td style="font-weight: bold;color:white"> Broj indeksa:</td>
                <td><input name="BRIND" type="text" size="7" value="<?php echo $BRIND ?>" /></td>
            </tr>
            <tr>
                <td style="font-weight: bold;color:white">Prezime:</td>
                <td><input name="PREZIME" type="text" size="30" value="<?php echo $PREZIME ?>" /></td>
            </tr>
            <tr>
                <td style="font-weight: bold;color:white">Ime:</td>
                <td><input name="IME" type="text" size="30" value="<?php echo $IME ?>" /></td>
            </tr>
            <tr>
                <td style="font-weight: bold;color:white">Status:</td>
                <td>
                    <?php if ($STATUS == "S") { ?>
                        <label>
                            B <input name="STATUS" type="radio" value="B" />
                        </label>
                        <label>
                            S <input name="STATUS" type="radio" value="S" checked="checked" />
                        </label>
                    <?php } else { ?>
                        <label>
                            B <input name="STATUS" type="radio" value="B" checked="checked" />
                        </label>
                        <label>
                            S <input name="STATUS" type="radio" value="S" />
                        </label>
                    <?php } ?>
                </td>
                <td style="font-weight: bold;color:white">SIFRA SMERA</td>
                <td><input name="SIFRA" type="text" size="5" value="<?php echo $SIFRA ?>" /></td>
            </tr>
        </table>
        <br>
        <input type="submit" name="DODAJ" value="DODAJ" style="background-color: #C3073F; color: white; font-weight: bold;" />
        <input type="submit" name="AZURIRAJ" value="AZURIRAJ" style="background-color: #C3073F; color: white; font-weight: bold;" />
        <input type="submit" name="OBRISI" value="OBRISI" style="background-color: #C3073F; color: white; font-weight: bold;" />
        <input type="submit" name="TRAZI" value="TRAZI PO PREZIMENU" style="background-color: #C3073F; color: white; font-weight: bold;" />
        <input type="submit" name="TRAZI2" value="TRAZI PO BROJU INDEKSA" style="background-color: #C3073F; color: white; font-weight: bold;" />
        <a href="login.php" style="background-color: blue; color: white; font-weight: bold;">ODJAVLJIVANJE</a>

        <!-- <input type="submit" name="IZLAZ" value="LOG OUT" style="background-color: #C3073F; color: white; font-weight: bold;" /> -->

        <hr>
        <?php
        if (isset($MESSAGE)) {
            echo "<br> <br> $MESSAGE";
        }
        ?>
    </form>
</body>

</html>