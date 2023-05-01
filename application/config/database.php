<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/
if (!defined('DB_SERVERGD')) define('DB_SERVERGD', "192.168.100.61");
if (!defined('DB_EMPSERVER')) define('DB_EMPSERVER', "192.168.100.2");
if (!defined('DB_SERVERSM')) define('DB_SERVERSM', "192.168.100.62");
if (!defined('DB_SERVERKPI')) define('DB_SERVERKPI', "192.168.100.62");
if (!defined('DB_SERVERSDMSMirror')) define('DB_SERVERSDMSMirror', "192.168.100.21");
if (!defined('DB_FactoryDashBoard')) define('DB_FactoryDashBoard', "192.168.100.75");

//define('DB_SERVER', "192.168.100.2");
if (!defined('DB_DBGD')) define('DB_DBGD', "Groupdashboard");
if (!defined('DB_EMP')) define('DB_EMP', "PIMSNEW");
if (!defined('DB_DBSM')) define('DB_DBSM', "KPI");  
if (!defined('DB_DBKPI')) define('DB_DBKPI', "BusinessKPI");  
if (!defined('DB_DBSDMSMirror')) define('DB_DBSDMSMirror', "SDMSMIRROR");
if (!defined('DB_DBFactoryDashBoard')) define('DB_DBFactoryDashBoard', "FactoryDashBoard");

if (!defined('DB_CONSTRINGGD'))define('DB_CONSTRINGGD', "DRIVER={SQL Server};SERVER=".DB_SERVERGD.";DATABASE=".DB_DBGD);                          
if (!defined('DB_EMPCONSTRING')) define('DB_EMPCONSTRING', "DRIVER={SQL Server};SERVER=".DB_EMPSERVER.";DATABASE=".DB_EMP);
if (!defined('DB_CONSTRINGSM'))define('DB_CONSTRINGSM', "DRIVER={SQL Server};SERVER=".DB_SERVERSM.";DATABASE=".DB_DBSM);
if (!defined('DB_CONSTRINGKPI'))define('DB_CONSTRINGKPI', "DRIVER={SQL Server};SERVER=".DB_SERVERKPI.";DATABASE=".DB_DBKPI);
if (!defined('DB_CONSTRINGSDMSMIRROR'))define('DB_CONSTRINGSDMSMIRROR', "DRIVER={SQL Server};SERVER=".DB_SERVERSDMSMirror.";DATABASE=".DB_DBSDMSMirror);
if (!defined('DB_CONSTRINGFactoryDashBoard'))define('DB_CONSTRINGFactoryDashBoard', "DRIVER={SQL Server};SERVER=".DB_FactoryDashBoard.";DATABASE=".DB_DBFactoryDashBoard);


$active_group = 'default';
$active_record = TRUE;
$db['default']['hostname'] = DB_CONSTRINGGD;
$db['default']['username'] = "sa";
$db['default']['password'] = "dataport";
$db['default']['database'] = DB_DBGD;
$db['default']['dbdriver'] = "odbc";
$db['default']['dbprefix'] = "";
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = "";
$db['default']['char_set'] = "utf8";
$db['default']['dbcollat'] = "utf8_general_ci";
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = FALSE;
$db['default']['stricton'] = FALSE;

$db['emp']['hostname'] = DB_EMPCONSTRING;
$db['emp']['username'] = "sa";
$db['emp']['password'] = "dataport";
$db['emp']['database'] = DB_EMP;
$db['emp']['dbdriver'] = "odbc";
$db['emp']['dbprefix'] = "";
$db['emp']['pconnect'] = FALSE;
$db['emp']['db_debug'] = TRUE;
$db['emp']['cache_on'] = FALSE;
$db['emp']['cachedir'] = "";
$db['emp']['char_set'] = "utf8";
$db['emp']['dbcollat'] = "utf8_general_ci";
$db['emp']['swap_pre'] = '';
$db['emp']['autoinit'] = FALSE;
$db['emp']['stricton'] = FALSE;

$db['sm']['hostname'] = DB_CONSTRINGSM;
$db['sm']['username'] = "sa";
$db['sm']['password'] = "dataport";
$db['sm']['database'] = DB_DBSM;
$db['sm']['dbdriver'] = "odbc";
$db['sm']['dbprefix'] = "";
$db['sm']['pconnect'] = FALSE;
$db['sm']['db_debug'] = TRUE;
$db['sm']['cache_on'] = FALSE;
$db['sm']['cachedir'] = "";
$db['sm']['char_set'] = "utf8";
$db['sm']['dbcollat'] = "utf8_general_ci";
$db['sm']['swap_pre'] = '';
$db['sm']['autoinit'] = FALSE;
$db['sm']['stricton'] = FALSE;

$db['sdms']['hostname'] = DB_CONSTRINGSDMSMIRROR;
$db['sdms']['username'] = "sa";
$db['sdms']['password'] = "dataport";
$db['sdms']['database'] = DB_DBSDMSMirror;
$db['sdms']['dbdriver'] = "odbc";
$db['sdms']['dbprefix'] = "";
$db['sdms']['pconnect'] = FALSE;
$db['sdms']['db_debug'] = TRUE;
$db['sdms']['cache_on'] = FALSE;
$db['sdms']['cachedir'] = "";
$db['sdms']['char_set'] = "utf8";
$db['sdms']['dbcollat'] = "utf8_general_ci";
$db['sdms']['swap_pre'] = '';
$db['sdms']['autoinit'] = FALSE;
$db['sdms']['stricton'] = FALSE;


$db['kpi']['hostname'] = DB_CONSTRINGKPI;
$db['kpi']['username'] = "sa";
$db['kpi']['password'] = "dataport";
$db['kpi']['database'] = DB_DBKPI;
$db['kpi']['dbdriver'] = "odbc";
$db['kpi']['dbprefix'] = "";
$db['kpi']['pconnect'] = FALSE;
$db['kpi']['db_debug'] = TRUE;
$db['kpi']['cache_on'] = FALSE;
$db['kpi']['cachedir'] = "";
$db['kpi']['char_set'] = "utf8";
$db['kpi']['dbcollat'] = "utf8_general_ci";
$db['kpi']['swap_pre'] = '';
$db['kpi']['autoinit'] = FALSE;
$db['kpi']['stricton'] = FALSE;

$db['factory_kpi']['hostname'] = DB_CONSTRINGFactoryDashBoard;
$db['factory_kpi']['username'] = "sa";
$db['factory_kpi']['password'] = "dataport";
$db['factory_kpi']['database'] = DB_DBFactoryDashBoard;
$db['factory_kpi']['dbdriver'] = "odbc";
$db['factory_kpi']['dbprefix'] = "";
$db['factory_kpi']['pconnect'] = FALSE;
$db['factory_kpi']['db_debug'] = TRUE;
$db['factory_kpi']['cache_on'] = FALSE;
$db['factory_kpi']['cachedir'] = "";
$db['factory_kpi']['char_set'] = "utf8";
$db['factory_kpi']['dbcollat'] = "utf8_general_ci";
$db['factory_kpi']['swap_pre'] = '';
$db['factory_kpi']['autoinit'] = FALSE;
$db['factory_kpi']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */
