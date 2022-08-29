<?php
include('header.php');
$username = $_SESSION['username'];

$ID= $_GET['uid'];        

$sql = "select * from users where id='$ID'"; 
$result = $conn->query($sql);
$row= mysqli_fetch_array($result);


if(isset($_POST["btnedit"]))
{

$firstname=$_POST['txtfirstname'];
$middlename=$_POST['txtmiddlename'];
$lastname=$_POST['txtlastname'];
$contact=$_POST['txtcontact'];
$sex=$_POST['cmdsex'];
$dept=$_POST['cmddept']; 


$sql = " update users set firstname='$firstname',middlename='$middlename',lastname='$lastname',gender='$sex',contact='$contact',dept='$dept' where id='$ID'";
   
   if (mysqli_query($conn, $sql)) {

header("Location: user-record.php");
}else{
$_SESSION['error']='Editing Was Not Successful';


}
}
?> 

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                       
                        <li class="active">
                            <strong>Edit User</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
            <div class="col-lg-7">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
			
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Edit User Account</h3>
             <form  action="" method="POST">
                                    <div class="form-group"><strong>
                                    <label>Firstname</label></strong>
                                    <input type="text" size="77" name="txtfirstname"  value="<?php echo $row['firstname'];   ?>" class="form-control" required="">
                                    </div>
									 <div class="form-group"><strong>
                                    <label>Middlename</label></strong>
                                    <input type="text" size="77" name="txtmiddlename"  value="<?php echo $row['middlename'];   ?>" class="form-control" required="">
                                    </div>
									 <div class="form-group"><strong>
                                    <label>Lastname</label></strong>
                                    <input type="text" size="77" name="txtlastname"  value="<?php echo $row['lastname'];   ?>" class="form-control" required="">
                                    </div>
									     <div class="form-group"><label>Phone</label> 
										 <input type="text" size="77" name="txtcontact" value="<?php echo $row['contact'];   ?>" class="form-control" >
										 </div>
										 <div class="form-group"><label>Sex</label> 
         <select name="cmdsex" id="select" class="form-control" required="">
    <option value = "<?php echo $row['gender'];   ?>"><?php echo $row['gender'];   ?></option>
	    <option value = "Male">Male</option>
	<option value = "Female">Female</option>


      </select> 
									
									</div>
					    
									     <div class="form-group"><label>Department</label> 
<select name="cmddept" id="select" class="form-control" required="">
    <option value = "<?php echo $row['dept'];   ?>"><?php echo $row['dept'];   ?></option>
	    <option value = "ICT">ICT</option>
	<option value = "Security">Security</option>
<option value = "Student Affairs">Student Affairs</option>
	<option value = "Exam and Records">Exam and Records</option>
<option value = "Rector">Rector</option>
	<option value = "Treasury">Treasury</option>
      </select> 					
</div>

                               
									
                                    <div>
                                      
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="btnedit">
                                        <div align="centre"><strong><i class="fa fa-paste"></i>  Edit</strong></div>
                                        </button>
                                  </div>
                                </form>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
              <div class="col-lg-5"></div>
            </div>
            <div class="row"></div>
        </div>
        <div class="footer">
            <div class="pull-right"></div>
            <div><?php  include('../footer.php'); ?></div>
        </div>

        </div>
        </div>


    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
		<link rel="stylesheet" href="popup_style.css">
<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Success</strong> 
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
      <button class="button button--success" data-for="js_success-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);  
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Error</strong> 
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
      <button class="button button--error" data-for="js_error-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
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
</body>

</html>
