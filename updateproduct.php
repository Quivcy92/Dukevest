
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial scale=1.0" />
    <title>DukeVest</title>
    <link href="style2.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <script src="indexj.js"></script>
  </head>

  <body>
    <section class="user-header">
      <!--- adds the navigation bar --->
      <nav id="home" class="same-line">
        <div class="nav-left">
          <ul>
            <li><a href="./index.php">HOME</a></li>
            <li><a href="./index.php #ourplans">PLANS</a></li>
            <li><a href="./index.php #aboutus">ABOUT US</a></li>
          </ul>
        </div>
        <div class="nav-right">
          <ul>
            <li><a href="">SEARCH</a></li>
            <li><a href="./contact-us.html">CONTACT</a></li>
            <?php
              if($hasAccess){
                echo '<li><a href="./logout.php">LOG OUT</a></li>';
              }
            ?>
          </ul>
        </div>
      </nav>
      <!---<div class="second-text-box">
        <h1>DUKEVEST</h1>
      </div>--->
    </section>
    <section id="menu">
      <div class="user-row">
        <div class="user-col">
          <div class="logo">
            <h2>DukeVest</h2>
          </div>
          <div class="img-area">
            <img src="images/user.jpeg" />
          </div>
          <div class="clientname">
            <h3>Admin</h3>
          </div>
          <div class="admin-items">
            <li ><a href="admin.php">CLIENT</a></li>
            <li ><a href="admin.php">PRODUCTS</a></li>
          </div>
        </div>
        <div class="user-col2">
          <!-- / / /  Creation of New Product / / / /  -->
          <?php
             require_once("core/common.php");
             $hasAccess = checkAccess('ADMIN', 'admin');

             $currentProductId = escape($_GET['upid']);
             $currentProduct;
             if(isset($currentProductId)){

              $prodDetails = [
                  'ID' => $currentProductId
              ];
              $currentProduct =  $dbManager->fetchSingleData('product', $prodDetails);
             }

             if(isset($_POST['submit'])){
                 $riskLevel = escape($_POST['risk_level']);
                 $region = escape($_POST['region']);
                 $entryPrice = escape($_POST['entry_price']);
                 $currency = escape($_POST['currency']);

                 $values = [
                      'riskLevel' 		=> $riskLevel,
                      'region' 	      => $region,
                      'entryPrice' 		=> $entryPrice,
                      'currency'      => $currency
                  ];

                  $cond = ['ID' => $currentProductId];

                  if ($dbManager->updateData('product', $values, $cond)){
                    echo "Successfully Updated Product";
                  }
             }

           ?>
          <div class="board">
            <div class="su-form">
              <h2>Update Investment Products</h2>
              <form action="" method="POST">
                <div class="su-details">
                  <label for="risk_level">Risk Level:</label>
                  <div class="su-input">
                    <input value = "<?= $currentProduct['RiskLevel']; ?>" id="risk_level" type="number" name="risk_level" max="5" min="1" required />
                  </div>
                </div>
                <div class="su-details">
                  <label for="region">Region:</label>
                  <div class="su-input">
                    <input value = "<?= $currentProduct['Region']; ?>" id="region" type="text" name="region" required/>
                  </div>
                </div>
                <div class="su-details">
                  <label for="entry_price">Entry Price:</label>
                  <div class="su-input">
                    <input value = "<?= $currentProduct['EntryPrice']; ?>" id="entry_price" type="text" name="entry_price" required />
                  </div>
                </div>
                <div class="su-details">
                  <label for="currency"> Currency:</label>
                  <div class="su-input">
                    <input value = "<?= $currentProduct['Currency']; ?>" id="currency" type="text" name="currency" required />
                  </div>
                </div>
                <hr />
                <!-- Submit Button for the New Product Creation Form -->
                <input value="Update Product" name = "submit" type="submit" class="su-btn" />
              </form>
            </div>
          </div>
          <!-- / / /  END of Creation of New product -->
        </div>
      </div>
    </section>

    <!----- footer ---->
    <section class="footer">
      <h4>Dukevest</h4>
      <p>
        Explore the best investment portals and glide your way into financial
        freedom
      </p>
      <div class="icons">
        <!---- adds the contact icons ---->
        <i class="fa fa-twitter"></i>
        <i class="fa fa-whatsapp"></i>
        <i class="fa fa-instagram"></i>
        <i class="fa fa-linkedin"></i>
      </div>
    </section>
  </body>
</html>
