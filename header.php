<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Easy HotSpot - A Simple Hotspot user management utility by Team Zetozone">
    <meta name="author" content="Siby P Varkey, Team Zetozone">
<!--	
	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'> -->

    <title>Easy HotSpot - A Simple Hotspot user management utility by Team Zetozone</title>

    
    <link href="css/bootstrap.min.css" rel="stylesheet" media="all"> 
	<!--  Bootstrap Core CSS 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	-->
	
	<!-- Menu Items Animation CSS -->	
    <link href="css/animate.css" rel="stylesheet">

	<!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet"  media="screen" >
	<link href="css/awesome-bootstrap-checkbox.css" rel="stylesheet"  media="screen" >

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

    <!-- Template js -->
	<link href="css/print.css" rel="stylesheet" type="text/css" media="print">
	<link href="css/customModal.css" rel="stylesheet" type="text/css" media="screen">
	
	<!--
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
	-->
	<link href="css/font-awesome.min.css" rel="stylesheet"> 
	<!--
	<script src="https://use.fontawesome.com/a45bcd3e7b.js"></script>  -->

	<script src="js/jquery-2.1.1.min.js"></script> 
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.min.js"></script> 
	<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	-->	
	<!--<script src="printThis.js"></script> -->
	<script src="js/customModal.js"></script>
	<!--	<script src="js/gen_validatorv4.js" type="text/javascript"></script> -->

   <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript">
	function log_out() {
		btns = [{text:"No",action:"cmodalClose",style:"cmodal-cancel"}, {text:"Yes",action:"logout.php",style:"cmodal-ok"}];
		cmodalOkCancel("Logout System?", "Logout Selected.. Do you want to Logout ?", "information", btns);	
	return false;
    }
