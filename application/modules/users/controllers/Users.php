<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once ("Secure_area.php");
require_once ("interfaces/Idata_controller.php");
class Users extends Secure_area implements iData_controller
{
	public function __construct()
	{
		parent::__construct('users');
	}
	
	public function index()
	{
		$config['base_url'] = site_url('users/users/index');
		$this->load->library('pagination'); 
		$config['total_rows'] = $this->User->count_all();
		$config['per_page'] = $this->config->item('pagination_limit'); //Get page limit from config settings 
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['controller_name']=strtolower(get_class());
		$data['controller_path']=$this->router->fetch_module()."/".$this->router->fetch_class();;
		$data['form_width']=$this->get_form_width();
		$data['content_view']='users/users/manage';
 
		$data['manage_table']=get_people_manage_table( $this->User->get_all( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ), $this );
		$this->load->module("template");
		$this->template->manage_tables_template($data);
 
	}
	
	/*
	Returns user table data rows. This will be called with AJAX.
	*/
	public function search()
	{
		$search=$this->input->post('search');
		$data_rows=get_people_manage_table_data_rows($this->User->search($search),$this);
		echo $data_rows;
	}
	
	public function get_row()
	{
		$user_id = $this->input->post('row_id');
		$data_row=get_people_data_row($this->User->get_info($user_id),$this);
		echo $data_row;
	}
	/*
	Gives search suggestions based on what is being searched for
	*/
	public function suggest()
	{
		$suggestions = $this->User->get_search_suggestions($this->input->post('q'),$this->input->post('limit'));
		echo implode("\n",$suggestions);
	}
	
		
	public function get_dob_date($data,$selected_month="",$selected_day="",$selected_year="")
	{

		$months = array();
	    for ($k=1;$k<=12;$k++) {
		    $cur_month = mktime(0, 0, 0, $k, 1, 2000);
		    $months[date("m", $cur_month)] = date("M",$cur_month);
	    }
		$days = array();
	    for ($k=1;$k<=31;$k++) {
		    $cur_day = mktime(0, 0, 0, 1, $k, 2000);
		    $days[date('d',$cur_day)] = date('j',$cur_day);
	    }
	    $years = array();	
	    for ($k=0;$k<70;$k++){
           $y=date("Y");
		   $years[$y-$k] = $y-$k;
	    }
		$months['00'] = "00";
	    $days['00'] = "00";
     	$years['00'] = "0000";
		$data['dmonths'] = $months;
		$data['ddays'] = $days;
		$data['dyears'] = $years;
		if ($selected_month=="") {
		   $data['dselected_month']=date('n');
		   $data['dselected_day']=date('d');
		   $data['dselected_year']=date('Y');
		}
		else {
		   $data['dselected_month']=$selected_month;
		   $data['dselected_day']=$selected_day;
		   $data['dselected_year']=$selected_year;
		}
		return $data;
	}
	
	
		public function get_registration_date($data,$selected_month="",$selected_day="",$selected_year="")
	{
		$months = array();
	    for ($k=1;$k<=12;$k++) {
		$cur_month = mktime(0, 0, 0, $k, 1, 2000);
		$months[date("m", $cur_month)] = date("M",$cur_month);
	    }
		$days = array();
	    for($k=1;$k<=31;$k++){
		    $cur_day = mktime(0, 0, 0, 1, $k, 2000);
		    $days[date('d',$cur_day)] = date('j',$cur_day);
	    }
	    $years = array();
	    for($k=0;$k<20;$k++) {
            $y=date("Y");
	        $y=$y+5;
		    $years[$y-$k] = $y-$k;
	    }
			
		$data['rmonths'] = $months;
		$data['rdays'] = $days;
		$data['ryears'] = $years;	
		if ($selected_month=="") {
		    $data['rselected_month']=date('n');
		    $data['rselected_day']=date('d');
		    $data['rselected_year']=date('Y');
		}
		else {
		    $selected_month;
		    $data['rselected_month']=$selected_month;
		    $data['rselected_day']=$selected_day;
		    $data['rselected_year']=$selected_year;
		}
		
		return $data;
	}
	
	/*
	Loads the user edit form
	*/
	public function view($user_id=-1)
	{
		// get all user details by user id
	    $data['user_info']=$this->User->get_info($user_id);
		// dob of user
	    $dob=$data['user_info']->dob;
	    if ($dob=="0000-00-00" || $dob==""){
	        $d_o_b="0000-00-00";
	    }
	    else {
            $d_o_b= date("Y-m-d", strtotime($dob));
	    }
	   
	    $split_date = explode("-", $d_o_b);
	    $year = $split_date[0];
	    $month = $split_date[1];
	    $day = $split_date[2];
	    $data=$this->get_dob_date($data,$month,$day,$year);

	    // registration date of user account
	    $dateofregistration=$data['user_info']->register_date;
	    if ($dateofregistration==""){
	        $date_of_registration= date("Y-m-d");
	    }
	    else {
	        $date_of_registration= date("Y-m-d", strtotime($dateofregistration));
	    }
	 
		$split_date = explode("-", $date_of_registration);
		$cyear = $split_date[0];
		$cmonth = $split_date[1];
		$cday = $split_date[2];
		$data=$this->get_registration_date($data,$cmonth,$cday,$cyear);
		
		$data['all_modules']=$this->Module->get_editable_modules();
        
        $data['all_roles']=$this->Role->get_all();
		
		if ($user_id==-1) {//new user
		    $this->load->view("users/users//new_user_form",$data);
		}
	    else {
		    $this->load->view("users/users/form",$data);
	    }
	}
	
