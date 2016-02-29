<?php
class page_DB_Interaction extends CI_Model
{
	var $table_name 	= TBL_PAGE;
	
	function __construct()
	{
		// call the Model constructor
		parent::__construct();

	}
	
	function run_query($query)
	{
		$result_set = $this->db->query($query);
		if($result_set->num_rows > 0)
			return $result_set->result_array();
	}
	
	function table_exists($table){
		//Check if table exists		
		$exists = 0; 
		$result = $this->db->query("SHOW TABLES LIKE '".$table."'");			
		if($result->num_rows > 0); 
		{ 
			$exists = 1; 
		} 
		return $exists; 
	}	
	
	
	
	/**
	 * Get All records
	 *
	 * Lets you fetch all the records.
	 *
	 * @access	public
	 * @param	string
	 * @return	array
	 */	
	function get_all_records($order_by=NULL)
	{
		if ($order_by != NULL)
			$this->db->order_by($order_by);
			
		$query=$this->db->get($this->table_name);
		if($query->num_rows()>0)
		{
			// return result set as an associative array
			return $query->result_array();
		}
	}
	/**
	 * Get All records For Web Mangnet SEO
	 *
	 * Lets you fetch all the records.
	 *
	 * @access	public
	 * @param	string
	 * @return	array
	 */	
	function get_all_records_webmagnet()
	{
		$query=$this->db->get(TBL_WEBMAGNET);
		if($query->num_rows()>0)
		{
			// return result set as an associative array
			return $query->result_array();
		}
	}
	
	/**
	 * Get All records Object
	 *
	 * Lets you fetch all the records.
	 *
	 * @access	public
	 * @return	object - the whole object query is returned
	 */	
	function get_all_records_object($select="*",$where=array(),$order_by=NULL,$offset=NULL,$limit=NULL)
	{
		$this->db->select($select);
		
		//add where clause processing here if required
        $this->db->where($where);		
            
        //$this->db->having($having);
        
        if ($offset != NULL)
            $this->db->offset($offset);
			
        if ($limit != NULL)
            $this->db->limit($limit);
			
        if ($order_by != NULL)
			$this->db->order_by($order_by);
			
		$query=$this->db->get($this->table_name);
		// return result set as an associative array
		return $query;		
	}
	
	/**
	 * Get records Where
	 * 
	 * Lets you fetch all the records depending on the where condition.
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	array
	 */	
	function get_records_where($field,$param)
	{
		$this->db->where($field,$param);
		$query=$this->db->get($this->table_name);
		// return result set as an associative array
		return $query->result_array();
	}
	/**
	 * Get Limit records Where
	 * 
	 * Lets you fetch records using the LIMIT clause
	 * This is mainly used for pagination
	 *
	 * @access	public
	 * @param	string
	 * @param	integer
	 * @param	array
	 * @return	array
	 */		
	function get_limit_records_where($row,$limit=0,$where)
	{
		$query=$this->db->get_where($this->table_name,$where,$limit,$row);
		if($query->num_rows()>0)
		{
			// return result set as an associative array
			return $query->result_array();
		}
	}
	
	/**
	 * Get Num records
	 * 
	 * Lets you fetch total number of records
	 *
	 * @access	public
	 * @return	integer
	 */
	function get_num_records()
	{
		return $this->db->count_all($this->table_name);
	}
	
	/**
	 * Get Num records Where
	 * 
	 * Lets you fetch total number of records depending on the where condition
	 *
	 * @access	public
	 * @param	array
	 * @return	integer
	 */
	function get_num_records_where($params)
	{
		$this->db->where($params);
		$query=$this->db->get($this->table_name);
		// return result set as an associative array
		return count($query->result_array());
	}
	
	/**
	 * Add Web Magnet
	 * 
	 * Lets you add web magent to the table
	 *
	 * @access	public
	 * @param	array	
	 */
	function add_webmagnet($data=array())
	{
		if(count($data) >  0){
			$this->db->insert(TBL_WEBMAGNET, $data);
		}
	}
	/**
	 * Add User
	 * 
	 * Lets you add user to the table
	 *
	 * @access	public
	 * @param	array	
	 */	
	function add_user($data=array())
	{
		$this->db->insert($this->table_name, $data); 
	}
	
