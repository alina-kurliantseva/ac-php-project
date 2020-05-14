<?php
    include("includes/header.php");
    if (!$session->is_signed_in()) {
        redirect("LogIn.php");
    }
    extract($_POST);
    $friend_id = htmlspecialchars($student_id);
    $validation = TRUE;   
    if (isset($btnSubmit)) {
        $errorStudentID = ValidateFriendID($friend_id); 
        if((strlen(trim($errorStudentID)) != 0)) {
            $validation = FALSE; 
        } else {
            $successMessage = '<p>Your request has sent to ' . User::find_by_id($friend_id)->name . ' (ID: ' . $friend_id . ').</p>'
                            . '<p>Once ' . User::find_by_id($friend_id)->name . ' accepts your request, you and ' . User::find_by_id($friend_id)->name . ' will be friends and be able to view each other\'s shared albums.</p>';
        }
    }    
?>
<div class="container text-center">
    <h2 class="mt-5">Add Friend</h2><br />
    <p>Welcome, <?php echo User::find_by_id($session->user_id)->name; ?>!</p>
    <p class="my-5"><i>Enter the ID of the user you want to be friend with:</i></p> 
    <form class="mb-5" method="post" action="<?php echo $_SERVER['PHP_SEFL']; ?>">         
        <div class="form-group row">
            <label for="student_id" class="col-sm-3 col-form-label text-left">Student ID</label>
            <span class="col-sm-3 text-left">
                <input type="text" class="form-control" placeholder="AK26DEC1991" name="student_id" value="<?php echo htmlentities($student_id); ?>" />
            </span>               
            <span class="col-sm-5 text-left">
                <input type="submit" name="btnSubmit" value="Send Friend Request" class="btn btn-success" />
            </span>
        </div>
        <div class="text-danger text-center">
            <?php
                if (!$validation) {
                    echo $errorStudentID;
                }
                if ($validation) {
                    echo $successMessage;
                }
            ?>
        </div>
    </form>
</div>
<?php include("includes/footer.php");