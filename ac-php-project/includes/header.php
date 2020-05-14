<?php
    ob_start();
    require_once("init.php");
?>
<!DOCTYPE html>
<html lang="en" style="position: relative; min-height: 100%;">
    <head>
        <title>Alina Kurliantseva | AC PHP Project</title>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="PHP, CSS, Bootstrap, Adobe Photoshop">
        <meta name="keywords" content="PHP, CSS, Bootstrap, Adobe Photoshop">
        <link rel="stylesheet" href="./includes/bootstrap.min.css"/>
    </head>
    
    <body style="padding-top: 50px; margin-bottom: 60px;">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
            <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-toggler-demo" aria-controls="navbar-toggler-demo" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbar-toggler-demo">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link" href="Index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="MyFriends.php">My Friends</a></li>
                        <li class="nav-item"><a class="nav-link" href="MyAlbums.php">My Albums</a></li>
                        <li class="nav-item"><a class="nav-link" href="UploadPictures.php">Upload Pictures</a></li>                       
                        <?php
                            if($session->is_signed_in()) {                        
                                echo "<li class=\"nav-item\"><a class=\"nav-link\" href='Logout.php'>Log Out</a></li>";
                            } else {
                                echo "<li class=\"nav-item\"><a class=\"nav-link\" href='Login.php'>Log In</a></li>";
                            }                    
                        ?>
                    </ul>
                </div>
            </div>  
        </nav>