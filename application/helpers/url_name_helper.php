<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * EASFv9
 *
 * @package		EASFv9 FRAMEWORK
 * @author		v9 Team
 * @link		http://www.exademosite.com
 * @since		Version 3.1
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Easfv9  PAGE NAME Helpers
 *
 * @package		EASFv9 FRAMEWORK
 * @subpackage	Helpers
 * @category	Helpers
 * @author		v9 Team
 * @link		http://www.exa.com.au
 */


// ------------------------------------------------------------------------

function page_name_check($name_to_check = '')
{
	$CI 		 		= & get_instance();
	$module_name 		= 0;
	$reserved_keyword	= $CI->config->item('reserved_page_name');
	$site_id = 0;
	
	if($CI->session->userdata('site_id'))
	{
		$site_id = $CI->session->userdata('site_id');
	}
	
	if($name_to_check !='')
	{
		$SQL_PAGE_NAME = "SELECT id AS PAGE_NAME FROM ".TBL_PAGE."	WHERE site_id = ".$site_id." AND page_name =".$CI->db->escape($name_to_check);
		$page_managent_check = $CI->db->query($SQL_PAGE_NAME);
		if($page_managent_check->num_rows > 0)
		{
			$module_name = 1;
		}
		else
		{
			$SQL_PRODUCT_NAME = "SELECT id AS PRODUCT_NAME	FROM ".TBL_PRODUCT." WHERE product_name =".$CI->db->escape($name_to_check);	
			$product_check = $CI->db->query($SQL_PRODUCT_NAME);
			if($product_check->num_rows > 0)
			{
				$module_name = 2;
			}//END OF if($product_check->num_rows > 0)
			else
			{
				$SQL_CATEGORY_NAME = "SELECT id AS CATEGORY_NAME  FROM ".TBL_CATEGORIES." WHERE category =".$CI->db->escape($name_to_check);
				$category_check = $CI->db->query($SQL_CATEGORY_NAME);
				if($category_check->num_rows > 0)
				{
					$module_name = 3;
				}
				else
				{
					//----------------- FUNCTION TO CHECK WHETHER THE NAME EXIST AS BRAND NAME---------------------
					$SQL_BRAND_NAME = "SELECT id AS SQL_BRAND_NAME	FROM ".TBL_BRAND." WHERE brand_name =".$CI->db->escape($name_to_check);	
					$brand_check 		= $CI->db->query($SQL_BRAND_NAME);
					if($product_check->num_rows > 0)
					{
						$module_name = 5;
					}
					else
					{
							if(in_array($name_to_check,$reserved_keyword))
								$module_name = 4;
					}
				}
				
			}			
		}			
	} //END OF if($name_to_check !='')
	return $module_name;
}//END OF function page_name_check($name_to_check = '')
// ------------------------------------------------------------------------

/**
 * Checks the page name While updating
 *
 *
 * @access	public
 * @return	integer
 */	
if ( ! function_exists('update_page_name_check'))
{
	function update_page_name_check($name_to_check = '', $id ='',$site_id = 0)
	{
		$CI =& get_instance();
		$module_name = 0;
		if($name_to_check !='' && $id !='')
		{
			$SQL_PAGE_NAME = "SELECT 
										id AS PAGE_NAME
								FROM 
										".TBL_PAGE."
								WHERE 
										page_name =".$CI->db->escape($name_to_check)."
								AND
										site_id = ".$site_id."
								AND 
										id <> ".$id."
								  ";
			$page_managent_check = $CI->db->query($SQL_PAGE_NAME);
			
			if($page_managent_check->num_rows > 0)
			{
				$module_name = 1;
			}
		}//END OF if($name_to_check !='' && $id !='')
		return $module_name;
	}	//END OF function page_name_check($name_to_check = '')
}


// ------------------------------------------------------------------------

/**
 * Checks the page name While updating
 *
 *
 * @access	public
 * @return	integer
 */	
if ( ! function_exists('update_name_check'))
{
	function update_name_check($name_to_check = '')
	{
		$CI =& get_instance();
		$module_name = 0;
		if($name_to_check !='')
		{
			$SQL_PAGE_NAME = "SELECT 
										id AS PAGE_NAME
								FROM 
										".TBL_PAGE."
								WHERE 
										page_name =".$CI->db->escape($name_to_check)."
									
								  ";
			$page_managent_check = $CI->db->query($SQL_PAGE_NAME);
			
			if($page_managent_check->num_rows > 0)
			{
				$module_name = 1;
			}
		}//END OF if($name_to_check !='' && $id !='')
		return $module_name;
	}	//END OF function page_name_check($name_to_check = '')
}


// ------------------------------------------------------------------------

/**
 * Checks the Product Name name While updating
 *
 *
 * @access	public
 * @return	integer
 */	
