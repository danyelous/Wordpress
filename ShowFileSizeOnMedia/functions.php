// Agregar columna de tamaño de archivo en la biblioteca de medios
function agregar_columna_tamano($columns) {
    $columns['filesize'] = 'Tamaño';
    return $columns;
}
add_filter('manage_media_columns', 'agregar_columna_tamano');

// Mostrar el tamaño del archivo en la columna
function mostrar_tamano_archivo($column_name, $post_id) {
    if ($column_name === 'filesize') {
        $file = get_attached_file($post_id);
        
        if (file_exists($file)) {
            $filesize = filesize($file);
            echo size_format($filesize, 2);
        } else {
            echo 'N/A';
        }
    }
}
add_action('manage_media_custom_column', 'mostrar_tamano_archivo', 10, 2);

// Hacer la columna ordenable (opcional)
function columna_tamano_ordenable($columns) {
    $columns['filesize'] = 'filesize';
    return $columns;
}
add_filter('manage_upload_sortable_columns', 'columna_tamano_ordenable');
