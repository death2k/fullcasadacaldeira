<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
*,
*:before,
*:after {
  box-sizing: border-box;
}
body {
  font-family: Montersat;
  font-size: 14px;
  font-weight:400;
  line-height: 1.6;  
  width: 100%;
  overflow-x: hidden;
  margin: 0;
  background: #fff;
  color: black;
}

a { text-decoration: none; }

h4 {
  text-transform: uppercase;
  font-size: 16px;
  font-weight: 400;
}  
img {

  max-width: 100%;
}
input {
  width: 100%;
  font-size: 13px;
  background: #fafafa;
  text-align: left;
}
li { list-style: none; }
li a { 
  padding-right: 2px;
  display: inline-block;
  color: #000;
}
ul { padding: 0; }

/* Support Classes */
.block { display: block; }
.hide { display: none; }

#topbar {
  color: white;
  background: #466091;
  height: 30px;
  border-bottom: 1px solid #ccc;
}
.container {
  min-width:320px;
  max-width: 960px;
  margin: 0 auto;
  padding: 0; /* override bs4 */
}
@media (min-width: 1200px) {
  .container {
    max-width: 1140px;
  }
}

.flexbox .topbar-nav {
  display: flex;
  flex-flow: row wrap;
  justify-content:flex-end;
  align-content: flex-end;
}

/* Mobile */
@media (max-width: 767px) {
  .flexbox .topbar-nav  {
    justify-content: center;
  }
  .flexbox .topbar-nav > a.topbar-nav-link {
    display:none;
  }
}  

.topbar-phone { margin-right: auto; }

.topbar-nav-msg,
.topbar-nav-link {
  padding: 4px 10px;
}

.topbar-nav a,
.navbar-nav a {
  display: block;
  color: white;
}
.topbar-nav a:hover {
  display: block;
  background: linear-gradient(to bottom, #466091, #1883b5, #00a7cb, #00cad0, #3eebc5);
  color: #011; 
}

#main-header {
  font-size: 16px;
  background: #fff;
  border-bottom: 1px solid #ccc;
}

.flexbox .main-header-wrap,
.flexbox .catalog-section-wrap {
  display: flex;
  flex-flow: row wrap;
  justify-content: flex-start;
  align-items: flex-start;
}

.flexbox .main-header-wrap > div,
.flexbox .catalog-category-wrap > div{
  display:flex;
  flex-direction: column;
  justify-content: center;
  text-align: center;
  align-items: center;
  border-left: 1px solid #eee; /*temp css */
  border-right: 1px solid #eee; /*temp css */
  height: 90px;
}

.main-header-wrap > .main-header-tagline {
  font-family: Roboto;
  font-weight: 200;
  font-size: 16px;
}

.main-header-wrap > #main-header-cart__mobile.main-header-mobile,
.main-header-wrap > #main-header-cart.main-header-mobile{
  display: none;  /* activate in media query */
}

.main-header-search-row-1 {
  height: 60px;
  padding: 0 5px;
}

#main-header-cart-cart {
  margin-top: 15px;
}

#main-header-cart-item-total {
  position: absolute;
  margin: -45px 20px;
  padding: 4px 1px 0 0;
  height: 24px;
  width: 24px;
  border-radius: 50%;
  background: #900;
  font: 11px/1.6 arial;
  color: white;
  z-index: 2;
}

.main-header-search-row-2 {
  justify-content: stretch;
  align-self: center;
  height:30px;
  width: 100%;
  padding: 0 5px;
}

#main-search { 
  float: left;
  height: 100%;
  width: 80%;
  text-indent: 5px; /* nice trick for placeholder text */
}

