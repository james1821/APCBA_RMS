

<!DOCTYPE html>
<html>
<head>
  <style>
    .logout{
      color:red;
    }
    .iconimg {
      height: 50px;
      width: auto;
      margin-top: 50px;
      margin-left: 50px;
    }
    
    .icons {
      font-weight: bold;
      font-family: "Lucida Console", "Courier New", monospace;
      text-align: center;
    }
    
    .sidenav {
      height: 100%;
      width: 250px;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0; /* Changed the left value to 0 for desktop mode */
      background-color: black;
      overflow-x: hidden;
      padding-top: 90px;
      transition: 0.5s;
    }
    
    .sidenav a {
     
      margin-top: 20px;
      padding: 4px 8px 4px 16px;
      text-decoration: none;
      font-size: 18px;
      color: white;
      display: block;
    }
    
    .sidenav a:hover {
      color: #f1f1f1;
    }
    
    .sidenav ul {
      padding-left: 8px;
    }
    
    .sidenav li.active ul {
      display: block;
    }
    
    .sidenav li ul li a {
      font-size: 16px;
    }
    
   
    
    .openbtn {
    
      font-size: 20px;
      cursor: pointer;
      background-color: black;
      color: white;
      
      border: none;
      position: fixed;
      z-index: 2;
      top: 10px;
 

      display: block; /* Hide the button by default */
    }
   
    .openbtn:hover {
      background-color: #444;
    }
    
    /* Added CSS for active menu item */
    .sidenav li.active {
      background-color: #333;
    }
    
    /* Added CSS for active student dropdown */
    .sidenav li.dropdown.active ul {
      background-color: black;
    }
    
    /* Media query for responsive sidebar */
    @media (max-width: 768px) {
      .sidenav {
        left: -250px; /* Adjusted the left value to hide the sidebar */
      }
      
   
      .openbtn {
        display: block; /* Show the button for screens below 768px */
      }
    }
  </style>
  
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
</head>
<body>
  <!-- Side navigation -->
  <div id="mySidenav" class="sidenav">
    <ul>
     
      <li>
        <?php 
         $stat = $_SESSION['status'];
         if ($stat != "Head-Admin") { ?>
          <a href="view-user-profile.php">
            <i class="bi bi-person-circle"></i> Account Profile
          </a>
        <?php } else { ?> 
          <a href="user.php">
            <i class="bi bi-person-circle"></i> Account and Users
          </a>
        <?php } ?>
      </li>
      
      <li class="dropdown">
      
        <ul>
          <li><a href="student.php">All Students</a></li>
          <li><a href="enrolled-students.php">Enrolled</a></li>
          <li><a href="graduate-students.php">Graduated</a></li>
        </ul>
      </li>
      
      <li>
        <a href="course.php">
          <i class="bi bi-book"></i> Courses  
        </a>
      </li>
      
      <li>
        <a href="activity_log.php">
          <i class="bi bi-card-list"></i> Activity Log
        </a>
      </li>
      
      <li>
        <a href="student_archive.php">
          <i class="bi bi-archive-fill"></i> Archive
        </a>
      </li>
      
      <li>
        <a href="reports.php" onclick="toggleNav()">
          <i class="bi bi-pie-chart-fill"></i> Analytics
        </a>
      </li>

      
      <div class="container-fluid">
			
			<?php 
			$stat = $_SESSION['status'] ;
				$query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_id` = '$_SESSION[user]'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);
			?>

		
				
						<a  href = "logout.php" > <p class="logout" >Logout</p></a>
					
		</div>
    </ul>


    
  </div>

  <!-- Hamburger menu button -->
  <button class="openbtn" onclick="toggleNav()" >
  <i class="bi-arrow-left-right"></i>

  </button>

  
  <script>
   function toggleNav() {
    var sidenav = document.getElementById("mySidenav");

    // Get the current computed style of the element
    var computedStyle = window.getComputedStyle(sidenav);

    // Extract the computed left value (removing "px" and converting to a number)
    var currentLeft = parseFloat(computedStyle.left);

    if (currentLeft === -250) {
        sidenav.style.left = "0";
    } else {
        sidenav.style.left = "-250px";
    }
}

    // Add 'active' class to the current menu item
    var currentLocation = window.location.href;
    var menuItemLinks = document.querySelectorAll('.sidenav a');
    menuItemLinks.forEach(function (link) {
      if (link.href === currentLocation) {
        link.parentNode.classList.add('active');
        link.parentNode.parentNode.classList.add('active');
      }
    });

    // Function to handle the dropdown click event
    function handleDropdownClick(event) {
      event.stopPropagation();
      this.classList.toggle('active');
      // Store the state of the dropdown in local storage
      var isActive = this.classList.contains('active');
      localStorage.setItem('studentDropdownActive', isActive);
    }

    // Add click event listener to the dropdown toggle
    var dropdownToggle = document.querySelector('.sidenav li.dropdown');
    dropdownToggle.addEventListener('click', handleDropdownClick);

    // Check if the student dropdown should remain open
    var storedDropdownActive = localStorage.getItem('studentDropdownActive');
    if (storedDropdownActive === 'true') {
      dropdownToggle.classList.add('active');
    }

    // Prevent the dropdown from closing when child links are clicked
    var dropdownLinks = document.querySelectorAll('.sidenav li.dropdown ul li a');
    dropdownLinks.forEach(function (link) {
      link.addEventListener('click', function (event) {
        event.stopPropagation();
      });
    });
  </script>
</body>
</html>