	public function edit_profile_image($user_id=-1)
	{
		$data['user_id']=$user_id;
		$data['user_info']=$this->User->get_info($user_id);
		$this->load->view("users/users/edit_profile_image",$data);
	}
	
	public function save_profile_pic($user_id=-1)
	{
 
			if (isset($GLOBALS["HTTP_RAW_POST_DATA"]))
			
			{
			// Get the data
			$imageData=$GLOBALS['HTTP_RAW_POST_DATA'];

			$filter_filename=substr($imageData,0, strpos($imageData, ","));
			$filteredData=substr($imageData, strrpos($imageData, ",")+1);
			$targetDir = './uploads/'.$user_id;
			
			 
			
			$userinfo_data = array
			(
				'profile_image'=>$user_id.".png"
			);
			if ($this->User->update_user_info($userinfo_data,$user_id)) {
				
				$filePath = $targetDir ;
				$unencodedData=base64_decode($filteredData);

				if ($this->is_writable_r('./uploads/')) {
				$fp = fopen($filePath.'.png', 'w' );
				fwrite( $fp, $unencodedData);
				fclose( $fp );
				
				 echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_avatar_updated')));
				}
				else{
					 echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_avatar_not_writable'))); 
				}
			}
		}
		
		
	}
	
	public function is_writable_r($dir)
	{
		if (is_dir($dir)) {
            if(is_writable($dir)){
                $objects = scandir($dir);
                foreach ($objects as $object) {
                    if ($object != "." && $object != "..") {
                        if (!$this->is_writable_r($dir."/".$object)) return false;
                        else continue;
                    }
                }    
                return true;    
              }else{
              return false;
        }
        
       }
	   else if(file_exists($dir)){
           return (is_writable($dir));
        
       }
	}
	
	public function change_password($user_id=-1)
	{
	    
		// get all user details by user id
	    $data['user_info']=$this->User->get_info($user_id);
		$this->load->view("users/users/login_info",$data);
	}
	