</script> 
<script type="text/javascript">
//Guest User - Removal
function removeAjax(username){
   var ajaxRequest;  // The variable that makes Ajax possible!
   try{
   
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
         
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
   

   var queryString = "?username=" + username ;

   ajaxRequest.open("GET", "ajax_rem_user.php" + queryString, true);
   ajaxRequest.send(null);
   cmodal("User Removal Success", "User " + username + " Removed Successfully", "success");
}

</script>
	
<script>
//Guest User - Add Multiple Nos
function ajaxMultiple(){ 
   var no_of_users = document.getElementById('no_of_users').value;
   var pass_length = document.getElementById('pass_length').value;
   var user_prefix = document.getElementById('user_prefix').value;
   var limit_uptime = document.getElementById('limit_uptime').value;
   var limit_bytes = document.getElementById('limit_bytes').value;
   var profile = document.getElementById('profile').value;
   var same_pass = document.getElementById('same_pass').value;
   var Pass_type = document.getElementById('pass_type').value;

//   btns = [{text:"No",action:"cmodalClose",style:"cmodal-cancel"}, {text:"Yes",action:"test.php",style:"cmodal-ok"}];
   
   var ajaxRequest;  // The variable that makes Ajax possible!
   try{
   
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
         
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
   
      ajaxRequest.onreadystatechange = function(){
   
      if(ajaxRequest.readyState == 4){
			var ajaxResult = ajaxRequest.responseText;
			btns = [{text:"No",action:"cmodalClose",style:"cmodal-cancel"}, {text:"Yes",action:"test.php",style:"cmodal-ok"}];
			if (ajaxResult == 0) {
				cmodal("User Rights Issue",  "User Rights Problem/Empty Username.  Contact Admin for details", "error");
			}
			else {
				//btns = [{text:"No",action:"cmodalClose",style:"cmodal-cancel"}, {text:"Yes",action:"js:print_modal();",style:"cmodal-ok"}];
				//cmodalOkCancel("User Creation Success", ajaxResult + " Users Added Successfully. Print the Vouchers now ?", "success", btns);
				cmodal("Multiple Users Created", ajaxResult + " Users Accounts Added Successfully. Print the Vouchers from Voucher Printing Menu", "success");
			}
		}
	  }
  
   var queryString = "?no_of_users=" + no_of_users ;
   queryString +=  "&pass_length=" + pass_length + "&user_prefix=" + user_prefix ;
   queryString += "&limit_uptime=" + limit_uptime + "&profile=" + profile + "&same_pass=" + same_pass;
   queryString += "&limit_bytes=" + limit_bytes + "&pass_type=" + Pass_type;
   ajaxRequest.open("GET", "ajax_addusers.php" + queryString, true);
   ajaxRequest.send(null);
}
</script>
<script>
//Guest User - Add Multiple Nos
function ajaxVoucher1(){ 

   var ajaxRequest;  // The variable that makes Ajax possible!
   try{
   
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
         
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
   
   ajaxRequest.open("GET", "test.php", true);
   ajaxRequest.send(null);

  // cmodal("User Creation Success", no_of_users + " Users Added Successfully. You may Print the Vouchers now", "success");
}
</script>

<script>
//Guest User - Start of Creation of a Single Guest User; Ajax Call
function ajaxSingle() { //Guest User Add Single User
   var ajaxRequest;  // The variable that makes Ajax possible!
   try{
   
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
         
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }

   ajaxRequest.onreadystatechange = function(){
   
      if(ajaxRequest.readyState == 4){
         var ajaxDisplay = document.getElementById('single');
         ajaxDisplay.innerHTML = ajaxRequest.responseText;
      }
   }
   
   var username = document.getElementById('uname').value;
   var password = document.getElementById('psw').value;
   var profile = document.getElementById('sprofile').value;
   var limit_uptime = document.getElementById('slimit_uptime').value;
   var limit_bytes = document.getElementById('slimit_bytes').value;
 
   var queryString = "?name=" + username ;

   queryString +=  "&psd=" + password + "&profile=" + profile + "&limit_uptime=" + limit_uptime + "&limit_bytes=" + limit_bytes;
   ajaxRequest.open("GET", "ajax_adduser.php" + queryString, true);
   ajaxRequest.send(null);

 // cmodal("User Creation Success", username + "  Added Successfully. You may Print the Vouchers now", "success");
}
// End of Creation of a Single Guest User; Ajax Call
</script> 
<script>
//Guest User - Start of Removing All Un-initiated Guest User Accounts
function ajaxUninitiated() { //Guest User
   var ajaxRequest;  // The variable that makes Ajax possible!
   try{
   
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
         
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
   
   ajaxRequest.open("GET", "ajax_uninitiated.php", true);
   ajaxRequest.send(null);

  cmodal("User Removal Success", "Removed all Un-Initiated Guest User Accounts from the Registry Successfully.", "success");
}
// End of Removing All Un-initiated Guest User Accounts
</script>

<script>
//Guest User - Start of Removing All Expired Guest User Accounts
function ajaxExpired() {
   var ajaxRequest;  // The variable that makes Ajax possible!
   try{
   
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
         
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
   
   ajaxRequest.open("GET", "ajax_expired.php", true);
   ajaxRequest.send(null);

   cmodal("User Removal Success", "Removed all Validity Expired Guest User Accounts from the Registry Successfully.", "success");
}
// End of Removing All Expired Guest User Accounts
</script> 
<script>
//System User - Password reset option for System Users, Calling From Menu option SYSTEM USERS
function resetpass(oForm){ 
	user_id = oForm.elements["user_id"].value;
  
   var ajaxRequest;  // The variable that makes Ajax possible!
   try{
   
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
         
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
      ajaxRequest.onreadystatechange = function(){
   
      if(ajaxRequest.readyState == 4){
         var ajaxResult = ajaxRequest.responseText;
        
		if (ajaxResult == 0) {
			cmodal("User Rights Issue",  "User Rights Problem.  Contact Admin for details", "error"); }
		else if (ajaxResult == 1) {
			cmodal("NOT EXIST..",  "No such User Exist,  Please re-check ..!", "warning"); }
		 else if (ajaxResult == 2) {
			cmodal("User Password Reset Success", "System User Password Reset Successfully", "success"); }
	  }

   }
 
   var queryString = "?user_id=" + user_id ;

   ajaxRequest.open("GET", "ajax_reset_pass.php" + queryString, true);
   ajaxRequest.send(null);
   
}
</script>

<script>
//System User - Start of Adding a New System User;
function addsysuser(oForm) { 
	//$('#system-user').modal('hide');

	var username = oForm.elements["username"].value;
	var firstname = oForm.elements["firstname"].value;
	var lastname = oForm.elements["lastname"].value;
	var user_level = oForm.elements["user_level"].value;
	var status = oForm.elements["status"].value;
	
   var ajaxRequest;  // The variable that makes Ajax possible!
   try{
   
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
         
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
   
      ajaxRequest.onreadystatechange = function(){
   
      if(ajaxRequest.readyState == 4){
         var ajaxResult = ajaxRequest.responseText;
        
		if (ajaxResult == 0) {
			cmodal("User Rights Issue",  "User Rights Problem/Empty Username.  Contact Admin for details", "error"); }
		else if (ajaxResult == 1) {
			cmodal("Already Exist..",  "Username Already Exist,  Please select another Name..!", "warning"); }
		 else if (ajaxResult == 2) {
			cmodal("Success..",  "New System User Created Successfully..!", "success"); }
	  }

   }

	var queryString = "?username=" + username ;
   
	queryString +=  "&username=" + username + "&firstname=" + firstname + "&lastname=" + lastname + "&user_level=" + user_level + "&status=" + status;
	ajaxRequest.open("GET", "ajax_add_sysuser.php" + queryString, true);
	ajaxRequest.send(null);
   
}
//System User - End of Adding a New System User;
</script>
<script>
//System User - Removes a System User
function deleteuser(oForm) { 
	user_id = oForm.elements["user_id"].value;
   var ajaxRequest;  // The variable that makes Ajax possible!
   try{
   
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
         
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
   
         ajaxRequest.onreadystatechange = function(){
   
      if(ajaxRequest.readyState == 4){
         var ajaxResult = ajaxRequest.responseText;
        
		if (ajaxResult == 0) {
			cmodal("User Rights Issue",  "User Rights Problem.  Contact Admin for details", "error"); }
		else if (ajaxResult == 1) {
			cmodal("Removed User..",  "User details removed Successfully..!", "success"); }
	  }

   }

   var queryString = "?user_id=" + user_id ;

   ajaxRequest.open("GET", "ajax_del_sysuser.php" + queryString, true);
   ajaxRequest.send(null);
}
</script>

<script>
//System User - Edit details of System User;
function edituser(oForm) { 
	var	user_id = oForm.elements["user_id"].value;
	var username = oForm.elements["username"].value;
	var firstname = oForm.elements["firstname"].value;
	var lastname = oForm.elements["lastname"].value;
	var user_level = oForm.elements["user_level"].value;
	var status = oForm.elements["status"].value;
	
   var ajaxRequest;  // The variable that makes Ajax possible!
   try{
   
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
         
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
   
     ajaxRequest.onreadystatechange = function(){
   
      if(ajaxRequest.readyState == 4){
         var ajaxResult = ajaxRequest.responseText;
        
		if (ajaxResult == 0) {
			cmodal("User Rights Issue",  "User Rights Problem/Empty Username.  Contact Admin for details", "error"); }
		else if (ajaxResult == 1) {
			cmodal("Already Exist..",  "Username Already Exist,  Please select another Name..!", "warning"); }
		 else if (ajaxResult == 2) {
			cmodal("Success..",  "Updated System User details Successfully..!", "success"); }
	  }

   }

   var queryString = "?user_id=" + user_id ;
   
   queryString +=  "&username=" + username + "&firstname=" + firstname + "&lastname=" + lastname + "&user_level=" + user_level + "&status=" + status;
   ajaxRequest.open("GET", "ajax_edit_sysuser.php" + queryString, true);
   ajaxRequest.send(null);
   
}
</script>
<script>
//System User - Changes Password for the current logged-in user
function changePass(oForm) { 
	//$('#system-user').modal('hide');
	var	np = oForm.elements["newpassword"].value;
	var	rp = oForm.elements["retypepassword"].value;
	
	var passReg = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
	
	if (np != rp) {
		cmodal("Warning"," Passwords do not Match...", "warning");
		return false;
	}
	else if ((np == '') || (rp == '')) {
		cmodal("Warning"," Blank Password not allowed...", "warning");
		return false;
	} else if(!(np).match(passReg)){
		cmodal("Password Change Fail", "Your password is not Complex enough;, 1 Capital, 1 small, 1 Number, 1 symbol and 8 chars minimum", "error");
		return false;
	} else {
     
		var ajaxRequest;  // The variable that makes Ajax possible! change-password
		try{
   
		// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		}catch (e){
      
			// Internet Explorer Browsers
			try{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			}catch (e) {
			
				try{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				}catch (e){
			
					// Something went wrong
					alert("Your browser broke!");
					return false;
				}
			}
		}
		
		ajaxRequest.onreadystatechange = function(){
   
      if(ajaxRequest.readyState == 4){
         var ajaxResult = ajaxRequest.responseText;
        
		if (ajaxResult == 0) {
			cmodal("User Rights Issue",  "Authorisation Problem/Password Change Failed.  Contact Admin for details", "error"); }
		else if (ajaxResult == 1) {
			cmodal("Password Changed", "Your password has been changed Successfully", "success"); }
	  }

   }
  
		var queryString = "?np=" + np ;
		queryString +=  "&rp=" + rp;
		ajaxRequest.open("GET", "ajax_change_syspass.php" + queryString, true);
		ajaxRequest.send(null);
	}
	
}	
</script>

<script>
function genClicks(event) { // Called by all Input Elements to Set Focus to next TabItem when pressing the ENTER key.
    var key = event.keyCode;
	var cti = document.activeElement.tabIndex;
	if (key == 13) {
		event.preventDefault();
		$('[tabindex=' + (cti + 1) + ']').focus();
	}
}
</script>
<script>
function genClick(event) { // Called by all Input Elements to Set Focus to next TabItem when pressing the ENTER key.
	var cti = document.activeElement.tabIndex;
	$('[tabindex=' + (cti + 1) + ']').focus();
}
</script>
<script>
//Jquery Functions Start Here
$(document).ready(function() {

function print_modal() { 
	$('#voucher_print').modal('show');
};

$('#change-password').bind('keypress',function (event){
  if (event.keyCode === 13){
	event.preventDefault();
    $("#update_pass").trigger('click');
  }
});

$('#add_sysuser').bind('keypress',function (event){
  if (event.keyCode === 13){
	event.preventDefault();
    $("#add_user").trigger('click');
  }
});

//Activates the common User Modal for System users,
// which retrieves data related to that user and facilitiates editing, removal, reset pass etc in the modal
$('#getUserModal').on('show.bs.modal', function (event)   {
    var button = $(event.relatedTarget)
    var recipient = button.data('id')
    var modal = $(this)
    modal.find('.modal-title').text('System User # ' + recipient + "'s details.")
    $(function () 
          {
            $.ajax(
            {  
                type: 'GET',
                url: "ajax_get_sysuser.php?user_id=" + recipient,             
                data: 'recipient',
                dataType: "json",
                success: function(data) 
                {
                    
                    var firstName = data.firstname;       
                    var lastName = data.lastname;
                    var userName = data.username;
					var userId = data.user_id;       
                    var userLevel = data.user_level;
					var userStatus = data.status;
						 
					modal.find('.modal-body #firstname').val(firstName)
					modal.find('.modal-body #lastname').val(lastName)
					modal.find('.modal-body #username').val(userName) 
					modal.find('.modal-body #user_level').val(userLevel)
					modal.find('.modal-body #status').val(userStatus)
					modal.find('.modal-body #user_id').val(userId) 
                }
            })
 
        })
    } )

//Activates the common User Modal for System users,
// which retrieves data related to that user and facilitiates editing, removal, reset pass etc in the modal

$('#getProfileModal').on('show.bs.modal', function (event)   {
    var button = $(event.relatedTarget)
    var profile_name = button.data('id')
    var modal = $(this)
    modal.find('.modal-title').text('Hotspot User Profile ' + profile_name + "'s details.")
    $(function () 
          {
            $.ajax(
            {  
                type: 'GET',
                url: "ajax_get_profiles.php?profile_name=" + profile_name,             
                //data: profile_name,
                dataType: "json",
                success: function(data) 
                {
					//console.log(data);
                    var Name = data.name;  
					var Address_pool = data.address_pool;					
                    var Rate_limit = data.rate_limit;
					if (Rate_limit) {
						var Limits = Rate_limit.split("/");
						var Rx_rate_limit = Limits.slice(0,1);
						var Tx_rate_limit = Limits.slice(1,2);
					}	
                    var Session_timeout = data.session_timeout;
					var Shared_users = data.shared_users;       
                    var Mac_cookie_timeout = data.mac_cookie_timeout;
					var Keepalive_timeout = data.keepalive_timeout;
					
					var Validity = data.validity;
					var Grace_period = data.grace_period;
					var On_expiry = data.on_expiry;
					var Price = data.price;
					var Lock_user = data.lock_user;
					
					modal.find('.modal-body #profile_name').val(Name)
					modal.find('.modal-body #address_pool').val(Address_pool)
					modal.find('.modal-body #rx_rate_limit').val(Rx_rate_limit)
					modal.find('.modal-body #tx_rate_limit').val(Tx_rate_limit)
					modal.find('.modal-body #session_timeout').val(Session_timeout) 
					modal.find('.modal-body #shared_users').val(Shared_users)
					modal.find('.modal-body #mac_cookie_timeout').val(Mac_cookie_timeout)
					modal.find('.modal-body #keepalive_timeout').val(Keepalive_timeout)

					modal.find('.modal-body #validity').val(Validity)
					modal.find('.modal-body #grace_period').val(Grace_period)
					modal.find('.modal-body #on_expiry').val(On_expiry)					
					modal.find('.modal-body #price').val(Price)
					modal.find('.modal-body #lock_user').val(Lock_user)
                }
            })
        })
    } )    
    

} );
</script>
<script>

//Guest User Profile - Start of Adding a New User profile;
function addprofile(oForm) { 
	//$('#system-user').modal('hide');

	var Profile_name = oForm.elements["profile_name"].value;
	var Rx_rate_limit = oForm.elements["rx_rate_limit"].value;
	var Tx_rate_limit = oForm.elements["tx_rate_limit"].value;
	var Session_timeout = oForm.elements["session_timeout"].value;
	var Shared_users = oForm.elements["shared_users"].value;
	var Mac_cookie_timeout = oForm.elements["mac_cookie_timeout"].value;
	var Keepalive_timeout = oForm.elements["keepalive_timeout"].value;
	
	var Validity = oForm.elements["validity"].value;
	var Grace_period = oForm.elements["grace_period"].value;
	var On_expiry = oForm.elements["on_expiry"].value;
	var Price = oForm.elements["price"].value;
	var Lock_user = oForm.elements["lock_user"].value;
	
   var ajaxRequest;  // The variable that makes Ajax possible!
   try{
   
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
         
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
   
      ajaxRequest.onreadystatechange = function(){
   
      if(ajaxRequest.readyState == 4){
         var ajaxResult = ajaxRequest.responseText;
        //console.log ("Log = " + ajaxResult);
		
		if (ajaxResult == 0) {
			cmodal("User Rights Issue",  "User Rights Problem, Not Authorised to.  Contact Admin for details", "error"); }
		else if (ajaxResult == 1) {
			cmodal("Empty Values",  "Blank Profile Name Not Permitted,  Please Fill required Fields and Proceed..!", "warning"); }
		 else if (ajaxResult == 2) {
			cmodal("Completed..",  "New Hotspot User Profile Creation Attempt Completed..!", "success"); }
	  }

   }

	var queryString = "?profile_name=" + Profile_name ;
   
	queryString += "&session_timeout=" + Session_timeout;
	queryString +=  "&shared_users=" + Shared_users + "&mac_cookie_timeout=" + Mac_cookie_timeout + "&keepalive_timeout=" + Keepalive_timeout;
	queryString += "&rx_rate_limit=" + Rx_rate_limit + "&tx_rate_limit=" + Tx_rate_limit;
	queryString += "&validity=" + Validity + "&grace_period=" + Grace_period;
	queryString += "&on_expiry=" + On_expiry + "&price=" + Price + "&lock_user=" + Lock_user;
	ajaxRequest.open("GET", "ajax_add_profile.php" + queryString, true);
	ajaxRequest.send(null);
   
}
//Guest User Profile - End of Adding a New User profile;
</script>
<script>
//Guest User Profile - Start of Deleting a Guest User profile;
function deleteprofile(oForm) { 
	//$('#system-user').modal('hide');

	var Profile_name = oForm.elements["profile_name"].value;
	
   var ajaxRequest;  // The variable that makes Ajax possible!
   try{
   
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
         
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
   
      ajaxRequest.onreadystatechange = function(){
   
      if(ajaxRequest.readyState == 4){
         var ajaxResult = ajaxRequest.responseText;
        //console.log ("Log = " + ajaxResult);
		
		if (ajaxResult == 0) {
			cmodal("User Rights Issue",  "User Rights Problem, Not Authorised to.  Contact Admin for details", "error"); }
		else if (ajaxResult == 1) {
			cmodal("Empty Values",  "Blank Profile Name Not Permitted,  Please Select any proper Profile and try..!", "warning"); }
		 else if (ajaxResult == 2) {
			cmodal("Completed..",  "Hotspot User Profile Removal attempt Attempt Completed..!", "success"); }
	  }

   }

	var queryString = "?profile_name=" + Profile_name ;
   
	ajaxRequest.open("GET", "ajax_del_profile.php" + queryString, true);
	ajaxRequest.send(null);
   
}
//Guest User Profile - End of Deleting a Guest User profile;
</script>
<script>
//Guest User Profile - Start of Updating a User profile;
function editprofile(oForm) { 
	//$('#system-user').modal('hide');

	var Profile_name = oForm.elements["profile_name"].value;
	var Rx_rate_limit = oForm.elements["rx_rate_limit"].value;
	var Tx_rate_limit = oForm.elements["tx_rate_limit"].value;
	var Session_timeout = oForm.elements["session_timeout"].value;
	var Shared_users = oForm.elements["shared_users"].value;
	var Mac_cookie_timeout = oForm.elements["mac_cookie_timeout"].value;
	var Keepalive_timeout = oForm.elements["keepalive_timeout"].value;
	
	var Validity = oForm.elements["validity"].value;
	var Grace_period = oForm.elements["grace_period"].value;
	var On_expiry = oForm.elements["on_expiry"].value;
	var Price = oForm.elements["price"].value;
	var Lock_user = oForm.elements["lock_user"].value;
	
   var ajaxRequest;  // The variable that makes Ajax possible!
   try{
   
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
         
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
   
      ajaxRequest.onreadystatechange = function(){
   
      if(ajaxRequest.readyState == 4){
         var ajaxResult = ajaxRequest.responseText;
       // console.log ("Log = " + ajaxResult);
		
		if (ajaxResult == 0) {
			cmodal("User Rights Issue",  "User Rights Problem, Not Authorised to.  Contact Admin for details", "error"); }
		else if (ajaxResult == 1) {
			cmodal("Improper Values",  "Profile Name Not Proper,  Please Select Proper Profile and Proceed..!", "warning"); }
		 else if (ajaxResult == 2) {
			cmodal("Completed..",  "Updation of Hotspot User Profile Completed..!", "success"); }
	  }

   }

	var queryString = "?profile_name=" + Profile_name ;
   
	queryString += "&session_timeout=" + Session_timeout;
	queryString +=  "&shared_users=" + Shared_users + "&mac_cookie_timeout=" + Mac_cookie_timeout + "&keepalive_timeout=" + Keepalive_timeout;
	queryString += "&rx_rate_limit=" + Rx_rate_limit + "&tx_rate_limit=" + Tx_rate_limit;
	queryString += "&validity=" + Validity + "&grace_period=" + Grace_period;
	queryString += "&on_expiry=" + On_expiry + "&price=" + Price + "&lock_user=" + Lock_user;
	ajaxRequest.open("GET", "ajax_edit_profile.php" + queryString, true);
	ajaxRequest.send(null);
   
}
//Guest User Profile - End of Updating a User profile;
</script>
<script>
//Guest User Profile - Start of Adding a New User profile;
function removeSelected(oForm) { 
	var Removal1 = oForm.elements['removal_list[]'];
	var Removal_list = new Array();
	var queryString = "";
	var k = 0;
	//var queryString = "?removal_list[]=";
   for (var i = 0; i < Removal1.length; i++) {
    var aControl = Removal1[i].checked;
	var bControl = Removal1[i].value;
	if (aControl == true) {
		Removal_list.push(bControl);
		if (k == 0) { queryString += "?removal_list[]=" + bControl ; } else { queryString += "&removal_list[]=" + bControl; }
		k = k + 1;
	}	
	//alert("Success : " + aControl + ", : " + bControl);
   }
   //alert("Final List : " + Removal_list);
   
   
   var ajaxRequest;  // The variable that makes Ajax possible!
   try{
   
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
         
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
   
      ajaxRequest.onreadystatechange = function(){
   
      if(ajaxRequest.readyState == 4){
         var ajaxResult = ajaxRequest.responseText;
		
		if (ajaxResult == 0) {
			cmodal("User Rights Issue",  "User Rights Problem, Not Authorised....  Contact Admin for details", "error"); }
		else if (ajaxResult == -1) {
			cmodal("No Proper Selections",   "No Guest user accounts selected for removal", "warning"); }
		else {
			cmodal("Removal Completed..",  ajaxResult + " Guest user accounts removed successfully", "success"); }
	  }
   }
	//var queryString = "?removal_list[]=array(" + Removal_list + ")";
	ajaxRequest.open("GET", "ajax_rem_selected.php" + queryString, true);
	ajaxRequest.send(null);
   
}
</script>
</head>