	/**
	 * Update User
	 * 
	 * Lets you update user depending on the id specified
	 *
	 * @access	public
	 * @param	integer
	 * @param	array	
	 */	
	function update_user($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table_name, $data);
 
	}
	/**
	 * Update seo data
	 * 
	 * Lets you update seo data depending on the condition specified
	 *
	 * @access	public
	 * @param	integer
	 * @param	array
	 */	
	function update_seodata($where,$data)
	{
		$this->db->where($where);
		$this->db->update($this->table_name, $data);
 
	}
	/**
	 * Update Web Magnet
	 * 
	 * Lets you update web magent data
	 *
	 * @access	public
	 * @param	array	
	 */	
	function update_webmagnet($data)
	{
		$this->db->update(TBL_WEBMAGNET, $data); // update the seo_webmagenet table
		
		
 	}
	
	/**
	 * Delete User
	 * 
	 * Lets you delete user depending on the id specified
	 *
	 * @access	public
	 * @param	integer
	 */	
	function delete_user($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table_name);
 
	}
		
	/**
	 * Get Search User
	 * getSearchrecords
	 * Lets you delete user depending on the id specified
	 *
	 * @access	public
	 * @param	array
	 * @param	array
	 * @return	array
	 */	
	function get_search_records($params=array(),$where=array())
	{
		$this->db->where($where);
		$this->db->like($params); 
		$query=$this->db->get($this->table_name);
		if($query->num_rows()>0)
		{
			// return result set as an associative array
			return $query->result_array();
		}
	}
	
	/**
	 * Get Records Use Query
	 * 
	 * Lets you build you own query and then run
	 *
	 * @access	public
	 * @param	string
	 * @param	array
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	array
	 */	
	function get_records_use_query($where="",$like=array(),$offset=NULL,$limit=NULL,$order_by=NULL)
	{
		$query = "";
		
		$query .= " SELECT * FROM (`".$this->table_name."`) ";
		if(!empty($where))
		{
			$query .= " WHERE $where ";	
			
			$cnt = array($like);
			if (!empty($like) && is_array($like) && $cnt > 0)
			{
				$query .= " AND ( ";					
				foreach($like as $field=>$value)			
				{
					$temp_arr[] = " `$field` LIKE '%".$value."%' ";
				}		
				$query .= implode(" OR ",$temp_arr);;			
				$query .= " ) ";		
			}			
			
		}
		
	 	if ($order_by != NULL)
		{
			$query .= " ORDER BY $order_by ";
		}		
			
        if ($limit != NULL)
		{
            $query .= " LIMIT $limit ";
			
			if ($offset != NULL)
				$query .= " , $offset ";	
		}	
				
		$query=$this->db->query($query);
		if($query->num_rows()>0)
		{
			// return result set as an associative array
			return $query->result_array();
		}
	}
	
	function get_records($offset, $limit,$where=array(),$like=array(),$or_like=array(),$order_by='')
    {
        //add where clause processing here if required
        $this->db->where($where);		
		
        $this->db->select('*');    
        //$this->db->having($having);
        
        if ($offset != NULL)
            $this->db->offset($offset);
        if ($limit != NULL)
            $this->db->limit($limit);
			
        if ($order_by != NULL)
			$this->db->order_by($order_by);
		
		if (!empty($like) && is_array($like))
			$this->db->like($like[0],$like[1]);
		
		if (!empty($or_like) && is_array($or_like))
		{
			$cnt = count($or_like);
			for($i=0 ; $i < $cnt ; $i++)			
				$this->db->or_like($or_like[$i][0],$or_like[$i][1]); 
		}
        if ($limit == NULL && $offset == NULL)
        {
            $count = $this->db->get($this->table_name);
            return $count->result_array();
        }
        else
		{
			$query = $this->db->get($this->table_name);
            return $query->result_array();
		}	
    }
	
	function get_records_like_only($offset, $limit,$where=array(),$like=array(),$order_by='')
    {
        //add where clause processing here if required
        $this->db->where($where);		
		
        $this->db->select('*');    
        //$this->db->having($having);
        
        if ($offset != NULL)
            $this->db->offset($offset);
        if ($limit != NULL)
            $this->db->limit($limit);
			
        if ($order_by != NULL)
			$this->db->order_by($order_by);
				
		if (!empty($like) && is_array($like))
		{	
			$this->db->like($like); 
		}
        if ($limit == NULL && $offset == NULL)
        {
            $count = $this->db->get($this->table_name);
            return $count->result_array();
        }
        else
		{
			$query = $this->db->get($this->table_name);
            return $query->result_array();
		}	
    }
	
	// Allow to user to be subscriber from any other modules
	function get_newsletter_where($email,$grp_id)
	{
		$sql = "SELECT id,status from ".TBL_SUBSCRIBER." WHERE e_email = '".$email."' AND e_group_id = ".$grp_id."";
		$result_set = $this->db->query($sql);
		if($result_set->num_rows > 0)
			return $result_set->result_array();		
	}
	
	function update_subscriber($name,$email,$grp_id)
	{ 
                $user=$this->session->userdata("user");
		// THIS UPDATES THE DETAILS FOR THE GROUP ID - 2 (ALL SUBSCRIBER FROM FRONTEND)
				
		$sql_update_frontend = "UPDATE 
											".TBL_SUBSCRIBER."  
								SET
											e_name = ".$this->db->escape($name).",
											modified = '".date("Y-m-d H:i:s")."',
											modified_by = ".$this->db->escape((isset($user)) ? $user : '').",
											STATUS = 0
								WHERE 
												e_email = ".$this->db->escape($email)."
										    AND
										        e_group_id = 	".$grp_id."
								"; 
		$this->db->query($sql_update_frontend);		
		
		//THIS UPDATES THE DETAILS FOR THE ALL SUBSCRIBERS 
		//(WHENEVER SUBSCRIBER SUBSCRIBER FROM FRONT END THE SUBSCRIBER ALSO GET SUBSCRIBED TO ALL SUBSCRIBERS)
		$sql_all = "UPDATE 
												".TBL_SUBSCRIBER." 
									SET
												e_name 		= ".$this->db->escape($name).",
												modified 	= '".date("Y-m-d H:i:s")."',
												modified_by = ".$this->db->escape((isset($user)) ? $user : '').",
												status = 0
									WHERE
													e_email = ".$this->db->escape($email)."
												AND
														e_group_id = 	".ALLSUBSCRIBER."			
					";
		$this->db->query($sql_all); 
	}
	
	function web_magnet()
	{
		$sql = "SELECT 
						*
				  FROM 
				  		".TBL_WEB_MAGNET."";			
		$web_magnet = $this->run_query($sql);				
		
		if(is_array($web_magnet) && count($web_magnet)>0)
			$data = $web_magnet[0];
		else
			$data = '';
			
                
                $sql_gtm = "SELECT 
						*
				  FROM 
				  		".TBL_GTM."";			
		$gtm = $this->run_query($sql_gtm);				
		
		if(is_array($gtm) && count($gtm)>0)
			$data['gtm'] = $gtm[0];
		else
			$data['gtm'] = '';
			
                
		return $data;		
	}
  
        
        
  	function health_check()
	{
		$sql = "SELECT 
						test_data,testbed_login
				  FROM 
				  		".TBL_HEALTH_CHECK."";			
		$health_check_arr = $this->run_query($sql);				
		
		if(is_array($health_check_arr) && count($health_check_arr)>0)
    {
			$data = $health_check_arr[0];
    } 
    else
      {
        $data = '';
      }
		return $data;		
	}
	//--------------------------------------------------------------------------
	function add_newsletter($name,$email,$grp_id)
	{
		//THIS ADDS THE DETAILS FOR THE GROUP ID - 2 (ALL SUBSCRIBER FROM FRONTEND)
		$user=$this->session->userdata("user");
                
		$sql = "INSERT INTO 
									".TBL_SUBSCRIBER."
							 SET
									e_name  	= ".$this->db->escape($name).",		
									e_email 	= ".$this->db->escape($email)." ,		
									created		= '".date("Y-m-d H:i:s")."',	
									created_by 	= ".$this->db->escape((isset($user)) ? $user : '').",	
									e_group_id 	= ".$grp_id.",
									STATUS 		= 0
							   ";
		
		$this->db->query($sql);
		
		//THIS ADD THE DETAILS FOR THE ALL SUBSCRIBERS 
		//(WHENEVER SUBSCRIBER SUBSCRIBER FROM FRONT END THE SUBSCRIBER ALSO GET SUBSCRIBED TO ALL SUBSCRIBERS)
		$sql_select = "SELECT 
									COUNT(*) AS SUBSCRIBER_COUNT
							FROM 
									e_subscribers 
							WHERE 
										e_email=".$this->db->escape($email)."
									 AND
										e_group_id=".ALLSUBSCRIBER."
							";
			$check_subscriber = $this->run_query($sql_select);
			
			if(is_array($check_subscriber) && $check_subscriber[0]['SUBSCRIBER_COUNT']==0)
			{
				$sql_insert = "INSERT INTO 
											".TBL_SUBSCRIBER."
									  SET
												e_name  	= ".$this->db->escape($name).",		
												e_email 	= ".$this->db->escape($email)." ,		
												created		= '".date("Y-m-d H:i:s")."',	
												created_by 	= ".$this->db->escape((isset($user)) ? $user : '').",	
												e_group_id 	= ".ALLSUBSCRIBER.",
												STATUS 		= 0
							   ";
				$this->db->query($sql_insert);	
			}	 
	}
	
	/*
	| We are Copying the Modified by Date in both the Columne of the Unsubscriber log Since
	| CREATED Entry in unsubscriber log is equivalent to the Unsubscribed date of subscriber
	| MODIFIED Entry in Unsubscriber log is Equivalent to the Subscribed again  date of subscriber 
	|
	*/
	function newsletter_log($email,$grp_id)
	{
	//THIS MAINTAINS THE LOG HISTORY OF THE UNSUBSCRIBER WHO WISHES TO SUBSCRIBE AGAIN 
	$sql_frontend = "INSERT INTO
				".TBL_EXAVMAIL_UNSUBSCRIBER_LOG." 
				(
					e_name,
					e_email,
					e_group_id,
					created_by,
					modified_by,
					status,
					created,
					modified
				 )
				SELECT 
					e_name,
					e_email,
					e_group_id,
					created_by,
					modified_by,
					status,
					modified, 
					modified
				FROM ".TBL_SUBSCRIBER." s
				WHERE s.e_email=".$this->db->escape($email)." AND s.e_group_id = ".$grp_id."
			 ";

			$this->db->query($sql_frontend); 
	
	//THIS MAINTAINS THE LOG HISTORY OF THE UNSUBSCRIBER WHO WISHES TO SUBSCRIBE AGAIN 
			//THE ENTRY IS MADE TWICE SINCE THE SUBSCRIBER ENTRY WAS ALSO MADE IN THE RESPECTIVE GROUP AND ALSO IN THE ALL SUBSCRIBER SO IF THE SUBSRIBER IS UNSUBSCRIBED FOR THE NEWSLETTER HE ALSO GETS UNSUBSCRIBED FROM THE ALL SUBSCRIBER .HANCE NEED TO MAINTAIN THE LOG HISTORY
			 	
		$sql_all = "INSERT INTO
				".TBL_EXAVMAIL_UNSUBSCRIBER_LOG." 
				(
					e_name,
					e_email,
					e_group_id,
					created_by,
					modified_by,
					status,
					created,
					modified
				 )
				SELECT 
					e_name,
					e_email,
					e_group_id,
					created_by,
					modified_by,
					status,
					modified,
					modified
				FROM ".TBL_SUBSCRIBER." ALL_SUBSCRIBER
				WHERE 
							ALL_SUBSCRIBER.e_email=".$this->db->escape($email)."
						 AND
						    ALL_SUBSCRIBER.e_group_id = ".ALLSUBSCRIBER."
			 ";

			$this->db->query($sql_all); 			
			
	}
	
	//----------------------------------------------------------------------------------------------------
	/*
	| Function to Get the Group Details and Email Subscribed Group
	*/
	function get_frontend_groups()
	{
		$frontend_group = array();
		
		 $table_exist = $this->table_exists(TBL_GROUP);
		if($table_exist == 1)
		{
			$SQL_GROUP = "SELECT 
													id,
													frontend_group_title
 									 FROM
													".TBL_GROUP."
									 WHERE
															frontend_status=1
													AND
															status<>2	
								";
			$frontend_group = $this->run_query($SQL_GROUP);	
		}
		return $frontend_group;
	}
	//----------------------------------------------------------------------------------------------------
	/*
	| Function to Get the Group Details and Email Subscribed Group
	*/
	function get_subscriber_group($subscriber_email)
	{
		 $SQL_SAVED_PREFERENCES = "SELECT 	
																			id,
																			e_group_id
																FROM
																			".TBL_SUBSCRIBER." 
																WHERE
																					e_email=".$this->db->escape($subscriber_email)."
																			AND
																					STATUS<>2
															";						
		$saved_preferences = $this->run_query($SQL_SAVED_PREFERENCES);
		return $saved_preferences;
	}
	//----------------------------------------------------------------------------------------------------
	/*
	| Function to Get Links of Unsent Campaign
	*/
	function get_unsent_list_campaign($ids,$subscriber_id)
	{
			$SQL_GETLINKS_UNSENTCAMPAIGN = "SELECT  
																							id,e_title
																			FROM 
																							".TBL_NEWSLETTER."
																			WHERE 
																								SUBSTRING(e_newsletter_status,1,8)='Finished'
																						AND 	
																								preview_email_template <> ''
																						AND 
																								status <> 2
																						AND    
																								e_group_id = ".$ids."
																						AND ID IN (
																													SELECT 	
																																	exa_newsletter_id
																														FROM 
																																	".TBL_EXAVMAIL."
																														WHERE 
																																			exa_group_id =".$ids."
																																	AND 
																																			exa_subscriber_id = ".$subscriber_id."
																																	AND 
																																			exa_status = 'marked as sent'
																											)
																		"; 
			$links_unsent_campaign = $this->run_query($SQL_GETLINKS_UNSENTCAMPAIGN);
			return $links_unsent_campaign;	
	}
	
	//---------------------------------------------------------------------------------------------------------------
	/*
	| Used in the MEMBERS MY Account
	| When Susbcriber wished to Unsubscribe from all the groups using My Acccount Facility
	*/
	function memberlog_unsubscriber($member_email)
	{
		$SQL_MEMBER_UNSUBSCRIBER = "INSERT INTO ".TBL_EXAVMAIL_UNSUBSCRIBER_LOG."	
																			(e_name,e_email,e_group_id,created_by,modified_by,STATUS,created,modified)
																SELECT 
																			e_name,e_email,e_group_id,created_by,modified_by,STATUS,modified,modified
																FROM 
																			".TBL_SUBSCRIBER." SUBSCRIBER
																WHERE 
																				SUBSCRIBER.e_email = ".$this->db->escape($member_email)." 
																		AND 
																				SUBSCRIBER.e_group_id NOT IN (".EGROUPID.",".ALLSUBSCRIBER.")
															";
		$this->db->query($SQL_MEMBER_UNSUBSCRIBER);													
	}
	
	//------------------------------------------------------------------------------------------------------------------
	/*
	| Function to Unsubscribe Members from My Account
	| This Unsubscribes User from the selected Group only
	*/
	function member_selected_unsubscribe($group_ids,$member_email)
	{
		  $SQL_MEMBER_UNSUBSCRIBE = "UPDATE
																				".TBL_SUBSCRIBER."
																	SET	
																				status = 2
																	WHERE 
																				 e_email= ".$this->db->escape($member_email)."
																			AND 
																				 e_group_id IN (".$group_ids.")
																";
			$this->db->query($SQL_MEMBER_UNSUBSCRIBE);
			
			//----------------LOG THE UNSUBSCRBE DATA------------	
			$SQL_MEMBER_UNSUBSCRIBER = "INSERT INTO ".TBL_EXAVMAIL_UNSUBSCRIBER_LOG."	
																			(e_name,e_email,e_group_id,created_by,modified_by,STATUS,created,modified)
																SELECT 
																			e_name,e_email,e_group_id,created_by,modified_by,STATUS,modified,modified
																FROM 
																			".TBL_SUBSCRIBER." SUBSCRIBER
																WHERE 
																				SUBSCRIBER.e_email = ".$this->db->escape($member_email)." 
																		AND 
																				SUBSCRIBER.e_group_id IN (".$group_ids.")
															";
		$this->db->query($SQL_MEMBER_UNSUBSCRIBER);													
	}
        
}

?>