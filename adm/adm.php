<?php

session_start();
if($_SESSION['connected'] == false){
    header('location:../index.php');
}
require_once '../models/article.php';
require_once '../models/user.php';

require_once '../models/query.php';


$query = new query;
$nb = new article;
$us = new user;
$pseudo = $_SESSION['pseudo'];
$adminf = $us->getAdmin($_SESSION['id']);



?>
<head>
    <title>Pannel Admin</title>

    <!--
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" type="text/css"  href="../css/adm.css">

</head>
<div class="container">
    <div class="row  justify-content-center">

        <nav id="navigation" class="col-10 col-lg-12 d-flex justify-content-center mb-4">
            <ul class="col-12 col-lg-10 list  ">

                <li id="first" class="col-2 col-lg-2">
                    <a href="javascript:void(0)" onclick="Showarticle();">Invités</a>
                </li>

                <li  class="col-2 col-lg-2">
                    <a href="javascript:void(0)" onclick="Showcategorie();">Maisons</a>
                </li>
                 <li  class="col-2 col-lg-2">
                    <a href="javascript:void(0)" onclick="Showlink();">Links</a>
                </li>
                <li  class="col-2 col-lg-2">
                    <a href="javascript:void(0)" onclick="Showhome();" >Home</a>
                </li>
                <li  class="col-2 col-lg-2">
                    <a href="javascript:void(0)" onclick="Showadm();"> <?php echo $_SESSION['pseudo'] ;?></a>
                </li>
                <li class="col-2 col-lg-2" >

                    <a href="../logout.php">Logout</a>
                </li>

            </ul>
        </nav>
    </div>
</div>
<div class="container-fluid ">
    <div class="row allarticle justify-content-around">

        <div class="col-10 col-lg-4  m-lg-2 case"><label class="col-sm-12 col-md-12" >INVITES</label>

            <h6><?php $query->Counterby('guest','id_house is not null');echo "/";$query->Counter('guest');?></h6>
            <div class="col-md-12 caser">
                <?php  
                $name=$query->selectWithID('*', 'guest', 'id_house is null');
                foreach($name as $invite) {
                ?>
                <div class="col-12 listing"> <p class="col-md-4">- <?php echo $invite['name']."<p class='col-6'>".$invite['lastname']."</p>";?><form action="../models/forms.php" class="col-md-1"> <input type="hidden" name="id" value="<?php echo $invite['id'];?>"><button class="col-12" type="submit" name="suppruser"><i class="fa fa-trash-o" ></i>
                    </button></form>
                </div>

                <?php }?>
            </div>
        </div>
        <div class="col-10 col-lg-4 m-lg-2 case"><label class="col-12 " >MAISONS</label> <h6><?php $query->Counterby('house','count < 5');echo "/";$query->Counter('house');?></h6>
            <div class="col-md-12 caser">
                <?php  
                $name=$query->selectWithID('*', 'house', 'count < 5');
                foreach($name as $invite) {
                    $link=$invite['devise'];

                ?>
                <div class="col-md-12 listing"> <p class="col-md-4">- <?php echo $invite['nom']."</p><p class='col-md-4'>".$link."</p><p class='col-md-2'>".$invite['count']."</p>";?><form action="../models/forms.php" class="col-md-2"> <input type="hidden" name="id" value="<?php echo $invite['id'];?>"><button class="col-md-12" type="submit" name="supprhouse"><i class="fa fa-trash-o" ></i>
                    </button></form>
                </div>
                <?php }?>
            </div>
        </div>
        <div class="col-10 col-lg-4 m-lg-2 case"><label class="col-12 " >LINKS</label> <h6><?php $query->Counterby('link','available is null');echo "/";$query->Counter('link');?></h6>
            <div class="col-md-12 caser">
                <?php  
                $name=$query->selectWithID('*', 'link', 'available is null');
                foreach($name as $invite) {
                   $link=$query->autolink($invite['link']);

                ?>
                <div class="col-md-12 listing"> <p class="col-md-4">- <?php echo $invite['nom']."</p><p class='col-md-6'>".$link."</p>";?><form action="../models/forms.php" class="col-md-2"> <input type="hidden" name="id" value="<?php echo $invite['id'];?>"><button class="col-md-12" type="submit" name="supprlink"><i class="fa fa-trash-o" ></i>
                    </button></form>
                </div>
                <?php }?>
            </div>
        </div>

    </div>

