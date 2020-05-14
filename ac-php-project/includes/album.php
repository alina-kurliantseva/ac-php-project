<?php
    class Album extends DB_object
    {
        protected static $db_table = "Album";
        protected static $db_table_fields = array('album_id', 'title', 'description', 'date_updated', 'owner_id', 'accessibility_code');
        public $album_id; //db autoincrement
        public $title;
        public $description;
        public $date_updated;
        public $owner_id;
        public $accessibility_code; 
        public function deleteAlbum()
        {
            global $database; 
            $sql = "DELETE FROM ".self::$db_table;
            $sql .= " WHERE album_id = '".$this->album_id."'";
            $sql .= " LIMIT 1";
            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false; 
        }        
        public static function find_by_id($id) {
            $sql = "SELECT * FROM  " . static::$db_table . "  WHERE album_id = '$id' LIMIT 1";
            $the_result_array = static::find_by_query($sql);
            return !empty($the_result_array) ? array_shift($the_result_array) : false;
        }
        public static function find_shared_albums($friend_id) {
            global $database;          
            $sql = "SELECT * FROM  " . self::$db_table . "  WHERE ";
            $sql .= "accessibility_code = 'shared'";
            $sql .= " AND owner_id = '{$friend_id}'";
            $shared_albums = self::find_by_query($sql);           
            return count((array)$shared_albums);          
        }
         public static function find_by_owner_id($id) {
            $the_result_array = static::find_by_query("SELECT * FROM  " . static::$db_table . "  WHERE owner_id = '$id'");
            return !empty($the_result_array) ? ($the_result_array) : false;
        }
        public static function find_album_by_id($id, $owner_id) {
            $sql = "SELECT * FROM  " . static::$db_table . "  WHERE album_id = '$id' AND owner_id = '$owner_id' LIMIT 1";
            $the_result_array = static::find_by_query($sql);
            return !empty($the_result_array) ? array_shift($the_result_array) : false;
        }
        public function update() {
            global $database;
            $properties = $this->clean_properties();
            $properties_pairs = array();
            foreach ($properties as $key => $value) {
                $properties_pairs[] = "{$key}='{$value}'";
            }
            $sql = "UPDATE " . static::$db_table . " SET ";
            $sql .= implode(", ", $properties_pairs);   
            $sql .= " WHERE album_id= '" . $database->escape_string($this->album_id) . "'";
            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false; 
        }
        public function update_accessibility_code($changeStatus)
        {
            global $database;
            $sql = "UPDATE ".static::$db_table;
            $sql .= " SET accessibility_code = '$changeStatus'";
            $sql .= " WHERE album_id = '".$this->album_id."'";    
            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false; 
        }
        public static function find_shared_album($id) {
            $the_result_array = static::find_by_query("SELECT * FROM  " . static::$db_table . "  WHERE owner_id = '$id' AND accessibility_code = 'shared'");
            return !empty($the_result_array) ? ($the_result_array) : false;
        }        
    }