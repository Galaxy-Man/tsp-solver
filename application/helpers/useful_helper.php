<?php
// ------------------------------------------------------------------------

/**
 * Most Used Helpers
 *
 * @author		Vishal Agarwal
 */
// ------------------------------------------------------------------------

/**
 * Create a Unique values of array
 *
 * Useful for Getting the uniques values of an arry.
 *
 * @access	public
 * @param	array
 * Also remove keys 
 * @return	array
 */

function remove_duplicated_values($arr)
{
    $_a = array();
    while(list($key,$val) = each($arr))
	{
        $_a[$val] = 1;
    }
    return array_keys($_a);
}
// ------------------------------------------------------------------------

/**
 * Removes junk character Created By Ck editor
 *
 * @access	public
 * @param	string
 * @return	string
 */


function restore_hsc($val){
    $val = str_replace('&amp;', '&', $val);
    $val = str_replace('&ouml;', '', $val);//'?'
    $val = str_replace('&auml;', '', $val); //'?'
    $val = str_replace('&uuml;', '', $val);//'?'
    $val = str_replace('&lt;', '<', $val);
    $val = str_replace('&gt;', '>', $val);
    $val = str_replace('&quot;', '"', $val);
    return $val;
}
// ------------------------------------------------------------------------

/**
 * Trims an array recursivley
 *
 * @access	public
 * @param	array
 * @return	array
 */

function TrimArray($Input)
{
    if (!is_array($Input))
        return trim($Input);
 
    return array_map('TrimArray', $Input);
}

// ------------------------------------------------------------------------

/**
 * Removes Empty values
 * Does not remove the keys
 * @access	public
 * @param	array
 * @return	array
 */

function array_remove_empty($arr){
    $narr = array();
    while(list($key, $val) = each($arr)){
        if (is_array($val)){
            $val = array_remove_empty($val);
            // does the result array contain anything?
            if (count($val)!=0){
                // yes :-)
                $narr[$key] = $val;
            }
        }
        else {
            if (trim($val) != ""){
                $narr[$key] = $val;
            }
        }
    }
    unset($arr);
    return $narr;
}

/**
 * Creates Sef URl
 * @access	public
 * @param	string
 * @return	string
 */


 if ( ! function_exists('seo_friendly_url'))
{
	function seo_friendly_url($string){
	$string = preg_replace("`\[.*\]`U","",$string);
	$string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$string);
	$string = htmlentities($string, ENT_COMPAT, 'utf-8');
	$string = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i","\\1", $string );
	$string = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $string);
	return strtolower(trim($string, '-'));
	}
}

// ------------------------------------------------------------------------

/**
 * Removes junk character Created By Ck editor
 *
 * @access	public
 * @param	string
 * @return	string
 */


function restore_hsc_ck($val){

	$val = str_replace('&', '&amp', $val);
    $val = str_replace('', '&auml;', $val);//'?'
    $val = str_replace('', '&auml;', $val); //'?'
    $val = str_replace('', '&uuml;', $val);//'?'
    $val = str_replace('<', '&lt;', $val);
    $val = str_replace('>', '&gt;', $val);
    $val = str_replace('"', '&quot;', $val);
    return $val;
}

// ------------------------------------------------------------------------
/*
* Function to test number is even or odd
*/
function is_odd($number) {
  return $number & 1; // 0 = even, 1 = odd
}

//-----------------------------------------------------------

/*
| Function to remove the array values 
| Used in BANNER MODULE
*/
function array_remove_value($workdata,$item2remove)
{
	foreach($workdata as $item)
	{
	    	if($item != $item2remove) $newworkdata[] = $item;
	}
	
	return implode(',',$newworkdata);
}


//------------------------------------------------------------
/*
| Function to give the Date Between Two specifed Dates
*/

function get_date_list($date_value, $another_date_value)
{
	$check_in_date   = strtotime($date_value);
	$check_out_date  = strtotime($another_date_value);
	$increment = 0;
	$date_loop = '';
	while ($check_out_date != $date_loop)
	{
		$date_loop = mktime(0, 0, 0, date('n', $check_in_date), date('j', $check_in_date) + $increment, date('Y', $check_in_date));
		$reservation_dates[] = $date_loop;
		$increment++;
	}
        return $reservation_dates;
}
//-----------------------------------------------------------------------------------
	/*
	| Function to Load the Javascript Files and Make A singel request to the server
	|
	*/
	
	 /*function js()
	 {
       $this->path_js = ROOTBASEPATH.'js/frontend/';
	   $segs = $this->uri->segment_array();
       foreach ($segs as $segment)
	   {
         $filepath = $this->path_js.$segment.'.js';
         if(file_exists($filepath))
		 {
             readfile($filepath);
		 }
      }
 	}*/

