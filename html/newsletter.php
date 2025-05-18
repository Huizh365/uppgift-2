<?php
    require_once "includes/header.php";
?>
    <?php
    
    echo($_GET["id"]);

    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $database = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, "products");

        $sql = "SELECT * FROM newsletters WHERE id = $id";
        $result = $database->query($sql);

        if($result->num_rows > 0) {
            $newsletter = $result->fetch_assoc();
            print_r($newsletter);
        } else {
            echo "No newsletter found";
        }

    } else {
        echo "No id provided";
    }
?>
<?php
    require_once "includes/footer.php"
?>