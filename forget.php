<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 
class Forget extends CI_Controller
{


	 function index($parm = null)
	 {
	   if($parm != null)
	   {
	   	$data['error'] =$parm;
	   }
       $data['main_content']='forget_form';
       $this->load->view('includes/template',$data);
	 }
	 function forget_pass()
	 {
	   $this->form_validation->set_rules('email_txt','Email Address','trim|required|valid_email');
	   if($this->form_validation->run() == False){
	   	 $error="Please enter write Email format";
	   	 $this->index($error);
	   }
       else{
	   $this->load->model('membership_model');
	       if(!$this->membership_model->reset_pass()){
	         $error = "Email not match  with the record";
	         $this->index($error); 
	       } 
	       
       }	 
	 }

}