.main-search-btn {
  width: 20%;
  height: 100%;
  float: left;
  background-color: #990000; /* fallback */
  background:    linear-gradient(#990000, #6b0000);
  border:        1px solid #660000;
  border-radius: 5px;
  box-shadow:    0 1px #6b0000;
  padding:       2px 5px;
  color:         #ffffff;
  display:       inline-block;
  font-size:     16px;
  text-align:    center;
  text-shadow:   1px 1px #000000;
}

.main-search-btn:hover {
 background-color: #aa0000; /* fallback */
 background: linear-gradient(#aa0000, #7C0A02); 
}

@media (max-width: 768px) {
  .flexbox .main-header-wrap {
    flex-direction: row;
    flex-wrap: wrap;
  }
  
  .flexbox .main-header-wrap > div {
    justify-content: flex-end;
    height: 45px;
  }
  
  .flexbox .main-header-wrap > .main-header-logo {
    display: flex;
    height: 60px;
    flex: 1 1 50%;
    justify-content: center;
    text-align: center;

   }
  
   .flexbox .main-header-wrap > #main-header-cart.main-header-mobile {
     display: flex;  /* activated */
     height: 60px;
     flex: 1 1 50%;
   }
  
   #main-header-cart-item-total {
     position: absolute;
     margin: -25px -20px;
  }  
  
  .flexbox .main-header-wrap .main-header-tagline { display: none; }
  
  .flexbox .main-header-wrap > .main-header-row-1 {
    display: flex;
    height: 60px;
    flex: 1 1 100%;
  }
  
  .flexbox .main-header-search-row-1 {
    display: none;  /* activated */
  }
  .flexbox .main-header-search-row-2 {
    height: 45px;
  }

}

.flexbox .grid-1-of-4 {
  flex: 1 1 25%;
  /*border-right: 1px solid #eef;*/
}
.flexbox .grid-2-of-4 {
  flex: 2 1 50%;
  /*border-right: 1px solid #eef;*/
}
.flexbox .grid-3-of-4 {
  flex: 3 1 75%;
  /*border-right: 1px solid #eef;*/
}

/*
** Main Navigation
*/

#navigation {
  font-family: "Open Sans", Arial, sans-serif;
  background: #173161; 
  height: 60px;
  border-top: 1px solid #777;
  border-bottom: 1px solid #777;
  box-shadow: 0px 2px 5px #959595;
  margin-bottom: 20px;
}

/* override bootstrap 4 */
#navigation a {
  color: white;
}
#navigation a.dropdown-item {
  color: black;
}

.dropdown:hover>.dropdown-menu {
  display: block;
}

.dropdown>.dropdown-toggle:active {
  /*Without this, clicking will make it sticky*/
   /* pointer-events: none; */
}

/* override bootstrap 4 */
.navbar {
  padding: 0 4px;
}
/* override bootstrap 4 */
.navbar-expand-md .navbar-nav .nav-link  {
  display: block;
  font-size: 18px;
  line-height: 1.0;
  padding: 21px 16px;
}

.navbar-nav a {
  display: block;
  color: white;
}
.navbar-nav > a:hover {
  display: block;
  background: linear-gradient(to bottom, #173161, #1883b5, #00a7cb, #00cad0, #3eebc5);
  color: #011; 
}

#navbar-mobile > .navbar-nav {
  display:none;
}
@media (max-width: 768px) {
  #navigation {
    height: 60px;
    border-top: 1px solid #777;
    border-bottom: 1px solid #777;
  }
  /* override bootstrap 4 */
  #navigation .navbar-collapse a {
    position: relative; /* needed for z-index to work */
    color: black;
    background: #fff; 
    border: 1px solid #eee;
    z-index: 20;
    
  }
  #navigation #navbar-mobile a   {
    color: white;
  }
  
  .navbar-expand-md .navbar-nav .nav-link  {
    font-size: 14px;
    padding: 21px 10px;
  }
    
  #navbar-mobile > .navbar-nav {
    display: flex;
    flex-flow: row nowrap;
    justify-content: center;
    align-content: center;
    font-size: 16px;
  }
  
  #navbar-mobile .navbar-toggler {
    color: rgba(255,255,255,1);
    border-color: rgba(255,255,255,.5);
  }

  .navbar-dark .navbar-nav .active >.nav-link {
    display: block;
    color: #173161;
  }
  .navbar-nav > a:hover {
    display: block;
    background: linear-gradient(to bottom, #173161, #1883b5, #00a7cb, #00cad0, #3eebc5);
    color: #011; 
  }
}
/* override bootstrap 4 */
.dropdown-menu {
  margin: 0;
  padding: 0;
  box-shadow: 0px 2px 5px #959595;
}

