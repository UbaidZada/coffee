
<?php require "header/navbar.php" ?>

<?php
 include('connection/connection.php');  
?>

<?php 

if(isset($_SESSION['username'])){

	header('location:index.php');

}else{


	$sqlfetch = "SELECT * FROM `register_user`";

$fetchprepare = $connection->prepare($sqlfetch);

$fetchprepare->execute();

$fetch = $fetchprepare->fetchAll(PDO::FETCH_ASSOC);

//  print_r($fetch);

if(isset($_POST['login'])){

	$email = $_POST['email'];
	$password = $_POST['password'];

	$isloginNOTSuccessfull = false;

foreach($fetch as $data){

	if($email ===  $data['user_email'] &&  password_verify($password,$data['user_password'])){

        $_SESSION['userid'] = $data['user_id'];
        $_SESSION['username'] = $data['user_name'];
        $_SESSION['useremail'] = $data['user_email'];

        header('location:index.php');

	}else{

		$isloginNOTSuccessfull = true;
		
		
		
	}
	
}

	  if($isloginNOTSuccessfull){

echo "<script>alert('login UnSucceessfull')</script>";

	  }

}



}




?>


    <!-- END nav -->

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/bg_1.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Login</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Login</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 ftco-animate">
			<form action="<?php $_SERVER['PHP_SELF']?>" method = "post" class="billing-form ftco-bg-dark p-3 p-md-5">
				<h3 class="mb-4 billing-heading">Login</h3>
	          	<div class="row align-items-end">
	          		<div class="col-md-12">
	                <div class="form-group">
	                	<label for="Email">Email</label>
	                  <input type="text" class="form-control" placeholder="Email" name  = "email">
	                </div>
	              </div>
                 
	              <div class="col-md-12">
	                <div class="form-group">
	                	<label for="Password">Password</label>
	                    <input type="password" class="form-control" placeholder="Password" name = "password">
	                </div>

                </div>
                <div class="col-md-12">
                	<div class="form-group mt-4">
							<div class="radio">
                                <input type = "submit" class="btn btn-primary py-3 px-4" value="Login" name = "login" >
						    </div>
					</div>
                </div>

               
	          </form><!-- END -->
          </div> <!-- .col-md-8 -->
          </div>
        </div>
      </div>
    </section> <!-- .section -->


    <?php require "header/footer.php" ?>


  <script>
		$(document).ready(function(){

		var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		            
		            $('#quantity').val(quantity + 1);

		          
		            // Increment
		        
		    });

		     $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>0){
		            $('#quantity').val(quantity - 1);
		            }
		    });
		    
		});
	</script>


    


  </body>
</html>