if ( ! function_exists('update_product_name_check'))
{
	function update_product_name_check($name_to_check = '',$id ='')
	{
		$CI  = &get_instance();
		$module_name = 0;
		if($name_to_check !='' && $id !='')
		{
			$SQL_PRODUCT_NAME = "SELECT 
										id AS UPDATE_PRODUCT_NAME
								FROM 
										".TBL_PRODUCT."
								WHERE 
										product_name =".$CI->db->escape($name_to_check)."
									AND 
										id <> ".$id."
								  ";
			$product_name_check = $CI->db->query($SQL_PRODUCT_NAME);
			
			if($product_name_check->num_rows > 0)
			{
				$module_name = 1;
			}
		}//END OF if($name_to_check !='' && $id !='')*/
		//$module_name = 0;
		return $module_name;
	}	//END OF function update_product_name_check($name_to_check = '')
}

// ------------------------------------------------------------------------

/**
 * Checks the Product Name name While updating
 *
 *
 * @access	public
 * @return	integer
 */	
if ( ! function_exists('update_product_check'))
{
	function update_product_check($name_to_check = '')
	{
		/*$CI  = &get_instance();
		$module_name = 0;
		if($name_to_check !='')
		{
			$SQL_PRODUCT_NAME = "SELECT 
																	id AS UPDATE_PRODUCT_NAME
														FROM 
																	".TBL_PRODUCT."
														WHERE 
																	product_name =".$CI->db->escape($name_to_check)."
													";
			$product_name_check = $CI->db->query($SQL_PRODUCT_NAME);
			
			if($product_name_check->num_rows > 0)
			{
				$module_name = 1;
			}
		}//END OF if($name_to_check !='' && $id !='')*/
		$module_name = 0;
		return $module_name;
	}	//END OF function update_product_name_check($name_to_check = '')
}

// ------------------------------------------------------------------------
/**
 * Checks the Category Name name While updating
 * @access	public
 * @return	integer
 */	
if ( ! function_exists('update_category_name_check'))
{
	function update_category_name_check($name_to_check = '',$id ='')
	{
		/*$CI  = &get_instance();
		$module_name = 0;
		if($name_to_check !='' && $id !='')
		{
		   $SQL_CATEGORY_NAME = "SELECT 
																		id AS UPDATE_CATEGORY_NAME
															FROM 
																		".TBL_CATEGORIES."
															WHERE 
																			category =".$CI->db->escape($name_to_check)."
																	AND 
																			id <> ".$id."
														";
			$category_name_check = $CI->db->query($SQL_CATEGORY_NAME);
			
			if($category_name_check->num_rows > 0)
			{
				$module_name = 1;
			}
		}//END OF if($name_to_check !='' && $id !='')*/
		$module_name = 0;
		return $module_name;
	}	//END OF function update_category_name_check($name_to_check = '')
}
// ------------------------------------------------------------------------
/**
 * Checks the Category Name name While updating
 * @access	public
 * @return	integer
 */	
if ( ! function_exists('update_brand_name_check'))
{
	function update_brand_name_check($name_to_check = '',$id ='')
	{
		/*$CI  = &get_instance();
		$module_name = 0;
		if($name_to_check !='' && $id !='')
		{
		   $SQL_BRAND_NAME = "SELECT 
																	id AS UPDATE_BRAND_NAME
														FROM 
																	".TBL_BRAND."
														WHERE 
																		brand_name =".$CI->db->escape($name_to_check)."
																AND 
																		id <> ".$id."
														";
			$category_name_check = $CI->db->query($SQL_BRAND_NAME);
			
			if($category_name_check->num_rows > 0)
			{
				$module_name = 1;
			}
		}//END OF if($name_to_check !='' && $id !='')*/
		$module_name = 0;
		return $module_name;
	}	//END OF function update_category_name_check($name_to_check = '')
}
// ------------------------------------------------------------------------

/**
 * Checks the Category Name name While updating
 *
 *
 * @access	public
 * @return	integer
 */	
if ( ! function_exists('update_category_check'))
{
	function update_category_check($name_to_check = '')
	{
		/*$CI  = &get_instance();
		$module_name = 0;
		if($name_to_check !='')
		{
		   $SQL_CATEGORY_NAME = "SELECT 
																			id AS UPDATE_CATEGORY_NAME
															FROM 
																			".TBL_CATEGORIES."
															WHERE 
																			category =".$CI->db->escape($name_to_check)."
														";
			$category_name_check = $CI->db->query($SQL_CATEGORY_NAME);
			
			if($category_name_check->num_rows > 0)
			{
				$module_name = 1;
			}
		}//END OF if($name_to_check !='' && $id !='')*/
		$module_name = 0;
		return $module_name;
	}	//END OF function update_category_name_check($name_to_check = '')
}

// ------------------------------------------------------------------------

/**
 * Checks the Reserved Keyword name While updating
 *
 *
 * @access	public
 * @return	integer
 */	
if ( ! function_exists('update_reservedword_check'))
{
	function update_reservedword_check($name_to_check = '')
	{
		$CI  				= &get_instance();
		$reserved_keyword	= $CI->config->item('reserved_page_name');
		$module_name = 0;
		if($name_to_check !='')
		{
		   if(in_array($name_to_check,$reserved_keyword))
			$module_name = 1;
		}//END OF if($name_to_check !='' && $id !='')
		return $module_name;
	}	//END OF function update_reservedword_check($name_to_check = '')
}




/* End of file email_helper.php */
/* Location: ./system/helpers/email_helper.php */