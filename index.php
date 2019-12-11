<?php
    // URL de la Libreria implementada https://github.com/geekcom/phpjasper
    
    require __DIR__ . '/vendor/autoload.php';
    use PHPJasper\PHPJasper;
    $jasper = new PHPJasper;

    $compile_flag = false;
    $ext = "pdf";
    $filename = "prueba1";

    if ($compile_flag) {
        // Compilar el modelo
        $input = __DIR__ . '\\resources\\'.$filename.'.jrxml';
        $jasper = $jasper->compile($input)->execute();
        echo "Compilado";
    } else {
        // Generar PDF
        $input = __DIR__ . '\\resources\\'.$filename.'.jasper';
        $output = __DIR__ .'\output';

        $options = [ 
            // 'format' => ['pdf', 'rtf'] ,
            'format' => ['pdf'] ,
            'locale' => 'en',
            'params' => [
                "nombre" => "Rene Corona Valdes",
                "imagen" => __DIR__ . '\resources\pacman.png'
            ]
        ];

        //Procesamiento directo

        $jasper->process(
            $input,
            $output,
            $options
        )->execute();

        // Mostrar la lista de parametros permitidos en el modelo jasper

        /*$output = $jasper->listParameters($input)->execute();
        foreach($output as $parameter_description)
            print $parameter_description . '<pre>';*/

            
        // Procesamiento manual con ejecucion a consola
        /*
            $command = $jasper->process(
                $input,
                $output,
                $options
            )->output();
                
            exec($command);
                
            echo $command; // Comando emitido a la consola
        */

        // Muestra el archivo generado y lo elimina

        header('Content-Description: File Transfer');
        header('Content-type: application/pdf');
        header('filename=' . $filename . ' - ' . time().''.$ext);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Length: ' . filesize($output.'\\'.$filename.'.'.$ext));
        flush();
        readfile($output.'\\'.$filename.'.'.$ext);
        unlink($output.'\\'.$filename.'.'.$ext);

        // echo "completado " . $output.'\prueba1.'.$ext;
    }
?>