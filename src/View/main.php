
<div class="container">
  <h3>Catalog</h3>
    <div class="card-deck">
        <?php foreach($productModel->getAll() as $product): ?>
        <form action="/main" method="POST">
            <div class="card text-center">
                <a href="#">
                    <div class="card-header">
                        Products!
                    </div>
                    <img class="card-img-top" src="<?php echo $product['img_url']; ?>" alt="Card image">
                    <div class="card-body">
                        <p class="card-text text-muted"><?php echo $product['name']; ?></p>
                        <a href="#"><h5 class="card-title"><?php echo $product['description']; ?></h5></a>
                        <div class="card-footer">
                            <?php echo $product['price']; ?>
                        </div>
                        <input type="hidden" placeholder="Enter Product ID" name="product_id" id="name" value="<?php echo $product['id']; ?>" required>
                        <input type="text" placeholder="Enter Quantity" name="quantity" id="quantity" required>
                        <button type="submit" class="registerbtn">Add</button>
                    </div>
                </a>
            </div>
        </form>

        <?php endforeach; ?>


  </div>
</div>

<style>
    body {
        font-style: sans-serif;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    h3 {
        line-height: 3em;
    }

    .card {
        max-width: 16rem;
    }

    .card:hover {
        box-shadow: 1px 2px 10px lightgray;
        transition: 0.2s;
    }

    .card-header {
        font-size: 13px;
        color: gray;
        background-color: white;
    }

    .text-muted {
        font-size: 18px;
    }

    .card-footer{
        font-weight: bold;
        font-size: 18px;
        background-color: white;
    }
    .card-img-top {
        width: 250px;
        height: 200px;
        border-style: solid;
    }

    .card-img-top img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: 0 0;
    }
</style>
