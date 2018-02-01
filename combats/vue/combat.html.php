<html>
<body>
<?php if(isset($erreur)):
    if($erreur != ""): ?>
        <div class="error">
            <?php echo $erreur ?>
        </div>
    <?php endif; ?>
<?php endif ?>
<br>
<a href="?fermer">Changer de perso</a><BR>
<?php if (isset($image)): ?>

    <img src="images/<?php echo $image;?>" alt="img">
<?php endif; ?>
<?php if (isset($cible)): ?>

    <?php echo $perso->getNom() . " attaque " . $cible->getNom() . " !"?><br>
    <?php echo $cible->getNom() . " subit 5 dégats, il lui reste " .  $pvRestants . " points de vie !"?><br><br>
<p>Attaquez à nouveau ?</p>

<?php else: ?>
    <h1><?php echo $perso->getNom() . " choisit sa cible"?></h1>

<?php endif; ?>

<form method="post">
    choisir : <select name="choixAttaque">
        <option value="none">Choisir</option>
        <?php foreach ($liste as $item): ?>
        <?php if($_SESSION['current'] != $item): ?>
            <option value="<?php echo $item->getId() ?>"><?php echo $item->getNom() ?></option>;
        <?php endif; ?>
        <?php endforeach; ?>
    </select>
    <button type="submit" name="lance">OK</button>
</form>
</body>
</html>