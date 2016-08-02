<?php
    require __DIR__ . '/src/MinecraftQuery.php';
    require __DIR__ . '/src/MinecraftQueryException.php';

    use xPaw\MinecraftQuery;
    use xPaw\MinecraftQueryException;

    $Query = new MinecraftQuery( );

    try
    {
        $Query->Connect( 'localhost', 25565 );
        print_r( $Query->GetInfo( ) );
        print_r( $Query->GetPlayers( ) );
    }
    catch( MinecraftQueryException $e )
    {
        echo $e->getMessage( );
    }
?>