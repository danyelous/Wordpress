# 🏍️ Configurador de Cuotas ABC Motos

# I created it with the help of Claude AI and ChatGPT

Plugin de WordPress para WooCommerce que permite configurar dinámicamente el porcentaje de interés y número de cuotas para pagos financiados.

## 📋 Descripción

Este plugin proporciona una interfaz administrativa simple para gestionar los parámetros de financiación en tu tienda WooCommerce, eliminando la necesidad de modificar código cada vez que quieras cambiar las condiciones de pago.

## ✨ Características

- 🔧 **Configuración dinámica**: Cambia porcentaje de interés y número de cuotas desde el admin
- 👀 **Vista previa en tiempo real**: Ve cómo afectan los cambios antes de guardar
- 🔌 **Funciones helper**: APIs simples para usar en tu código
- 🎯 **Integración perfecta**: Compatible con WooCommerce
- ⚡ **Fácil de usar**: Interfaz intuitiva en el panel de administración

## 🚀 Instalación

1. Sube el archivo `installments-manager.php` a la carpeta `/wp-content/plugins/`
2. Activa el plugin desde el panel de administración de WordPress
3. Ve a **WooCommerce → Configuración de Cuotas** para configurar los parámetros

## ⚙️ Configuración

### Panel de Administración

Accede a **WooCommerce → Configuración de Cuotas** donde podrás configurar:

- **Porcentaje de Interés**: De 0% a 100% (con decimales)
- **Número de Cuotas**: De 1 a 24 cuotas

### Vista Previa

El plugin incluye una vista previa que muestra cómo se calculan las cuotas con un ejemplo de $1000.

## 🛠️ Uso en el Código

### Funciones Helper Disponibles

```php
// Obtener tasa de interés como decimal (ej: 0.20 para 20%)
$interest_rate = abc_get_interest_rate();

// Obtener número de cuotas configurado
$installments = abc_get_installments_number();

// Obtener multiplicador de interés (ej: 1.20 para 20% de interés)
$multiplier = abc_get_interest_multiplier();
```

### Ejemplo de Implementación

```php
// Mostrar cuotas en páginas de productos
add_action('woocommerce_single_product_summary', 'show_installments_after_price', 11);
function show_installments_after_price() {
    global $product;
    
    if (!$product || !$product->get_price()) {
        return;
    }
    
    $price = $product->get_price();
    $price_with_interest = $price * abc_get_interest_multiplier();
    $installment = $price_with_interest / abc_get_installments_number();
    $installment_formatted = wc_price($installment);
    $cuotas_numero = abc_get_installments_number();
    
    echo '<div class="cuotas-info">
            <span>💳 ' . $cuotas_numero . ' cuotas de ' . $installment_formatted . '</span>
          </div>';
}
```

## 📁 Archivos del Proyecto

```
abc-motos-installments/
├── installments-manager.php    # Plugin principal
├── functions-example.php       # Funciones de ejemplo para functions.php
└── README.md                  # Esta documentación
```

## 🔄 Migración desde Código Fijo

Si ya tienes código con valores fijos, simplemente reemplaza:

| Código Anterior | Código Nuevo |
|----------------|--------------|
| `* 1.20` | `* abc_get_interest_multiplier()` |
| `/ 3` | `/ abc_get_installments_number()` |
| `3 cuotas` | `abc_get_installments_number() . ' cuotas'` |

## 🎯 Funciones de Ejemplo Incluidas

El proyecto incluye funciones listas para usar en `functions.php`:

- ✅ Mostrar cuotas en páginas de productos individuales
- ✅ Mostrar cuotas en páginas de tienda/categorías
- ✅ JavaScript para página de inicio
- ✅ Mostrar cuotas en carrito y checkout

## 🔧 Requisitos

- WordPress 5.0+
- WooCommerce 3.0+
- PHP 7.0+

## 📊 Valores por Defecto

- **Interés**: 20%
- **Cuotas**: 3

## 🤝 Contribuir

¿Tienes ideas para mejorar el plugin? ¡Las contribuciones son bienvenidas!

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit tus cambios (`git commit -am 'Agrega nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Abre un Pull Request

## 📝 Changelog

### v1.0
- ✨ Lanzamiento inicial
- ⚙️ Configuración de porcentaje de interés
- 🔢 Configuración de número de cuotas
- 👀 Vista previa en tiempo real
- 🔌 Funciones helper para developers

## 👨‍💻 Autor

**ABC Motos**

## 📄 Licencia

Este proyecto es de código abierto y está disponible bajo la Licencia MIT.

---

💡 **Tip**: Después de cambiar la configuración, las cuotas se actualizarán automáticamente en toda tu tienda sin necesidad de tocar código.