//----------------------------------------------------------------------------------------


//------------------------------------------------------------------------------------
/*
* FUNCTION TO SEARCH THE Answers DETAILS FROM THE POLL ARRAY AND ALSO IN EXAVMAIL
*/

function search_answers($array, $key, $value)
{ 
    $results = array();
    if (is_array($array))
    {
		if(isset($array[$key]))
		{
	   	if($array[$key] == $value)
            $results[] = $array;
		}	
        foreach ($array as $subarray)
            $results = array_merge($results, search_answers($subarray, $key, $value));
    }

    return $results;
}


	//-------------------------------------------------------------------------------------
	/*
	| Function to load All the Css and make a single request to the server
	|
	*/
	
	/*function css()
	 {
    	  $this->path_css = ROOTBASEPATH.'css/frontend/';
		  $segs = $this->uri->segment_array();
		  foreach ($segs as $segment)
		  {
        	$filepath = $this->path_css.$segment.'.css';
	         if(file_exists($filepath))
			 {
	    	   readfile($filepath);
			 }
		   }
	 }*/
//------------------------------------------------------------------
	/**
    * check if haystack string begins with needle
    *
    * @param string $haystack the string to check
    * @param string $needle string it should begin with
    * @return bool true if begins with
    * @assert ('hello world', 'hello') === true
    * @assert ('hello world', 'world') === false
    * @assert ('ello world', 'hello') === false
    * @assert ('hello', 'hello') === true
    * @assert ('hell', 'hello') === false
    * @assert ('hell', '') === true
    */
if ( ! function_exists('beginsWith'))
{
    function beginsWith($haystack, $needle)
    {
        return substr($haystack, 0, strlen($needle))===$needle;
    }
}

//--------------------------------------------------------------------
/*
| Finds the Maximum Element of 2D Array
*/
function multimax( $array )
{
    $return ='';
	 foreach( $array as $value ) 
	 {
        if( is_array($value) ) 
		{
            $subvalue = multimax($value);
            if( $subvalue > $return ) 
			{
                $return = $subvalue;
            }
        } 
		elseif($value > $return) 
		{
            $return = $value;
        }
    }//END OF foreach( $array as $value ) 
   return $return;
}

//-------------------------------------------------------------------------------

//FUNCTION TO CONVERT FILES SIZE TO APPROPRIATE TYPE
function formatbytes($file, $type)  
{  
    switch($type){  
        case "KB":  
            $filesize = filesize($file) * .0009765625; // bytes to KB  
        break;  
        case "MB":  
            $filesize = (filesize($file) * .0009765625) * .0009765625; // bytes to MB  
        break;  
        case "GB":  
            $filesize = ((filesize($file) * .0009765625) * .0009765625) * .0009765625; // bytes to GB  
        break;  
    }  
    if($filesize <= 0)
	{  
        return $filesize = 'unknown file size';
	}  
    else
	{
		return round($filesize, 2).' '.$type;
    }  
}  


//--------------------------------------------------------------------------------------

function formatbytes_number($size, $type)  
{  
    switch($type){  
        case "KB":  
            $size = $size * .0009765625; // bytes to KB  
        break;  
        case "MB":  
            $size = ($size * .0009765625) * .0009765625; // bytes to MB  
        break;  
        case "GB":  
            $size = (($size * .0009765625) * .0009765625) * .0009765625; // bytes to GB  
        break;  
    }  
    if($size <= 0)
	{  
        return $size = 'unknown file size';
	}  
    else
	{
		return round($size, 2).' '.$type;
    }  
}  

//------------------------------------------------------------

function valid_url($str)
{
    return ( ! preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $str)) ? FALSE : TRUE;
}

