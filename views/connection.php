<?php
require_once 'models/query.php';
$query = new query;


if(!$_GET['id_house'] && !$_GET['id_link']){
    header('location:index.php');
}
$guests =$query->selectWithID('*', 'guest', 'id_link is null');
?>

<head>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/guest.css">
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js" integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9" crossorigin="anonymous"></script>


</head>



<div class="container "> 
    <div class="row justify-content-center align-items-center" >
      
         <div class="col-12"> <h3>Qui vas là ?</h3>
      
            <div class="col-12  d-flex list guestlist py-5" >
             
            <?php
            if(isset($erreurs))
            {
                echo '<font color="red">'. $erreurs.'</font>';
            }
            ?>
               
                <?php foreach($guests as $guest){
                ?>
                
                <div class="col-lg-3 col-6 d-flex flex-wrap justify-content-center m-2 guest" >
                   <form method="POST" action="models/forms.php"class="form col-12" style="text-align:center;margin:20px;">
                    <div class="col-12 d-flex flex-wrap justify-content-center">
                        <div class="col-12">
                                <img width="100%" src="img/guest/<?php echo $guest['name']."_".$guest['lastname'] ?>.png" alt="<?php echo $guest['name']."_".$guest['lastname'] ?>">
                            </div>
                        <div class="col-12 text-center">
                           
                            <h3><?php echo $guest['name']. "<br> " . $guest['lastname']; ?></h3>
                        </div>
 
                        <input type="hidden" class="col-6"  name="iduser"  value="<?php echo $guest['id'];?>" class="textbox" >
                        <input type="hidden" class="col-6"  name="idhouse"  value="<?php echo $_GET['id_house'];?>" class="textbox" >
                        <input type="hidden" class="col-6"  name="idlink"  value="<?php echo $_GET['id_link'];?>" class="textbox" >
                    </div>
                    <input type="submit"  class="  col-12  addbut" name="addchoice" value="Décliner mon identé" >    
                     </form>
                </div>
               
                <?php } ?>
                
            </div>
        </div>
    </div>
</div>






<script src="js/functions.js"></script>

