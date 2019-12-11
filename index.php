<?php
    require __DIR__ . '/vendor/autoload.php';

    use PHPJasper\PHPJasper;

    $jasper = new PHPJasper;

    /*$input = __DIR__ . '/jasp/prueba1.jrxml';

    $jasper = $jasper->compile($input)->execute();*/

    $input = __DIR__ .'/jasp/prueba1.jasper';  
    $output = __DIR__ .'/output';
    $options = [ 
        'format' => ['pdf', 'rtf'] 
    ];


    $jasper->process(
        $input,
        $output,
        $options
    )->execute();

    /*$command = $jasper->process(
        $input,
        $output,
        $options
    )->output();

    exec($command);

    echo $command;*/
    

   
    // echo "hola";
?>