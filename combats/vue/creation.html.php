<html>
<body>
<?php if(isset($erreur)):
    if($erreur != ""): ?>
        <div class="error">
            <?php echo $erreur ?>
        </div>
    <?php endif; ?>
<?php endif ?>
<?php if(isset($succes)): var_dump($liste)?>
        <div class="success">
            <?php echo $succes ?>
        </div>
<?php endif ?>
<h1>Choix du perso</h1>
<form method="post">
    Nouveau: <input type="text" name="nom">
    <button type="submit" name ="new">OK</button>
</form><hr>
<form method="post">
choisir : <select name="choix">
    <option value="none">Choisir</option>
        <?php foreach ($liste as $item): ?>
        <option value="<?php echo $item->getId() ?>"><?php echo $item->getNom() ?></option>;
        <?php endforeach ;?>
</select>
<button type="submit" name ="charge">OK</button>
</form>
</body>
</html>