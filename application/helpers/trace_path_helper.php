<?php

// ------------------------------------------------------------------------

/**
 * Prints the traversed path By user
 *
 * Useful for Getting the Traverse Path of array.
 *
 * @access	public
 * @param	array
 * Also remove keys 
 * @return	array
 */

 function traverse_user_path()
 { 
	$patht 			= explode(",", $_SESSION["totalpath"]);
	$referer_url 	= '';
	$last_val 		= '';
	foreach($patht as $val) 
	{
        $val = trim($val);
        $pos_swf = strpos($val, ".swf");
		$pos_exa = strpos($val, "exateam.com");
        if(!empty($val) && $pos_swf === false && $pos_exa === false) 
		{
            if($val != $last_val)
			{
                if(strlen($val) > 70)
                {
					$val_display = substr($val,0,70)."&hellip;";
				}
                else
                {
					$val_display = $val;
				}
                $referer_url .= "<a href = '".$val."'>".$val_display."</a><br />";
                 $last_val = $val;
            }
        }
  }

	return $referer_url;
 }