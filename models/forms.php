<?php
require_once 'db.php';
require_once '../models/article.php';
require_once '../models/user.php';
require_once '../models/query.php';

$query = new query;
$nb = new article;
$us = new user;


if(isset($_POST['addguest']))
{
    $_Gname=htmlentities($_POST['prenom']);
    $_Glname=htmlentities($_POST['nom']);

    $query->insert('guest', 'name,lastname', $_Gname.','.$_Glname);

      header('location:../adm/adm.php');

}

if (isset($_POST['addanimals']))
{ 
    $name = htmlentities($_POST['name']);
    $link = htmlentities($_POST['link']);
    $query->insertd('animals', 'name,link', $name.','.$link);
    header('location:../adm/adm.php');
}

if (isset($_POST['addhouse']))
{ 
    $name = htmlentities($_POST['name']);
    $devise = htmlentities($_POST['devise']);
    $query->insertd('house', 'nom,devise', $name.','.$devise);
    header('location:../adm/adm.php');
}

if (isset($_POST['addlink']))
{ 
    $link = htmlentities($_POST['link']);
    $idhouse = htmlentities($_POST['idhouse']);
    $name = htmlentities($_POST['name']);
    $query->insertlink('link', 'link,id_house,nom', $link.','.$idhouse.','.$name);
    header('location:../adm/adm.php');
}
if (isset($_POST['addchoice']))
{ 
    $user = htmlentities($_POST['iduser']);
    $idhouse = htmlentities($_POST['idhouse']);
    $idlink = htmlentities($_POST['idlink']);
    $count=$query->selectWith('count', 'house', 'id',$idhouse);
   $query->update('guest', 'id_link ='.$idlink , 'id='.$user);
   $query->update('guest', 'id_house ='.$idhouse, 'id='.$user);
    $count[0]++;
    $query->update('house', 'count ='.$count[0] , 'id='.$idhouse);
    $query->update('link', 'available = 1' , 'id='.$idlink);
    
    header('location:../index.php');
}
if(isset($_GET['suppruser']))
{
    $id = $_GET['id'];
    $id2=$query->selectWith('id', 'guest', 'id_couple',$id);
    if($id2){
        $query->update('guest', 'id_couple= null' , 'id='.$id2[0]);
    }
   

    $query->delete('guest', $id);
    header('location:../adm/adm.php');
}

if(isset($_GET['supprlink']))
{
    $id = $_GET['id'];
    $links=$query->selectWith('id', 'guest', 'id_link',$id);
    if($link){
        foreach($link as $ids){
            $query->update('guest', 'id_link = null' , 'id='.$ids);
        }
    }
    $query->delete('link', $id);
    header('location:../adm/adm.php');
}
if(isset($_GET['suppranimaux']))
{
    $id = $_GET['id'];
    $animals=$query->selectWith('id', 'guest', 'id_animals',$id);
    if($animals){
        foreach($animals as $ids){
            $query->update('guest', 'id_animals = null' , 'id='.$ids);
        }
    }
    $query->delete('animals', $id);
    header('location:../adm/adm.php');
}

if(isset($_GET['supprhouse']))
{
    $id = $_GET['id'];
    $house=$query->selectWith('id', 'guest', 'id_house',$id);
    if($house){
        foreach($house as $ids){
            $query->update('guest', 'id_house = null' , 'id='.$ids);
        }
    }
    $query->delete('house', $id);
    header('location:../adm/adm.php');
}

if(isset($_POST['modifadmin'])){
    $A_mdp=sha1($_POST['Amdp']);
    $N_mdp=sha1($_POST['Nmdp']);
    $id=$_POST['id'];
    $mdp =$query->selectWith('mdp', 'adm', 'id ',$id);

    if($A_mdp == $mdp[0]){

        $query->updated('adm', $N_mdp , $id);
        header('location:../adm/adm.php');
    }
    else{
        echo "Mauvais mot de passe";
    }


}

