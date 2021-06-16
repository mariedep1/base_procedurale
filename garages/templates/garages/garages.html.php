<div class="container">

    <?php foreach($garages as $garage){ ?>
        <div class="row">
            <h3> <?php echo $garage['name']; ?> </h3>
            <p><strong>  <?php echo $garage['address']; ?>  </strong></p>
            <p><strong>  <?php echo $garage['description']; ?>  </strong></p>
            <a href="garage.php?id=<?php echo $garage['id']; ?>" class="btn btn-success">Voir le garage</a>
            <a href="deleteGarage.php?id=<?php echo $garage['id']; ?>" class="btn btn-danger">Supprimer ce garage</a>
        </div>
        <hr>
    <?php } ?>


</div>