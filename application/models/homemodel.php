<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class homemodel extends CI_Model{
    public function inserttwitterdata()
    {
        
        $displayname=$this->input->post('displayname');
        $token=$this->input->post('userid');
        $firstname=$this->input->post('firstname');
        $lastname=$this->input->post('lastname');
        $profilepic=$this->input->post('image');
       $query = mysql_query("SELECT * FROM buyer WHERE twitter_token = '$token' ") or die(mysql_error());
        $result = mysql_fetch_array($query);
        if (!empty($result)) {
         return 2;
        } 
        else {
        $this->db->query("insert into buyer values('','".$firstname."','".$lastname."','".$displayname."','','','','".$profilepic."','','','','','','','',
            '".$token."','','','','','')");
        $id=$this->db->insert_id();
        return $id;
        }
    }
    public function Validateadmin($username,$password)
    {
        $result = $this->db->query("select * from  admin where emailid='".$username."' and password='".$password."'");
       if($result->num_rows > 0)
        {
            return $result->row();
        }
        else{
            return 0;
        }
    }
}
?>
