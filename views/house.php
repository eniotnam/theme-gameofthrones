<?php
require_once 'models/query.php';
$query = new query;


$house =$query->selectWith('*', 'house', 'id ',$_GET['id']);
if(!$house){
    header('location:index.php');
}
$links =$query->selectWithID('*', 'link', 'id_house = '.$_GET['id']);
?>

<head>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/house.css">


</head>



<div class="container">
	<a href="./" style="position: absolute;top:0;left: 0;padding:10px;"><i class="fa-arrow-left">retour</i></a>
    <div class="row justify-content-center py-5 p-lg-5">
        <div class="col-3 text-left banner"><img src="img/banner/<?php echo strtolower($house['nom'])?>.png" alt=""></div>
        <div class="col-6 text-center title">
            <img  src="img/symbol/<?php echo strtolower($house['nom']);?>.png" alt="">
            <h2>" <?php echo $house['devise']; ?>"</h2>
            <img class="castle" src="img/castles/<?php echo strtolower($house['nom']);?>.png" alt="">
        </div>
        <div class="col-3 text-right banner"><img src="img/banner/<?php echo strtolower($house['nom'])?>.png" alt=""></div>
    </div>

    <div class="row justify-content-center ">
        <div class="col-12  d-flex flex-wrap list py-5" >
<?php foreach($links as $link){
    $name = explode(' ',$link['nom']);
            ?>
            <div class="col-lg-4 col-12 d-flex justify-content-center my-2 deguise" >
                <div class="col-10 d-flex flex-wrap justify-content-center">
                  <div class="col-10 text-center">
                   <h3><?php echo $link['nom']; ?></h3>
                   </div>
                   <div class="col-12">
                       <img width="100%" src="img/deguisement/<?php echo $name[1] ?>.png" alt="<?php echo $name[1] ?>">
                   </div>
                    <a class="col-6 text-center "href="<?php echo $link['link']?>"> VOIR</a>
                    <a class="col-6 text-center "href="connection.php?id_house=<?php echo $_GET['id'];?>&id_link=<?php echo $link['id'] ?>">CHOISIR</a>
                </div>
            </div>
           
            <?php } ?>
        </div>
    </div>
</div>




<script src="js/functions.js"></script>

    