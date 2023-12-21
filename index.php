<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Dukevest</title>
  </head>
  <body>
    <!-- / / / / / / The Creation of the Navigation Bar / / / / -->
    <header>
      <nav class="navbar">
        <div class="navContainer">
          <div class="logo">
            <a href="index.php">
              <img src="./Images/Dukevest-logos.jpeg" alt="Dukevest Logo" />
            </a>
          </div>
          <ul class="navLeft">
            <li>
              <a href="index.php">Home</a>
            </li>
            <li>
              <a href="about-us.html">About Us</a>
            </li>
            <li>
              <a href="contact-us.html">Contact us</a>
            </li>
          </ul>
          <ul class="navRight">
            <li>
              <a href="#">
                <img src="./Images/location.gif" alt="locate a branch" />
                <span class="adj">Find a Branch</span>
              </a>
            </li>
            <li>
              <a href="signin.php"><button class="btn">Sign In</button></a>
            </li>
            <div class="searchBox">
              <input
                type="text"
                class="searchText"
                placeholder="search keywords..."
              />
              <a href="#" class="searchBtn">
                <i class="fa-solid fa-magnifying-glass-dollar fa-2x"></i>
              </a>
            </div>
          </ul>
        </div>
      </nav>
      <!-- / /The Creation of Cover Page Section with Sign Up Page  / /-->
      <section class="sector">
        <div class="sector-container">
          <div class="sector-left">
            <h1>Dukevest</h1>
            <h3>
              Tiny efforts amount to great things with consistency. At DUKEVEST,
              we are committed to helping our customers realize their long-term
              financial goals. Our team of experts is highly knowledgeable and
              experienced and takes the time to understand each customer's
              individual situation. We use our in-depth understanding of the
              financial markets and industry to develop custom strategies for
              each customer. Our experienced team of professionals is always
              available to provide advice and take the time to answer any
              questions our customers may have. We believe in providing our
              customers with the best investment plans and products to create
              long lasting wealth. Our team of professionals uses their
              extensive knowledge and experience to develop comprehensive
              strategies for each customer's unique financial situation. We
              strive to provide our customers with optimal returns, while
              ensuring their investments are secure and protected Sounds
              interesting, right?
            </h3>
            <a href="signup.php"><button type="submit">Sign-up</button></a>
          </div>
          <div class="sector-right">
            <img
              src="./Images/Dukevest-Cover.jpeg"
              alt="Dukevest Covver Image"
            />
          </div>
        </div>
      </section>
    </header>
    <!-- / / / The Creation of the Dukevest Popular Packages/ / / -->
    <section class="dukevest-packages">
      <h2>We Got You Covered</h2>
      <div class="packages">
        <a href="./Packages-pages/banking.html">
          <div class="packs">
            <h3>Banking</h3>
            <p>
              We offer top level banking experience for our higly esteemed
              customers. You want a secure, fast and convenient banking
              experience? Location is not a barrier...
            </p>
            <span><img src="./Images/bank.svg" alt="Banking Icon" /></span>
          </div>
        </a>
        <a href="./Packages-pages/investment.html">
          <div class="packs">
            <h3>Investment</h3>
            <p>
              Our highly experienced team is at your service to ensure you get
              the best Asset Management and trading advice for your dream
              investment. With our track record, your investment is guaranteed
              to grow...
            </p>
            <span
              ><img src="./Images/investment.svg" alt="Investment Icon"
            /></span>
          </div>
        </a>
        <a href="./Packages-pages/wealth-management.html">
          <div class="packs">
            <h3>Wealth Management</h3>
            <p>
              You got all these assets and you're thinking of how to secure
              them? We have a highly experienced team to offer you the best
              financial planning and Asset Management services...
            </p>
            <span
              ><img src="./Images/wealth-management.svg" alt="Banking Icon"
            /></span>
          </div>
        </a>
        <a href="./Packages-pages/business-lending.html">
          <div class="packs">
            <h3>Business Lending</h3>
            <p>
              Our financial lending packagaes and policies for potential and
              promising businesses are tailored for your business growth.
              Contact us let's keep that dream of yours alive...
            </p>
            <span><img src="./Images/loan.svg" alt="Loan Icon" /></span>
          </div>
        </a>
      </div>
    </section>
    <hr class="hr1" />
    <section class="sector-two">
      <div class="sector-two-box">
        <img src="./Images/homepage-1.jpeg" alt="" />
      </div>
      <div class="sector-two-box">
        <img src="./Images/homepage-2.jpg" alt="" />
      </div>
    </section>
    <footer class="sector-bottom">
      <div>
        <img src="./Images/Dukevest-logo-transparent.png" alt="" />
        <div class="sector-bottom-contact">
          <h1>Contact us</h1>
          <div class="pack-icons">
            <i class="fa-brands fa-twitter fa-2x fa-icon"></i>
            <i class="fa-brands fa-facebook fa-2x fa-icon"></i>
            <i class="fa-brands fa-instagram fa-2x fa-icon"></i>
            <i class="fa-brands fa-linkedin fa-2x fa-icon"></i>
          </div>
        </div>
      </div>
    </footer>
  </body>
</html>
