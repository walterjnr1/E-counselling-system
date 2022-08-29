<?php
session_start();
error_reporting(1);

if(isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0){
    header("Location:./");
    exit;
}
require_once('./DBConnection.php');
include('connect.php');


$page = isset($_GET['page']) ? $_GET['page'] : 'home';


 date_default_timezone_set('Africa/Lagos');
 $current_date = date('Y-m-d H:i:s');

if(isset($_POST["btnsave"]))
{
sleep(5);
///check if email already exist
$stmt = $dbh->prepare("SELECT * FROM users WHERE email=?");
$stmt->execute([$_POST["txtemail"]]); 
$user = $stmt->fetch();

if ($user) {

$message = '
 <div class="alert alert-danger">This Email Already Exist </div> ';
 
  
} else {


$image= addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
$image_name= addslashes($_FILES['avatar']['name']);
$image_size= getimagesize($_FILES['avatar']['tmp_name']);
move_uploaded_file($_FILES["avatar"]["tmp_name"],"uploads/" . $_FILES["avatar"]["name"]);			
$location="uploads/" . $_FILES["avatar"]["name"];

		
$query = "INSERT INTO users (firstname,middlename,lastname,contact,gender,dob,email,password,user_id,dept,avatar) VALUES (:firstname,:middlename,:lastname,:contact,:gender,:dob,:email,:password,:user_id,:dept,:avatar)";
 
 $user_data = array(
  ':firstname'  => $_POST["txtfirstname"],
    ':middlename'   => $_POST["txtmiddlename"],
  ':lastname'   => $_POST["txtlastname"],
  ':contact'   => $_POST["txtcontact"],
  ':gender'   => $_POST["cmdsex"],
  ':dob'   => $_POST["txtdob"],
  ':email'   => $_POST["txtemail"],
  ':password'   => md5($_POST["txtpassword"]),
   ':user_id'   => $_POST["txtuser_ID"],
    ':dept'   => $_POST["cmddept"],
  ':avatar'   => $location
 );
 $statement = $dbh->prepare($query);
 if($statement->execute($user_data))
 {
$message = ' <div class="alert alert-success">User Registration was successful</div> ';
}
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | E-Counselling system</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/custom.css">
		<link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">

    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/script.js"></script>
    <style>
        html, body{
            height:100%;
        }
        #logo-img{
            width:75px;
            height:75px;
            object-fit:scale-down;
            background : var(--bs-light);
            object-position:center center;
            border:1px solid var(--bs-dark);
            border-radius:50% 50%;
        }
    </style>
</head>
<body class="bg-light bg-gradient">
   <div class="h-100 d-flex jsutify-content-center align-items-center">
       <div class='w-100'>
        <h3 class="py-5 text-center">&nbsp;</h3>
        <h3 class="py-5 text-center">&nbsp;</h3>
        <h3 class="py-5 text-center">E-Counselling system - User Registration</h3>
        <h5 align="center" ><?php echo $message; ?></h5> 
        </p></p>
        <div class="card my-3 col-md-8 offset-md-2">
            <div class="card-body">
                <form action="" method="POST" id="register-form11111111111111111111111" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="0">
                    <div class="form-group row">
                        
                        <div class="col-md-6">
                            <label for="firstname" class="control-label">First Name</label>
                            <input type="text" id="firstname" name="txtfirstname" class="form-control form-control-sm rounded-0" required>
                        </div>
                       <div class="col-md-6">
                            <label for="lastname" class="control-label">Middle Name</label>
                            <input type="text" id="txtmiddlename" autofocus name="txtmiddlename" class="form-control form-control-sm rounded-0" required>
                      </div>
						<div class="col-md-6">
                            <label for="lastname" class="control-label">Last Name</label>
                            <input type="text" id="lastname" autofocus name="txtlastname" class="form-control form-control-sm rounded-0" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender" class="control-label">Gender</label>
                                <select type="text" id="gender" name="cmdsex" class="form-control form-control-sm rounded-0" required>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="contact" class="control-label">Contact #</label>
                                <input type="text" id="contact" pattern="[0-9+/s//]+" name="txtcontact" class="form-control form-control-sm rounded-0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dob" class="control-label">Date of Birth</label>
                                <input type="date" id="dob" name="txtdob" class="form-control form-control-sm rounded-0" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        <input type="email" id="email" name="txtemail" class="form-control form-control-sm rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" id="password" name="txtpassword" class="form-control form-control-sm rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="cpassword" class="control-label">Confirm Password</label>
                        <input type="password" id="cpassword" name="txtcpassword" class="form-control form-control-sm rounded-0" required>
                    </div>
					<div class="form-group">
                        <label for="user_ID" class="control-label">User ID/Reg No.</label>
                        <input type="text" id="user_ID" name="txtuser_ID"  class="form-control form-control-sm rounded-0" required>
                    </div>
					<div class="form-group">
                        <label for="user_ID" class="control-label">Department</label>
        <select name="cmddept" id="dept" class="form-control" required="">
       <option value = "">---Select dept---</option>
       <option value = "Computer Science">Computer Science</option>
        <option value = "Information technology">Information Technology</option>
        <option value = "Electrical Engineering">Electrical Engineering</option>
        <option value = "Mechanical Engineering">Mechanical Engineering</option>

      </select>                     
	   </div>
                    <div class="form-group">
                        <label for="avatar" class="control-label">User Avatar</label>
                        <input type="file" name="avatar" id="avatar" required class="form-control form-control-sm rounded-0" accept="image/png,image/jpeg" <?php echo !isset($employee_id) ? 'required' : '' ?> onChange="display_img(this)">
                    </div>
                    <div class="form-group text-center mt-2">
                        <img src="././images/no-image-available.png" alt="Avatar" width="200" height="189" id="logo-img">            
						        </div>
                    <div class="form-group d-flex w-100 justify-content-between">
                        <a href="./">Already has an Account?</a>
                        <button class="btn btn-sm btn-primary rounded-0 my-1" name="btnsave">Save</button>
                    </div>
                </form>
            </div>
        </div>
       </div>
   </div>
</body>
<script>
    function display_img(input){
        if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#logo-img').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
    }
    $(function(){
        $('#register-form').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            $('#password, #cpassword').removeClass('border-danger border-success')
            $('.err_msg').remove()
            if($('#password').val() != $('#cpassword').val()){
                $('#password, #cpassword').addClass('border-danger')
                $('#cpassword').after('<small class="text-danger err_msg">Password doesn\'t match</small>')
                return false;
            }
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            _this.find('button').attr('disabled',true)
            _this.find('button[type="submit"]').text('Saving data...')
            $.ajax({
                url:'././Actions.php?a=save_user',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error:err=>{
                    console.log(err)
                    _el.addClass('alert alert-danger')
                    _el.text("An error occurred.")
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled',false)
                    _this.find('button[type="submit"]').text('Save')
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        _el.addClass('alert alert-success')
                        setTimeout(() => {
                            location.replace('./');
                        }, 2000);
                    }else{
                        _el.addClass('alert alert-danger')
                    }
                    _el.text(resp.msg)

                    _el.hide()
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled',false)
                    _this.find('button[type="submit"]').text('Save')
                }
            })
        })
    })
</script>
 <script>
    function display_img(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#logo-img').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
   
</script>
</html>