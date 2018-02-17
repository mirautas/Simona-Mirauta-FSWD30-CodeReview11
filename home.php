<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';

 // if session is not set this will redirect to login page

 if( !isset($_SESSION['users']) ) {
  header("Location: index.php");
  exit;
 }

 // select logged-in users detail

 $res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['users']);
 $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
<title>Welcome - <?php echo $userRow['userEmail']; ?></title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
      crossorigin="anonymous"></script>   
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<style>
  
.hero-img {
  background-image: url('img/coperta3.jpg');
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  height: 100vh;
  }
  h1 {
    color: white;
    text-align: center;
    font-weight: normal;
    padding: 250px;
    background-color: $white;
  }


</style>

</head>
<body>

<nav class="navbar navbar-fixed-top navbar-inverse" style="height: 56px;"><!--Here we make a navbar-->
      <div class="container-fluid">
        <div class="navbar-header"><!--Now we want the navbar to be like buttom when we let the width of our page small  -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="  #bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="glyphicon glyphicon-menu-hamburger"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="https://lh3.googleusercontent.com/-E1Cr9_ykl2Y/Vy3RLNOc-gI/AAAAAAAAAXs/kzh2mufeGYE/s1600/PicsArt_05-07-04.21.22.png" class="brand" width="100" height="30"></a>
        </div>
  
      <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
           
          
          <div class="col-lg-7" style="margin-top: 10px;">
            <div class="input-group">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                </span>
                <input type="text" class="form-control" placeholder="Search for...">
            </div>
        </div>

          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="MAP.html"><img src="http://logo-load.com/uploads/posts/2016-08/google-maps-logo.png" width="25"></a>
            </li>
            <li>
              <a href="logout.php?logout">Sign Out</a>
            </li>
          </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

  



  <section class="hero-img flex-row j-center">
    <h1>You need a car?<br>We have the right one for you!</h1>
  </section><!-- /hero-section -->


    <h1 class="text-center text-primary">Welcome to our page</h1>
    
  



   
    <div class="container">
    
      <h2>Our Offices ...</h2>

      <button type="button"  data-toggle="modal" data-target="#myModal2" onclick="showofficelist()">Office List</button>
    <div>
    <hr>
    <h2>Our Cars ...</h2>
    <button onclick="showcarlist()">Car List</button>
    <p id="demo2"></p>
    </div>
    <hr>
    <h2>Our reserved Cars</h2>

      
    <button onclick="locar()">Cars Location </button>
    <hr>
  <!-- Modal -->
    <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Office List</h4>
          </div>
          <div class="modal-body">
              <p id="demo"></p>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      
    </div>
  
  </div>
  
    <p id="demo4"></p>


    
    <h2>List of locations ...</h2>
    <button type="button" data-toggle="modal" data-target="#myModal1" onclick="carlocation()">Report Now </button>

        <!-- Modal -->
        <div class="modal fade" id="myModal1" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Location</h4>
              </div>
              <div class="modal-body">
                <p id="demo3"></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
  </div>
  \
  <hr>

  <script>
  function showofficelist(){
        var obj, dbParam, xmlhttp;
        obj = {}; 
        dbParam = JSON.stringify(obj); 
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("demo").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "office_list.php?office=" + dbParam, true); 
        xmlhttp.send(); 
        }
        function showcarlist(){
        var obj, dbParam, xmlhttp;
        obj = {}; 
        dbParam = JSON.stringify(obj); 
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("demo2").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "cars_list.php?CarList=" + dbParam, true); 
        xmlhttp.send(); 
        }


        function carlocation(){
          var obj, dbParam, xmlhttp;
          obj = {}; 
          dbParam = JSON.stringify(obj); 
          xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("demo3").innerHTML = this.responseText;
              }
          };
          xmlhttp.open("GET", "cars_locations.php?location=" + dbParam, true); 
          xmlhttp.send();
    }
        function locar(){
        var obj, dbParam, xmlhttp;
        obj = {}; 
        dbParam = JSON.stringify(obj); 
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("demo4").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "locar.php?locar=" + dbParam, true); 
        xmlhttp.send(); 
        }

</script>
            

  <section class="hero-img flex-row j-center" style="height: 500px;">
  </section><!-- /hero-section -->

  <footer>
        Created by: <a href="https://github.com/mirautas" target="_blank" rel="nofollow">mirautas</a>
        <br><br>
  </footer>


</body>

</html>

<?php ob_end_flush(); ?>