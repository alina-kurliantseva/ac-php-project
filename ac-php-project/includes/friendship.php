<?php
    class Friendship extends DB_object {
        protected static $db_table = "Friendship";
        protected static $db_table_fields = array('friend_requester_id', 'friend_requestee_id', 'status');
        public $friend_requester_id;
        public $friend_requestee_id;
        public $status;
        public static function verify_friendship($friend_requester_id, $friend_requestee_id, $status) {
            global $database;
            $friend_requester_id = $database->escape_string($friend_requester_id);
            $friend_requestee_id = $database->escape_string($friend_requestee_id);
            $sql = "SELECT * FROM  " . self::$db_table . "  WHERE ";
            $sql .= "friend_requester_id = '{$friend_requester_id}'";
            $sql .= "AND friend_requestee_id = '{$friend_requestee_id}'";
            $sql .= "AND status = '{$status}'";
            $sql .= "LIMIT 1";
            $the_result_array = self::find_by_query($sql);
            return !empty($the_result_array) ? true : false;        
        }
        public static function change_friendship_status($friend_requester_id, $friend_requestee_id) {
            global $database;
            $friend_requester_id = $database->escape_string($friend_requester_id);
            $friend_requestee_id = $database->escape_string($friend_requestee_id);
            $sql = "UPDATE " . static::$db_table . " SET ";
            $sql .= "status = 'accepted'";
            $sql .= " WHERE friend_requester_id = '{$friend_requester_id}'";
            $sql .= " AND friend_requestee_id = '{$friend_requestee_id}'";
            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false;            
        }
        public static function make_request($friend_requester_id, $friend_requestee_id) {
            global $database;
            $friend_requester_id = $database->escape_string($friend_requester_id);
            $friend_requestee_id = $database->escape_string($friend_requestee_id);
            $sql = "INSERT INTO " . static::$db_table;
            $sql .= " (friend_requester_id, friend_requestee_id, status)";
            $sql .= " VALUES ('{$friend_requester_id}', '{$friend_requestee_id}', 'request')";
            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false;
        }
        public static function find_friends_ids($user_id) {
            global $database;          
            $sql = "SELECT friend_requester_id, friend_requestee_id FROM  " . self::$db_table . "  WHERE ";
            $sql .= "status = 'accepted'";
            $sql .= " AND (friend_requester_id = '{$user_id}'";
            $sql .= " OR friend_requestee_id = '{$user_id}')";  
            $ids = self::find_by_query($sql);
            $friends_ids = array();
            foreach($ids as $id) {
                $friends_ids[] = $id->friend_requester_id != $user_id ?  $id->friend_requester_id : $id->friend_requestee_id;
            }            
            return $friends_ids;
        }
        public static function find_friend_by_ids($requester_id, $requestee_id, $status = "accepted") {
            $sql = "SELECT * FROM Friendship "
                  . "WHERE friend_requester_id = '$requester_id' "
                  . "AND friend_requestee_id = '$requestee_id' "
                  . "AND status = '$status'";
            
            $result_array = self::find_by_query($sql);
            return !empty($result_array) ? array_shift($result_array) : false;
        }
        public function delete_friend($status = 'accepted')
        {
            global $database; 
            $sql = "DELETE FROM ".self::$db_table;
            $sql .= " WHERE friend_requester_id = '".$this->friend_requester_id."'";
            $sql .= " AND friend_requestee_id = '".$this->friend_requestee_id."'";
            $sql .= " AND status = '$status'";
            
            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false; 
        }
        public static function find_friends_request_ids($user_id) {
            global $database;          
            $sql = "SELECT friend_requester_id FROM  " . self::$db_table;
            $sql .= " WHERE status = 'request'";
            $sql .= " AND friend_requestee_id = '{$user_id}'";
            $ids = self::find_by_query($sql);
            $request_ids = array();
            foreach($ids as $id) {
                $request_ids[] = $id->friend_requester_id;
            }
            return $request_ids;
        }
        public function accept_friend()
        {
            global $database;
            $sql = "UPDATE " . static::$db_table . " SET ";
            $sql .= "status = 'accepted'";
            $sql .= " WHERE friend_requester_id = '".$this->friend_requester_id."'";
            $sql .= " AND friend_requestee_id = '".$this->friend_requestee_id."'";
            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false; 
        }        
    }