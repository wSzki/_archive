 <?php
 // Connexion à la base de données
 try
 {
    $bdd = new PDO('mysql:host=localhost;dbname=cvtheque;charset=utf8', 'wsz', 'porcelain');
     }
     catch(Exception $e)
     {
             die('Erreur : '.$e->getMessage());
            }

             $req = $bdd->prepare('INSERT INTO contact (email, phone, msg) VALUES(?, ?, ?)');
             $req->execute(array($_POST['name'], $_POST['email'], $_POST['message']));
             if (count($_POST)>0) echo "Contact enrégistré avec succès";
             header('Location: index.php');
             ?>
