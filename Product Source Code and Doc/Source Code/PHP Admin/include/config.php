<?php 
  error_reporting(0);
  define('DB_SERVER', 'localhost');
  define('DB_SERVER_USERNAME', 'root');
  define('DB_SERVER_PASSWORD', '');
  define('DB_DATABASE', 'imagequiz');
  define('USE_PCONNECT', 'false');
  define('STORE_SESSIONS', 'mysql');
  tep_db_connect() or die('Unable to connect to database server!');
  function tep_db_connect($server = DB_SERVER, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD, $database = DB_DATABASE, $link = 'db_link') 
  {
    global $$link;
    if (USE_PCONNECT == 'true')
	 {
      $$link = mysql_pconnect($server, $username, $password);
    } else 
	{
      $$link = mysql_connect($server, $username, $password);
    }
    if ($$link) mysql_select_db($database);
    return $$link;
  } 

?>