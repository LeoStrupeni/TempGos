<?php
ini_set("display_errors", "0");
error_reporting(E_ALL & ~ E_NOTICE & ~ E_STRICT & ~ E_DEPRECATED);
/**
 * Fuente:
 * http://stackoverflow.com/questions/105572/a-script-to-change-all-tables-and-fields-to-the-utf-8-bin-collation-in-mysql
 * Adapted to use with PDO
 */
define('BR', "</br>\n");
define('Tables_in_', TBLIN);

function MysqlError()
{
    if (mysql_errno()) {
        echo "<b>Mysql Error: " . mysql_error() . '</b>' . BR;
    }
}

/**
 *
 * Enter description here ...
 *
 * @param unknown_type $username            
 * @param unknown_type $password            
 * @param unknown_type $db            
 * @param unknown_type $host            
 * @param unknown_type $target_charset            
 * @param unknown_type $target_collate            
 */
function changeFullDBCollation($username = "ebido_usr", $password = "06abr2004", $db = "ebido_db", $host = "localhost", $target_charset = "utf8", $target_collate = "utf8_spanish_ci")
{
    echo "<pre>";
    echo "Conecting to BD $db user $username password $password..." . BR;
    $connBD = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    // if connected
    if ($connBD) {
        try {
            query($connBD, "SET FOREIGN_KEY_CHECKS=0;");
            query($connBD, "SET collation_connection = '$target_collate'");
            $tables = array();
            $rows = query($connBD, "SHOW TABLES");
            /*
             * //for testing
             * $limit = 1;
             * $i = 0;
             */
            foreach ($rows as $row) {
                $tables[] = $row;
                /*
                 * //for testing
                 * if ($limit == $i) {
                 * break;
                 * }
                 * ++ $i;
                 */
            }
            $str = 'Tables_in_' . $db;
            // now, fix tables
            foreach ($tables as $table) {
                $tblName = $table[$str];
                // $indicies=removeIndices ( $connBD, $tblName );
                $rows = query($connBD, "DESCRIBE {$tblName}");
                //
                foreach ($rows as $row) {
                    $name = $row['Field'];
                    $type = $row['Type'];
                    $set = false;
                    echo "Checking field $name on table $tblName in DB $db ..." . BR;
                    if (preg_match("/^varchar\((\d+)\)$/i", $type, $mat)) {
                        $size = $mat[1];
                        // echo "Checking field $name on table $tblName in DB $db ..." . BR;
                        query($connBD, "ALTER TABLE {$tblName} MODIFY {$name} VARBINARY({$size})");
                        
                        query($connBD, "ALTER TABLE {$tblName} MODIFY {$name} VARCHAR({$size}) CHARACTER SET {$target_charset} COLLATE {$target_collate}");
                        
                        $set = true;
                        
                        echo "Altered field {$name} on {$tblName} from type {$type}\n";
                    } else if (! strcasecmp($type, "CHAR")) {
                        query($connBD, "ALTER TABLE {$tblName} MODIFY {$name} BINARY(1)");
                        
                        query($connBD, "ALTER TABLE {$tblName} MODIFY {$name} VARCHAR(1) CHARACTER SET {$target_charset} COLLATE {$target_collate}");
                        
                        $set = true;
                        
                        echo "Altered field {$name} on {$tblName} from type {$type}\n";
                    } else if (! strcasecmp($type, "TINYTEXT")) {
                        query($connBD, "ALTER TABLE {$tblName} MODIFY {$name} TINYBLOB");
                        
                        query($connBD, "ALTER TABLE {$tblName} MODIFY {$name} TINYTEXT CHARACTER SET {$target_charset} COLLATE {$target_collate}");
                        
                        $set = true;
                        
                        echo "Altered field {$name} on {$tblName} from type {$type}\n";
                    } else if (! strcasecmp($type, "MEDIUMTEXT")) {
                        query($connBD, "ALTER TABLE {$tblName} MODIFY {$name} MEDIUMBLOB");
                        
                        query($connBD, "ALTER TABLE {$tblName} MODIFY {$name} MEDIUMTEXT CHARACTER SET {$target_charset} COLLATE {$target_collate}");
                        
                        $set = true;
                        
                        echo "Altered field {$name} on {$tblName} from type {$type}\n";
                    } else if (! strcasecmp($type, "LONGTEXT")) {
                        query($connBD, "ALTER TABLE {$tblName} MODIFY {$name} LONGBLOB");
                        
                        query($connBD, "ALTER TABLE {$tblName} MODIFY {$name} LONGTEXT CHARACTER SET {$target_charset} COLLATE {$target_collate}");
                        
                        $set = true;
                        
                        echo "Altered field {$name} on {$tblName} from type {$type}\n";
                    } else if (! strcasecmp($type, "TEXT")) {
                        query($connBD, "ALTER TABLE {$tblName} MODIFY {$name} BLOB");
                        
                        query($connBD, "ALTER TABLE {$tblName} MODIFY {$name} TEXT CHARACTER SET {$target_charset} COLLATE {$target_collate}");
                        
                        $set = true;
                        
                        echo "Altered field {$name} on {$tblName} from type {$type}\n";
                    }
                    
                    if ($set)
                        query($connBD, "ALTER TABLE {$tblName} MODIFY {$name} COLLATE {$target_collate}");
                }
                
                // re-build indicies..
                /*
                 * foreach ( $indicies as $index ) {
                 * if ($index ["unique"]) {
                 * query ( $connBD, "CREATE UNIQUE INDEX {$index["name"]} ON {$tblName} ({$index["col"]})" );
                 * } else {
                 * query ( $connBD, "CREATE INDEX {$index["name"]} ON {$tblName} ({$index["col"]})" );
                 * }
                 * echo "Created index {$index["name"]} on {$tblName}. Unique: {$index["unique"]}\n";
                 * }
                 */
                
                // set default collate
                query($connBD, "ALTER TABLE {$tblName}  DEFAULT CHARACTER SET {$target_charset} COLLATE {$target_collate}");
            }
            
            // set database charset
            query($connBD, "ALTER DATABASE {$db} DEFAULT CHARACTER SET {$target_charset} COLLATE {$target_collate}");
            query($connBD, "ALTER DATABASE {$db} DEFAULT CHARACTER SET {$target_charset}");
            query($connBD, "ALTER DATABASE {$db} DEFAULT COLLATE {$target_collate}");
            
            mysql_close($connBD);
            ;
        } catch (PDOException $ex) {
            ejecuta($connBD, "SET FOREIGN_KEY_CHECKS=1;");
            echo "An Error occured!" . BR . $ex->getMessage(); // user friendly message
                                                                   // some_logging_function ( $ex->getMessage () );
        }
        query($connBD, "SET FOREIGN_KEY_CHECKS=1;");
    }
    echo "</pre>";
}

