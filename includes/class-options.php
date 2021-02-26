<?php
class IDXPT_Options {
	protected $plugin = null;

	/**
	 * Constructor.
	 *
	 * @since  0.0.1
	 *
	 * @param  Hack4cause $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();

		// Set our title.
		$this->title = esc_attr__( 'IDXPT', 'idxpt' );
	}

	public function hooks() {
		add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
		add_action( 'admin_init', array( $this, 'idx_power_tools_register_settings' ) );
	}

	public function add_settings_page() {
		add_options_page( 'IDX Power Tools Page', 'IDX Power Tools', 'manage_options', 'idx_power_tools', array( $this, 'idx_power_tools_render_plugin_settings_page' ) );
	}

	public function idx_power_tools_render_plugin_settings_page() {
		?>
		<h2>IDX Power Tools Settings</h2>
		<form action="options.php" method="post">
			<?php 
			settings_fields( 'idx_power_tools_options' );
			do_settings_sections( 'idx_power_tools' ); ?>
			<input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save' ); ?>" />
		</form>
		<?php
	}

	public function idx_power_tools_register_settings() {
		register_setting( 'idx_power_tools_options', 'idx_power_tools_options', 'idx_power_tools_options_validate' );
		add_settings_section( 'api_settings', '', array( $this, 'idx_power_tools_plugin_section_text' ), 'idx_power_tools' );
		add_settings_field( 'idx_power_tools_plugin_setting_api_key', 'API Key', array( $this, 'idx_power_tools_plugin_setting_api_key'), 'idx_power_tools', 'api_settings' );
		add_settings_field( 'idx_power_tools_plugin_setting_dev_key', 'Developer Key', array( $this, 'idx_power_tools_plugin_setting_dev_key'), 'idx_power_tools', 'api_settings' );
		add_settings_field( 'idx_power_tools_plugin_setting_details_url', 'Details URL *include trailing /', array( $this, 'idx_power_tools_plugin_setting_details_url'), 'idx_power_tools', 'api_settings' );
	}
	
	
	public function idx_power_tools_options_validate( $input ) {
		$newinput['api_key'] = trim( $input['api_key'] );
		$newinput['dev_key'] = trim( $input['dev_key'] );
		$newinput['details_url'] = trim( $input['details_url'] );
		return $newinput;
	}
	
	public function idx_power_tools_plugin_section_text() {
		echo '<p>Here you can set all the options</p>';
	}
	
	public function idx_power_tools_plugin_setting_api_key() {
		$options = get_option( 'idx_power_tools_options' );
		echo "<input id='idx_power_tools_plugin_setting_api_key' name='idx_power_tools_options[api_key]' type='text' value='" . esc_attr( $options['api_key'] )  . "' />";
	}
	
	public function idx_power_tools_plugin_setting_dev_key() {
		$options = get_option( 'idx_power_tools_options' );
		echo "<input id='idx_power_tools_plugin_setting_dev_key' name='idx_power_tools_options[dev_key]' type='text' value='" . esc_attr( $options['dev_key'] )  . "' />";
	}
	
	public function idx_power_tools_plugin_setting_details_url() {
		$options = get_option( 'idx_power_tools_options' );
		echo "<input id='idx_power_tools_plugin_setting_dev_key' name='idx_power_tools_options[details_url]' type='text' value='" . esc_attr( $options['details_url'] )  . "' />";
	}

	public function IDX_API( $access_key = null, $dev_key = null, $request = null, $method = null ) {
		$args = array(
			'headers' => array(
				'Content-Type' => 'application/x-www-form-urlencoded',
				'accesskey' => $access_key,
				'ancillarykey' => $dev_key,
				'outputtype' => 'json',
			)
		);
		$response = wp_remote_retrieve_body( wp_remote_get( $request, $args ) );
		$response = json_decode( $response, true );
		return $response;
	}

}