<?php
    include("includes/header.php");
    if (!$session->is_signed_in()) {
        redirect("LogIn.php");
    }
    if(isset($_POST['btnSubmit']))
    { 
        $friendsSelected = $_POST['friendsSelected'];
        if(!empty($_POST['friendsSelected']))
        {
            foreach ($friendsSelected as $friendSelected) 
            {
                $user_id = $session->user_id;            
                $foundFriendship = Friendship::find_friend_by_ids($friendSelected, $user_id);
                if($foundFriendship !== false)
                {
                    $foundFriendship->delete_friend();
                }
                $foundFriendship2 = Friendship::find_friend_by_ids($user_id, $friendSelected);
                if($foundFriendship2 !== false)
                {
                    $foundFriendship2->delete_friend();
                }
            }            
        }
    }
    if(isset($_POST['btnAccept']))
    { 
        $requestsSelected = $_POST['requestsSelected'];
        if(!empty($_POST['requestsSelected']))
        {
            foreach ($requestsSelected as $requestSelected) 
            {           
                $friend_requester_ids = Friendship::find_friend_by_ids($requestSelected, $session->user_id, "request");
                if($friend_requester_ids !== false) {
                    $friend_requester_ids->accept_friend();
                }
            }
        }
    }
    if(isset($_POST['btnDecline']))
    { 
        $requestsSelected = $_POST['requestsSelected'];
        if(!empty($_POST['requestsSelected']))
        {
            foreach ($requestsSelected as $requestSelected) 
            {           
                $friend_requester_ids = Friendship::find_friend_by_ids($requestSelected, $session->user_id, "request");
                if($friend_requester_ids !== false) {
                    $friend_requester_ids->delete_friend("request");
                }
            }
        }
    }    
?>
<div class="container text-center">
    <h2 class="my-5">My Friends</h2>
    <p class="mb-5">Welcome, <?php echo User::find_by_id($session->user_id)->name; ?>!</p>
    <form class="mb-5" method="post" id="form_id" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return confirmDelete(this);">
        <div class="row">
            <p class="col-sm-6 text-lef">Friends:</p>
            <p class="col-sm-6 text-lef"><a href="AddFriend.php">Add Friends</a></p>
        </div>        
        <table class="table table-hover text-left mb-5">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Shared Albums</th>
                    <th>Delete Friend</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $friends_ids = Friendship::find_friends_ids($session->user_id);
                    foreach ($friends_ids as $friend_id):
                        $fr_id = User::find_by_id($friend_id);
                        $shared_albums = Album::find_shared_albums($friend_id);                       
                ?>
                <tr>
                    <td><?php echo $fr_id->name; ?></a></td>
                    <td><?php echo $shared_albums; ?></td>
                    <td><input type="checkbox" name="friendsSelected[]" value="<?php echo $fr_id->user_id; ?>"></td>
                </tr>                
                <?php 
                    endforeach;
                ?>                
            </tbody>
        </table>
        <p>
            <input type="submit" name="btnSubmit" value="Delete Friend" class="btn btn-success btn-lg" />
        </p>
    </form>
    <form class="mb-5" method="post" id="form_id" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="row">
            <p class="col-sm-6 text-lef">Friend Requests:</p>
        </div>
        <table class="table table-hover text-left mb-5">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Accept or Decline</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $friend_requester_ids = Friendship::find_friends_request_ids($session->user_id);
                    foreach ($friend_requester_ids as $friend_requester_id):
                        $friend_requester_name = User::find_by_id($friend_requester_id);                       
                ?>
                <tr>
                    <td><?php echo $friend_requester_name->name; ?></td>
                    <td><input type="checkbox" name="requestsSelected[]" value="<?php echo $friend_requester_name->user_id; ?>"></td>
                </tr>                
                <?php
                    endforeach;
                ?>                
            </tbody>
        </table>        
        <p>
            <input type="submit" name="btnAccept" value="Accept Friend Request" class="btn btn-success btn-lg" />&nbsp;&nbsp;
            <input type="submit" name="btnDecline" value="Decline Friend Request" class="btn btn-success btn-lg" onclick="return confirm('Are you sure you want to delete selected requests?')"/>
        </p>
    </form>    
</div>
<script>
    function confirmDelete()
    {
        var yes = confirm('Are you sure you want to delete selected friends?');
        if (yes) document.getElementById("form_id").submit();
        else return false;
    }    
</script>
<?php include("includes/footer.php");