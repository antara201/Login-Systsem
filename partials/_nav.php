<?php 
if (!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!=true){
  $loggedin=false; 
}
else{
  $loggedin=true;
}
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/PROJECT_FINAL">MyLoginSytem</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/PROJECT_FINAL/listing.php">Home</a>
        </li>';
if (!$loggedin){
        echo '<li class="nav-item">
          <a class="nav-link" href="/PROJECT_FINAL/login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/PROJECT_FINAL/registration.php">Register</a>
        </li>';}
        if ($loggedin){
        echo '<li class="nav-item">
          <a class="nav-link" href="/PROJECT_FINAL/logout.php">Log Out</a>
        </li>';
        }
  echo    
  '</div>
  </div>
  </nav>'
?>