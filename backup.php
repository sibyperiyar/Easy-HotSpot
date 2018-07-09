<?php include('session.php'); ?>
<?php header( 'Content-Type: text/plain' ); ?>
<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
<?php
$progress_val = 100; ?>
<div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="<?php echo $progress_val; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progress_val; ?>%">
    <?php echo $progress_val.'%'; ?>
  </div>
</div>
<?php
$folder = $_SESSION['backup_folder'];
if (!is_dir($folder)) { mkdir($folder, 0777, true); }
chmod($folder, 0777);
$date = date('d-m-Y-H-i-s', time()); 
$filename = $folder."db-backup-".$date; 
include('dbconfig.php'); 
define( 'DUMPFILE', $filename . '.sql' );
 
try {
    //$DB_con = new PDO( 'mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS );
    $f = fopen( DUMPFILE, 'wt' );
 
    $tables = $DB_con->query( 'SHOW TABLES' );
    foreach ( $tables as $table ) {
		//echo   $table[0] . ' ... ';
		flush();
        $sql = '-- TABLE: ' . $table[0] . PHP_EOL;
        $create = $DB_con->query( 'SHOW CREATE TABLE `' . $table[0] . '`' )->fetch();
        $sql .= $create['Create Table'] . ';' . PHP_EOL;
        fwrite( $f, $sql );
 
        $rows = $DB_con->query( 'SELECT * FROM `' . $table[0] . '`' );
        $rows->setFetchMode( PDO::FETCH_ASSOC );
        foreach ( $rows as $row ) {
            $row = array_map( array( $DB_con, 'quote' ), $row );
            $sql = 'INSERT INTO `' . $table[0] . '` (`' . implode( '`, `', array_keys( $row ) ) . '`) VALUES (' . implode( ', ', $row ) . ');' . PHP_EOL;
            fwrite( $f, $sql );
        }
 
        $sql = PHP_EOL;
        $result = fwrite( $f, $sql );
        if ( $result !== FALSE ) {
           echo '';
        } else {
         //   echo 'ERROR!!' . PHP_EOL;
        }
        flush();
    }
    fclose( $f );
} catch (Exception $e) {
    echo 'Damn it! ' . $e->getMessage() . PHP_EOL;
}
?>
<a id="dlink" href=<?php echo '"'.$filename.'.sql"'?> download>

<script>
	var btnDownload = function() {
		document.getElementById("dlink").click();
		window.location = "admin.php";
	}
	btns = [{text:"No",action:"admin.php",style:"cmodal-cancel"}, {text:"Yes",action:btnDownload,style:"cmodal-ok"}];
	cmodalOkCancel("Backup Complete", "Backing-up of Database Tables to the Selected Path Completed Successfully. Do you want to download the backup ?", "information", btns);
</script>