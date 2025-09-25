# WooCommerce WhatsApp Integration

# I created it with the help of Claude AI and ChatGPT

Integración automática de WhatsApp con WooCommerce que redirige a los clientes a WhatsApp después de completar una compra, enviando automáticamente los detalles del pedido.

## 🚀 Características

- ✅ **Sin popups bloqueados** - Usa redirección directa del navegador
- ✅ **Redirección automática** - Lleva al cliente a WhatsApp automáticamente
- ✅ **Mensaje personalizado** - Incluye todos los detalles del pedido
- ✅ **Responsive** - Optimizado para dispositivos móviles
- ✅ **Configurable** - Número de WhatsApp editable desde el admin
- ✅ **Múltiples opciones** - Diferentes métodos de implementación
- ✅ **Contador visual** - El usuario sabe cuándo será redirigido

## 📱 Demo

Después de completar una compra, el cliente verá:

1. La página de confirmación del pedido
2. Un contador de 3 segundos con mensaje visual
3. Redirección automática a WhatsApp con el mensaje pre-cargado

## 🛠️ Instalación

### Opción 1: Descarga directa
1. Descarga el archivo `functions-whatsapp.php`
2. Copia el contenido al final de tu archivo `functions.php` del tema activo
3. Configura tu número de WhatsApp en el admin de WordPress

### Opción 2: Como plugin
```bash
git clone https://github.com/tuusuario/woocommerce-whatsapp-integration.git
```
1. Sube la carpeta a `/wp-content/plugins/`
2. Activa el plugin desde el panel de administración

## ⚙️ Configuración

### 1. Configurar número de WhatsApp

Ve a **Ajustes > Generales** en tu admin de WordPress y encontrarás el campo "Número de WhatsApp".

Formato: `543487639522` (código de país + número sin espacios ni símbolos)

### 2. Elegir método de redirección

El código incluye 3 opciones:

#### **Opción 1: Redirección Automática** ⭐ (Recomendada)
```php
add_action('woocommerce_thankyou', 'redirect_to_whatsapp_after_checkout');
add_action('wp_footer', 'add_whatsapp_redirect_script');
```
- Redirección automática después de 3 segundos
- Contador visual para el usuario
- Mejor experiencia de usuario

#### **Opción 2: Redirección Inmediata**
```php
add_action('woocommerce_thankyou', 'whatsapp_redirect_with_wp_redirect');
```
- Redirección inmediata del servidor
- Más rápida pero menos control visual
- Descomenta para activar

#### **Opción 3: Solo Botón**
```php
add_action('woocommerce_thankyou', 'add_whatsapp_button_to_thankyou_page', 20);
```
- Muestra un botón atractivo para ir a WhatsApp
- El usuario controla cuándo ir
- Siempre activa por defecto

## 📋 Mensaje de WhatsApp

El mensaje incluye automáticamente:

```
🛒 Pedido Confirmado - Nicasio

📋 Número de Pedido: #123

👤 Datos del Cliente:
Nombre: Juan Pérez
Email: juan@email.com
Teléfono: +54 11 1234-5678
Dirección: Av. Corrientes 1234, CABA
Código Postal: 1043
Provincia: Buenos Aires

🛍️ Productos:
• Producto 1 (x2) - $50.00
• Producto 2 (x1) - $25.00

💰 Total: $75.00

💳 Método de pago: Transferencia bancaria

📝 Notas: Entregar por la mañana

✅ Pedido procesado correctamente en nuestro sistema.
```

## 🎨 Personalización

### Cambiar el mensaje
Modifica la función `redirect_to_whatsapp_after_checkout()`:

```php
$message = "🛒 *Tu tienda - Nuevo Pedido*\n\n";
// ... resto del mensaje
```

### Cambiar el tiempo de redirección
En el JavaScript, modifica:

```javascript
setTimeout(function() {
    window.location.href = '<?php echo esc_js($whatsapp_url); ?>';
}, 3000); // 3000ms = 3 segundos
```

### Cambiar dispositivos objetivo
Por defecto solo funciona en móviles. Para habilitarlo en desktop:

```php
// Comenta o elimina esta línea:
if (!is_mobile_device()) {
    return;
}
```

### Personalizar el botón
Modifica la función `add_whatsapp_button_to_thankyou_page()` para cambiar colores, texto o estilo.

## 🔧 Requisitos

- WordPress 5.0+
- WooCommerce 4.0+
- Tema compatible con WooCommerce
- PHP 7.4+

## 🐛 Resolución de Problemas

### El cliente no es redirigido
1. Verifica que WooCommerce esté instalado y activo
2. Confirma que el número de WhatsApp esté configurado correctamente
3. Revisa la consola del navegador para errores JavaScript

### El mensaje no se genera correctamente
1. Verifica que el pedido se esté procesando correctamente
2. Revisa que todos los campos del formulario de checkout estén completos
3. Confirma que no hay conflictos con otros plugins

### Redirección en bucle
- El código incluye protección con transients
- Si persiste, limpia los transients desde el admin o base de datos

### Popups bloqueados (problema anterior)
✅ **Solucionado** - Esta versión no usa popups, usa redirección directa

## 📚 Hooks Disponibles

### Acciones
- `woocommerce_thankyou` - Ejecuta después del checkout exitoso
- `wp_footer` - Agrega JavaScript a la página
- `admin_init` - Registra configuraciones del admin

### Filtros personalizables
Puedes agregar estos filtros para mayor personalización:

```php
// Personalizar el mensaje
add_filter('whatsapp_order_message', 'mi_mensaje_personalizado', 10, 2);

// Personalizar el número de teléfono
add_filter('whatsapp_phone_number', 'mi_numero_personalizado');

// Personalizar la URL de WhatsApp
add_filter('whatsapp_redirect_url', 'mi_url_personalizada', 10, 2);
```

## 🤝 Contribuir

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/nueva-caracteristica`)
3. Commit tus cambios (`git commit -am 'Agrega nueva característica'`)
4. Push a la rama (`git push origin feature/nueva-caracteristica`)
5. Abre un Pull Request

## 📝 Changelog

### v1.2.0 - 2024-09-25
- ✅ Eliminados popups bloqueados
- ✅ Agregada redirección directa
- ✅ Contador visual mejorado
- ✅ Protección contra bucles con transients
- ✅ Botón más atractivo con efectos hover

### v1.1.0 - 2024-09-20
- ✅ Configuración desde admin de WordPress
- ✅ Múltiples opciones de implementación
- ✅ Limpieza automática de transients

### v1.0.0 - 2024-09-15
- ✅ Versión inicial con popup (deprecada)

## 📄 Licencia

MIT License - ver archivo [LICENSE](LICENSE) para detalles

## 👨‍💻 Autor

Desarrollado para integración WooCommerce + WhatsApp

- 🐛 **Reportar bugs**: [Issues](https://github.com/tuusuario/repo/issues)
- 💡 **Solicitar features**: [Feature Requests](https://github.com/tuusuario/repo/issues/new)
- 📧 **Contacto**: tu-email@ejemplo.com

## ⭐ ¿Te gustó?

Si este código te ayudó, considera:
- Darle una ⭐ al repositorio
- Compartirlo con otros desarrolladores
- Contribuir con mejoras

---

**💡 Tip**: Para mejores resultados, usa números de WhatsApp Business y configura respuestas automáticas para una experiencia completa de atención al cliente.
