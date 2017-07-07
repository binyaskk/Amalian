<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Role  extends CI_Model
{
	/*
	Determines if a given user_id is exist
	*/
	public function exists($role_id)
	{
		$this->db->from('roles');	
		$this->db->where('roles.role_id',$role_id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}	
	
	/*
	Returns all the users
	*/
	public function get_all($limit=10000, $offset=0)
	{
		$this->db->from('roles');	
		$this->db->order_by("role_id", "asc");
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
		
	}
	
	
	public function count_all()
	{
		$this->db->from('roles');
		return $this->db->count_all_results();
	}
	
	public function check_rolename($rolename,$role_id)
	{
	    $this->db->from('roles');
	    $this->db->where('role_name',$rolename);
	    $this->db->where_not_in('role_id',$role_id);
	    return $this->db->count_all_results();
	}
	
	
	public function get_rolename_role_id($rolename)
	{
		$this->db->select('role_id');
        $this->db->from('roles');
        $this->db->where('role_name', $rolename);
		 $query = $this->db->get();
		$role_id=-1;
       if ($query->num_rows() > 0) {

        $result = $query->row_array();
        return $role_id=$result['role_id'];
	   }
	   else {
		    return -1;
	   }
		
	}
	
	
	
	/*
	Gets information about a particular user
	*/
	public function get_info($role_id)
	{
		$this->db->from('roles');	
		$this->db->where('roles.role_id',$role_id);
		$query = $this->db->get();
		//log_message('debug','id='.$role_id .',qury='.$query->num_rows());
		if ($query->num_rows()==1) {
			return $query->row();
		}
		else {
			//Get empty base parent object
			$role_obj=new stdClass;
			//Get all the fields from user table
			$fields = $this->db->list_fields('roles');
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field) {
				$role_obj->$field='';
			}
			return $role_obj;
		}
	}
	
	
	/*
	Gets information about multiple users
	*/
	public function get_multiple_info($roles_id)
	{
		$this->db->from('roles');	
		$this->db->where_in('roles.role_id',$roles_id);
		$this->db->order_by("role_name", "asc");
		return $this->db->get();		
	}
	
	/*
	Inserts or updates an user
	*/
	public function save(&$role_data, &$rolelog_data,&$permission_data,$role_id=false)
	{
		$success=false;
        //log_message('debug', implode("|",$role_data));
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();	
		
			if (!empty($role_data)) {
				//log_message('debug', $role_id);
				if (!$role_id or !$this->exists($role_id)) {
                    
                    if ($this->db->insert('roles',$role_data)) {
                        $role_data['role_id']=$this->db->insert_id();
                        $rolelog_data['role_id'] = $role_id = $role_data['role_id'];
                        $success= true;
                     }else{
                        $success= false;
                    }
			    }
			    else {
				$this->db->where('role_id', $role_id);
				$success = $this->db->update('roles',$role_data);	
                    
			    }
				
				
			}
			else {
				$success=true;
			}
			
			
			//We have either inserted or updated a new user, now lets set permissions. 
			if ($success) {
				//First lets clear out any permissions the user currently has.
				$success=$this->db->delete('role_permissions', array('role_id' => $role_id));
				
				//Now insert the new permissions
				if ($success) {
					foreach ($permission_data as $allowed_module) {
						$success = $this->db->insert('role_permissions',
						array(
						'module_id'=>$allowed_module,
						'role_id'=>$role_id));
					}
				}
			}
			
		
		$this->db->trans_complete();		
		return $success;
	}
	
	
	
	/*
	Deletes one user
	*/
	/*public function delete($users_id)
	{
		$success=false;
		
		//Don't let user delete their self
		if ($users_id==$this->get_logged_in_user_info()->user_id){
			return false;
		}
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		
		//Delete permissions
		if ($this->db->delete('permissions', array('user_id' => $users_id))) {	
			$this->db->where('user_id', $users_id);
			$success = $this->db->update('users', array('active' => 1));
			
			$this->db->where('user_id', $users_id);
			$success = $this->db->update('users', array('deleted' => 1));
		}
		$this->db->trans_complete();		
		return $success;
	}*/
	
	/*
	Deletes a list of users
	*/
	/*public function delete_list($user_ids)
	{
		$success=false;
		 
		//Don't let user delete their self
		if(in_array($this->get_logged_in_user_info()->user_id,$user_ids))
			return false;

		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		$this->db->where_in('user_id',$user_ids);
		if ($this->db->delete('permissions')) {       //Delete permissions
		    $this->db->where_in('user_id',$user_ids);
			$success = $this->db->update('eum_users', array('deleted' => 1));
		}
		$this->db->trans_complete();		
		return $success;
 	}*/
	
	/*
	Get search suggestions to find users
	*/
	public function get_search_suggestions($search,$limit=5)
	{
		$suggestions = array();
		
		$this->db->select('role_name');
		$this->db->from('roles');		
		$this->db->where("(	role_name LIKE '%".$this->db->escape_like_str($search)."%'
	    )");		
		$this->db->order_by("role_name", "asc");
		
		$by_name = $this->db->get();
		foreach ($by_name->result() as $row) {
			$suggestions[]=$row->role_name;		
		}

		
		return $suggestions;
	
	}
	
	/*
	Preform a search on users
	*/
	public function search($search)
	{	
	    $this->db->from('roles');	
		$this->db->where("(	role_name LIKE '%".$this->db->escape_like_str($search)."%'");		
		$this->db->order_by("role_name", "asc");
		return $this->db->get();		
	}
	
	/*
	Determins whether the user specified has access the specific module.
	*/
	public function has_permission($module_id,$role_id)
	{
		//if no module_id is null, allow access
		if($module_id==null) {
			return true;
		}
		
        
		//$query = $this->db->get_where('permissions', array('user_id' => $user_id,'module_id'=>$module_id), 1);
        
        $this->db->from('role_permissions');
        $this->db->where('role_id',$role_id);
        $this->db->where('module_id',$module_id);
        $query = $this->db->get();

        
		return $query->num_rows() == 1;
		return false;
	}

}
