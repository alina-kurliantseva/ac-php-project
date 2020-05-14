<?php include("includes/header.php"); ?>
<?php
    if (!$session->is_signed_in()) {
        redirect("LogIn.php");
    } 
    extract($_POST);
    $albums = Album::find_by_owner_id($session->user_id);
    if(isset($_GET['albumId']))
    {
        $selected_album_id = $_GET['albumId'];
        $selectecAlbum = Album::find_album_by_id($selected_album_id, $session->user_id);
        $albumTitle = $selectecAlbum->title;
        $pictures = Photo::get_all_pictures($_GET["albumId"]);
        if (isset($_GET['pictureId'])) {
            $selectedPic = Photo::getPictureById($_GET['pictureId']);
            if($selectedPic !== false)
            {
                $_SESSION["selectedPicId"] = $selectedPic->picture_id;
            }
        }
    }
?>
<div class="container">
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
        <h2 class="my-5 text-center">My Pictures</h2>
        <div class="row">
            <?php 
                if(!is_null($pictures) && $pictures !== false):
                    foreach ($pictures as $pic) :
            ?>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                            <img class="img-fluid" src="<?php echo $pic->getAlbumFilePath()."?rnd=".rand(); ?>">
                        </div>
                <?php  
                    endforeach; 
                endif; ?>                                 
        </div>
    </form>
</div> 
<?php include("includes/footer.php"); ?>