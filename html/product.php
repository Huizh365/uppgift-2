<?php
    require_once "header.php";
?>
    here is main
    <div>
<?php
    
    echo($_GET["id"]);

    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $database = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, "products");

        $sql = "SELECT * FROM products WHERE id = $id";
        $result = $database->query($sql);

        if($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            print_r($product);
        } else {
            echo "No product found";
        }

    } else {
        echo "No id provided";
    }
?>
</div>
<?php
    require_once "footer.php"
?>