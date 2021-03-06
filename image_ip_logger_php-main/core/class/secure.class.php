<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  index.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  DEVISION
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

class Secure {

	public function SecureTxt($String)  {
        $String = htmlspecialchars(trim($String), ENT_QUOTES);

    	$String = str_ireplace('&amp;#34;', '"', $String);
        $String = str_ireplace('&amp;#39;', "'", $String);

        return $String;
    }

	public function LimitText($text, $chars_limit) {
		// Check if length is larger than the character limit
		if (strlen($text) > $chars_limit) {
			// If so, cut the string at the character limit
			$new_text = substr($text, 0, $chars_limit);
			// Trim off white space
			$new_text = trim($new_text);
			// Add at end of text ...
			return $new_text . "...";
		} else {
			return $text;
		}
	}
	// Valid email
	public function isValidMail($email) {
	    if(filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
	        return true;
	    } else {
	        return false;
	    }
	}
	// Random Key ()
	public function RandKey($length = 32, $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890") {
		$chars_length = strlen( $chars ) - 1;
	    $string = $chars[rand( 0, $chars_length )];
	    $i = 1;
	    while ( $i < $length ) {
	        $r = $chars[rand( 0, $chars_length )];
	        if ( $r != $string[$i - 1] ) {
	            $string .= $r;
	        }
	        $i = strlen( $string );
	    }

	    return $string;
	}
	// Random key Link
	public function randKeyForLink($length=30, $chars = "abcdefghijklmnopqrstuvwxyz1234567890") {
		$chars_length = strlen( $chars ) - 1;
	    $string = $chars[rand( 0, $chars_length )];
	    $i = 1;
	    while ( $i < $length ) {
	        $r = $chars[rand( 0, $chars_length )];
	        if ( $r != $string[$i - 1] ) {
	            $string .= $r;
	        }
	        $i = strlen( $string );
	    }

	    return $string;
	}

	public function timeDiff($firstTime, $lastTime) {
		// convert to unix timestamps
		$firstTime = strtotime($firstTime);
		$lastTime = strtotime($lastTime);

		// perform subtraction to get the difference (in seconds) between times
		$timeDiff = ($lastTime - $firstTime);

		// return the difference
		return $timeDiff;
	}
	/* 24h to Array */
	public function get_hours_range( $start = 0, $end = 86400, $step = 3600, $format = 'H:ia' ) {
		$times = array();
		foreach ( range( $start, $end, $step ) as $timestamp ) {
			$hour_mins = gmdate( 'H:i', $timestamp );
			if ( ! empty( $format ) )
				$times[$hour_mins] = gmdate( $format, $timestamp );
			else $times[$hour_mins] = $hour_mins;
		}
		return $times;
	}
	/**
	 * [GetNexMonth]
	 * @param 	$Day   [1]
	 * @param 	$Month [1]
	 * @return 	11/11/2020 (example)
	 */
	public function GetNexMonth($Day=0, $Month=0) {
		$NextMonth = mktime(date('H'), date('i'), date('s'), date('n') + $Month, date('j') + $Day, date('Y'));

		return date('d/m/Y', $NextMonth);
	}

