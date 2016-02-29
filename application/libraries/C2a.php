<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Easfv9
*/
// ------------------------------------------------------------------------

/**
 * C2A Manager Class
 *
 * Prints Calls to Action in Side Nav
 *
 */

 class c2a 
 {
	 var $c2a;
	 var $priviledges;
	 var $dpcs_id 				=	array();
	 var $default_page		= 'home';
	 
	 // --------------------------------------------------------------------
	 /*
	 | COnstructor of Base Class
	 */
	 function __construct()
	 {
		 
	 }
	 
	// --------------------------------------------------------------------
	/*
	| Function to update the DPCS array
	*/	
	function dpcs_ids()
	{
		$SQL_DPCS ="SELECT 
												id,page_name
									FROM 	
												".TBL_PAGE."
									WHERE 
													STATUS = 1
							";
		$dpcs_pages = $this->run_query($SQL_DPCS);	
		if(is_array($dpcs_pages) && count($dpcs_pages)>0)
		{
			foreach($dpcs_pages as $page_details)
			{
					$this->dpcs_id[$page_details['page_name']] = $page_details['id'];
			}
		}//END OF if(is_array($dpcs_pages) && count($dpcs_pages)>0)
	}
	//--------------------------------------------------------------------
	function get_c2a_list()
	{
		 $CI 						= & get_instance();
		 $page_name   	= $CI->uri->segment(1);
//		 $module_name   = $CI->uri->rsegment(1);
		 $c2a_details   = array();
		 if($page_name == '')
			$page_name = $this->default_page;
		 
				//--------------------------GET C2A LIST FROM PAGE NAMES------------------
				
				$SQL_C2A = "SELECT 
														MAP_C2A.page_id,MAP_C2A.c2a_id,MAP_C2A.row_no,
														PANEL_C2A.c2a_heading,PANEL_C2A.c2a_sub_title,
														PANEL_C2A.c2a_title_large,PANEL_C2A.c2a_description,
														PANEL_C2A.c2a_link_text,PANEL_C2A.c2a_link,PANEL_C2A.image_name,c2a_panel
										FROM 
														".TBL_C2A_PANEL_MAP." MAP_C2A
										INNER JOIN 
														".TBL_PAGE." DPCS ON (DPCS.id = MAP_C2A.page_id)	
										INNER JOIN 
														".TBL_C2A_PANEL." PANEL_C2A ON (MAP_C2A.c2a_id = PANEL_C2A.id)	
										WHERE
															DPCS.page_name = ".$CI->db->escape($page_name)."	
													AND
															PANEL_C2A.status = 1	
										
									";
		 
		
		  if($CI->session->userdata('email_id_frontend') <> 'admin@exateam.com')
			{
			
				$allowed_modules_session  		 = isset($CI->session->userdata['modules_allowed']['pid_frontend'])?$CI->session->userdata['modules_allowed']['pid_frontend']:'';
			 if($allowed_modules_session!='')
					 $modules_allowed        = implode(',',array_keys($allowed_modules_session));
			 else
					 $modules_allowed        = 0;
					 
				$SQL_C2A .=   " AND MAP_C2A.page_id IN (".$modules_allowed.")";	 
			}
			
			$SQL_C2A .= " ORDER BY 
														MAP_C2A.row_no";
			
			
				$c2a_details = $this->run_query($SQL_C2A);
				
				return $c2a_details;
	}
	
	function run_query($query)
	{
		$CI = & get_instance();
		$result_set = $CI->db->query($query);
		if($result_set->num_rows > 0)
			return $result_set->result_array();
	}
	
	function table_exists($table){
		//Check if table exists
		$CI = & get_instance();
		$result = array();
		$exists = 0; 		
		$result = $CI->db->query("SHOW TABLES LIKE '".$table."'");					
		if($result->num_rows > 0) 
		{ 
			$exists = 1; 
		}
		return $exists; 
	}
	
	function get_news_list()
	{
		 $CI 		= & get_instance();
		 $page_name   	= $CI->uri->segment(1);
		 $module_name   = $CI->uri->rsegment(1);
		 $c2a_details   = array();		 
		 $table_exist = $this->table_exists(TBL_NEWS);
		 if($table_exist == 1)
		 {
		 $SQL_C2A = "SELECT * from ".TBL_NEWS." where status=1 ORDER BY rank LIMIT 0,5";
		 $news_details = $this->run_query($SQL_C2A);
		 }	
		 return $news_details;
		 
	}
	
	function get_articles_list()
	{
		 $CI 		= & get_instance();
		 $page_name   	= $CI->uri->segment(1);
		 $module_name   = $CI->uri->rsegment(1);
		 $c2a_details   = array();		 
		 $table_exist = $this->table_exists(TBL_ARTICLES);
		 if($table_exist == 1)
		 {
		 $SQL_C2A = "SELECT * from ".TBL_ARTICLES." where status=1 ORDER BY rank LIMIT 0,5";
		 $articles_details = $this->run_query($SQL_C2A);
		 }		
		 return $articles_details;
		 
	}
	
	function get_faq_list()
	{
		 $CI 		= & get_instance();
		 $page_name   	= $CI->uri->segment(1);
		 $module_name   = $CI->uri->rsegment(1);
		 $faq_details   = array();		 
		 $table_exist = $this->table_exists(TBL_FAQ);
		 if($table_exist == 1)
		 {
		  $SQL_C2A = "SELECT * from ".TBL_FAQ." where status=1 ORDER BY rank LIMIT 0,5";
		  $news_details = $this->run_query($SQL_C2A);
		 }
		 return $news_details;
		 
	}
	
	function get_emp_list()
	{
		 $CI 		= & get_instance();
		 $page_name   	= $CI->uri->segment(1);
		 $module_name   = $CI->uri->rsegment(1);
		 $job_details   = array();		 
		 $table_exist = $this->table_exists(TBL_EMPLOYMENT_OPENINGS);
		 if($table_exist == 1)
		 {
		 $SQL_C2A = "SELECT * from ".TBL_EMPLOYMENT_OPENINGS." where status=1 ORDER BY rank LIMIT 0,5";
		 $job_details = $this->run_query($SQL_C2A);
		 }		
		 return $job_details;
		 
	}
	
	function get_download_list()
	{
		 $CI 		= & get_instance();
		 $page_name   	= $CI->uri->segment(1);
		 $module_name   = $CI->uri->rsegment(1);
		 $download_details   = array();
		 
		 $val = $this->table_exists(TBL_DOWNLOAD_FILE);
		if($val == 1)
		{
			$SQL_C2A = "SELECT * from ".TBL_DOWNLOAD_FILE." where status=1 ORDER BY rank LIMIT 0,5";
			$download_details = $this->run_query($SQL_C2A);
		}
		return $download_details;
		 
	}
	
	function get_glossary_list()
	{
		 $CI 		= & get_instance();
		 $page_name   	= $CI->uri->segment(1);
		 $module_name   = $CI->uri->rsegment(1);
		 $glossary_details   = array();
		 $table_exist = $this->table_exists(TBL_GLOSSARY); echo 'here'.$table_exist; exit;
		 if($table_exist == 1)
		 {
		 $SQL_C2A = "SELECT * from ".TBL_GLOSSARY." where status=1 ORDER BY rank LIMIT 0,5";
		 $glossary_details = $this->run_query($SQL_C2A);
		}	
		 return $glossary_details;
		 
	}
	
	function get_flipbook_list()
	{
		 $CI 		= & get_instance();
		 $page_name   	= $CI->uri->segment(1);
		 $module_name   = $CI->uri->rsegment(1);
		 $flip_details   = array();		 
		 $table_exist = $this->table_exists(TBL_CATALOGUE);
		 if($table_exist == 1)
		 {
		 $SQL_C2A = "SELECT * from ".TBL_CATALOGUE." where status=1 ORDER BY id LIMIT 0,5";
		 $flip_details = $this->run_query($SQL_C2A);
		}	
		 return $flip_details;
		 
	}
	
	function get_video_list()
	{
		 $CI 		= & get_instance();
		 $page_name   	= $CI->uri->segment(1);
		 $module_name   = $CI->uri->rsegment(1);
		 $video_details   = array();		 
		 $table_exist = $this->table_exists(TBL_VIDEOGALLERY);
		 if($table_exist == 1)
		 {
		
		//Get Videos with Featured Ones
			$SQL_C2A = "SELECT * from ".TBL_VIDEOGALLERY." where status=1 And featured =1 ORDER BY rank LIMIT 0,5";
		 $video_details = $this->run_query($SQL_C2A);
		}		
		 return $video_details;		 
	}
	
	function get_testimonial_list()
	{
		 $CI 		= & get_instance();
		 $page_name   	= $CI->uri->segment(1);
		 $module_name   = $CI->uri->rsegment(1);
		 $testim_details   = array();		 
		 $table_exist = $this->table_exists(TBL_TESTIMONIALS);
		 if($table_exist == 1)
		 {
		  $SQL_C2A = "SELECT * from ".TBL_TESTIMONIALS." where status=1 ORDER BY rank LIMIT 0,5";
		  $testim_details = $this->run_query($SQL_C2A);
		 }		
		 return $testim_details;		 
	}
	
	function get_album()
	{
		$CI 		= & get_instance();
		$page_name   	= $CI->uri->segment(1);
		$module_name   = $CI->uri->rsegment(1);
		$album_details   = array();		
		$table_exist = $this->table_exists(TBL_ALBUM);
		if($table_exist == 1)
		{
			$SQL_C2A = "SELECT * from ".TBL_ALBUM." where status=1 ORDER BY rank";
			$album_details = $this->run_query($SQL_C2A);
		}		
		return $album_details;		 
		
	}
	
	function get_photo_list($album_id)
	{
		$CI 		= & get_instance();
		$page_name   	= $CI->uri->segment(1);
		$module_name   = $CI->uri->rsegment(1);
		$photo_details   = array();		 
		 $table_exist = $this->table_exists(TBL_ALBUM);
		 if($table_exist == 1)
		 {
		$SQL_C2A = "SELECT * from ".TBL_GALLERY." where status=1 and image1 <> '' and album_id = ".$album_id." ORDER BY rank limit 0,1";
		
		$photo_details = $this->run_query($SQL_C2A);
		}
   
  
		return $photo_details;		 
		
		
	}
	
	function get_active_poll_question()
	{
		$active_polls   = array();		 
		 $table_exist = $this->table_exists(TBL_POLLS_QUESTIONS);
		 if($table_exist == 1)
		 {
			$SQL_POLL_QUESTIONS = "SELECT *
	
							FROM
									".TBL_POLLS_QUESTIONS." QUESTION
							WHERE
									(QUESTION.status=1 OR QUESTION.featured=1) 
								 AND 
									(DATE_FORMAT(STR_TO_DATE(publish_date,'%d-%m-%Y'),'%Y-%m-%d') <=  '".date('Y-m-d')."')
								 AND
									(DATE_FORMAT(STR_TO_DATE(expiry_date,'%d-%m-%Y'),'%Y-%m-%d') >=  '".date('Y-m-d')."')
								 ORDER BY image1 DESC";
			$active_polls = $this->run_query($SQL_POLL_QUESTIONS);	
		 }
			return $active_polls;						
	}
	
	
	function get_latest_active_poll()
	{
		$active_poll   = array();		
		$table_exist = $this->table_exists(TBL_POLLS_QUESTIONS);
		if($table_exist == 1)
		{
			$SQL_LATEST_POLL = "SELECT *
	
							FROM
									".TBL_POLLS_QUESTIONS." QUESTION
							WHERE
									(QUESTION.status=1 OR QUESTION.featured=1) 
								 AND 
									(DATE_FORMAT(STR_TO_DATE(publish_date,'%d-%m-%Y'),'%Y-%m-%d') <=  '".date('Y-m-d')."')
								 AND
									(DATE_FORMAT(STR_TO_DATE(expiry_date,'%d-%m-%Y'),'%Y-%m-%d') >=  '".date('Y-m-d')."')
								 ORDER BY created DESC
								
								 LIMIT 0,1								 
								";
			$active_poll = $this->run_query($SQL_LATEST_POLL);
		}
			return $active_poll;					
	}
	
	function get_poll_answers($question_id)
	{
		$polls_answer   = array();		
		$table_exist = $this->table_exists(TBL_POLLS_ANSWERS);
		if($table_exist == 1)
		{
			$SQL_POLL_ANSWER = "SELECT  *
									
							FROM
									".TBL_POLLS_ANSWERS."
							WHERE
									poll_question_id =".$question_id."
							ORDER BY 
									answer_order			
							";
			$polls_answer	 = $this->run_query($SQL_POLL_ANSWER);		
		}
		return $polls_answer;					
	}
	
	
	function get_newsletter_group_list()
	{
		$group_list = array();		
		$table_exist = $this->table_exists(TBL_GROUP);
		if($table_exist == 1)
		{
			$SQL_GROUP = "SELECT
								*
					FROM
							".TBL_GROUP."
					WHERE
							frontend_status = 1
					ORDER BY 
							created DESC
					";
		 $group_list	 = $this->run_query($SQL_GROUP);	
		}
		return $group_list;	
	}

	function get_recent_newletter_list()
	{
		$recent_newsletter_list = array();
		$table_exist = $this->table_exists(TBL_NEWSLETTER);
		if($table_exist == 1)
		{
		$SQL_QUERY = "SELECT
								*
					FROM
							".TBL_NEWSLETTER."
					WHERE
							e_newsletter_status LIKE 'Finished%'
					ORDER BY 
							created DESC
					LIMIT 0,6
					";
		$recent_newsletter_list	 = $this->run_query($SQL_QUERY);
	
		}
		
		return $recent_newsletter_list;	
	}
	function get_testimonial_ids()
	{
        $testimonial_ids = array();		
		$table_exist = $this->table_exists(TBL_TESTIMONIALS);
		if($table_exist == 1)
		{
		$SQL_QUERY = "	SELECT 
								id,testimonial_image_1,testimonial_image_2
						FROM 	
								".TBL_TESTIMONIALS."
						WHERE  
								status = 1
						AND 
								testimonial_image_2 != ''
						AND
								testimonial_featured = 1 ";

		$testimonial_ids	 = $this->run_query($SQL_QUERY);	
		}
		
		return $testimonial_ids;	
	}
	
	function get_testimonial_details($testimonial_random_id)
	{
        $testimonial_data = array();		
		$table_exist = $this->table_exists(TBL_TESTIMONIALS);
		if($table_exist == 1)
		{
			$SQL_QUERY = "	SELECT 
								*
						FROM 	
								".TBL_TESTIMONIALS."
						WHERE  
								id=".$testimonial_random_id;
								
			$testimonial_data	 = $this->run_query($SQL_QUERY);	
		}
		
		return $testimonial_data;
	}
	


        function get_faq_category_list()
        {
         $CI 		= & get_instance();
		 $page_name   	= $CI->uri->segment(1);
		 $module_name   = $CI->uri->rsegment(1);
		 $faq_category_list   = array();		 
		 $table_exist = $this->table_exists(FAQ_CATEGORY);
		if($table_exist == 1)
		{
		 $SQL_C2A = "SELECT * from  ".FAQ_CATEGORY." ORDER BY rank ";
		 $faq_category_list = $this->run_query($SQL_C2A);
		}
		 return $faq_category_list;
            
        }
        
        function get_category_records($id)
        {
          $CI 		= & get_instance();
		 $page_name   	= $CI->uri->segment(1);
		 $module_name   = $CI->uri->rsegment(1);
		 $faq_category_records   = array();	     
		 $table_exist = $this->table_exists(TBL_FAQ);
		if($table_exist == 1)
		{
		 $SQL_C2A = "SELECT * FROM  ".TBL_FAQ."  WHERE category_id = ".$id." AND status = 1 ";
		 $faq_category_records = $this->run_query($SQL_C2A);
		}
		 return $faq_category_records;
            
        }
		
	function get_recent_catelogue_image()
	{
		$flipbook_image = array();		
		$table_exist = $this->table_exists(TBL_CATALOGUE_IMAGES);

		if($table_exist == 1)
		{
			$SQL_QUERY = "	SELECT 
								image
						FROM 	
								".TBL_CATALOGUE_IMAGES."
						WHERE  
								status=1
						ORDER BY
								created desc 
						LIMIT
								0,2";
								
			$flipbook_image	 = $this->run_query($SQL_QUERY);		
		}
		return $flipbook_image;
		
	}
	
	function below_banner_snippet()
	{		
		$snippet_details = array();		
		$table_exist_c2a_panel = $this->table_exists(TBL_C2A_PANEL);
		$table_exist_c2a_category = $this->table_exists(TBL_C2A_CATEGORY);
		if($table_exist_c2a_panel == 1 && $table_exist_c2a_category == 1)
		{
			$SQL_QUERY = "	SELECT 
								a.*, b.*
						FROM 	
								".TBL_C2A_PANEL."  a,
								".TBL_C2A_CATEGORY."  b
						WHERE  
								a.status=1
						AND 
								a.c2a_category = b.id
						AND
								a.c2a_category = 2
						ORDER BY
								a.created desc
						LIMIT
								0,4";
			$snippet_details	 = $this->run_query($SQL_QUERY);					
		}
			
		
		return $snippet_details;
	}
	
	function get_c2a_flipbook_icon()
	{
		
		$flipbook_details = array();
		
		$table_exist_c2a_panel = $this->table_exists(TBL_C2A_PANEL);
		$table_exist_c2a_category = $this->table_exists(TBL_C2A_CATEGORY);
		if($table_exist_c2a_panel == 1 && $table_exist_c2a_category == 1)
		{
		$SQL_QUERY = "	SELECT 
								a.*, b.*
						FROM 	
								".TBL_C2A_PANEL."  a,
								".TBL_C2A_CATEGORY."  b
						WHERE  
								a.status=1
						AND 
								a.c2a_category = b.id
						AND
								a.c2a_category = 3
						AND
								a.c2a_heading = 'Flipbook'
						AND
								a.c2a_panel=0
						LIMIT
								0,1";
								
		
		$flipbook_details	 = $this->run_query($SQL_QUERY);	
		}
		return $flipbook_details;
	}
	
	function get_c2a_newletter_icon()
	{
		$newsletter_details = array();
		
		$table_exist_c2a_panel = $this->table_exists(TBL_C2A_PANEL);
		$table_exist_c2a_category = $this->table_exists(TBL_C2A_CATEGORY);
		if($table_exist_c2a_panel == 1 && $table_exist_c2a_category == 1)
		{
		$SQL_QUERY = "	SELECT 
								a.*, b.*
						FROM 	
								".TBL_C2A_PANEL."  a,
								".TBL_C2A_CATEGORY."  b
						WHERE  
								a.status=1
						AND 
								a.c2a_category = b.id
						AND
								a.c2a_category = 3
						AND
								a.c2a_heading = 'Newsletter Signup'
						AND
								a.c2a_panel=0
						LIMIT
								0,1";
								
		
		$newsletter_details	 = $this->run_query($SQL_QUERY);	
		}
		return $newsletter_details;
	}
	
	function load_c2a_view($c2a_category,$c2a_heading)
	{
		$c2a_view_details ='';
		
		$table_exist_c2a_panel = $this->table_exists(TBL_C2A_PANEL);
		$table_exist_c2a_category = $this->table_exists(TBL_C2A_CATEGORY);
		if($table_exist_c2a_panel == 1 && $table_exist_c2a_category == 1)
		{
		$SQL_QUERY = "	SELECT 
								a.*, b.*
						FROM 	
								".TBL_C2A_PANEL."  a,
								".TBL_C2A_CATEGORY."  b
						WHERE  
								a.status=1
						AND 
								a.c2a_category = b.id
						AND
								b.c2a_category = '".$c2a_category."'
						AND
								a.c2a_heading = '".$c2a_heading."'
						Order By 
								a.created
						LIMIT
								0,1";
								
		
		$c2a_view_details	 = $this->run_query($SQL_QUERY);
		return $c2a_view_details[0]['c2a_link'];
		}
		else
		{
		 return $c2a_view_details;
		}
		
		
	}
	
	function load_frontend_menu($menu_category_level)
	{
		$menu_list = array();
		
		$table_exist_menu = $this->table_exists(TBL_MENU_MANAGEMENT);
		$table_exist_category_level = $this->table_exists(TBL_MENU_CATEGORY_LEVEL);
		$table_exist_page = $this->table_exists(TBL_PAGE);
		
		$sql = "SELECT 	*  FROM ".TBL_WEB_MAGNET."";	
						
		$web_magnet = $this->run_query($sql);
		if($web_magnet[0]['test_data'] == 1)
		{
			$test_record = '';
		}
		else
		{
			$test_record = ' AND b.testdata = 0 ';
		}
		
		if($table_exist_menu == 1 && $table_exist_category_level == 1 && $table_exist_page == 1)
		{
		
			$SQL_QUERY = "SELECT 
								a.*,b.* ,c.page_name
					  FROM
								".TBL_MENU_CATEGORY_LEVEL." a, ".TBL_MENU_MANAGEMENT." b, ".TBL_PAGE." c
					  WHERE
								a.id = b.menu_category_level
					  AND 
								b.status = 1
					  AND 
								menu_category_sef_name = '".$menu_category_level."'
					  AND 
								c.id = b.menu_url ".$test_record."
					  Order By 
								b.rank,b.id";
								
			$menu_primary	 = $this->run_query($SQL_QUERY);	
			
			$SQL_EXTERNAL_QUERY =
					"SELECT 
								a.*,b.*
					  FROM
								".TBL_MENU_CATEGORY_LEVEL." a, ".TBL_MENU_MANAGEMENT." b
					  WHERE
								a.id = b.menu_category_level
					  AND 
								b.status = 1
					  AND 
								menu_category_sef_name = '".$menu_category_level."'
					  AND 
								b.external_link = 1 ".$test_record."
					  Order By 
								b.rank,b.id";
								
			$menu_external	 = $this->run_query($SQL_EXTERNAL_QUERY);	
			
			if(is_array($menu_external) && count($menu_external) > 0)
			{
				$menu_list = array_merge($menu_primary,$menu_external);
			}
			else
			{
				if(is_array($menu_primary) && count($menu_primary) > 0)
					$menu_list = $menu_primary;
			}
			
		}
		return $menu_list;
		
	}
	
	function load_c2a_map($page,$c2a_panel)
	{
		$page_details = array();		
		$table_exist_c2a_panel = $this->table_exists(TBL_C2A_PANEL);
		$table_exist_c2a_category = $this->table_exists(TBL_C2A_CATEGORY);
		$table_exist_c2a_panel_map = $this->table_exists(TBL_C2A_PANEL_MAP);
		$table_exist_page = $this->table_exists(TBL_PAGE);
		

		if($table_exist_c2a_panel == 1 && $table_exist_c2a_category == 1 && $table_exist_c2a_panel_map == 1 && $table_exist_page == 1 )
		{
			$SQL_QUERY = "SELECT 
							a.c2a_link,a.c2a_heading
					FROM 
						".TBL_PAGE." b, 
						".TBL_C2A_PANEL_MAP." c,
						".TBL_C2A_PANEL." a,
						".TBL_C2A_CATEGORY." d
					WHERE 
							b.page_name = '".$page."'
					AND 
							b.id = c.page_id
					AND 
							c.c2a_id = a.id
					And
							a.c2a_category = d.id
					And
							a.status = 1
					AND 
							d.c2a_category = '".$c2a_panel."'";
		
		$page_details = $this->run_query($SQL_QUERY);	
		}
		return $page_details;
	}
	
	function get_pages()
	{
		$SQL_DPCS ="SELECT 
												id,page_name
									FROM 	
												".TBL_PAGE."
									WHERE 
													STATUS = 1
							";
		$dpcs_pages = $this->run_query($SQL_DPCS);	
		if(is_array($dpcs_pages) && count($dpcs_pages)>0)
		{
			foreach($dpcs_pages as $page_details)
			{
					$pages[] = $page_details['page_name'];
			}
		}
		return $pages;
	}
	
	function load_multi_sites()
	{
		$table_exist_multi_site = $this->table_exists(TBL_MULTI_SITE);
		$multisite_details = array();
		if($table_exist_multi_site == 1 )
		{
			$SQL_QUERY = "SELECT 
								id,url
						FROM 	
								".TBL_MULTI_SITE." 
						WHERE  
								status = 1
					";
								
		
			$multisite_details	 = $this->run_query($SQL_QUERY);	
		}
		return $multisite_details;
	}
	
	function get_multi_site_status()
	{
		$SQL_QUERY = "SELECT 
								status
						FROM 	
								".TBL_PAGE." 
						WHERE  
								id = 233
					";
								
		
		$status	 = $this->run_query($SQL_QUERY);	
		
		return $status;
	}
 }
// END Input class

/* End of file C2A.php */
/* Location: ./application/libraries/C2a.php */