<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once ("Secure_area.php");
require_once ("interfaces/Idata_controller.php");
class Roles extends Secure_area implements iData_controller
{
	public function __construct()
	{
        //$this->load->model('Role');
		parent::__construct('roles');
	}
	
	public function index()
	{
        //echo "1";
		$config['base_url'] = site_url('users/roles/index');
		$this->load->library('pagination'); 
		$config['total_rows'] = $this->Role->count_all();
		$config['per_page'] = $this->config->item('pagination_limit'); //Get page limit from config settings 
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['controller_name']=strtolower(get_class());
		$data['controller_path']=$this->router->fetch_module()."/".$this->router->fetch_class();;
		$data['form_width']=$this->get_form_width();
		$data['content_view']='users/roles/manage';
 
		$data['manage_table']=get_role_manage_table( $this->Role->get_all( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ), $this );
		$this->load->module("template");
		$this->template->manage_tables_template($data);
 
	}
	
	/*
	Returns user table data rows. This will be called with AJAX.
	*/
	public function search()
	{
		$search=$this->input->post('search');
		$data_rows=get_role_manage_table_data_rows($this->Role->search($search),$this);
		echo $data_rows;
	}
	
	public function get_row()
	{
		$role_id = $this->input->post('row_id');
		$data_row=get_role_data_row($this->Role->get_info($role_id),$this);
		echo $data_row;
	}
	/*
	Gives search suggestions based on what is being searched for
	*/
	public function suggest()
	{
		$suggestions = $this->Role->get_search_suggestions($this->input->post('q'),$this->input->post('limit'));
		echo implode("\n",$suggestions);
	}
	
		
	
	/*
	Loads the user edit form
	*/
	public function view($role_id=-1)
	{
		// get all user details by user id
	    $data['role_info']=$this->Role->get_info($role_id);
		
		$data['all_modules']=$this->Module->get_editable_modules();

		
		if ($role_id==-1) {//new user
		    $this->load->view("users/roles//new_role_form",$data);
		}
	    else {
		    $this->load->view("users/roles/form",$data);
	    }
	}
	
	
	
	/*
	Inserts/updates an user
	*/
	public function save($role_id=-1)
	{
		//$this->load->library('bcrypt');
        $rolelog_data['$role_id']=$role_id;
	    //server side validation
		$this->form_validation->set_rules('role_name', $this->lang->line('roles_name'), 'required|max_length[250]');
		
		if ($this->form_validation->run() == FALSE) {
		    $error_message="<ul><li>".form_error('role_name')."</li></ul>";
            
		    echo json_encode(array('success'=>false,'message'=>$error_message));
        }	
		
		else {
		   
	  
	        $role_data = array(
		    'role_name'=>$this->input->post('role_name'),
		    
		    );
			if ($role_id!=-1){
                $role_data['role_id']=$role_id;
            }
			
		   
		    $permission_data = $this->input->post("permissions")!=false ? $this->input->post("permissions"):array();
		    
		
		    $role=$this->input->post('role_name');
		    $rolecount=$this->Role->check_rolename($role,$role_id);
			
			if ($role_id==-1 && $rolecount!=0) {
		        echo json_encode(array('success'=>false,'message'=>$this->lang->line('roles_rolename_exist')));
		    }
		    else {
                

		       if ($this->Role->save($role_data,$rolelog_data,$permission_data,$role_id)) {
			    //New user
			        if ($role_id==-1) {
				        echo json_encode(array('success'=>true,'message'=>$this->lang->line('roles_successful_adding').' '.
						html_escape($this->security->xss_clean($role_data['role_name'])),'role_id'=>$rolelog_data['role_id']));	
			    }
			    else {  //previous user
				    echo json_encode(array('success'=>true,'message'=>$this->lang->line('roles_successful_updating').' '.
				    html_escape($this->security->xss_clean($role_data['role_name'])),'role_id'=>$role_id));
			    }
		        }
		        else {	 //failure
			    echo json_encode(array('success'=>false,'message'=>$this->lang->line('roles_error_adding_updating').' '.
			    html_escape($this->security->xss_clean($role_data['role_name'])),'role_id'=>-1));
		        }
		
		    }
		}
	}
	
	
	/*
	This deletes users from the users table
	*/
	public function delete()
	{
		/*$roles_to_delete=$this->input->post('ids');
		if ($this->Role->delete_list($roles_to_delete)) {
			echo json_encode(array('success'=>true,'message'=>$this->lang->line('roles_successful_deleted').' '.
			count($roles_to_delete).' '.$this->lang->line('roles_one_or_multiple')));
		}
		else {
			echo json_encode(array('success'=>false,'message'=>$this->lang->line('roles_cannot_be_deleted')));
		}*/
	}
	/*
	get the width for the add/edit form
	*/
	public function get_form_width()
	{
		return 650;
	}
}