/*
.flexbox .navbar-nav {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content:flex-start;
  align-content: flex-end;
}
.navbar-nav-link  {
  display: block;
  font-size: 18px;
  line-height: 1.0;
  padding: 21px 16px;
}
*/

@media (max-width: 768px) {
/*  
 .flexbox .navbar-nav {
    justify-content:center;
  }   
*/  
}

.hero-image {
  height: 520px;
  background: url("https://res.cloudinary.com/djhkdplck/image/upload/w_1000,ar_16:9,c_fill,g_auto,e_sharpen/v1553750034/homepage-nut.jpg") center;
  background-size: cover;
  background-attachment: fixed;
}

.hero-overlay {
    position: absolute;
    /* background-color: rgba(0, 0, 0, 0.5); */
    color: white;
    top: 55%;
    width: 50%;
    left: 25%;
    right: 0;
    text-align: center;
    z-index: 15;
}
.hero-caption {
  font-family: "Open Sans", sans-serif;
}

.hero-caption > h6 {
  font-size: 18px;
  letter-spacing: 0.2em;
  line-height: 1.3;
}
.hero-caption > h1 {
  text-transform: uppercase;
  font-size: 32px;
  font-weight: 100;
  letter-spacing: 0.1em;
}
.hero-caption > h1 span {
  display: block;
  font-weight: 700;
}

.hero-overlay > a {
  display: inline-block;
  width : 240px;
  background-color: #990000; /* fallback */
  background:    linear-gradient(#990000, #6b0000);
  border:        1px solid #660000;
  border-radius: 5px;
  box-shadow:    0 1px #6b0000;
  padding:       8px 20px;
  color:         #ffffff;
  font-size:     18px;
  text-align:    center;
  text-shadow:   1px 1px #000000;
  text-decoration: none;
}

.hero-overlay > a:hover {
 background-color: #aa0000; /* fallback */
 background: linear-gradient(#aa0000, #7C0A02); 
}

@media (max-width: 768px) {
  .hero-overlay {
    left: 22%;
  }
}
@media (max-height: 480px) {
  .hero-overlay {
    top: 75%;
  }
}

/*
** Product Category
*/
.catalog-section {
  font-family: Arial, 'Open Sans';
  font-size: 14px;
  line-height: 20px;
  margin-bottom: 20px;
}

#categories {
  width:100%;
  margin:0;
  padding:0;
  background-color: #fafafa;
}

#categories > li > a {
    display: block;
    padding: 10px 10px;
    color: #777;
    text-decoration: none;
    border-left: 3px solid #e21c23;
    border-bottom: 1px solid #eee;
    background-color: #fafafa;
}  

.category-menu-wrap {
  display: flex;
  flex-flow: column nowrap;
  justify-content: flex-start;
  align-items: flex-start;
  font-size: 14px;
  line-height: 21px;
}

a.category-level-1 {
  display:flex;
  flex: 1 auto;
}
.categories-products-wrap,
.categories-cart-wrap{
  width:100%;
  max-width: 100%;
  height: auto;
}
.breadcrumb {
  width: 100%;
  background-color:#fafafa;
}

/*
** Tabs
*/

.tabs {
  min-width: 100%;
  max-width: 100%;
}

