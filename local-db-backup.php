<?php 


// Database Information

$host = '[DB HOST HERE]';
$user = '[DB USER]';
$password = '[DB PASSWORD]';
$database = '[DATABASE YOU WANT]';


// get today's date for file name
date_default_timezone_set('America/New_York');
$todays_date = date('m_d_Y', time());


// shell command to mysqldump db
// Note that you need to have MySQL installed locally, and this path be where mysqldump is located
// For mac download here - https://dev.mysql.com/doc/refman/5.6/en/osx-installation-pkg.html
// for windows look here

exec("/usr/local/mysql/bin/mysqldump --user=$user --password=$password --host=$host $database > backup_$todays_date.sql");



// SCP to remote server for backup
$src_path = "/path/to/target";
$filename = "file_name_$todays_date.sql";
$srcfile = $src_path . $filename;
echo "SRC FILE: $srcfile \r\n\r\n";
$destination_file = "/path/to/destination/$filename";


$ssh_remote_host = "[remote_host]"
$ssh_user = "[user]";
$ssh_password = "[password]";


$connection = ssh2_connect($ssh_remote_host, 22);
ssh2_auth_password($connection, $ssh_user, $ssh_password);

ssh2_scp_send($connection, $srcfile, $destination_file, 0644);

