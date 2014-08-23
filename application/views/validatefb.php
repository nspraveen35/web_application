<?php
ob_start();
require 'facebook/facebook.php';

$facebook = new Facebook(array(
  'appId'  => APP_ID,
  'secret' => APP_SECRET,
));
$users = $facebook->getUser();

if ($users!="") {	
  try {

    $user_profile = $facebook->api('/me');
	$logoutUrl = $facebook->getLogoutUrl();
     
	$fuserid=$user_profile["id"];
	$fusername=$user_profile["username"];
        $firstname=$user_profile["first_name"];
        $lastname=$user_profile["last_name"];
        $displayname=$firstname.$lastname;
        $gender=$user_profile["gender"];
       // $email=$user_profile["email"];
        $imagestring="http://graph.facebook.com/$fuserid/picture?type=normal";
        $profile_pic=  file_get_contents($imagestring);
        $buyercity=$user_profile["location"];
        $newtoken=base64_encode($fuserid."::".$fusername);
         
        $tokenarr=explode("::",base64_decode($newtoken));
		$passcode=$tokenarr[0];
                
	
	// print_r($gender);
              $msql = $this->db->query("insert into buyer values('','".$firstname."','".$lastname."','".$displayname."','".$gender."','','','".$profile_pic."','','','','','','','".$passcode."','','','','','','')" );
               
               $id=$this->db->insert_id();
               echo 'welcome user';
          

  } catch (FacebookApiException $e) {
  
    $users = null;
  }
}
?>