	public function GetPostoNum($tr_num=0, $max_num=0) {
		if ($tr_num == 0||$max_num == 0) {
			$VratiMi = '0';
		} else {
			$VratiMi = round((($tr_num / $max_num) * 100), 2);
		}

		return $VratiMi;
	}
	/* Get User IP */
	public function getUserIP() {
	    $ipaddress = '';
	    if (isset($_SERVER['HTTP_CLIENT_IP']))
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
	        $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
	    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if(isset($_SERVER['REMOTE_ADDR']))
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}
	/* Load Image */
	public function loadImageJPG($Image) {
		/* Attempt to open */
		$i = @imagecreatefromjpeg($Image);

		/* See if it failed */
		if(!$i){
		    /* Create a black image */
		    $i  = imagecreatetruecolor(150, 30);
		    $bgc = imagecolorallocate($i, 255, 255, 255);
		    $tc  = imagecolorallocate($i, 0, 0, 0);

		    imagefilledrectangle($i, 0, 0, 150, 30, $bgc);
		    /* Output an error message */
		    imagestring($i, 1, 5, 5, 'BreakLine. /K/', $tc);
		}
		return $i;
	}
	/* Get OS */
	public function getUserOS() {
	    global $user_agent;

	    $os_platform  				= "Unknown OS Platform";

	    $os_array    			 	= array(
			'/windows nt 10/i'      =>  'Windows 10',
			'/windows nt 6.3/i'     =>  'Windows 8.1',
			'/windows nt 6.2/i'     =>  'Windows 8',
			'/windows nt 6.1/i'     =>  'Windows 7',
			'/windows nt 6.0/i'     =>  'Windows Vista',
			'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
			'/windows nt 5.1/i'     =>  'Windows XP',
			'/windows xp/i'         =>  'Windows XP',
			'/windows nt 5.0/i'     =>  'Windows 2000',
			'/windows me/i'         =>  'Windows ME',
			'/win98/i'              =>  'Windows 98',
			'/win95/i'              =>  'Windows 95',
			'/win16/i'              =>  'Windows 3.11',
			'/macintosh|mac os x/i' =>  'Mac OS X',
			'/mac_powerpc/i'        =>  'Mac OS 9',
			'/linux/i'              =>  'Linux',
			'/ubuntu/i'             =>  'Ubuntu',
			'/iphone/i'             =>  'iPhone',
			'/ipod/i'               =>  'iPod',
			'/ipad/i'               =>  'iPad',
			'/android/i'            =>  'Android',
			'/blackberry/i'         =>  'BlackBerry',
			'/webos/i'              =>  'Mobile'
		);

	    foreach ($os_array as $regex => $value)
	        if (preg_match($regex, $user_agent))
	        	$os_platform = $value;
	    return $os_platform;
	}
	/* Get Browser */
	public function getUserBrowser() {
	    global $user_agent;

	    $browser        	= "Unknown Browser";
	    $browser_array 		= array(
			'/msie/i'      => 'Internet Explorer',
			'/firefox/i'   => 'Firefox',
			'/safari/i'    => 'Safari',
			'/chrome/i'    => 'Chrome',
			'/edge/i'      => 'Edge',
			'/opera/i'     => 'Opera',
			'/netscape/i'  => 'Netscape',
			'/maxthon/i'   => 'Maxthon',
			'/konqueror/i' => 'Konqueror',
			'/mobile/i'    => 'Handheld Browser'
		);

	    foreach ($browser_array as $regex => $value)
	        if (preg_match($regex, $user_agent))
	            $browser = $value;
	    return $browser;
	}
	/* Save Information in Database */
	public function saveUserInfo($userHost, $userOS, $userBrowser, $userAgent) {
		global $DataBase;

		$DataBase->Query("INSERT INTO `logger` (`id`, `userHost`, `userOS`, `userBrowser`, `userAgent`, `logDate`, `logDateF2`) VALUES (NULL, :userHost, :userOS, :userBrowser, :userAgent, :logDate, :logDateF2);");
		$DataBase->Bind(':userHost', $userHost);
		$DataBase->Bind(':userOS', $userOS);
		$DataBase->Bind(':userBrowser', $userBrowser);
		$DataBase->Bind(':userAgent', $userAgent);
		$DataBase->Bind(':logDate', date('d/m/Y, H:ia'));
		$DataBase->Bind(':logDateF2', time());

		return $DataBase->Execute();
	}
	/* Change Text */
	public function changeTxt($oText) {
		global $Secure;

		/* Mail template */
		$oText = str_ireplace('[*br*]', '<br>', $oText);

		/* General */
		$oText = str_ireplace('&amp;#34;', '"', $oText);
        $oText = str_ireplace('&amp;#39;', "'", $oText);


		// Latin
	    $oText = str_replace('??', 'A', $oText);
	    $oText = str_replace('??', 'A', $oText);
	    $oText = str_replace('??', 'A', $oText);
	    $oText = str_replace('??', 'A', $oText);
	    $oText = str_replace('??', 'A', $oText);
	    $oText = str_replace('??', 'A', $oText);
	    $oText = str_replace('??', 'AE', $oText);
	    $oText = str_replace('??', 'C', $oText);
	    $oText = str_replace('??', 'E', $oText);
	    $oText = str_replace('??', 'E', $oText);
	    $oText = str_replace('??', 'E', $oText);
	    $oText = str_replace('??', 'E', $oText);
	    $oText = str_replace('??', 'I', $oText);
	    $oText = str_replace('??', 'I', $oText);
	    $oText = str_replace('??', 'I', $oText);
	    $oText = str_replace('??', 'I', $oText);
	    $oText = str_replace('??', 'D', $oText);
	    $oText = str_replace('??', 'N', $oText);
	    $oText = str_replace('??', 'O', $oText);
	    $oText = str_replace('??', 'O', $oText);
	    $oText = str_replace('??', 'O', $oText);
	    $oText = str_replace('??', 'O', $oText);
	    $oText = str_replace('??', 'O', $oText);
	    $oText = str_replace('??', 'O', $oText);
	    $oText = str_replace('??', 'O', $oText);
	    $oText = str_replace('??', 'U', $oText);
	    $oText = str_replace('??', 'U', $oText);
	    $oText = str_replace('??', 'U', $oText);
	    $oText = str_replace('??', 'U', $oText);
	    $oText = str_replace('??', 'U', $oText);
	    $oText = str_replace('??', 'Y', $oText);
	    $oText = str_replace('??', 'TH', $oText);
	    $oText = str_replace('??', 'ss', $oText);
	    $oText = str_replace('??', 'a', $oText);
	    $oText = str_replace('??', 'a', $oText);
	    $oText = str_replace('??', 'a', $oText);
	    $oText = str_replace('??', 'a', $oText);
	    $oText = str_replace('??', 'a', $oText);
	    $oText = str_replace('??', 'a', $oText);
	    $oText = str_replace('??', 'ae', $oText);
	    $oText = str_replace('??', 'c', $oText);
	    $oText = str_replace('??', 'e', $oText);
	    $oText = str_replace('??', 'e', $oText);
	    $oText = str_replace('??', 'e', $oText);
	    $oText = str_replace('??', 'e', $oText);
	    $oText = str_replace('??', 'i', $oText);
	    $oText = str_replace('??', 'i', $oText);
	    $oText = str_replace('??', 'i', $oText);
	    $oText = str_replace('??', 'i', $oText);
	    $oText = str_replace('??', 'd', $oText);
	    $oText = str_replace('??', 'n', $oText);
	    $oText = str_replace('??', 'o', $oText);
	    $oText = str_replace('??', 'o', $oText);
	    $oText = str_replace('??', 'o', $oText);
	    $oText = str_replace('??', 'o', $oText);
	    $oText = str_replace('??', 'o', $oText);
	    $oText = str_replace('??', 'o', $oText);
	    $oText = str_replace('??', 'o', $oText);
	    $oText = str_replace('??', 'u', $oText);
	    $oText = str_replace('??', 'u', $oText);
	    $oText = str_replace('??', 'u', $oText);
	    $oText = str_replace('??', 'u', $oText);
	    $oText = str_replace('??', 'u', $oText);
	    $oText = str_replace('??', 'y', $oText);
	    $oText = str_replace('??', 'th', $oText);
	    $oText = str_replace('??', 'y', $oText);

	    // Symbols
	    $oText = str_replace('&copy;', '(c)', $oText);
	    $oText = str_replace('??', '(c)', $oText);

	    // Greek
	    $oText = str_replace('??', 'A', $oText);
	    $oText = str_replace('??', 'B', $oText);
	    $oText = str_replace('??', 'G', $oText);
	    $oText = str_replace('??', 'D', $oText);
	    $oText = str_replace('??', 'E', $oText);
	    $oText = str_replace('??', 'Z', $oText);
	    $oText = str_replace('??', 'H', $oText);
	    $oText = str_replace('??', '8', $oText);
	    $oText = str_replace('??', 'I', $oText);
	    $oText = str_replace('??', 'K', $oText);
	    $oText = str_replace('??', 'L', $oText);
	    $oText = str_replace('??', 'M', $oText);
	    $oText = str_replace('??', 'N', $oText);
	    $oText = str_replace('??', '3', $oText);
	    $oText = str_replace('??', 'O', $oText);
	    $oText = str_replace('??', 'P', $oText);
	    $oText = str_replace('??', 'R', $oText);
	    $oText = str_replace('??', 'S', $oText);
	    $oText = str_replace('??', 'T', $oText);
	    $oText = str_replace('??', 'Y', $oText);
	    $oText = str_replace('??', 'F', $oText);
	    $oText = str_replace('??', 'X', $oText);
	    $oText = str_replace('??', 'PS', $oText);
	    $oText = str_replace('??', 'W', $oText);
	    $oText = str_replace('??', 'A', $oText);
	    $oText = str_replace('??', 'E', $oText);
	    $oText = str_replace('??', 'I', $oText);
	    $oText = str_replace('??', 'O', $oText);
	    $oText = str_replace('??', 'Y', $oText);
	    $oText = str_replace('??', 'H', $oText);
	    $oText = str_replace('??', 'W', $oText);
	    $oText = str_replace('??', 'I', $oText);
	    $oText = str_replace('??', 'Y', $oText);
	    $oText = str_replace('??', 'a', $oText);
	    $oText = str_replace('??', 'b', $oText);
	    $oText = str_replace('??', 'g', $oText);
	    $oText = str_replace('??', 'd', $oText);
	    $oText = str_replace('??', 'e', $oText);
	    $oText = str_replace('??', 'z', $oText);
	    $oText = str_replace('??', 'h', $oText);
	    $oText = str_replace('??', '8', $oText);
	    $oText = str_replace('??', 'i', $oText);
	    $oText = str_replace('??', 'k', $oText);
	    $oText = str_replace('??', 'l', $oText);
	    $oText = str_replace('??', 'm', $oText);
	    $oText = str_replace('??', 'n', $oText);
	    $oText = str_replace('??', '3', $oText);
	    $oText = str_replace('??', 'o', $oText);
	    $oText = str_replace('??', 'p', $oText);
	    $oText = str_replace('??', 'r', $oText);
	    $oText = str_replace('??', 's', $oText);
	    $oText = str_replace('??', 't', $oText);
	    $oText = str_replace('??', 'y', $oText);
	    $oText = str_replace('??', 'f', $oText);
	    $oText = str_replace('??', 'x', $oText);
	    $oText = str_replace('??', 'ps', $oText);
	    $oText = str_replace('??', 'w', $oText);
	    $oText = str_replace('??', 'a', $oText);
	    $oText = str_replace('??', 'e', $oText);
	    $oText = str_replace('??', 'i', $oText);
	    $oText = str_replace('??', 'o', $oText);
	    $oText = str_replace('??', 'y', $oText);
	    $oText = str_replace('??', 'h', $oText);
	    $oText = str_replace('??', 'w', $oText);
	    $oText = str_replace('??', 's', $oText);
	    $oText = str_replace('??', 'i', $oText);
	    $oText = str_replace('??', 'y', $oText);
	    $oText = str_replace('??', 'y', $oText);
	    $oText = str_replace('??', 'i', $oText);

	    // Turkish
	    $oText = str_replace('??', 'S', $oText);
	    $oText = str_replace('??', 'I', $oText);
	    $oText = str_replace('??', 'C', $oText);
	    $oText = str_replace('??', 'U', $oText);
	    $oText = str_replace('??', 'O', $oText);
	    $oText = str_replace('??', 'G', $oText);
	    $oText = str_replace('??', 's', $oText);
	    $oText = str_replace('??', 'i', $oText);
	    $oText = str_replace('??', 'c', $oText);
	    $oText = str_replace('??', 'u', $oText);
	    $oText = str_replace('??', 'o', $oText);
	    $oText = str_replace('??', 'g', $oText);

	    // Russian
	    $oText = str_replace('??', 'A', $oText);
	    $oText = str_replace('??', 'B', $oText);
	    $oText = str_replace('??', 'V', $oText);
	    $oText = str_replace('??', 'G', $oText);
	    $oText = str_replace('??', 'D', $oText);
	    $oText = str_replace('??', 'E', $oText);
	    $oText = str_replace('??', 'Yo', $oText);
	    $oText = str_replace('??', 'Zh', $oText);
	    $oText = str_replace('??', 'Z', $oText);
	    $oText = str_replace('??', 'I', $oText);
	    $oText = str_replace('??', 'J', $oText);
	    $oText = str_replace('??', 'K', $oText);
	    $oText = str_replace('??', 'L', $oText);
	    $oText = str_replace('??', 'M', $oText);
	    $oText = str_replace('??', 'N', $oText);
	    $oText = str_replace('??', 'O', $oText);
	    $oText = str_replace('??', 'P', $oText);
	    $oText = str_replace('??', 'R', $oText);
	    $oText = str_replace('??', 'S', $oText);
	    $oText = str_replace('??', 'T', $oText);
	    $oText = str_replace('??', 'U', $oText);
	    $oText = str_replace('??', 'F', $oText);
	    $oText = str_replace('??', 'H', $oText);
	    $oText = str_replace('??', 'C', $oText);
	    $oText = str_replace('??', 'Ch', $oText);
	    $oText = str_replace('??', 'Sh', $oText);
	    $oText = str_replace('??', 'Sh', $oText);
	    $oText = str_replace('??', '', $oText);
	    $oText = str_replace('??', 'Y', $oText);
	    $oText = str_replace('??', '', $oText);
	    $oText = str_replace('??', 'E', $oText);
	    $oText = str_replace('??', 'Yu', $oText);
	    $oText = str_replace('??', 'Ya', $oText);
	    $oText = str_replace('??', 'a', $oText);
	    $oText = str_replace('??', 'b', $oText);
	    $oText = str_replace('??', 'v', $oText);
	    $oText = str_replace('??', 'g', $oText);
	    $oText = str_replace('??', 'd', $oText);
	    $oText = str_replace('??', 'e', $oText);
	    $oText = str_replace('??', 'yo', $oText);
	    $oText = str_replace('??', 'zh', $oText);
	    $oText = str_replace('??', 'z', $oText);
	    $oText = str_replace('??', 'i', $oText);
	    $oText = str_replace('??', 'j', $oText);
	    $oText = str_replace('??', 'k', $oText);
	    $oText = str_replace('??', 'l', $oText);
	    $oText = str_replace('??', 'm', $oText);
	    $oText = str_replace('??', 'n', $oText);
	    $oText = str_replace('??', 'o', $oText);
	    $oText = str_replace('??', 'p', $oText);
	    $oText = str_replace('??', 'r', $oText);
	    $oText = str_replace('??', 's', $oText);
	    $oText = str_replace('??', 't', $oText);
	    $oText = str_replace('??', 'u', $oText);
	    $oText = str_replace('??', 'f', $oText);
	    $oText = str_replace('??', 'h', $oText);
	    $oText = str_replace('??', 'c', $oText);
	    $oText = str_replace('??', 'ch', $oText);
	    $oText = str_replace('??', 'sh', $oText);
	    $oText = str_replace('??', 'sh', $oText);
	    $oText = str_replace('??', '', $oText);
	    $oText = str_replace('??', 'y', $oText);
	    $oText = str_replace('??', '', $oText);
	    $oText = str_replace('??', 'e', $oText);
	    $oText = str_replace('??', 'yu', $oText);
	    $oText = str_replace('??', 'ya', $oText);

	    // Ukrainian
	    $oText = str_replace('??', 'Ye', $oText);
	    $oText = str_replace('??', 'I', $oText);
	    $oText = str_replace('??', 'Yi', $oText);
	    $oText = str_replace('??', 'G', $oText);
	    $oText = str_replace('??', 'ye', $oText);
	    $oText = str_replace('??', 'i', $oText);
	    $oText = str_replace('??', 'yi', $oText);
	    $oText = str_replace('??', 'g', $oText);

	    // Czech
	    $oText = str_replace('??', 'C', $oText);
	    $oText = str_replace('??', 'D', $oText);
	    $oText = str_replace('??', 'E', $oText);
	    $oText = str_replace('??', 'N', $oText);
	    $oText = str_replace('??', 'R', $oText);
	    $oText = str_replace('??', 'S', $oText);
	    $oText = str_replace('??', 'T', $oText);
	    $oText = str_replace('??', 'U', $oText);
	    $oText = str_replace('??', 'Z', $oText);
	    $oText = str_replace('??', 'c', $oText);
	    $oText = str_replace('??', 'd', $oText);
	    $oText = str_replace('??', 'e', $oText);
	    $oText = str_replace('??', 'n', $oText);
	    $oText = str_replace('??', 'r', $oText);
	    $oText = str_replace('??', 's', $oText);
	    $oText = str_replace('??', 't', $oText);
	    $oText = str_replace('??', 'u', $oText);
	    $oText = str_replace('??', 'z', $oText);

	    // Polish
	    $oText = str_replace('??', 'A', $oText);
	    $oText = str_replace('??', 'C', $oText);
	    $oText = str_replace('??', 'e', $oText);
	    $oText = str_replace('??', 'L', $oText);
	    $oText = str_replace('??', 'N', $oText);
	    $oText = str_replace('??', 'o', $oText);
	    $oText = str_replace('??', 'S', $oText);
	    $oText = str_replace('??', 'Z', $oText);
	    $oText = str_replace('??', 'Z', $oText);
	    $oText = str_replace('??', 'a', $oText);
	    $oText = str_replace('??', 'c', $oText);
	    $oText = str_replace('??', 'e', $oText);
	    $oText = str_replace('??', 'l', $oText);
	    $oText = str_replace('??', 'n', $oText);
	    $oText = str_replace('??', 'o', $oText);
	    $oText = str_replace('??', 's', $oText);
	    $oText = str_replace('??', 'z', $oText);
	    $oText = str_replace('??', 'z', $oText);

	    // Latvian
	    $oText = str_replace('??', 'A', $oText);
	    $oText = str_replace('??', 'C', $oText);
	    $oText = str_replace('??', 'E', $oText);
	    $oText = str_replace('??', 'G', $oText);
	    $oText = str_replace('??', 'i', $oText);
	    $oText = str_replace('??', 'k', $oText);
	    $oText = str_replace('??', 'L', $oText);
	    $oText = str_replace('??', 'N', $oText);
	    $oText = str_replace('??', 'S', $oText);
	    $oText = str_replace('??', 'u', $oText);
	    $oText = str_replace('??', 'Z', $oText);
	    $oText = str_replace('??', 'a', $oText);
	    $oText = str_replace('??', 'c', $oText);
	    $oText = str_replace('??', 'e', $oText);
	    $oText = str_replace('??', 'g', $oText);
	    $oText = str_replace('??', 'i', $oText);
	    $oText = str_replace('??', 'k', $oText);
	    $oText = str_replace('??', 'l', $oText);
	    $oText = str_replace('??', 'n', $oText);
	    $oText = str_replace('??', 's', $oText);
	    $oText = str_replace('??', 'u', $oText);
	    $oText = str_replace('??', 'z', $oText);

	    $oText = htmlspecialchars_decode($oText);

	    return $oText;
	}

}