// --------------------------------------------------------------------
	
	/**
	 * product price
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	
	function product_price($str)
	{
		return (bool)preg_match( '/^[\+]?[0-9]*\.?[0-9]+$/', $str);

	}
	
	//----------------------------------------------------------------------------------------------------------------------------
	
	function date_when( $timestamp = NULL, $base = NULL)
    {
		
	   if( strlen($timestamp) < 10 ) return;
        
        if( empty($base) ) $base = strtotime(date("Y-m-d H:i:s"));
        
		
        // Is timestamp in past or future?
        $past = ($base > $timestamp) ? TRUE : FALSE;
        
        // Create suffix based on past/future
        $suffix = ($past) ? ' ago' : ' from now';
        
        // Actual time string of timestamp ie 4:54 pm
        $timestr = date('g:i a',$timestamp);
        
        $diff = abs($timestamp - $base);
        
        $periods = array('year'=>31536000,'month'=>2628000,'day'=>86400,'hour'=>3600,'minute'=>60,'second'=>1);
        
        // create array holding count of each period
        
        $out = array();
        
        foreach($periods as $period => $seconds)
        {
            if( $diff > $seconds )
            {
                $result = floor($diff/$seconds);
                $diff =  $diff % $seconds;
                $out[] = array($period, $result);
            }
        }
        //echo "<pre>";print_r($out); exit;
        // Get largest period, other counts are still in $out for use
        $top = array_shift($out);
        
        switch($top[0])
        {
            case 'month' : 
                $output = $top[1] == 1 ? ( $past ? 'last month' : 'next month' ) : $top[1] . ' months' . $suffix;
                break;
            case 'day' :
                $output = $top[1] == 1 ? ( $past ? 'yesterday' : 'tomorrow' ) .', '. $timestr : $top[1] . ' days' . $suffix;
                break;
            case 'hour':
                // Calculate in case, for example if yesterday was only 7 hours ago
                $output = date('j',$base) == date('j',$timestamp) ? 'today, '.$timestr : (( $past ? 'yesterday' : 'tomorrow' ) . ', '.$timestr);
                break;
            default : 
                $output = $top[1] .' '. $top[0] . ( $top[1] > 1 ? 's' : '' ) . $suffix;
                break;
        }
        
        
        return ucfirst($output);
        
    }
		
		//-----------------------------------------------------------------------------------------------
		/*
		| Function to get the Keywords from The URL (searched)
		*/
		function getKeywords($url)
		{
				$data  = explode('<br />',$url);
				
				if(is_array($data) && count($data)>1)
				{
						if(isset($data[0]))
						{
							$url_needed = $data[0];
							preg_match_all("/<a[ \r\n\t]{1}[^>]*HREF[^=]*=[ '\"\n\r\t]*([^ \"'>\r\n\t#]+)[ \"'>\r\n\t#>][^>]*>(.*)<\/a[ \r\n\t]*>/isU",$url_needed,$matches,PREG_SET_ORDER);
						
							$url     = isset($matches[0][1])?$matches[0][1]:'';
						}	
				}
				
				$refer = parse_url($url);
				$host = $refer['host'];
				$refer = isset($refer['query'])?$refer['query']:'';
   
				if($refer == '')
				{
					return false;
				}				
				elseif(strstr($host,'google'))
				{
						//do google stuff
						$match = preg_match('/&q=([a-zA-Z0-9+-]+)/',$refer, $output);
						if(count($output) == 0)
							$match = preg_match('/q=([a-zA-Z0-9+-]+)/',$refer, $output);
						
						if(count($output) > 1)
						{
							$querystring = $output[1];
							$querystring = str_replace('&q=','',$querystring);
							$keywords = str_replace('+',' ',$querystring);
							return $keywords;
						}
						else
						{
							return '';
						}
				}
				elseif(strstr($host,'yahoo'))
				{
						//do yahoo stuff
						$match = preg_match('/p=([a-zA-Z0-9+-]+)/',$refer, $output);
						$querystring = $output[0];
						$querystring = str_replace('p=','',$querystring);
						$keywords = str_replace('+',' ',$querystring);
						return $keywords;
						
				}
				elseif(strstr($host,'msn'))
				{
						//do msn stuff
						$match = preg_match('/q=([a-zA-Z0-9+-]+)/',$refer, $output);
						$querystring = $output[0];
						$querystring = str_replace('q=','',$querystring);
						$keywords = str_replace('+',' ',$querystring);
						return $keywords;
				}
				if(strstr($host,'altavista'))
				{
						//do google stuff
						$match = preg_match('/&q=([a-zA-Z0-9+-]+)/',$refer, $output);
						if(count($output) == 0)
							$match = preg_match('/q=([a-zA-Z0-9+-]+)/',$refer, $output);
						
						$querystring = $output[1];
						$querystring = str_replace('&q=','',$querystring);
						$keywords = str_replace('+',' ',$querystring);
						return $keywords;
				}
				else
				{
						//else, who cares
						return false;
				}
		}
		// ------------------------------------------------------------------------

