
<?php require "header/navbar.php" ?>
<?php require "connection/connection.php" ?>


<?php

$id = $_GET['prodId'];

$singleproductqurey =  "SELECT * FROM `products` WHERE prod_id = :id";


$singleprepare = $connection->prepare($singleproductqurey);
$singleprepare->bindParam(':id',$id);
$singleprepare->execute();

 $fetch = $singleprepare->fetch(PDO::FETCH_ASSOC);
// print_r($fetch);


//  related products start

$relatedproduct = "SELECT * FROM `products` WHERE prod_id != :id AND type = :type";

$relatedprepare = $connection->prepare($relatedproduct);
$relatedprepare->bindParam(':id',$id);
$relatedprepare->bindParam(':type',$fetch['type']);
$relatedprepare->execute();

$fetchrelated = $relatedprepare->fetchAll(PDO::FETCH_ASSOC);

// print_r($fetchrelated);


//  related products end

// Add to card start


if(isset($_POST['cart_submit'])){


if(isset($_SESSION['userid'])){


$price = $_POST['inputPrice'];
@$size = $_POST['size'];
$quantity = $_POST['quantity'];

$cart_insert_query = "INSERT INTO `cart`(`prod_name`, `prod_price`, `prod_description`, `quantity`, `size`, `prod_image`, `prod_id`, `user_id`) VALUES (:prodname, :prodprice, :prodDescription, :quantity, :size, :prodimage, :pridId, :userId)";


$cart_prepare = $connection->prepare($cart_insert_query);

$cart_prepare->bindParam(':prodname',$fetch['prod_name']);
$cart_prepare->bindParam(':prodprice',$price);
$cart_prepare->bindParam(':prodDescription',$fetch['prod_description']);
$cart_prepare->bindParam(':quantity',$quantity);
$cart_prepare->bindParam(':size',$size);
$cart_prepare->bindParam(':prodimage',$fetch['prod_image']);
$cart_prepare->bindParam(':prodId',$prodId);
$cart_prepare->bindParam(':userId',$_SESSION['userid']);


$cart_prepare->execute();


}else{

	echo "<script>alert('Kindly login to add to cart your product')</script>";

}


}



// Add to card end



// cart data start

$cart_fetch_query = "SELECT * FROM cart where prod_id = :prodId";

$cart_prepare = $connection->prepare($cart_fetch_query);
$cart_prepare->bindParam(':prodId', $id);
$cart_prepare->execute();

$cart_Data = $cart_prepare->fetch(PDO::FETCH_ASSOC);

// cart data end




?>





<!-- END nav -->

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Product Detail</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Product Detail</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-6 mb-5 ftco-animate">
    				<a href="images/menu-2.jpg" class="image-popup"><img src="images/<?= $fetch['prod_image']?>" class="img-fluid" alt="Colorlib Template"></a>
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3><?php echo $fetch['prod_name']?></h3>
    				<p class="price" ><span id = "prodPrice">$<?php echo $fetch['prod_price']?></span></p>
    				<p><?php echo $fetch['prod_description']?></p>
						</p>
						<div class="row mt-4">
							<div class="col-md-6">
								<div class="form-group d-flex">
			<form action="product-single.php?prodId=<?php echo $fetch['prod_id'] ?>" method = "post" >

		              <div class="select-wrap">
	                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
	                  <select name="" id="product_size" class="form-control">
	                  	<option value="small">Small</option>
	                    <option value="medium">Medium</option>
	                    <option value="large">Large</option>
	                    <option value="extra large">Extra Large</option>
	                  </select>
	                </div>
		            </div>
							</div>
							<div class="w-100"></div>
							<div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
	                   <i class="icon-minus"></i>
	                	</button>
	            		</span>
	             	<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
	             	<span class="input-group-btn ml-2">
	                	<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
	                     <i class="icon-plus"></i>
	                 </button>
	             	</span>
	          	</div>
          	</div>

			<?php   
			if(is_array($cart_Data)){
			
			if(is_array($cart_Data['prod_id']) === $fetch['prod_id']) {?>
			
				<p>Already added in the Cart</p>
			<?php

			}}

			else{
			?>

            <input type="hidden" value = "<?php echo $fetch['prod_price']?>" name = "inputPrice">
          	<p><input type = "submit" value = "Add to Cart" name = "cart_submit" class="btn btn-primary py-3 px-5"></p>

			  </form>

			  <?php   } ?>
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
          	<span class="subheading">Discover</span>
            <h2 class="mb-4">Related products</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </div>
        <div class="row">
        	<!-- <div class="col-md-3">
        		<div class="menu-entry">
    					<a href="#" class="img" style="background-image: url(images/menu-1.jpg);"></a>
    					<div class="text text-center pt-4">
    						<h3><a href="#">Coffee Capuccino</a></h3>
    						<p>A small river named Duden flows by their place and supplies</p>
    						<p class="price"><span>$5.90</span></p>
    						<p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
    					</div>
    				</div>
        	</div>
        	<div class="col-md-3">
        		<div class="menu-entry">
    					<a href="#" class="img" style="background-image: url(images/menu-2.jpg);"></a>
    					<div class="text text-center pt-4">
    						<h3><a href="#">Coffee Capuccino</a></h3>
    						<p>A small river named Duden flows by their place and supplies</p>
    						<p class="price"><span>$5.90</span></p>
    						<p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
    					</div>
    				</div>
        	</div>
        	<div class="col-md-3">
        		<div class="menu-entry">
    					<a href="#" class="img" style="background-image: url(images/menu-3.jpg);"></a>
    					<div class="text text-center pt-4">
    						<h3><a href="#">Coffee Capuccino</a></h3>
    						<p>A small river named Duden flows by their place and supplies</p>
    						<p class="price"><span>$5.90</span></p>
    						<p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
    					</div>
    				</div>
        	</div> -->

<?php

foreach($fetchrelated as $related){

?>
        	<div class="col-md-3">
        		<div class="menu-entry">
    					<a href="#" class="img" style="background-image: url(images/<?php echo $related['prod_image'] ?>);"></a>
    					<div class="text text-center pt-4">
    						<h3><a href="#"><?php echo $related['prod_name'] ?></a></h3>
    						<p><?php echo $related['prod_description'] ?></p>
    						<p class="price"><span>$<?php echo $related['prod_price'] ?></span></p>
    						<p><a href="product-single.php?prodId=<?php echo $related['prod_id'] ?>" class="btn btn-primary btn-outline-primary">Show</a></p>
    					</div>
    				</div>
        	</div>

<?php    }  ?>

        </div>
    	</div>
    </section>

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




let productSize = document.getElementById('product_size');
let prodPrice = document.getElementById('prodPrice');

productSize.addEventListener('change',()=>{

console.log(productSize.value);

if(productSize.value == 'small'){
prodPrice.innerHTML = '$<?php echo $fetch['prod_price'] ?>';
inputPrice.value = '<?php echo $fetch['prod_price'] ?>';

}

if(productSize.value == 'medium'){
prodPrice.innerHTML = '$<?php echo $fetch['prod_price'] +2.5 ?>';
inputPrice.value = '<?php echo $fetch['prod_price'] ?>';

}

if(productSize.value == 'large'){
prodPrice.innerHTML = '$<?php echo $fetch['prod_price'] +4.5 ?>';
inputPrice.value = '<?php echo $fetch['prod_price'] ?>';

}

if(productSize.value == 'extra large'){
prodPrice.innerHTML = '$<?php echo $fetch['prod_price'] +6.5 ?>';
inputPrice.value = '<?php echo $fetch['prod_price'] ?>';

}






})











	</script>


  </body>
</html>