/**
 *
 * to query
 *
 * @param connecion $connBD            
 * @param string $command            
 */
function query($connBD, $command)
{
    //
    echo "Query command $command ..." . BR;
    $q = $connBD->query($command);
    if ($q) {
        return $q->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return array();
    }
}

/**
 *
 * Enter description here ...
 *
 * @param unknown_type $connBD            
 * @param unknown_type $command            
 * @return PDOStatement
 */
function ejecuta($connBD, $command)
{
    //
    return $connBD->exec($command);
}

/**
 *
 * @param unknown $connBD            
 * @param unknown $tblName            
 */
function removeIndices($connBD, $tblName)
{
    $rows = query($connBD, "show index from {$tblName}");
    $indicies = array();
    // remove index
    foreach ($rows as $row) {
        if ($row[2] != "PRIMARY") {
            $indicies[] = array(
                "name" => $row[2],
                "unique" => ! ($row[1] == "1"),
                "col" => $row[4]
            );
            // query ( $connBD, "ALTER TABLE {$tblName} DROP INDEX {$row[2]}" );
            ejecuta($connBD, "ALTER TABLE {$tblName} DROP INDEX {$row[2]}");
            echo "Dropped index {$row[2]}. Unique: {$row[1]}\n";
        }
    }
}
//
$username = "lugaronline_gos";
$password = "developerGos2019";
$db = "lugaronline_gosbd";
$host = "167.114.68.124";
// $host = "192.168.0.50";
$target_charset = "utf8";
$target_collate = "utf8_spanish_ci";
//
changeFullDBCollation($username, $password, $db, $host, $target_charset, $target_collate);