</div>
<div class="container listarticle" id="listarticle">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 justify-content-center"style="text-align:center;">
            <h2 style="margin:0; border-bottom:1px solid #cecece;">Inviter d'autres personnes</h2>
            <form method="POST" action="../models/forms.php" class="form " id="formart" style="text-align:center;margin:20px;">



                <?php
                if(isset($erreurs))
                {
                    echo '<font color="red">'. $erreurs.'</font>';
                }
                ?>
                <div class="col-12  " >
                    <input type="text" class=" col-3" name="prenom" placeholder="Prenom">
                    <input type="text" class=" col-3" name="nom" placeholder="Nom">

                </div>

                <input type="submit" style="margin:auto;margin-top:20px;" class=" col-2  add" name='addguest'id="add"  value="Ajouter" >

            </form>
        </div>
    </div>


</div>


<div class="container listcategorie" id="listcategorie">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 justify-content-center"  style="text-align:center;">
            <h2 style="margin:0; border-bottom:1px solid #cecece">Ajouter une Maison</h2>
            <form method="POST" action="../models/forms.php"class="form" style="text-align:center;margin:20px;">
                <?php
                if(isset($erreurs))
                {
                    echo '<font color="red">'. $erreurs.'</font>';
                }
                ?>

                <div class="col-12 " >

                    <input type="text" class="col-6"  name="name"  placeholder="Nom de la maison" class="textbox" required>
                    <input type="text" class="col-6"  name="devise"  placeholder="Devise" class="textbox" required>

                </div>
                <input type="submit"  class="  col-2  add" name="addhouse" value="Ajouter" >

            </form>
        </div>

    </div>
</div>
<div class="container " id="listadm">
    <div class="row justify-content-center"style="display:flex; margin-bottom:20px; margin-top:0;">
        <div class="col-12 col-lg-8 justify-content-center"  style="text-align:center;">
            <h2 style="margin:0; border-bottom:1px solid #cecece">Bienvenue sur ton profil <?php echo ucfirst($_SESSION['pseudo']);?></h2>
            <form method="POST" action="../models/forms.php" class="form" style="text-align:center;margin:20px;">

                <?php if(isset($erreurs))
{
    echo '<font color="red">'.$erreur.'</font>';
}
                ?>

                <div class="col-12 " >
                    <input type="password" autocomplete="off" class="col-6" name="Amdp"  placeholder="Ancien mdp" class="textbox">

                    <input type="password" autocomplete="off" class="col-6" name="Nmdp"  placeholder="Nouveau mdp" class="textbox">
                    <input name="id"  type="hidden" value="<?php echo $_SESSION['id']; ?>" class="textbox">

                </div>
                <input type="submit" style="margin-top:50px;" class="col-2 add" name="modifadmin" value="Modifier" >

            </form>
        </div>
    </div>
</div>
<div class="container " id="listlink">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 justify-content-center"style="text-align:center;">
            <h2 style="margin:0; border-bottom:1px solid #cecece;">Ajouter une tenue</h2>
            <form method="POST" action="../models/forms.php" class="form " style="text-align:center;margin:20px;">



                <?php
                if(isset($erreurs))
                {
                    echo '<font color="red">'. $erreurs.'</font>';
                }
                ?>
                <div class="col-12  " >
                    <input type="text" class=" col-3" name="name" placeholder="Nom">
                    <input type="text" class=" col-3" name="link" placeholder="Link">
                    <select name="idhouse" >
                       <option >- CHOIX DE LA MAISON -</option>
                        <?php 
                        $houses= $query->select('*','house');

                        foreach($houses as $house){


                        ?>
                        <option value="<?php echo $house['id'];?>"><?php echo $house['nom']; ?></option>
                        <?php } ?>
                    </select>

                </div>

                <input type="submit" style="margin:auto;margin-top:20px;" class=" col-2  add" name='addlink'  value="Ajouter" >

            </form>
        </div>
    </div>


</div>

<script type="text/javascript">


    $('#listarticle').hide();
    $('#listcategorie').hide();
    $('#listadm').hide();
    $('#listlink').hide();
    function hideall(){
        $('#listarticle').hide();
        $('#listcategorie').hide();
        $('.allarticle').hide();
        $('#listlink').hide();
        $('#listadm').hide();
    }
    function Showarticle(){
        hideall();
        $('#listarticle').show();

    }
    function Showhome(){
        hideall();
        $('.allarticle').show();

    }
    function Showcategorie(){
        hideall();
        $('#listcategorie').show();

    }
    function Showuser(){
        hideall();
        $('#listuser').show();

    }
    function Showadm(){
        hideall();
        $('#listadm').show();

    }
    function Showlink(){
        hideall();
        $('#listlink').show();

    }
</script>