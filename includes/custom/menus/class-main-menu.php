<?php
/**
 * @Author: ComSi
 * @Date: 27-10-17
 * @Time: 17:28
 */

namespace Main\Custom\Menus;
use Main\Framework\Menu_Interface;
use Main\Constants;

class Main_Menu implements Menu_Interface {
	public function menu_page() {
		?>
		<form method="post" action="options.php">
			<?php
			settings_fields( Constants::PLUGIN_OPTIONS_GROUP );
			do_settings_sections( Constants::PLUGIN_OPTIONS_GROUP );
			?>
			<div class="wrap">
				<h1><?php echo __( 'Plugin Settings', Constants::PLUGIN_LANGUAGE_DOMAIN ); ?></h1>
				<table class="form-table">
					<tbody>
					<tr>
						<th scope="row"><label
								for="ExampleOption"><?php echo __( 'Example Option', Constants::PLUGIN_LANGUAGE_DOMAIN ); ?>
						</th>
						<td><input type="text" name="ExampleOption" id="ExampleOption" class="regular-text"
						           value="<?php echo get_option( "ExampleOption" ); ?>"/></td>
					</tr>
					</tbody>
				</table>
				<p class="submit"><?php submit_button(); ?></p>
			</div>
		</form>
		<?php
	}
}