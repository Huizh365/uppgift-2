<?php
    require "config.php"
?><html>
    <head>
        <title>Uppgift 2</title>
    </head>
    <body>
        <?php
            function fsu24d_say_hello($greeting="Hello") {
                if(isset($_POST["name"])) {
                    $name = $_POST["name"];                
                } else {
                    $name = "stranger";
                }
                echo($greeting. " " . $name . "!");
            }

            if($_SERVER["REQUEST_METHOD"] === "POST") {
                fsu24d_say_hello();
            } else {
                ?>
                <form method="POST">
                    <input name="name" />
                    <input type="submit" />
                </form>
            <?php
            }
            ?>

        
        <div style="display:flex">
        <?php 
            $products = [
                [
                    'name'=> "product 1",
                    'category' => "cat 1",
                    'price' => 11,
                    'is_new' => true
                ],
                [
                    'name'=> "product 2",
                    'category' => "cat 2",
                    'price' => 22,
                    'is_new' => false
                ],
                [
                    'name'=> "product 3",
                    'category' => "cat 3",
                    'price' => 333,
                    'is_new' => true
                ]
            ]
        ?>
        <?php 
            for ($i=0; $i<count($products); $i++) {
                $product = $products[$i]
                ?> 
                <div style="border: 1px solid black" class="<?php 
                    $extra_class = '';
                    
                    if($product['is_new']){
                        $extra_class=' is-new';
                    }
                    echo("product-card".$extra_class);
                
                ?>">
                    <div><?= $product['category']?></div>
                    <div><?= $product['name']?></div>
                    <div><?= $product['price']?></div>
                    <img width="200" height="200"/>
                    <?php
                        require "button.php"
                    ?>
                    <!-- link to product detail page, with .php end -->
                </div>
           <?php  }?>
            </div>

        

        
    </body>
</html>