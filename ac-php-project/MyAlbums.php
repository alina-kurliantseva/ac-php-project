<?php
    include("includes/header.php");
    if (!$session->is_signed_in()) {
        redirect("LogIn.php");
    }

    $all_album = Album::find_by_owner_id($session->user_id);
        
    if (isset($_POST["btnUpload"])) {
        foreach ($_POST as $key => $value) {
            $album = Album::find_album_by_id($key, $session->user_id);
            if ($album !== false) {
                $album->update_accessibility_code($value);
            }
        }
    }
    
    if(isset($_POST['btnDelete']))
    { 
        $foundAlbum = Album::find_by_id($_POST['btnDelete']);
        if($foundAlbum !== false)
        {
            $foundAlbum->deleteAlbum();
        }
    }    
?>

<div class="container text-center">
<h2 class="my-5">My Albums</h2>
<p class="mb-5">Welcome, <?php echo User::find_by_id($session->user_id)->name; ?>!</p>
<p class="mb-5"><a href="AddAlbum.php">Create New Album</a></p>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post"  enctype="multipart/form-data">
        <table class="table table-hover text-left mb-5">
            <thead>            
                <tr>
                    <th>Title </th>
                    <th>Date updated</th>
                    <th>Number of Pictures </th>
                    <th>Accessibility</th>
                    <th></th>
                </tr>
            </thead>
            <tbody> 
            <?php
                $albums = Album::find_by_owner_id($session->user_id);
                if($albums != null){
                    foreach ($albums as $album):
                        $albumId = $album->album_id;
            ?>               
                        <tr>
                            <td><a href="MyPictures.php?albumId=<?php echo $albumId; ?>"><?php echo $album->title; ?></a></td>
                            <td><?php echo $album->date_updated ?></td>
                            <td><?php echo Photo::get_all_photos($album->album_id); ?></td>
                            <td>
                                <select class="form-control" name="<?php echo $album->album_id; ?>" id="accessibility" value="<?php echo $album->album_id; ?>">
                                    <option  value="<?php echo $album->accessibility_code; ?>"><?php echo $album->accessibility_code; ?> </option>
                                    <option value="<?php
                                                            $selected = $album->accessibility_code;
                                                            $choies = (strcmp($selected, "private")) ? "private" : "shared";
                                                            echo $choies;
                                                    ?>">
                                                    <?php echo $choies; ?>
                                    </option>
                                </select>                                
                            </td>
                            <td>
                                <button type="submit" name="btnDelete" value="<?php echo $album->album_id; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to delete the selected album with all its pictures?')">Delete</button>
                            </td>
                        </tr>
            <?php
                    endforeach;
                }
            ?>               
            </tbody>
        </table>
        <p>
            <input type="submit" name="btnUpload" value="Save Changes" class="btn btn-success btn-lg" />
        </p> 
    </form> 
</div>
<script>
    function confirmDelete()
    {
        var yes = confirm('Are you sure you want to delete the selected album with all its pictures?');
        if (yes) document.getElementById("form_id").submit();
        else return false;
    }
</script>
<?php include("includes/footer.php");