// Limitar tamaño de subida de archivos a 1MB
function limitar_tamano_subida($file) {
    $size = $file['size'];
    $size_mb = $size / 1024 / 1024; // Convertir bytes a megabytes
    $limit = 1; // Límite en MB

    if ($size_mb > $limit) {
        $file['error'] = 'El archivo es demasiado grande. El tamaño máximo permitido es ' . $limit . ' MB.';
    }

    return $file;
}
add_filter('wp_handle_upload_prefilter', 'limitar_tamano_subida');
