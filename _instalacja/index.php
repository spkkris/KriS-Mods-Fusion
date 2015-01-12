<?php 
require_once "../maincore.php";
function delete_dir( $f ){

    if( is_dir( $f ) ){
        foreach( scandir( $f ) as $item ){
            if( !strcmp( $item, '.' ) || !strcmp( $item, '..' ) )
                continue;      
            delete_dir( $f . "/" . $item );
        }  
        rmdir( $f );
    }
    else{
        unlink( $f );
    }
}
delete_dir('../_instalacja');
 
rmdir('../_instalacja');

redirect('../index.php');
?>
