    <?php
    /**
     * Check Internet Connection.
     *
     * @author Pierre-Henry Soria <ph7software@gmail.com>
     * @copyright (c) 2012-2013, Pierre-Henry Soria. All Rights Reserved.
     * @param string $sCheckHost Default: www.google.com
     * @return boolean
     */
    function check_internet_connection($sCheckHost)
    {
		return (bool) @fsockopen($sCheckHost, 80, $iErrno, $sErrStr, 5);
    }
	
	$host = "www.google.com";
	
	if (check_internet_connection($host)){
	
		echo "Conectado a Internet";
		
	}else{
		echo "Sin conexion";
	}
	
	//echo check_internet_connection($host)
    ?>
	
	
	<?php
//function to check if the local machine has internet connection
function checkConnection()
{
    //Initiates a socket connection to www.itechroom.com at port 80
    $conn = @fsockopen("www.google.com", 80, $errno, $errstr, 30);
    if ($conn)
    {
        $status = "Connection is OK"; 
        fclose($conn);
    }
    else
    {
        $status = "NO Connection<br/>\n";
        $status .= "$errstr ($errno)";
    }
    return $status;
}
 
echo "<br>".checkConnection();
?> 
	
	