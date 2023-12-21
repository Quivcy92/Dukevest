<?php
  require_once("core/common.php");
  $hasAccess = checkAccess('CLIENT', 'client');

  //  For when client accepts a product 
  if(isset($_GET["cpid"])){ 
    $cpid = escape($_GET["cpid"]);
    $currentTimestamp = date('Y-m-d H:i:s',time());
    $conn->query("UPDATE client_product SET accepted = '1', date_accepted = '$currentTimestamp' WHERE id = $cpid");
    header("Location: client.php");
  }

  // For when clients submits investment preferences form
  if(isset($_POST['submit_client_investment'])){

    $region = escape($_POST['region']);
    $industry = escape($_POST['industry']);
    $income = escape($_POST['income']);
    $risk_level = escape($_POST['risk_level']);
    $currentUserId = $_SESSION['user_id'];

    $clientInvestment = [
        'region' => $region,
        'industry' => $industry,
        'income' => $income,
        'risk_level' => $risk_level,
        'client_id' => $currentUserId
    ];

    if ($dbManager->newData('client_investment', $clientInvestment)){
      header("Location: client.php");
    }else{
      echo "error creating client investment";
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
            <li><a href="./index.php">PLANS</a></li>
            <li><a href="./index.php">ABOUT US</a></li>
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
          <div class="clientname">
            <h3>            
              <?php
                echo $_SESSION['user_email'] . "(" . $_SESSION['user_name'] . ")";
              ?>
            </h3>
          </div>
          <div class="edit">
            <i class="fa fa-pencil-square-o">Edit Profile</i>
          </div>
          <div class="items">
            <li id="portfolio"><a href="">MY PORTFOLIO</a></li>
            <li id="investment"><a href="">INVESTMENT</a></li>
            <li id="banking"><a href="">BANKING</a></li>
            <li id="wealth-mgt"><a href="">WEALTH MANAGEMENT</a></li>
          </div>
        </div>
        <div class="user-col2" id="banking-div" style="display: none">
          <div class="plan-headers">
            <h1>BANKING</h1>
            <p>
              Banking is a vital part of managing personal finances. For the
              everyday business man and woman, entrepreneur, banking is an
              important part of financial planning, providing the means to save,
              invest, and access necessary funds. Our banking services can help
              with budgeting and achieving financial goals, such as saving for
              retirement or a home.
            </p>
          </div>
          <div class="banking">
            <div class="row">
              <div class="plans-col">
                <div class="pba">
                  <h3>Provide Bank Account</h3>
                  <ul class="pba-menu">
                    <li><a href="">Private Banking</a></li>
                    <li><a href="">Offshore Banking</a></li>
                  </ul>
                  <input
                    type="submit"
                    name="submit"
                    value="Switch Account"
                    class="form-btn"
                  />
                </div>
              </div>
              <div class="plans-col">
                <img src="images/user.jpeg" />
              </div>
            </div>
          </div>
        </div>
        <section
          class="user-col2"
          id="investment-section"
          style="display: none"
        >
          <div class="plan-headers">
            <h1>INVESTMENT</h1>
            <p>
              Our investment services and tools are the best in the industry,
              making them the perfect choice for businesses, entrepreneurs and
              business-minded individuals. Professional and experienced, we
              provide the highest quality resources to help you make informed
              decisions about your investments. Moreover, our services and tools
              are designed to maximize your profits and minimize your risks.
            </p>
            <h2>Go ahead and select your preferences to start investing.</h2>
          </div>
          <div class="invest">
            <div class="invest-form">
              <form action="" method="POST">
                <label for="region">Select Your Region</label>
                <select id="region" name = "region">
                  <option value="australia">Australia</option>
                  <option value="usa">USA</option>
                  <option value="uk">United Kingdom</option>
                  <option value="canada">Canada</option>
                  <option value="india">India</option>
                  <option value="pakistan">Pakistan</option>
                  <option value="nepal">Nepal</option>
                </select>
                <label for="industry">Select Industry</label>
                <select id="industry" name = "industry">
                  <option value="medicare">Medicare</option>
                  <option value="mining">Mining</option>
                  <option value="energy">Energy</option>
                  <option value="finance">Finance</option>
                  <option value="agro">Agriculture</option>
                </select>
                <label for="income">How Much Do You Earn?</label>
                <input type="number" name="income" min="0" />
                <label for="risk_level">Choose risk level (from 1-5) </label>
                <input
                  id="risk_level"
                  type="number"
                  name="risk_level"
                  max="5"
                  min="1"
                  required
                />
                <input
                type="submit"
                name="submit_client_investment"
                value="submit"
                class="form-btn"
                />
              </form>
              
            </div>
          </div>
        </section>

        <section
          class="user-col2"
          id="wealth-mgt-section"
          style="display: none"
        >
          <div class="plan-headers">
            <h1>WEALTH MANAGEMENT</h1>
            <p>
              Wealth management and sustainability are closely linked, requiring
              professional approaches to ensure both are optimally managed. We
              consider environmental and social impacts when making investment
              decisions, while also ensuring their clients' portfolios remain
              profitable. To do this, we take into account factors such as
              climate change, energy transition and the social consequences of
              certain investments. By doing so, we can help our clients manage
              their wealth responsibly and sustainably.
            </p>
          </div>
          <div class="wealth-mgt">
            <p>contact our financial adviser<br />for more details</p>
            <input
              type="submit"
              name="submit"
              value="Contact Adviser"
              class="form-btn"
            />
          </div>
        </section>
        <section
          class="user-col2"
          id="portfolio-section"
        >
          <div class="portfolio-header">
            <h1>MY PORTFOLIO</h1>
            <p>
              Unlock your investment opportunities with a live track of all important events. See all the investment packages we have tailored for you based on your preferences.
            </p>
          </div>
          <div class="portfolio-products">
            <div class="row">
              <?php
                $i = 1;
                $currentUserId = $_SESSION['user_id'];
                $list = $conn->query("SELECT * FROM client_product cp left join product p on p.id = cp.product_fk where cp.client_fk = $currentUserId ORDER BY cp.id asc");
                $count = $list->num_rows;
                foreach ($list as $clientProduct) :
              ?>
                <div class="plans-col">
                  <div class="product1">
                    <h4><?= $clientProduct['ProductName']; ?></h4>
                    <input
                      type="submit"
                      onclick="acceptProduct(<?= $clientProduct['id']; ?>, <?= $clientProduct['accepted']; ?>)"
                      value="<?php
                        if($clientProduct['accepted']) {
                            echo 'Accepted';
                        } else{
                            echo 'Accept';
                        }
                      ?>"
                      class="<?php
                        if($clientProduct['accepted']) {
                            echo 'active-prd';
                        } else{
                            echo 'form-btn';
                        }
                      ?>"
                    />
                  </div>
                </div>
              <?php $i++;
                endforeach; 
              ?>
            </div>
          </div>
        </section>
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

      function acceptProduct(clientProductId, accepted){
          
        if(accepted == 1){
          return;
        }

        window.location.href = "client.php?cpid=" + clientProductId;
      }

      $(document).ready(function () {
        $("#banking").click(function () {
          $("#banking-div").show();
          $("#investment-section").hide();
          $("#wealth-mgt-section").hide();
          $("#portfolio-section").hide();
          $(this).css({
            "background-color": "#c0c0c0",
            color: "#eee",
          });
          $("#investment, #wealth-mgt, #portfolio").css({
            "background-color": "#ccc",
          });
          return false;
        });
        $("#investment").click(function () {
          $("#investment-section").show();
          $("#wealth-mgt-section").hide();
          $("#portfolio-section").hide();
          $("#banking-div").hide();
          $(this).css({
            "background-color": "#c0c0c0",
            color: "#eee",
          });
          $("#banking, #wealth-mgt, #portfolio").css({
            "background-color": "#ccc",
          });
          return false;
        });
        $("#wealth-mgt").click(function () {
          $("#wealth-mgt-section").show();
          $("#investment-section").hide();
          $("#portfolio-section").hide();
          $("#banking-div").hide();
          $(this).css({
            "background-color": "#c0c0c0",
            color: "#eee",
          });
          $("#investment, #banking, #portfolio").css({
            "background-color": "#ccc",
          });
          return false;
        });
        $("#portfolio").click(function () {
          $("#portfolio-section").show();
          $("#investment-section").hide();
          $("#wealth-mgt-section").hide();
          $("#banking-div").hide();
          $(this).css({
            "background-color": "#c0c0c0",
            color: "#eee",
          });
          $("#investment, #wealth-mgt, #banking").css({
            "background-color": "#ccc",
          });
          return false;
        });
      });
    </script>
  </body>
</html>
