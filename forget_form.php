<?php
?>
<div>
  <h1>
  	hello world
  <h2>
  <?php
    echo form_open('forget/forget_pass');
    echo form_fieldset('Forget Pass');
    echo form_radio('forget','not_accept',False,'id="forget"');
    echo form_label("I don't know my password",'Pass_tet');
    ?>
    <div id="email_field">
    <?php
    $string=$this->typography->auto_typography("To reset your password, enter the email address you use to sign in to Google. This can be your Gmail address, your Google Apps email address, or another email address associated with your account.");
    echo $string; 
    echo form_label("Email address",'Email_address');
    echo form_input('email_txt','Email');
    echo form_fieldset_close(); 
    echo form_submit('submit','Continue');
    if(isset($error)){
          echo "<p class='error'> $error</p>";  
      }
  ?>
</div>	
