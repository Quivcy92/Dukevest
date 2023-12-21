<?php
  require_once("core/common.php");
  $hasAccess = checkAccess('ADMIN', 'admin');

  if(isset($_POST['submit'])){
      $productName = escape($_POST['product_name']);
      $industry = escape($_POST['industry']);
      $riskLevel = escape($_POST['risk_level']);
      $region = escape($_POST['region']);
      $entryPrice = escape($_POST['entry_price']);
      $currency = escape($_POST['currency']);

      if($dbManager->checkIfProductExists($productName)){
        echo "Product already Exists";
      } else {
        $values = [
            'productName' 	=> $productName,
            'industry' 			=> $industry,
            'riskLevel' 		=> $riskLevel,
            'region' 	      => $region,
            'entryPrice' 		=> $entryPrice,
            'currency'      => $currency
        ];

        if ($dbManager->newData('product', $values)){
          echo "Successfully created product";
        }
      }
  }

  if(isset($_GET["dplid"])){
    $pid = escape($_GET["dplid"]);
    $conn->query("DELETE FROM product WHERE ID = $pid");
    header("Location: admin.php");
  }

  $productCount = [];

?>
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
            <li id="client"><a href="">CLIENT</a></li>
            <li id="new_product"><a href="">CREATE PRODUCT</a></li>
            <li id="product"><a href="">PRODUCTS</a></li>
            <!-- <li id="payment"><a href="">PAYMENT</a></li> -->
          </div>
        </div>
        <div class="user-col2">
          <div class="board client">
            <table width="100%">
              <thead>
                <tr>
                  <td>Client Name</td>
                  <td>Email</td>
                  <td>Active Investment-Risk Level-Region</td>
                </tr>
              </thead>
              <tbody>
                  <?php
                    $i = 1;
                    $list = $conn->query("SELECT * FROM user WHERE accountType = 'CLIENT' ORDER BY id desc");
                    $count = $list->num_rows;
                    foreach ($list as $client) :
                  ?>
                    <tr class="admin-row">
                      <td>
                        <p><?= $client['lastName'] . " " . $client['firstName']; ?></p>
                      </td>
                      <td>
                        <p><?= $client['email']; ?></p>
                      </td>
                      <td>
                        <p>
                        <?php
                          $clientId = $client['id'];
                          $list = $conn->query("SELECT pr.ProductName, pr.RiskLevel, pr.Region FROM client_product cp LEFT JOIN client_investment ci ON ci.id = cp. investment_fk LEFT JOIN product pr ON pr.ID = cp.product_fk WHERE ci.client_id = $clientId");

                          $count = $list->num_rows;
                          $i = 0;
                          if($count > 0){
                            $result = "";
                            foreach ($list as $investment) :
                              $result = $result . "[ " .$investment['ProductName']."-".$investment['RiskLevel']."-".$investment['Region']."]";
                              if($i < $count - 1){
                                $result = $result . ",";
                              }
                              $i++;
                            endforeach;
                            echo $result;
                          } else {
                            echo "N/A";
                          }
                          
                        ?> 
                        
                        </p>
                      </td>
                    </tr>
                <?php $i++;
                  endforeach; 
                ?>
              </tbody>
            </table>
          </div>
          <div class="board product">
            <table width="100%">
              <thead>
                <tr>
                  <td>Product Name</td>
                  <td>Region</td>
                  <td>Industry</td>
                  <td>Entry Price</td>
                  <td>Risk Level</td>
                  <td>Create Date</td>
                  <td>Active Clients</td>
                  <td>Actions</td>
                </tr>
              </thead>
              <tbody>
                <?php
                  $list = $conn->query("SELECT * FROM product ORDER BY createdAt desc");
                  $count = $list->num_rows;
                  foreach ($list as $product) :
                ?>
                  <tr class="admin-row">
                    <td>
                      <p><?= $product['ProductName']; ?></p>
                    </td>
                    <td>
                      <p><?= $product['Region']; ?></p>
                    </td>
                    <td>
                      <p><?= $product['Industry']; ?></p>
                    </td>
                    <td>
                      <p><?= $product['EntryPrice'] . "(" . $product['Currency'] . ")"; ?></p>
                    </td>
                    <td>
                      <p><?= $product['RiskLevel']; ?></p>
                    </td>
                    <td>
                      <p>
                        <?= $product['CreatedAt']; ?>
                      </p>
                    </td>
                    <td>
                      <p>
                        <?php 
                          $productId = $product['ID'];
                          $result = $conn->query("SELECT * FROM client_product WHERE product_fk = $productId and accepted = 1");
                          $proCount = $result->num_rows;
                          $productCount[$productId] = $proCount;
                          echo $proCount;
                        ?>
                      </p>
                    </td>
                    <td>
                      <?php
                        if($productCount[$productId] == 0) {
                          echo "<a class = 'action-btn' onclick='deleteProduct(" .$product['ID'].")'>delete</a>";
                        } 
                      ?>
                      <a class = "action-btn" onclick="updateProduct(<?= $product['ID']; ?>)">update</a>
                    </td>
                  </tr>
                <?php
                  endforeach; 
                ?>
              </tbody>
            </table>
          </div>

          <!-- / / /  Creation of New Product / / / /  -->
          <div class="board newProduct">
            <div class="su-form">
              <h2>Create New Investment Products</h2>
              <form action="" method="POST">
                <div class="su-details">
                  <label for="product_name">Product Name:</label>
                  <div class="su-input">
                    <input id="product_name" type="text" name="product_name" required />
                  </div>
                </div>
                <div class="su-details">
                  <label for="industry">Industry:</label>
                  <div class="su-input">
                    <input id="industry" type="text" name="industry" required />
                  </div>
                </div>
                <div class="su-details">
                  <label for="risk_level">Risk Level:</label>
                  <div class="su-input">
                    <input id="risk_level" type="number" name="risk_level" max="5" min="1" required />
                  </div>
                </div>
                <div class="su-details">
                  <label for="region">Region:</label>
                  <div class="su-input">
                    <input id="region" type="text" name="region" required/>
                  </div>
                </div>
                <div class="su-details">
                  <label for="entry_price">Entry Price:</label>
                  <div class="su-input">
                    <input id="entry_price" type="text" name="entry_price" required />
                  </div>
                </div>
                <div class="su-details">
                  <label for="currency"> Currency:</label>
                  <div class="su-input">
                    <input id="currency" type="text" name="currency" required />
                  </div>
                </div>
                <hr />
                <!-- Submit Button for the New Product Creation Form -->
                <input value="Create Product" name = "submit" type="submit" class="su-btn" />
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
    <script>

      function deleteProduct(productId){
        let text = "Are you sure you want to delete product?";
        if (confirm(text) == true) {
          window.location.href = "admin.php?dplid=" + productId;
        }
      }

      function updateProduct(productId){
        window.location.href = "updateproduct.php?upid=" + productId;
      }

      $(document).ready(function () {
        $("#client").click(function () {
          $(".board.product").css({ display: "none" });
          // $(".board.payment").hide();
          $(".board.newProduct").hide();
          $(".board.client").show();
          $(this).css({
            "background-color": "#C0C0C0",
            color: "#eee",
          });
          $("#product, #new_product").css({
            "background-color": "#ccc",
          });
          return false;
        });
        $("#new_product").click(function () {
          $(".board.product").css({ display: "none" });
          // $(".board.payment").hide();
          $(".board.client").hide();
          $(".board.newProduct").show();
          $(this).css({
            "background-color": "#C0C0C0",
            color: "#eee",
          });
          $("#product, #client").css({
            "background-color": "#ccc",
          });
          return false;
        });
        $("#product").click(function () {
          $(".board.client").css({ display: "none" });
          // $(".board.payment").hide();
          $(".board.newProduct").hide();
          $(".board.product").show();
          $(this).css({
            "background-color": "#C0C0C0",
            color: "#eee",
          });
          $("#client, #new_product").css({
            "background-color": "#ccc",
          });
          return false;
        });
      });
    </script>
  </body>
</html>
