<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des notes</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
<form  action="GoogleKeep.php" method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-sm-12 col-md-6">
    <h2><strong>Ajouter une note</strong></h2><br>
    <div class="form-group">
        <label>Nom:</label>
        <input name="nom" class="form-control" id="nom" type="text" placeholder="insérer votre nom">
    </div>
    <div class="form-group">
        <label for="note">Note: </label>
        <input name="note" class="form-control" id="note" type="text" placeholder="créer une note">
    </div>
    <input type="submit" value="Ajouter" class="btn btn-primary">
            </div></div></div>
</form>

<?php
if (isset($_POST['nom'])) {
        if($_POST['nom']=="" || $_POST['note']==""){
            $_SESSION['error'] = "Veuillez insérer votre nom ou votre note";
    }

    else if (isset($_SESSION['mesNotes'][$_POST['nom']])) {
        $_SESSION['error'] = "Cette note existe déjà, impossible de l'ajouter";
    }
    else {
        $_SESSION['mesNotes'][$_POST['nom']] = $_POST['note'];
        $_SESSION['succes'] = "Note: " . $_SESSION['mesNotes'][$_POST['nom']] . " ajoutée avec succés";
    }
}
?>

<?php
if(!isset($_SESSION['mesNotes'])){
    ?>
    <div class="alert alert-danger" role="alert">Liste vide</div>
    <?php
} else {
?>

<?php if(isset($_SESSION['error'])){
    ?>
    <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
    <?php
    unset($_SESSION['error']);
}
?>

<?php if(isset($_SESSION['succes'])){
    ?>
    <div class="alert alert-success"><?= $_SESSION['succes'] ?></div>
    <?php
    unset($_SESSION['succes']);
}
?>

<form action='GoogleKeep.php' method='get' name='formulaire'>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-sm-12 col-md-6">
    <h2><strong>Liste des notes</strong></h2><br>
    <div class="card-group" style="display:flex;flex-wrap:wrap;">
        <?php
        foreach ($_SESSION['mesNotes'] as $titre => $contenu)  {
            ;?>
            <div class="list-group-item" style="width:20%;">
                <div class="card" ">
                    <div class="card-body" style="color:white;background-color:darkgrey;">
                        <?php echo $titre.":". $contenu ; ?></div>
                    <a href="GoogleKeep.php?id=<?= $titre ?>" style="border:1px solid white;
                    padding:2px 5px; display: block; margin-left:auto; margin-right:auto;
                    text-decoration: none;color:white;background-color:darkblue">Delete</a>
                </div>

            </div>
            <?php
            foreach ($_SESSION['mesNotes'] as $titre1 => $contenu1)
            {if (isset($_GET["id"]))
            { $deleteelt= $_GET["id"];

                unset($_SESSION['mesNotes'][$deleteelt]);
            }}
            ?>
        <?php } ?>
        <?php
        if (isset($deleteelt)) {
            unset($_SESSION['mesNotes'][$deleteelt]);
            header("location:GoogleKeep.php");}
        } ?>
    </div>

            </div></div>
</form>
</body>
<?php
?>
</html>