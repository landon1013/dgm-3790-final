<?php
	session_start();
//$row = mysqli_fetch_array($data);

			//setcookie('username', $row['username'], time()+(60*60*24*30));
require_once('variables.php');
//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection failed');
//BUILD THE query
$brand_query = "SELECT DISTINCT(brand) FROM `inventory` ORDER BY 'brand'";
//NOW TRY AND TALK TO THE database
$result = mysqli_query($dbconnection, $brand_query) or die ('query failed');
?>
   <?php include_once('header.php')?>
    <title>Checkout - Card</title>
  </head>
  <body >
    <?php include_once('nav.php'); ?>
<div id="shop" class="container">
    <div id="main">
      <div class="shop-container">
        <h1 class="shop-title">Our Products</h1>
        <?php
			while($row = mysqli_fetch_array($result)){
        $brand = $row['brand'];
        $query = "SELECT `model`, `image`, `price` FROM inventory WHERE `brand` = '$brand' GROUP BY `model`";
        $brand_result = mysqli_query($dbconnection, $query) or die ('query failed');
				echo '<h1>'.$row['brand'].'</h1>';
        echo '<div class="shop-container-inner">';
        while($row2 = mysqli_fetch_array($brand_result)) {
          echo '<div class="shop-item">';
           echo'   <img class="shop-item-img" src= img/'.$row2['image'].'>';
             echo '<h6 class="shop-item-title">'.$row2['model'].'</h6>
              <p class="shop-item-price">'.$row2['price'].'</p><br>
              <div  name="'.$row2['model'].'" class="viewDetails" isclicked="">View Details</div>
          </div>';
				//echo $_SESSION[];
        }
        echo '</div>';
			}

			?>
      </div>
    </div>
  </div> <!-- end of main div -->
</div> <!-- end of container div -->
<?php include_once('footer.php'); ?>
