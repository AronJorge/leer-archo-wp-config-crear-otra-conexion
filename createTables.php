<?php

global $wpdb;

// Apartir de aqui inicia la configuracion para crear el archivo con los datos de config de la BD
if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/wp-config.php") == true) {

    $archivoWp_config = fopen($_SERVER['DOCUMENT_ROOT'] . "/wp-config.php", "rb"); // Abrir el archivo, creándolo si no existe

    $wpConfiContenido = fread($archivoWp_config, filesize($_SERVER['DOCUMENT_ROOT'] . "/wp-config.php"));  // Leemos hasta el final del archivo

    $posicionInicialDATABASE = strpos($wpConfiContenido, "DB_NAME");
    $posicionFinalDATABASE = strpos($wpConfiContenido, ");", $posicionInicialDATABASE);
    $DATABASE = substr($wpConfiContenido, $posicionInicialDATABASE + 11, $posicionFinalDATABASE - ($posicionInicialDATABASE + 13));

    $posicionInicialUSER = strpos($wpConfiContenido, "DB_USER");
    $posicionFinalUSER = strpos($wpConfiContenido, ");", $posicionInicialUSER);
    $USER = substr($wpConfiContenido, $posicionInicialUSER + 11, $posicionFinalUSER - ($posicionInicialUSER + 13));

    $posicionInciailPASSWORD = strpos($wpConfiContenido, "DB_PASSWORD");
    $posicionFinalPASSWORD = strpos($wpConfiContenido, ");", $posicionInciailPASSWORD);
    $PASSWORD = substr($wpConfiContenido, $posicionInciailPASSWORD + 15, $posicionFinalPASSWORD - ($posicionInciailPASSWORD + 17));

    $posicionIncialHOST = strpos($wpConfiContenido, "DB_HOST");
    $posicionFinalHOST = strpos($wpConfiContenido, ");", $posicionIncialHOST);
    $HOST = substr($wpConfiContenido, $posicionIncialHOST + 11, $posicionFinalHOST - ($posicionIncialHOST + 13));


    $confiArchivo = fopen($_SERVER['DOCUMENT_ROOT'] . "/wp-content/plugins/SMS/config/config_db.php", "w+b");

    if ($confiArchivo == false) {
        error_log("Error al crear el archivo -- 'config_db.php'");
    } else {
        // Escribir en el archivo:
        fwrite($confiArchivo, "<?php \n");
        fwrite($confiArchivo, "define('HOST', '$HOST'); \n");
        fwrite($confiArchivo, "define('USER', '$USER'); \n");
        fwrite($confiArchivo, "define('PASSWORD', '$PASSWORD'); \n");
        fwrite($confiArchivo, "define('DATABASE', '$DATABASE'); \n");

        // Fuerza a que se escriban los datos pendientes en el buffer:
        fflush($confiArchivo);
    }

    // Cerrar el archivo:
    fclose($confiArchivo);
}

// Cerrar el archivo:
fclose($archivoWp_config);