.tabs-nav li {
  float: left;
  width: 50%;
}
.tabs-nav li:first-child a {
  border-right: 0;
  border-top-left-radius: 6px;
}
.tabs-nav li:last-child a {
  border-top-right-radius: 6px;
}
.tabs-nav a {
  background: #eaeaed;
  border: 1px solid #cecfd5;
  color: #0087cc;
  display: block;
  font-weight: 600;
  padding: 10px 0;
  text-align: center;
  text-decoration: none;
}
.tabs-nav a:hover {
  color: #ff7b29;
}
.tab-active a {
  background: #fff;
  border-bottom-color: transparent;
  color: #2db34a;
  cursor: default;
}
.tabs-stage {
  border: 1px solid #cecfd5;
  border-radius: 0 0 6px 6px;
  border-top: 0;
  clear: both;
  padding: 24px 30px;
  position: relative;
  top: -1px;
}


 /*
 ** Footer
 */
  
footer {
  border-top: 1px solid #ccc;
  color: white;
  background: #36454f; /* charcoal */
  height: 120px;
  border-bottom: 1px solid #ccc;
}

footer .trademark {
  position: relative;
  top: 100px;
}
  



</style>




<div id="navigation">
  <div class="container">
    <nav class="navbar navbar-expand-md navbar-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
      </button>
      <!-- This menu shows on mobile -->

      <div id="navbar-mobile">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Log In<span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">&#128722;Cart<span class="sr-only"></span></a>
          </li>
        </ul>
      </div>
      <!-- This menu hides (collapse ) on mobile -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a id="home-link" class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>

          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Catalog
          </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Metric Fasteners</a>
              <a class="dropdown-item" href="#">Imperial Fasteners</a>
              <a class="dropdown-item" href="#">Hot Dipped Galvanized</a>
              <a class="dropdown-item" href="#">Socket Head Fasteners</a>
              <a class="dropdown-item" href="#">Metric Washers</a>
              <a class="dropdown-item" href="#">Metric Nuts</a>
              <a class="dropdown-item" href="#">Machine Screws</a>
              <a class="dropdown-item" href="#">Threaded Rods / Bars</a>
              <a class="dropdown-item" href="#">Metric Pins / Keys</a>
              <a class="dropdown-item" href="#">Taps / Dies / Tools</a>
              <a class="dropdown-item" href="#">Inserts</a>
              <a class="dropdown-item" href="#">Retaining Rings</a>
              <a class="dropdown-item" href="#">Eye Bolts and Nuts</a>
              <a class="dropdown-item" href="#">Fittings / Studs / Carriage Bolts</a>
              <a class="dropdown-item" href="#">Stainless Steel Fasteners</a>
              <a class="dropdown-item" href="#">Brass / Bronze</a>
              <a class="dropdown-item" href="#">Nylon Fasteners</a>
              <a class="dropdown-item" href="#">Hose Clamps</a>
              <a class="dropdown-item" href="#">Assortments</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Policy</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://codepen.io/kbrfuller/pen//full/QoRGRy" target="_blank">Contact</a>
          </li>
        </ul>
      </div>

    </nav>
  </div>
</div>





<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
$(function() {
  $(".nav-link").on("click", function(e) {
    switch (e.target.id) {
      case "home-link":
        $(".hero-image").removeClass("hide");
        $(".catalog-section").addClass("hide");
        break;
      case "navbarDropdown":
        $(".hero-image").addClass("hide");
        $(".catalog-section").removeClass("hide");
        break;
      default:
    }
  }); // end

  // Show the first tab by default
  $(".tabs-stage > div").hide();
  $(".tabs-stage div:first").show();
  $(".tabs-nav li:first").addClass("tab-active");

  // Change tab class and display content
  $(".tabs-nav a").on("click", function(event) {
    event.preventDefault();
    $(".tabs-nav li").removeClass("tab-active");
    $(this)
      .parent()
      .addClass("tab-active");
    $(".tabs-stage > div").hide();
    $($(this).attr("href")).show();
  });
});

</script>