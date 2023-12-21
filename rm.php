
<?php
  require_once("core/common.php");
  $hasAccess = checkAccess('RM', 'rm');
// checks if all necessary parameters are set in the URL
  if(isset($_GET["rpid"]) && isset($_GET["cid"]) && isset($_GET["inid"])){
// checks if all necessary parameters are set in the URL
    $productId = escape($_GET["rpid"]);
    $clientId = escape($_GET["cid"]);
    $investmentFk = escape($_GET["inid"]);
    $rmId = $_SESSION['user_id'];
// creates an array with the necessary data for a new entry in the "client_product" table
    $values = [
        'client_fk' 		=> $clientId,
        'product_fk' 			=> $productId,
        'rm_fk' 			  => $rmId,
        'investment_fk' 	=> $investmentFk
    ];
// adds a new entry to the "client_product" table with the given data
    if ( $dbManager->newData('client_product', $values)){
      header("Location: rm.php");
    }else{
      // if there is an error, prints the error message "error"
      echo "error";
    }
  }

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
            <li><a href="./contact.html">CONTACT</a></li>
            <?php
              if($hasAccess){
                echo '<li><a href="./logout.php">LOG OUT</a></li>';
              }
            ?>
          </ul>
        </div>
      </nav>
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
          <div class="rmname">
            <h3>Relationship Manager</h3>
          </div>
          <div class="rm-items">
            <li><a href="">CLIENTS</a></li>
          </div>
        </div>
        <div class="user-col2">
          <div class="board">
            <table width="100%">
              <thead>
                <tr>
                  <td>Name</td>
                  <td>Created at</td>
                  <td>Industry</td>
                  <td>Salary</td>
                  <td>Risk Level</td>
                  <td>Status</td>
                  <td>Recommend Product</td>
                </tr>
              </thead>
              <tbody>
                  <?php
                    $i = 1;
                    // Execute a SQL query to retrieve data from multiple tables and store the result set in $list
                    $list = $conn->query("SELECT ci.id as ci_id, ci.*, cp.*, u.* FROM client_investment ci LEFT JOIN client_product cp ON ci.id = cp.investment_fk LEFT JOIN user u ON ci.client_id = u.id");
                    // Get the number of rows returned by the query
                    $count = $list->num_rows;
                    // Loop through the result set and display each row in an HTML table
                    foreach ($list as $client) :
                  ?>
                    <tr>
                      <td class="people">
                        <div class="people-de">
                           <!-- Display the client's name, email, and region -->
                          <h5><?= $client['lastName'] . " " . $client['firstName']; ?></h5>
                          <p><?= $client['email']; ?></p>
                          <p><?= $client['region']; ?></p>
                        </div>
                      </td>
                      <td class="active"><p> <?= $client['create_date']; ?></p></td>
                      <td class="industry"><p><?= $client['industry']; ?></p></td>
                      <td class="salary"><p>$<?= $client['income']; ?></p></td>
                      <td class="risk_level"><p><?= $client['risk_level']; ?></p></td>
                      <td class="status"><p><?= $client['accepted'] ? "Accepted" : "Pending"; ?></p></td>
                      <td class="recommend">
                        <select <?= is_null($client['product_fk']) == 1 ? "" : "disabled"; ?> onchange="recommendProduct(<?= $client['client_id']; ?>, <?= $client['ci_id']; ?>);" id = "<?= $client['ci_id']."recommend" ?>" name="recommend">
                         <!-- Display an option to recommend no product -->
                          <option value = "recommend_no">Recommend</option>
                          <?php
                            $riskLevel = $client['risk_level'];
                            // Execute a SQL query to retrieve product data and store the result set in $list
                            $list = $conn->query("SELECT * FROM product");
                            // Get the number of rows returned by the query
                            $count = $list->num_rows;
                            // Loop through the result set and display each product in a dropdown menu
                            foreach ($list as $product) :
                          ?>
                          <!-- Display each product as an option in the dropdown menu -->
                            <option <?= $client['product_fk'] == $product['ID'] ? 'selected' : ''; ?> value = "<?= $product['ID'] ?>"><?= $product['ProductName'] . "(" . $product['RiskLevel'] . ") - " . $product['Region'] ?></option>
                          <?php $i++;
                            endforeach; 
                          ?>
                        </select>
                      </td>
                    </tr>
                <?php $i++;
                  endforeach; 
                ?>
              </tbody>
            </table>
          </div>
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

 <script>
  function recommendProduct(clientId, investmentId){
    // Get the selected product ID from the dropdown menu
    var productId = $("#" + investmentId + "recommend").val();
    // If the user selected "Recommend" or no product is selected, do nothing
    if(productId === 'recommend_no'){
      return;
    }
    // Log the product ID, client ID, and investment ID to the console for debugging purposes
    console.log(productId,clientId,investmentId);
    // If any of the required IDs are missing, do nothing
    if(!(productId && clientId && investmentId)){
      return;
    }

    console.log(productId,clientId,investmentId);
    // Prompt the user to confirm the selection
    let text = "Are you sure you want to update this investment with this product?";
    if (confirm(text) == true) {
      // If the user confirms, send a request to the PHP script with the selected product ID, client ID, and investment ID
      window.location.href = "rm.php?rpid=" + productId + "&cid=" + clientId + "&inid=" + investmentId ;
    }

  }
</script>
