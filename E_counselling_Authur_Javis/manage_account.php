<?php
session_start();
error_reporting(0);
include('../connect.php');

if(empty($_SESSION['id']))
  {   
  header("Location: login.php"); 
  }

$idd=$_SESSION['user_ID'];
$stmt = $dbh->query("SELECT * FROM users where user_ID='$idd'");
$row_user = $stmt->fetch();
  
if(isset($_POST["btnupdate"]))
{

$firstname = $_POST['txtfirstname'];
$lastname = $_POST['txtlastname'];
$middlename = $_POST['txtmiddlename'];
$contact = $_POST['txtcontact'];
$gender = $_POST['cmdsex'];
$dob = $_POST['txtdob'];
$email = $_POST['txtemail'];



$image= addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
$image_name= addslashes($_FILES['avatar']['name']);
$image_size= getimagesize($_FILES['avatar']['tmp_name']);
move_uploaded_file($_FILES["avatar"]["tmp_name"],"uploads/" . $_FILES["avatar"]["name"]);			
$location="uploads/" . $_FILES["avatar"]["name"];

//edit profile details
$sql = "UPDATE users SET firstname=?, lastname=?,middlename=?, contact=?, gender=?,dob=?, avatar=? where user_ID=?";
$stmt= $dbh->prepare($sql);
$stmt->execute([$firstname,$lastname,$middlename,$contact, $gender,$dob, $location,$idd]);
if($stmt) {
  
header("Location: ?page=logout"); 

}else{
//$error='Problem Editing Profile ';
}
}

  ?>
<style>
    #logo-img{
        width:200px;
        height:200px;
    }
</style>
<div class="col-md-8 offset-2">
    <div class="card shadow-lg">
        <div class="card-header rounded-0">
            <div class="card-title">Manage Account Information & Credentials</div>
        </div>
        <div class="card-body">
            <form action="" class="" id="update-account111111" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="lastname" class="control-label">Last Name</label>
                        <input type="text" id="lastname" autofocus name="txtlastname" class="form-control form-control-sm rounded-0" required value="<?php echo $row_user['lastname'] ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="firstname" class="control-label">First Name</label>
                        <input type="text" id="firstname" name="txtfirstname" class="form-control form-control-sm rounded-0" required value="<?php echo $row_user['firstname'] ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="middlename" class="control-label">Middle Name</label>
                        <input type="text" id="middlename" name="txtmiddlename" class="form-control form-control-sm rounded-0" placeholder = "(optional)" value="<?php echo $row_user['middlename'] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender" class="control-label">Gender</label>
                            <select type="text" id="gender" name="cmdsex" class="form-control form-control-sm rounded-0" required>
                                <option><?php echo $row_user['gender'] ?></option>
								       <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contact" class="control-label">Contact #</label>
                            <input type="text" id="contact" pattern="[0-9+/s//]+" name="txtcontact" class="form-control form-control-sm rounded-0" required value="<?php echo $row_user['contact'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob" class="control-label">Date of Birth</label>
                            <input type="date" id="dob" name="txtdob" class="form-control form-control-sm rounded-0" required value="<?php echo $row_user['dob'] ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" id="email" name="txtemail" class="form-control form-control-sm rounded-0" required value="<?php echo $row_user['email'] ?>" readonly="">
                </div>
               
                <div class="form-group">
                    <label for="avatar" class="control-label">User Avatar</label>
                    <input type="file" name="avatar" id="avatar" class="form-control form-control-sm rounded-0" accept="image/png,image/jpeg" onchange="display_img(this)">
                </div>
                <div class="form-group text-center mt-2">
                    <img src="<?php echo $row_user['avatar'] ?>" id="logo-img" alt="Avatar">
                </div>
                <div class="form-group d-flex w-100 justify-content-end">
                    <button class="btn btn-sm btn-primary rounded-0 my-1" name="btnupdate">Update Account</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
    $(function(){
        $('#manage_account').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            _this.find('button').attr('disabled',true)
            _this.find('button[type="submit"]').text('Updating...')
            $.ajax({
                url:'./Actions.php?a=update_credentials',
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
                    $('#page-container,html,body').animate({scrollTop:0},'fast')
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        location.href='./?page=profile';
                    }else{
                        _el.addClass('alert alert-danger')
                    }
                    _el.text(resp.msg)

                    _el.hide()
                    _this.prepend(_el)
                    _el.show('slow')
                    $('#page-container,html,body').animate({scrollTop:0},'fast')
                    _this.find('button').attr('disabled',false)
                    _this.find('button[type="submit"]').text('Save')
                }
            })
        })
    })
</script>