/**
 * Generate Random ID
 *
 * Will generate a new random ID (integer)
 *
 * @access	public
 * @return	integer
 */	
if ( ! function_exists('generate_random_id') )
{
	function generate_random_id($maxlen=6) 
	{
		$random_id 	= "000000";		
		$random_id	= rand(99999,99999999);		
		$random_id	= substr($random_id , 0 ,  $maxlen);
		
		return $random_id;

	}
}

// ------------------------------------------------------------------------

/**
 * Generate Password
 *
 * Will generate a new random password
 *
 * @access	public
 * @return	string
 */	
if ( ! function_exists('generate_password') )
{
	function generate_password($maxlen=6) 
	{
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double)microtime()*1000000);	
		$i = 0;	
		$pass = '' ;	
	
		while ($i <= $maxlen) 
		{	
			$num = rand() % 33;	
			$tmp = substr($chars, $num, 1);	
			$pass = $pass . $tmp;	
			$i++;	
		}
		return $pass;

	}
}

function mysql_to_human($dte,$format='d-m-Y'){
    $time = strtotime($dte);
    
    		$r  = date('d', $time).'-'.date('m', $time).'-'.date('Y', $time).' ';

		
			$r .= date('H', $time).':'.date('i', $time);
			$r .= ':'.date('s', $time);
		
		return $r;

    
    }
    	//-----------------------------------------------------------------------------------------------

     function get_suburb_input($search_str){
      $CI  = &get_instance();
      if(is_numeric($search_str))
        $SQL_QUERY = "SELECT id,pcode, location, state
                    FROM ".TBL_AUSTRALIA_LOCATIONS."
                    WHERE pcode LIKE '".$CI->db->escape_like_str(trim($search_str))."%'
                    ORDER BY location
                    LIMIT 50";
      else
        $SQL_QUERY = "SELECT pcode, location, state
                    FROM ".TBL_AUSTRALIA_LOCATIONS."
                    WHERE location LIKE '".$CI->db->escape_like_str(trim($search_str))."%' 
                    ORDER BY location
                    LIMIT 50";
			$query_check = $CI->db->query($SQL_QUERY);
			if($query_check->num_rows > 0) {
				$result = $query_check->result_array();
        for($i=0;$i<count($result);$i++) {
          $suburb_list[$result[$i]['id']] = $result[$i];
        }
      }
      else
        $suburb_list = array();
      return $suburb_list;
    }	//END OF function get_suburb_input()
    
    
     function get_param($param){
        if(isset($_POST[$param])){
            return $_POST[$param];
        } elseif (isset($_GET[$param])){
            return $_GET[$param];
        } else {
            return '';
        }
    }
 /**
 * Get Theme Setting
 *
 * @access	public
 * @return	string
 */	
if ( ! function_exists('theme_setting') )
{
	function theme_setting() 
	{
    $table = THEME_MANAGER;
    $CI  = &get_instance();
    $user_id = '';
    $user_id  =  $CI->session->userdata('user_id');
    if(isset($user_id) && $user_id != '')
    {
      $selected_theme = "SELECT theme_id FROM ".THEME_USER_MAP." WHERE user_id = ".$user_id." ";
      $selected_theme_result = $CI->db->query($selected_theme);
      $theme_result = $selected_theme_result->result_array();
      if(count($theme_result) > 0)
      {
        $qry = "SELECT * FROM ".THEME_MANAGER." WHERE status = 1 AND	testdata = 0 AND id =".$theme_result[0]['theme_id']." "; 
        $result = $CI->db->query($qry);
        $reasult_array = $result->result_array();
        if(count($reasult_array) > 0)
        {
          return $reasult_array;
          
        }else{
          $qry = "SELECT * FROM ".THEME_MANAGER." WHERE status = 1 and 	testdata = 0 ORDER BY RAND() limit 1";
          $result = $CI->db->query($qry);
          $reasult_array = $result->result_array();       
          if(is_array($reasult_array) && count($reasult_array) > 0)
					{
						$insert_qry = "INSERT INTO ".THEME_USER_MAP."(user_id,theme_id) values('".$user_id."',".$reasult_array[0]['id'].")";
						$CI->db->query($insert_qry); 
					}
          return $reasult_array;      
        }        
      }
      else{
      
        $qry = "SELECT * FROM ".THEME_MANAGER." WHERE status = 1 and 	testdata = 0 ORDER BY RAND()  limit 1";
        $result = $CI->db->query($qry);
        $reasult_array = $result->result_array();
				if(is_array($reasult_array) && count($reasult_array) > 0)
				{
					$insert_qry = "INSERT INTO ".THEME_USER_MAP."(user_id,theme_id) values('".$user_id."',".$reasult_array[0]['id'].")";
					$CI->db->query($insert_qry); 
				}
        return $reasult_array; 
      }
    }

	}
}

