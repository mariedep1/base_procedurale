<div class="container">

<!-- <?php if( isset($_GET['info']) && $_GET['info'] == "error" ){?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  Il faut remplir tous le formulaire.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } ?> -->



<a href="index.php" class="btn btn-info">Retour à l'accueil</a>
    <article class="row">

        <h2><?php echo $garage['name'] ?></h2>
        <p><?php echo $garage['address'] ?></p>
        <p><?php echo $garage['description'] ?></p>

    </article>
    

    <form action="saveAnnonce.php" method="POST" class="mt-2">

        <input type="hidden" name="garageId" value="<?php echo $garage['id']?>">
        
        <div class="form-group">

            <textarea name="name" id="" cols="50" rows="5" placeholder="Nom"></textarea>
        </div>            
        <div class="form-group">
            <textarea name="price" id="" cols="50" rows="1" placeholder="Prix"></textarea>  
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Créer</button>
        </div>
    </form>

    <hr>

    <?php if(empty($annonces)){?>
        <p>Il n'y a pas d'annonces</p>
    <?php } ?>


    <?php foreach($annonces as $annonce){?>
         <ul class="list-unstyled">
            <li><?php echo $annonce['name']?></li>
            <li><?php echo $annonce['price']?>€</li>
        </ul>
        <a href="deleteAnnonce.php?id=<?php echo $annonce['id']?>" class="btn btn-danger">Supprimer l'annonce</a>
        <hr>
    <?php } ?>

    
    
</div>