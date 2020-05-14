<?php
    include("includes/header.php");
    if (!$session->is_signed_in()) {
        redirect("LogIn.php");
    }
    date_default_timezone_set("America/New_York");	
    extract($_POST); 
    if(isset($btnUpload))
    {
        $newAlbum = new Album();
        $newAlbum->title = htmlspecialchars($title);
        $newAlbum->description = htmlspecialchars($description);
        $newAlbum->date_updated = date("Y-m-d h:i:sa");
        $newAlbum->owner_id = $session->user_id;
        $newAlbum->accessibility_code = $accessibility;
        $newAlbum->create();          
        redirect("MyAlbums.php");
    }
?>
<div class="container text-center">
    <h2 class="my-5">Create New Album</h2>
    <p class="mb-5">Welcome, <?php echo User::find_by_id($session->user_id)->name; ?>!</p><br />
    <form class="mb-5" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="title" class="col-sm-3 col-form-label text-left">Title</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="title" value="<?php echo $title ?>" required="required" />
            </div>
        </div>
        <div class="form-group row">
            <label for="accessibility" class="col-sm-3 col-form-label text-left">Accessibility</label>
            <div class="col-sm-5">
                <select class="form-control" name="accessibility" id="accessibility" onchange="" required="required">
                    <option value="">Select Accessibility</option>
                    <option value="private">Private</option>
                    <option value="shared">Shared</option>
                </select>
            </div>          
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-3 col-form-label text-left">Description</label>
            <div class="col-sm-5">
                <textarea type="textarea" class="form-control" maxlength="3000" name="description" value="" ><?php echo $description ?></textarea>
            </div>
        </div><br />
        <input type="submit" name="btnUpload" value="Submit" class="btn btn-lg btn-success"/>&nbsp;&nbsp;
        <input type="reset" name="btnReset" value="Clear" class="btn btn-lg btn-success"/>
   </form>        
</div>
<script type="text/javascript">
    document.getElementById('accessibility').value = "<?php echo $_GET['accessibility'];?>";
</script>
<?php include("includes/footer.php");