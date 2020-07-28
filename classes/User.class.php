<?php

Class User{
    public function login($username, $password)  {  
        $db = new DB();
        $link = $db->connect();

        $hashedPassword = $password;  
        $resultArray = $db->select("id, status", "customer", "username = '$username' And password = '$hashedPassword'");

        if (count($resultArray) == 1 && $resultArray[0]["status"] == "active") {
            $curDateTime = date('Y-m-d H:i:s');
            $data = array("datetime_loggedIn" => "'$curDateTime'");
            $db->update($data, "customer", "id = ".$resultArray[0]["id"]);
            $_SESSION["userid"] = $resultArray[0]["id"];
            $_SESSION["logged_in"] = true;
            return true;
        }
        else return false;
    }

    public function logout() {  
        session_unset();
        session_destroy();
    }

    public function isLoggedIn(){
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
    }

    public function usernameExists($username) {
        $db = new DB();
        $link = $db->connect();
        $result = $db->select("*", "customer", "username= '".$username."'");
        return count($result) != 0;
    }

    public function getPermission($pageName, $userId){
        $db = new DB();
        $page_id = $db->select("id", "pages", "name = '$pageName'");
        $role_id = $db->select("usergroup_id", "customer", "id = $userId");
        return $db->select(
            "`read`, `add`, `edit`, `delete`",
            "usergroups_pages",
            "usergroup_id = ".$role_id[0]['usergroup_id']." And page_id = ".$page_id[0]['id']);
    }

    public function getUserById($id){
        $db = new DB();
        return $db->select("*", "customer", "id = $id");
    }
}

?>