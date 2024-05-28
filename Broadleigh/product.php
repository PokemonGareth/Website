<?php require __DIR__ . "/inc/header.php"; ?>

<section class="vh-100 text-center">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
      <a href="ProductSearch.php"><button type="button">Search Product</button></a>
        <?php require __DIR__ . "/components/products.php"; ?>
      </div>
    </div>
</section>  

<?php require __DIR__ . "/inc/footer.php"; ?>