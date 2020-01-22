<?php

namespace Main\Framework;

use Main\Framework\Classes\Option;
use Main\Plugin;

/**
 * Class Options_page
 *
 * This class will show all the options added by the plugin in the options page.
 *
 * @package Main\Framework
 * @author Berend de Groot <berend@nugtr.nl>
 */
class Options_page implements Menu_Interface {
	private $plugin_options;

	/**
	 * Options_page constructor.
	 *
	 * @param $plugin_options
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function __construct( $plugin_options ) {
		$this->plugin_options = $plugin_options;
	}

	/**
	 * Default options page
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function menu_page() {
		?>
        <form method="post" action="options.php">
			<?php
			settings_fields( Plugin::OPTIONS_GROUP );
			do_settings_sections( Plugin::OPTIONS_GROUP );
			?>
            <div class="wrap">
                <h1><?php echo Plugin::OPTIONS_PAGE_TITLE ?></h1>
                <table class="form-table">
                    <tbody>
					<?php
					foreach ( $this->plugin_options as $plugin_option ) {
						/** @var $plugin_option Option */
						$option_name  = $plugin_option->get_name();
						$option_label = $plugin_option->get_label();
						$option_type  = $plugin_option->get_type();
						?>
                        <tr>
                            <th scope="row">
                                <label for="<?php echo $option_name ?>"><?php echo $option_label ?>
                            </th>
                            <td>
                                <input type="<?php echo $option_type; ?>" name="<?php echo $option_name ?>"
                                       id="<?php echo $option_name; ?>"
                                       value="<?php echo get_option( $option_name ); ?>"/>
                            </td>
                        </tr>
						<?php
					}
					?>
                    </tbody>
                </table>
                <p class="submit"><?php submit_button(); ?></p>
            </div>
        </form>
		<?php

	}
}