function replace_special_chars($val)
{
		$val = str_replace('º','&#186;',$val);
		$val = str_replace('°','&#176;',$val);
		$val = str_replace('¨','&#168;',$val);
		$val = str_replace('³','&#179;',$val);
		$val = str_replace('™','&trade;',$val);
		$val = str_replace('®','&reg;',$val);
		$val = str_replace('°','&deg;',$val);
		return $val;
}
        
        function reverse_special_chars_test($val)
        {
                $val = str_replace('&amp;#186;','º',$val);
                $val = str_replace('&#186;','º',$val);
                $val = str_replace('&amp;#176;','°',$val);
                $val = str_replace('&#176;','°',$val);
                $val = str_replace('&amp;#168;','¨',$val);
                $val = str_replace('&#168;','¨',$val);
                $val = str_replace('&amp;#179;','³',$val);
                $val = str_replace('&#179;','³',$val);
                $val = str_replace('&amp;trade;','™',$val);
                $val = str_replace('&trade;','™',$val);
                $val = str_replace('&amp;reg;','®',$val);
                $val = str_replace('&reg;','®',$val);
               $val = str_replace('&amp;deg;','°',$val);
                $val = str_replace('&deg;','°',$val);
                
                return $val;
        }
        
        function replace_special_chars_blank($val)
        {
                $val = str_replace('º','',$val);
                $val = str_replace('°','',$val);
                $val = str_replace('¨','',$val);
                $val = str_replace('³','',$val);
                $val = str_replace('™','',$val);
                $val = str_replace('®','',$val);
                $val = str_replace('®','',$val);
                $val = str_replace('°','',$val);
                 $val = str_replace('&amp;#186;','',$val);
                $val = str_replace('&#186;','',$val);
                $val = str_replace('&amp;#176;','',$val);
                $val = str_replace('&#176;','',$val);
                $val = str_replace('&amp;#168;','',$val);
                $val = str_replace('&#168;','',$val);
                $val = str_replace('&amp;#179;','',$val);
                $val = str_replace('&#179;','',$val);
                $val = str_replace('&amp;trade;','',$val);
                $val = str_replace('&trade;','',$val);
                $val = str_replace('&amp;reg;','',$val);
                $val = str_replace('&reg;','',$val);
                $val = str_replace('&amp;deg;','',$val);
                $val = str_replace('&deg;','',$val);
                
                return $val;
        }

function create_ep_signature_for_easf_validation_check($signature_easf = '', $url_function = '') 
 // function create_ep_signature_for_easf_validation_check : Start
 {
        $key = 'epmatcheasf4049.#09hand744shake';
        $timestamp = date('Y-m-d H:i');
        $cur_date = date('Ymd', strtotime($timestamp));
        $addcheck_date_time = date('H', strtotime('+1 hour', strtotime($timestamp)));
        $remcheck_date_time = date('H', strtotime('-1 hour', strtotime($timestamp)));
        $url = 'http://exateam.com/projects/api/api_easf/'.$url_function.'';
        $time_append = $cur_date . '-' . '(' . $remcheck_date_time .''.'-'.$addcheck_date_time.')';
        echo $signature = sha1($key . $url . $time_append);
		
        unset($key,$time_append,$timestamp,$cur_date,$addcheck_date_time,$remcheck_date_time,$url);
        if ($signature == $signature_easf) {
            return 1;
        } else {
            return 0;
        }
}
		
?>