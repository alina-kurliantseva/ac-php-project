<?php
    session_start();    
    require_once("includes/header.php");
    $validation = TRUE;   
    if(isset($_POST['btnSubmit']))
    {
        extract($_POST);   
        $errorStudentID = ValidateStudentID($studentId);
        $errorStudentName = ValidateStudentName($studentName);
        $errorPhoneNumber = ValidatePhoneNumber($phoneNumber);
        $errorPassword = ValidatePassword($password);
        $errorPasswordAgain = ValidatePasswordAgain($passwordAgain, $password);
        if((strlen(trim($errorStudentID)) != 0) || (strlen(trim($errorStudentName)) != 0) || (strlen(trim($errorPhoneNumber)) != 0) ||
           (strlen(trim($errorPassword)) != 0) || (strlen(trim($errorPasswordAgain)) != 0)) {
            $validation = FALSE; 
        } elseif (isset($btnClear)) {
            $studentId = "";
            $studentName = "";
            $phoneNumber = "";
            $password = "";
            $passwordAgain = "";                             
        }
        if($validation) {            
            $newUser = new User();
            $newUser->user_id = htmlspecialchars($studentId); // we are doing this for all info that we need to display --> "htmlspecialchars"
            $newUser->name = htmlspecialchars($studentName);
            $newUser->phone = htmlspecialchars($phoneNumber);
            $newUser->password = sha1($password);
            $newUser->create();
            redirect("LogIn.php");
        }                              
    }
?>
<div class="container text-center">
    <h2 class="my-5">Sign Up</h2>
    <p class="mb-5"><i>All fields are required!</i></p>
    <form method="post" action="<?php echo $_SERVER['PHP_SEFL']; ?>">
        <div class="form-group row">
            <label for="studentId" class="col-sm-3 col-form-label text-left">Student ID</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder="AK26DEC1991" name="studentId" value="<?php echo $studentId; ?>" />
            </div>
            <div class="col-sm-4 text-danger text-left">
                <?php
                    if(!$validation)
                    {
                        echo $errorStudentID;
                    }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="studentName" class="col-sm-3 col-form-label text-left">Name</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder="Alina Kurliantseva" name="studentName" value="<?php echo $studentName; ?>" />
            </div>
            <div class="col-sm-4 text-danger text-left">               
                <?php
                    if(!$validation) {
                        echo $errorStudentName;
                    }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="phoneNumber" class="col-sm-3 col-form-label text-left">Phone Number (nnn-nnn-nnnn)</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder="613-700-4510" name="phoneNumber" value="<?php echo $phoneNumber; ?>" />
            </div>
            <div class="col-sm-4 text-danger text-left">
                <?php
                    if(!$validation) {
                        echo $errorPhoneNumber;
                    }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-3 col-form-label text-left">Password</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder="2505tY" name="password" value="<?php echo $password; ?>" />
            </div>
            <div class="col-sm-4 text-danger text-left">
                <?php
                    if(!$validation) {
                        echo $errorPassword;
                    }
                ?>
            </div>
        </div>
        <div class="form-group row mb-5">
            <label for="passwordAgain" class="col-sm-3 col-form-label text-left">Password Again</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder="2505tY" name="passwordAgain" value="<?php echo $passwordAgain; ?>" />
            </div>
            <div class="col-sm-4 text-danger text-left">
                <?php
                    if(!$validation) {
                        echo $errorPasswordAgain;
                    }
                ?>
            </div>
        </div>   
        <p>
            <input type="submit" name="btnSubmit" value="Submit" class="btn btn-success btn-lg" />&nbsp;&nbsp;
            <input type="submit" name="btnClear" value="Clear" class="btn btn-success btn-lg" />
        </p>
    </form>
</div>       
<?php require_once("includes/footer.php");