

<?php
	echo "<div id='menu_login'>"; 
		echo "<div id='ico'> <img src='img/icous.png'/></div>";
	
		echo "<div id='usua'> ";
			echo $_SESSION['usuario'];
		echo '</div> ';
		
		echo "<div class='div_btn'>  <a href='login/logout.php'>cerrar sesión <span>x</span></a></div>";  
	echo '</div> ';
?> 
    
	
	 
	