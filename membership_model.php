<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Membership_model extends CI_Model
{

    /*
     * Check if user exist in database and set session
     * @param null
     * @return boolean 
     * @depandent call custom helper
     */
    function validate()
    {
       $this->db->where('u_name',$this->input->post('username',TRUE)); 
       $this->db->where('password',  $this->input->post('password',True));
       $query=$this->db->get('users');
       if($this->input->post('checked')== 'accept')
       {
        echo 'check box' .$this->input->post('checked');
        $cookie =array(
            'name' => 'cookiepass',
            'value' => $this->input->post('password',TRUE),
            'expire'=>time()+120,
            'domain'=> '/'
            
            );
        setting_cookie($cookie);
       }
       if($query->num_rows ==1)
       {      echo "******";
           $data= array(
               'username'=>$this->input->post('username',True),
               'is_login_in' => TRUE
           );
           //call helper function
           set_session($data);
           //$data['username']= get_username();
              //echo " From Helper" . $data['username'];
          return TRUE;
       }
    }
    /*
     * Create user in database and set session
     * @param null
     * @return boolean
     * @depandent call custom helper
     */
    function create()
    {
        $data['f_name']=$this->input->post('f_name',True);
        $data['l_name']=$this->input->post('l_name',True);
        $data['u_name']=$this->input->post('username',True);
        $data['email']=$this->input->post('email',True);
        $data['password']=sha1($this->input->post('password',True));
        $data['reset_pass_token']=  uniqid();
        $data['updated_at']=date("Y-m-d H:i:s");
        $data['created_at']= date("Y-m-d H:i:s");
        $data['last_login_at']=date("Y-m-d H:i:s");
        $data['is_invite']= 0;
        if($this->db->insert('users',$data)){
            $data =array(
                'username'=>$this->input->post('username'),
                 'is_login_in' => TRUE
           );
         // call helper function   
          set_session($data);
           return TRUE;
           }
    }

    function reset_pass()
    {
      $data['email']=$this->input->post('email_txt',true);
      $data['pass']=substr ( md5(uniqid(rand(),1)), 3, 10);
      $this->db->where('email',$this->input->post('email_txt',true));
      $query = $this->db->get('users');
      if($query->num_rows == 1){
            //$p = substr ( md5(uniqid(rand(),1)), 3, 10);
              echo $p ."lalala --------";
            $config=array(
            'protocol'=>'smtp',
            'smtp_host'=>'mail.finaltier.com',
           //'smtp_host'=>'mail.gmail.com',
           'smtp_port'=>25,
            'smtp_user'=>'shagufta.shamsi@finaltier.com',
           'smtp_pass'=>"WorkLoad100",
          //   'smtp_user'=>'shagufta_shamsi@yahoo.com',
           // 'smtp_pass'=>"asdfghjkl;'",
            'mailtype' => 'html',
          );
           $this->load->library('email',$config);
           $this->email->from('shagufta.shamsi@finaltier.com','Admin');
           $this->email->to ($this->input->post('email_txt'));
           $msg =  $this->load->view('mail_content.html',$data,true);
           $this->email->message($msg);
           $this->email->set_newline("\r\n");
           // $this->email->attach('D:\Software\wamp\www\ci\application\Jellyfish.jpg');
              if( !$this->email->send()){
                  show_error($this->email->print_debugger()); 
              }
              else{
                  echo "A test Email is sent to ur id";
              }
      }
      else{
      return false;
      }
    }
}
?>
