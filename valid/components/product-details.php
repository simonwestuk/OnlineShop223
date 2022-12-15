<?php
require_once './inc/functions.php';

$id = $_GET['id'] ?? '';

if (!empty($id)) {

    $product =$controllers->products()->get($id);

    if ($product): ?>
    
        <div class="card" style="width: 18rem;">
            <img src="<?= $product['image'] ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $product['name'] ?></h5>
                <p class="card-text"><?= $product['description'] ?></p>
                <p class="card-text"><?= $product['price'] ?></p>
            </div>
        </div>

    <?php 
     else: redirect("not-found"); //404 file not found
     endif ?>

<?php
} else {
    redirect("not-found"); //404 file not found
}
?>

