<?php
require_once './inc/functions.php';

$products = $controllers->products()->get_all_products();
$max_count = 4; // Number of products to display

$products = array_slice($products, 0, $max_count); // Limit the array to the first 4 products

foreach ($products as $product):
?>
    <div class="col-4">
        <div class="card">
            <img src="<?= $product['image'] ?>" 
                class="card-img-top" 
                alt="image of <?= $product['description'] ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $product['name'] ?></h5>
                <p class="card-text"><?= $product['description'] ?></p>
                <p class="card-text"><?= $product['price'] ?></p>
            </div>
        </div>
    </div>
<?php 
endforeach;
?>