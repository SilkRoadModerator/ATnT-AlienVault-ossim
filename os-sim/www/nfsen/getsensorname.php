#!/usr/bin/php
<?php
/**
*
* License:
*
* Copyright (c) 2003-2006 ossim.net
* Copyright (c) 2007-2013 AlienVault
* All rights reserved.
*
* This package is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; version 2 dated June, 1991.
* You may not use, modify or distribute this program under any other version
* of the GNU General Public License.
*
* This package is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this package; if not, write to the Free Software
* Foundation, Inc., 51 Franklin St, Fifth Floor, Boston,
* MA  02110-1301  USA
*
*
* On Debian GNU/Linux systems, the complete text of the GNU General
* Public License can be found in `/usr/share/common-licenses/GPL-2'.
*
* Otherwise you can read it here: http://www.gnu.org/licenses/gpl-2.0.txt
*
*/

/*******************************************************************************/
/*                                                                             */
/* This script is called from nfsen packages to translate sensors uuid to name */
/*                                                                             */
/*******************************************************************************/

set_include_path('/usr/share/ossim/include');

error_reporting(0);
ini_set("display_errors", "0");

//This is used to avoid an error when there is not connection to mysql
if (!isset($GLOBALS["CONF"]))
{
    $GLOBALS["CONF"] = array();

    require_once 'ossim_db.inc';
    $db = new ossim_db();
    
    unset($GLOBALS["CONF"]);
}
else
{
    require_once 'ossim_db.inc';
    $db = new ossim_db();
}
  

$uuid = $argv[1];

if( @$db->test_connect() )
{
    $conn = $db->connect();

    $name = Av_sensor::get_nfsen_channel_name($conn, $uuid);

    $db->close(); 
}
else
{
    $name = empty($uuid) ? 'Unknown' : $uuid;
}

echo $name;

?>
