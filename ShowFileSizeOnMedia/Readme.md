# WordPress Media Library File Size Column

# I created it with the help of Claude AI and ChatGPT

Agrega una columna de tamaño de archivo a la biblioteca de medios de WordPress, mostrando el tamaño de cada archivo en formato legible.

## 📋 Descripción

Esta función de WordPress añade una columna adicional en la vista de lista de la biblioteca de medios que muestra el tamaño de cada archivo en un formato fácil de leer (bytes, KB, MB, GB). Además, la columna es ordenable para facilitar la gestión de archivos.

## ✨ Características

- Muestra el tamaño de archivo en formato legible
- Columna ordenable para organizar archivos por tamaño
- Conversión automática de unidades (B, KB, MB, GB)
- Compatible con todos los tipos de archivos
- No requiere plugins adicionales
- Ligero y sin impacto en el rendimiento

## 🚀 Instalación

### Opción 1: Usando functions.php del tema

1. Accede a tu sitio WordPress vía FTP o panel de hosting
2. Navega a `/wp-content/themes/tu-tema/`
3. Abre el archivo `functions.php` (preferiblemente de un tema hijo)
4. Agrega el código al final del archivo
5. Guarda los cambios

### Opción 2: Crear un plugin personalizado

1. Crea un nuevo archivo llamado `media-filesize-column.php` en `/wp-content/plugins/`
2. Agrega el código del plugin (ver ejemplo abajo)
3. Activa el plugin desde el panel de WordPress

## 💻 Código
```php
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
