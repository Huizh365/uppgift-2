<?php
    require_once "includes/header.php";
    if(isset($_GET["like"])){
        $id = 1*$_GET["like"];

        if(!isset($_SESSION["likes"])){
            $_SESSION["likes"] = [];
        }
        $_SESSION["likes"][] = $id; 
    }

    if(isset($_GET["removeLike"])){
        $id = 1*$_GET["removeLike"];

        if(!isset($_SESSION["likes"])){
            $_SESSION["likes"] = [];
        }
        $new_likes = array_values(array_diff($_SESSION["likes"], [$id]));

        $_SESSION["likes"] = $new_likes;
    }
?>
Here is the body 
        <?php

            $database = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, "products");
            $sql="SELECT * FROM newsletters";
            $result = $database->query($sql);

            $newsletters = [];

            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()){
                    $newsletters[] = $row;
                }
            } else {
                echo "No newsletters found";
            }
            ?>
        
        <div style="display:flex">

        <?php 
            for ($i=0; $i<count($newsletters); $i++) {
                $newsletter = $newsletters[$i]
                ?> 
                <div>
                    <div><?= $newsletter['id']?></div>
                    <div><?= $newsletter['user_id']?></div>
                    <div><?= $newsletter['name']?></div>
                    <?php
                        require "includes/button.php"
                    ?>
                    <?php
                        if(in_array($newsletter["id"], $_SESSION["likes"])):
                            ?>
                        Liked <a href="?removeLike=<?= $newsletter["id"] ?>">Remove</a>
                            <?php
                        else:
                            ?>
                        <a href="?like=<?= $newsletter["id"] ?>">Like</a>
                            <?php
                        endif;
                    ?>
                    <form method="POST">
                        <inpput type="hidden" name="action" value="like" />
                        <inpput type="hidden" name="id" value="<?= $newsletter["id"] ?>" />
                        <button>Like</button>
                    </form>
                </div>
           <?php  }?>
            </div>
<?php
    require_once "includes/footer.php"
?>