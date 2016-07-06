<?php
class IPGeo {

	function get_user_country($ip)
	{//Возвращает двухбуквенный код страны посетителя
		$site_name = "teploceramic.pro";

		$x=file_get_contents('http://api.wipmania.com/'.$ip.'?'.$site_name);

		return $x;
	}


	function getRealIpAddr()
	{//Возвращает реальный IP клиента
	    if ( getenv ('REMOTE_ADDR')) {$user_ip = getenv ('REMOTE_ADDR');}
	    elseif ( getenv ('HTTP_FORWARDED_FOR')) {$user_ip = getenv ('HTTP_FORWARDED_FOR');} 
	    elseif ( getenv ('HTTP_X_FORWARDED_FOR')) {$user_ip = getenv ('HTTP_X_FORWARDED_FOR');} 
	    elseif ( getenv ('HTTP_X_COMING_FROM')) {$user_ip = getenv ('HTTP_X_COMING_FROM');} 
	    elseif ( getenv ('HTTP_VIA')) {$user_ip = getenv ('HTTP_VIA');} 
	    elseif ( getenv ('HTTP_XROXY_CONNECTION')) {$user_ip = getenv ('HTTP_XROXY_CONNECTION');} 
	    elseif ( getenv ('HTTP_CLIENT_IP')) {$user_ip = getenv ('HTTP_CLIENT_IP');} 
	    else {$user_ip='unknown';}
	    if (15 < strlen ($user_ip)){
	        $ar = split (', ', $user_ip);
	        for ($i= sizeof ($ar)-1; $i> 0; $i--){
	            if ($ar[$i]!='' and !preg_match ('/[a-zA-Zа-яА-Я]/', $ar[$i])){
	                $user_ip = $ar[$i]; 
	                break; 
	                }
	            if ($i== sizeof ($ar)-1){$user_ip = 'unknown';}
	         }
	        }
	    if ( preg_match ('/[a-zA-Zа-яА-Я]/', $user_ip)){$user_ip = 'unknown';}
	    return $user_ip;
	}
}

?>