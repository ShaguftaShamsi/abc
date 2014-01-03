<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class User_login extends CI_Controller
{
    /*
     * This function load Login Form
     */
    function index($parm = null)
    {    
       if($parm!= null){
           $data['error'] =$parm;
       }
       $data['main_content']='login_form';
       $this->load->view('includes/template',$data);
    }
    /*This function call when user click user login button
     * check for valid user
     * @param void
     * @return void
     * @depandent index()
     */
    function validate_credential()
    {
        $this->load->model('membership_model');
        if($this->membership_model->validate())
            redirect('track');
        else{
            $error='Invalid Username or Password';
            $this->index($error);
        }
    }
    /*
     * Invoke when user click on siguup button
     * create user
     * @param void
     * @return void
     * @dependant signup
     */
    function create_member()
    {
        $this->form_validation->set_rules('f_name','First Name','trim|required');
        $this->form_validation->set_rules('l_name','Last Name','trim|required');
        $this->form_validation->set_rules('email','Email Address','trim|required|valid_email');
        $this->form_validation->set_rules('username','User Name','trim|required|min_lenght[5]');
        $this->form_validation->set_rules('password','Password','trim|required|min_lenght[5]');
        $this->form_validation->set_rules('password2','Confirm Password','trim|required|matches[password]');
        if($this->form_validation->run() == FALSE)
             $this->signup();
        else{
            $this->load->model('membership_model');
            if($this->membership_model->create())
                redirect ('track');
            else 
                $this->signup();
        }
    }
       /*
        * This function load Signup Form
        */     
    function signup()
    {
       $data['main_content']='signup_form';
       $this->load->view('includes/template',$data);
    }
     function forget_pass()
     {
       redirect('forget');
      
     }
    
}
?>