	/*
	Inserts/updates an user
	*/
	public function save($user_id=-1)
	{
		$this->load->library('bcrypt');
	    //server side validation
		$this->form_validation->set_rules('first_name', $this->lang->line('profiles_first_name'), 'required|max_length[250]');
		// $this->form_validation->set_rules('last_name',  $this->lang->line('profiles_last_name'), 'max_length[250]');
		$this->form_validation->set_rules('phone_number',  $this->lang->line('profiles_phone'), 'max_length[250]');
		$this->form_validation->set_rules('state',  $this->lang->line('profiles_state'), 'max_length[250]');
		$this->form_validation->set_rules('city',  $this->lang->line('profiles_city'), 'max_length[250]');
		$this->form_validation->set_rules('address',  $this->lang->line('profiles_address'), 'max_length[2000]');
		// $this->form_validation->set_rules('comments',  $this->lang->line('profiles_comments'), 'max_length[2000]');
		
		$usermailcount=0;
		
		if($user_id==-1) {
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[250]');
		    $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[250]');
		    $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[250]');
		}
		if ($this->form_validation->run() == FALSE) {
		    $error_message="<ul><li>".form_error('first_name')."</li><li>".form_error('phone_number')."</li><li>".form_error('state')."</li><li>".form_error('city')."</li><li>".form_error('address')."</li><li>".form_error('username')."</li><li>".form_error('password')."</li><li>".form_error('email')."</li></ul>";
		    echo json_encode(array('success'=>false,'message'=>$error_message));
        }	
		
		else {
		    $dobmonth=$this->input->post('dobmonth');
	        $dobday=$this->input->post('dobday');
	        $dobyear=$this->input->post('dobyear');
	        $dob= date("Y-m-d", strtotime("$dobyear-$dobmonth-$dobday")); 
	  
	        $rmonth=$this->input->post('rmonth');
	        $rday=$this->input->post('rday');
	        $ryear=$this->input->post('ryear');
	        $date_of_registration= date("Y-m-d", strtotime("$ryear-$rmonth-$rday"));
	  
	        $userinfo_data = array(
		    'first_name'=>$this->input->post('first_name'),
		    // 'last_name'=>$this->input->post('last_name'),
		    'phone_number'=>$this->input->post('phone_number'),
		    'city'=>$this->input->post('city'),
		    'state'=>$this->input->post('state'),
		    'register_date'=>$date_of_registration,
		    'dob'=>$dob,
		    'country_code'=>$this->input->post('country'),
		    'country_name'=>$this->input->post('country_name'),
		    'marital_status'=>$this->input->post('marital_status'),
		    'gender'=>$this->input->post('gender'),
		    // 'comments'=>$this->input->post('comments'),
		    'address'=>$this->input->post('address')
		    );
			if($user_id==-1){
				$userinfo_data['email'] = $email = $this->input->post('email');
				$usermailcount=$this->User->check_email($email,$user_id);
			}
			
		   
		    /*$permission_data = $this->input->post("permissions")!=false ? $this->input->post("permissions"):array();*/

            if ($this->input->post('role')!='') {
                $permission_data["role_id"]=$this->input->post("role");
                $permission_data["user_id"]=$user_id;
            }
		    if ($this->input->post('password')!='') {
			    $userlog_data=array(
			    'username'=>$this->input->post('username'),
				'password'=>($this->bcrypt->hash_password($this->input->post('password'))),
			    'active'=>($this->input->post('_status'))
			    );
		    }
		    else {  
			     $userlog_data=array(
			    'active'=>($this->input->post('_status'))
			    );
		    }
		
		    $user=$this->input->post('username');
		    $usercount=$this->User->check_username($user,$user_id);
			
			if($user_id==-1 && $usermailcount!=0){
				echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_email_exist')));
			}
		    else if ($usercount!=0) {
		        echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_username_exist')));
		    }
		    else {


		       if ($this->User->save($userinfo_data,$userlog_data,$permission_data,$user_id)) {
			    //New user
			        if ($user_id==-1) {
				        echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_successful_adding').' '.
						html_escape($this->security->xss_clean($userinfo_data['first_name'])).' '.html_escape($this->security->xss_clean($userinfo_data['last_name'])),'user_id'=>$userlog_data['user_id']));	
			    }
			    else {  //previous user
				    echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_successful_updating').' '.
				    html_escape($this->security->xss_clean($userinfo_data['first_name'])),'user_id'=>$user_id));
			    }
		        }
		        else {	 //failure
			    echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_error_adding_updating').' '.
			    html_escape($this->security->xss_clean($userinfo_data['first_name'])).' '.$this->security->xss_clean($userinfo_data['last_name']),'user_id'=>-1));
		        }
		
		    }
		}
	}
	
	public function save_password($user_id=-1)
	{
		$this->load->library('bcrypt');
		//Password has been changed 
		$login_user_id=$this->User->get_logged_in_user_info()->user_id;
		
		//server side validation
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[250]');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[250]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[250]');
		$this->form_validation->set_rules('current_password', 'Current Password', 'required|min_length[8]|max_length[250]');
		
		if ($this->form_validation->run() == FALSE) {
			$error_message="<ul><li>".form_error('email')."</li><li>".form_error('username')."</li><li>".form_error('password')."</li><li>".form_error('current_password')."</li></ul>";
			echo json_encode(array('success'=>false,'message'=>$error_message));
		}
        else {
			$password =  $this->input->post('password');
			$email =  $this->input->post('email');
			$username = $this->input->post('username');
			$userlog_data=array(
			'username'=>$username,
			'password'=>($this->bcrypt->hash_password($password))
			);
			 $userinfo_data = array(
		    'email'=>$this->input->post('email'),
		    );
			$user=$this->input->post('username');
			$current_password=$this->input->post('current_password');
			$usermailcount=$this->User->check_email($email,$user_id);
			$usercount=$this->User->check_username($user,$user_id);
			
		
			$password_match=$this->User->check_password($current_password,$login_user_id);
			if ($password_match==0) {
				echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_password_missmatch')));
			}
			else if ($usermailcount!=0) {
				echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_email_exist')));
			}
			else if ($usercount!=0) {
				echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_username_exist')));
			}
			else {
				if ($this->User->update_password( $userlog_data,$userinfo_data,$user_id)) {
				    echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_successful_updating').' ','user_id'=>$user_id));
				}
				else {	 //failure
				echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_error_adding_updating').' ','user_id'=>$user_id));
				}
			}
		
		}
	}
	
	/*
	This deletes users from the users table
	*/
	public function delete()
	{
		$users_to_delete=$this->input->post('ids');
		if ($this->User->delete_list($users_to_delete)) {
			echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_successful_deleted').' '.
			count($users_to_delete).' '.$this->lang->line('profiles_one_or_multiple')));
		}
		else {
			echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_cannot_be_deleted')));
		}
	}
	/*
	get the width for the add/edit form
	*/
	public function get_form_width()
	{
		return 650;
	}
}
