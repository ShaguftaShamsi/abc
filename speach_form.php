<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<style type="text/css">
     body{
        background-image: url( '../images/Slider-background.png');
        background-repeat :no-repeat;
        background-size: 100% 100%;
     }
	 #content {
	 	margin: 130  0  0 450;
	 	width: 500px;
	 }
     .underline{
        text-decoration: underline;
     }
     .blue{
        color: orange;
     }
     .bold{
       font-weight: bold; 
     }
     ul li{
        list-style: none;
        padding: 5px;
        text-decoration: 
     }
  	</style>
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script type= "text/javascript">
	    function callfunc(name){
	     var  temp = name;
	     $('#container ul').empty();
	     $.ajax({
     	 url:"<?php echo base_url().'/index.php/speach/req_handle'; ?>",
     	 type:'POST',
     	 data:{'type' : temp},
          'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
                    var container = $('#container'); //jquery selector (get element by id)
                    if(data){
                        res = eval("(" + data + ")");
                        var reslen = res.length;
                        var error = "Data not Match";
                        if(reslen === 0 ){
                            $('#container ul').append("<li>" +error+"</li>");
                            //container.html("No Data");
                            } 
                        else{ 
                            $.each(res, function(index, value){ 
                            //console.log(value.description.split(name);  
                            $('#container ul').append("<li>" +value.description+"</li>");
                            $("li:contains("+name+")").each(function(){
                                 var $el = $(this);
                             $el.html($el.html().replace(name,'<span class="underline blue bold">'+name+'</span>')) ;
                             
                                console.log("Inside Container");
                            });
                            
                            	}); 
                                }
                    }
                }
	       });
        }
	</script>
</head>
<body>
	<div id="content">
        <marquee behavior="alternate"><p style="color:#61210B"><font size ="5">Say Something....</font></p></marquee>
		<!-- Codes by HTML.am -->
      <img src="../images/Shutterstock_HTML5.png"  align="middle" style="height:190px;width:350px;padding-left:70px;opacity:.9;padding-bottom:15px" >  
	  <input type="text" align='middle'  name="username" id ="user"  style="background-color:#F6E3CE;text-align:center;width:530px;height:35px;border-radius:7px;" x-webkit-speech onwebkitspeechchange="callfunc($(this).val()) ;" />
	 <div id='container'>
		<ul id= "name-list"></ul>
	</div>
    </div>
</body>
</html>