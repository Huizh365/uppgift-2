<?php
    require_once "header.php";

    if(isset($_GET["like"])){
        $id = 1*$_GET["like"];

        if(!isset($_SESSION["likes"])){
            $_SESSION["likes"] = [];
        }
        $_SESSION["likes"][] = $id; //push an item to a array
    }

    if(isset($_GET["removeLike"])){
        $id = 1*$_GET["removeLike"];

        if(!isset($_SESSION["likes"])){
            $_SESSION["likes"] = [];
        }
        $new_likes = array_values(array_diff($_SESSION["likes"], [$id]));
        //array_values: get the values of the array, skip showing all the keys
        //array_diff: remove items with a certain value from an array

        $_SESSION["likes"] = $new_likes;
    }
?>
Here is the body 
        <?php

            $database = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, "products");
            $sql="SELECT * FROM products";
            $result = $database->query($sql);

            $products = [];

            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()){
                    $products[] = $row;
                }
            } else {
                echo "No products found";
            }

            function fsu24d_say_hello($greeting="Hello") {
                if(isset($_POST["name"])) {
                    $name = $_POST["name"];     
                    $_SESSION["name"]=$name;           
                } else {
                    if(isset($_SESSION["name"])){
                        $name=$_SESSION["name"];
                    } else {
                        $name = "stranger";
                    }
                }
                echo($greeting. " " . $name . "!");
            }

            if($_SERVER["REQUEST_METHOD"] === "POST" || isset($_SESSION["name"])) {
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
                    <!-- button: link to product detail page, with .php end -->

                    <!-- if in_array: show like button / Liked text -->
                    <?php
                        if(in_array($product["id"], $_SESSION["likes"])):
                            ?>
                        Liked <a href="?removeLike=<?= $product["id"] ?>">Remove</a>
                            <?php
                        else:
                            ?>
                        <a href="?like=<?= $product["id"] ?>">Like</a>
                            <?php
                        endif;
                    ?>
                    <form method="POST">
                        <inpput type="hidden" name="action" value="like" />
                        <inpput type="hidden" name="id" value="<?= $product["id"] ?>" />
                        <button>Like</button>
                    </form>
                </div>
           <?php  }?>
            </div>
<?php
    require_once "footer.php"
?>