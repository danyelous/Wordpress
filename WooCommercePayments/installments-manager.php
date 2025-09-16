<?php
/**
 * Plugin Name: Configurador de Cuotas ABC Motos
 * Description: Plugin simple para configurar porcentaje de interés y número de cuotas
 * Version: 1.0
 * Author: ABC Motos
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

class ABC_Installments_Config {

    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'init_settings'));
    }

    // Crear menú en el admin
    public function add_admin_menu() {
        add_submenu_page(
            'woocommerce',
            'Configuración de Cuotas',
            'Configuración de Cuotas',
            'manage_options',
            'abc-installments-config',
            array($this, 'admin_page')
        );
    }

    // Inicializar configuraciones
    public function init_settings() {
        // Registrar opciones
        register_setting('abc_installments_settings', 'abc_interest_rate', array(
            'default' => 20,
            'sanitize_callback' => 'floatval'
        ));
        register_setting('abc_installments_settings', 'abc_installments_number', array(
            'default' => 3,
            'sanitize_callback' => 'intval'
        ));
    }

    // Página de administración
    public function admin_page() {
        // Procesar formulario
        if (isset($_POST['submit'])) {
            update_option('abc_interest_rate', floatval($_POST['abc_interest_rate']));
            update_option('abc_installments_number', intval($_POST['abc_installments_number']));
            echo '<div class="notice notice-success"><p><strong>¡Configuración guardada correctamente!</strong></p></div>';
        }

        // Obtener valores actuales
        $interest_rate = get_option('abc_interest_rate', 20);
        $installments_number = get_option('abc_installments_number', 3);
        ?>
        <div class="wrap">
            <h1>🏍️ Configuración de Cuotas - ABC Motos</h1>
            <p>Configura los parámetros para el cálculo de cuotas en tu tienda.</p>

            <form method="post" action="">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="abc_interest_rate">Porcentaje de Interés (%)</label>
                            </th>
                            <td>
                                <input type="number"
                                       id="abc_interest_rate"
                                       name="abc_interest_rate"
                                       value="<?php echo esc_attr($interest_rate); ?>"
                                       step="0.1"
                                       min="0"
                                       max="100"
                                       class="regular-text"
                                       required>
                                <p class="description">
                                    Ej: 20 para aplicar 20% de interés total. Valor actual: <strong><?php echo $interest_rate; ?>%</strong>
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="abc_installments_number">Número de Cuotas</label>
                            </th>
                            <td>
                                <input type="number"
                                       id="abc_installments_number"
                                       name="abc_installments_number"
                                       value="<?php echo esc_attr($installments_number); ?>"
                                       min="1"
                                       max="24"
                                       class="regular-text"
                                       required>
                                <p class="description">
                                    Cantidad de cuotas a mostrar (1-24). Valor actual: <strong><?php echo $installments_number; ?> cuotas</strong>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Vista previa -->
                <div style="background: #f0f9f0; padding: 20px; margin: 20px 0; border-radius: 8px; border-left: 4px solid #28a745;">
                    <h3 style="margin-top: 0;">📋 Vista Previa</h3>
                    <?php
                    $preview_price = 1000;
                    $preview_multiplier = 1 + ($interest_rate / 100);
                    $preview_total = $preview_price * $preview_multiplier;
                    $preview_installment = $preview_total / $installments_number;
                    ?>
                    <p><strong>Ejemplo con un producto de $<?php echo number_format($preview_price, 2); ?>:</strong></p>
                    <ul style="margin-left: 20px;">
                        <li>💳 <strong><?php echo $installments_number; ?> cuotas de $<?php echo number_format($preview_installment, 2); ?></strong></li>
                        <li>Total con interés: $<?php echo number_format($preview_total, 2); ?></li>
                        <li>Interés aplicado: <?php echo $interest_rate; ?>%</li>
                    </ul>
                </div>

                <!-- Funciones disponibles -->
                <div style="background: #f7f7f7; padding: 15px; margin: 20px 0; border-radius: 8px;">
                    <h3>🔧 Funciones para usar en tu código:</h3>
                    <code style="background: white; padding: 5px; display: block; margin: 5px 0;">
                        abc_get_interest_rate() // Retorna: <?php echo $interest_rate / 100; ?> (decimal)
                    </code>
                    <code style="background: white; padding: 5px; display: block; margin: 5px 0;">
                        abc_get_installments_number() // Retorna: <?php echo $installments_number; ?>
                    </code>
                    <code style="background: white; padding: 5px; display: block; margin: 5px 0;">
                        abc_get_interest_multiplier() // Retorna: <?php echo $preview_multiplier; ?>
                    </code>
                </div>

                <?php submit_button('Guardar Configuración', 'primary', 'submit', false); ?>
            </form>

            <hr style="margin: 30px 0;">

            <!-- Información adicional -->
            <div style="background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
                <h3>ℹ️ Información del Plugin</h3>
                <ul>
                    <li>✅ Este plugin solo maneja la configuración</li>
                    <li>✅ Tus funciones existentes siguen funcionando normalmente</li>
                    <li>✅ Los cambios se aplican automáticamente en toda la tienda</li>
                    <li>✅ Compatible con WooCommerce</li>
                </ul>

                <h4>📝 Para actualizar tu código actual:</h4>
                <p>Reemplaza los valores fijos (1.20 y 3) por las funciones helper:</p>
                <ul>
                    <li><code>1.20</code> → <code>abc_get_interest_multiplier()</code></li>
                    <li><code>3</code> → <code>abc_get_installments_number()</code></li>
                </ul>
            </div>
        </div>

        <style>
            .form-table th {
                width: 200px;
                font-weight: 600;
            }
            .regular-text {
                width: 100px !important;
            }
            code {
                font-family: 'Courier New', monospace;
                font-size: 13px;
            }
        </style>
        <?php
    }
}

// Funciones helper para usar en tu código
function abc_get_interest_rate() {
    return get_option('abc_interest_rate', 20) / 100;
}

function abc_get_installments_number() {
    return get_option('abc_installments_number', 3);
}

function abc_get_interest_multiplier() {
    return 1 + abc_get_interest_rate();
}

// Inicializar el plugin
new ABC_Installments_Config();

// Hook de activación
register_activation_hook(__FILE__, 'abc_installments_activate');

function abc_installments_activate() {
    // Establecer valores por defecto
    add_option('abc_interest_rate', 20);
    add_option('abc_installments_number', 3);
}
