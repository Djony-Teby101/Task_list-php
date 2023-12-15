<?php
require_once("config.db.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task-List</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="main-section">
        <div class="add-section">

            <form action="App/ajout.logic.php" method="POST" autocomplete="off">
                <?php if (isset($_GET["mess"]) && $_GET["mess"]=="error") { ?>
                    <input type="text" name="title" 
                    style="border-color: #ff6666;"
                    placeholder="Veuillez remplir le champs please ." 
                    required />
                    <button type="submit">Ajouter &nbsp;<span>&#43;</span>
                    </button>

                <?php } else { ?>
                    <input type="text" name="title" placeholder="inserer une tache à faire ." required>
                    <button type="submit">Ajouter &nbsp;<span>&#43;</span>
                    </button>
                <?php } ?>
            </form>
        </div>

        <?php
        $sql = "SELECT * FROM tasklist ORDER BY id DESC";
        $alltask = $conn->query($sql);
        ?>

        <div class="show-todo-section">
            <?php if ($alltask->rowCount() <= 0) { ?>
                <div class="todo-item">
                    <div class="empty">
                        <img src="image/cover.jpg" width="28%" /><br>
                        <img src="image/Ellipsis.gif" width="10%">
                    </div>
                </div>
            <?php } ?>
            <?php while ($item= $alltask->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">
                    <span id=<?= $item['id'] ?> class="remove-to-do">x</span>

                    <?php if ($item["checked"]) { ?>
                        <input type="checkbox" 
                        data-todo-id="<?= $item['id'] ?>"
                        class="check-box" checked />
                        <h2 class="checked"><?= $item["title"] ?></h2>

                    <?php } else { ?>
                        <input type="checkbox"  
                        data-todo-id="<?= $item['id'] ?>"
                        class="check-box" />
                        <h2><?= $item["title"] ?></h2>
                    <?php } ?>
                    <br>
                    <small>created:<?= $item["date_time"] ?></small>
                </div>
            <?php } ?>




        </div>



    </div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function(){ 
            $('.remove-to-do').click(function(){
                const id=$(this).attr('id');
                $.post("App/remove.logic.php",
                {
                    id:id
                },
                (data)=>{
                    if(data){
                        $(this).parent().hide(600);
                    }
                }
                )
            });

            $('.check-box').click(function(e){
                const id=$(this).attr('data-todo-id');
                $.post("App/check.logic.php",
                {
                    id:id
                },
                (data)=>{
                    if(data != "error"){
                        const h2=$(this).next();
                        if(data==='1'){
                            h2.removeClass('checked')
                        }else{
                            h2.addClass('checked')
                        }
                    }
                }
                )
            })
        })
    </script>
</body>

</html>