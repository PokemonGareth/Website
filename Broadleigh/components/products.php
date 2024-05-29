<?php
require_once './inc/functions.php';

 $products = $controllers->products()->get_all_products();

foreach ($products as $product):
?>
    <div class="col-4">
        <div class="card" style="background-color: #9BB895; color: #ffffff;">
            <img src="<?= $product['image'] ?>" 
                class="card-img-top" 
                alt="image of <?= $product['description'] ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $product['name'] ?></h5>
                <p class="card-text"><?= $product['description'] ?></p>
                <p class="card-text">£<?= $product['price'] ?></p>
                <a href="productdetail.php?id=<?= $product['id'] ?>" class="btn btn-primary">View Details</a>
            </div>
        </div>
    </div>
<?php 
endforeach;
?>
