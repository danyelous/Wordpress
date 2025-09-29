# WordPress Upload Size Limiter

# I created it with the help of Claude AI and ChatGPT

Función simple para WordPress que limita el tamaño máximo de archivos subidos a la biblioteca de medios.

## 📋 Descripción

Esta función de WordPress permite establecer un límite personalizado para el tamaño de los archivos que se pueden subir a la biblioteca de medios. Por defecto, está configurado para rechazar archivos mayores a 1 MB.

## ✨ Características

- Límite de tamaño configurable
- Mensaje de error personalizable
- Compatible con cualquier tema de WordPress
- Fácil de implementar
- No requiere plugins adicionales

## 🚀 Instalación

### Opción 1: Usando functions.php del tema

1. Accede a tu sitio WordPress vía FTP o panel de hosting
2. Navega a `/wp-content/themes/tu-tema/`
3. Abre el archivo `functions.php`
4. Agrega el código al final del archivo
5. Guarda los cambios

### Opción 2: Crear un plugin personalizado

1. Crea un nuevo archivo llamado `upload-size-limiter.php` en `/wp-content/plugins/`
2. Agrega el código del plugin (ver ejemplo abajo)
3. Activa el plugin desde el panel de WordPress

## 💻 Código
```php
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
