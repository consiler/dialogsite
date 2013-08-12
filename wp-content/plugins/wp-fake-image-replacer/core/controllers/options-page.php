<?php 

/*
*  wpfir options page
*
*  @description: add an options page
*  @since: 1.3
*  @created: 13/05/13
*/

class wpfirOptionsPage
{

	public $options;                                // retrieve plugin options


	public function __construct()
	{
		
		// get plugin options values
		$this->options = get_option('wpfir_settings');
		
		// initialize options the first time
		if(!$this->options) {
		
		    $this->options = array( 'mode' => 'dev', 
		                            'custom_text' => '',
		                            'theme' => 'grey',
		                            'background_color' => '',
		                            'foreground_color' => '',
		                            'font_size' => '',
		                            'flickr_search' => ''
		                        );
		    add_option('wpfir_settings', $this->options);
		}

		// Create option page 

		if(is_admin()) {

			// create options page
			add_action('admin_menu', array($this, 'add_options_page'));
			add_action('admin_init', array($this, 'page_init'));

		}    
	}


	/**
	 *
	 * Add options page
	 *
	 */

	public function add_options_page() 
	{        
		$wpfir_page = add_options_page('WP Fake Image Replacer Settings', 'WP Fake Image', 'manage_options', 'wpfir_settings', array($this, 'create_admin_page'));
		
		// add colorpicker script in options page only 
        add_action( 'admin_print_scripts-'.$wpfir_page, array($this, 'load_admin_scripts'));
	}


	/**
	 *
	 * Load colorpicker scripts in options page
	 *
	 */

	public function load_admin_scripts()
	{
	    $file = str_replace('core/controllers', '', __FILE__);
		
	    wp_enqueue_style('wp-color-picker');
	    wp_enqueue_script('wpfir-script', plugins_url('js/wpfir.js', $file), array('wp-color-picker'), false, true );
	}


	/**
	 *
	 * Option page settings
	 *
	 */

	public function page_init() 
	{

		// Section : Mode

		add_settings_section(
			'mode_section',
			__('Display mode', 'wpfir'),
			array($this, 'print_mode_info'),
			'wpfir_settings'
		);  
		

		add_settings_field(
			'mode', 
			__('Mode', 'wpfir'), 
			array($this, 'field_mode'), 
			'wpfir_settings',
			'mode_section'            
		);


		// Section : holder options

		add_settings_section(
			'holderjs_section',
			__('Fake image display', 'wpfir'),
			array($this, 'print_holderjs_info'),
			'wpfir_settings'
		);  
		

		add_settings_field(
			'custom_text', 
			__('Custom text', 'wpfir'), 
			array($this, 'field_text'), 
			'wpfir_settings',
			'holderjs_section'            
		);
		
		add_settings_field(
			'theme', 
			__('Theme', 'wpfir'), 
			array($this, 'field_theme'), 
			'wpfir_settings',
			'holderjs_section'            
		);


		// Section : Customize theme section

		add_settings_section(
			'customize_theme_section',
			__('Custom theme', 'wpfir'),
			array($this, 'print_theme_info'),
			'wpfir_settings'
		); 

		add_settings_field(
			'background_color', 
			__('Background color','wpfir'), 
			array($this, 'field_bg_color'), 
			'wpfir_settings',
			'customize_theme_section'            
		);

		add_settings_field(
			'foreground_color', 
			__('Foreground color', 'wpfir'), 
			array($this, 'field_fg_color'), 
			'wpfir_settings',
			'customize_theme_section'            
		);

		add_settings_field(
			'font_size', 
			__('Font size','wpfir'), 
			array($this, 'field_font_size'), 
			'wpfir_settings',
			'customize_theme_section'            
		); 


		// Section : flickr options

		add_settings_section(
			'flickr_section',
			__('Pics from Flickr', 'wpfir'),
			array($this, 'print_flickr_info'),
			'wpfir_settings'
		);  
		

		add_settings_field(
			'custom_text', 
			__('Keyword to search', 'wpfir'), 
			array($this, 'field_search'), 
			'wpfir_settings',
			'flickr_section'            
		);
		

		// register settings
		register_setting( 'wpfir_settings', 'wpfir_settings', array($this, 'sanitize_values'));
	}


	/**
	 *
	 * Option page HTML output
	 *
	 */


	public function create_admin_page() 
	{
		require(WPFIR_CORE.'views/options-page.php');
	}


	/**
	 *
	 * Sections text output
	 *
	 */

	public function print_mode_info() 
	{
		_e('Switch between developer mode (fake images) and presentation mode (Flick pics) for client review.', 'wpfir');
	}

	public function print_holderjs_info() 
	{
		_e('Customize fakes images text and theme on developer mode.', 'wpfir');
	}

	public function print_theme_info() 
	{
		_e('Don\'t like default themes ? Make your own !', 'wpfir');
	}

	public function print_flickr_info() 
	{		
		_e('By default, presentation mode get random popular pictures from Flickr, but you can provide a keyword. Type "Kittens" and get a cuteness overload !', 'wpfir');
	}


	/**
	 *
	 * Field Radio mode
	 *
	 */

	public function field_mode() 
	{

		// default value for the first time	
		if ($this->options['mode'] == "") {
			$this->options['mode'] = "dev";
		}

		$output = "<label><input type='radio' id='wpfir_settings[mode]' name='wpfir_settings[mode]' value='dev' ".checked('dev', $this->options['mode'], false)."> ".__('<strong>DEVELOPER MODE</strong>','wpfir')."</label>";
		$output.= "<p class='description'>".__('During theme development process. Images are generated with holder.js. Works offline.', 'wpfir')."</p>";
		$output.= "<label><input type='radio' id='wpfir_settings[mode]' name='wpfir_settings[mode]' value='pres' ".checked('pres', $this->options['mode'], false)."> ".__('<strong>PRESENTATION MODE</strong>','wpfir')."</label>";
		$output.= "<p class='description'>".__('Show the site to your client with beautiful random images from Flickr. Uses Flickr API. Web access required.', 'wpfir')."</p>";
	
		echo $output;
	}


	/**
	 *
	 * Field Text Custom text
	 *
	 */

	public function field_text() 
	{

		$output = "<input type='text' name='wpfir_settings[custom_text]' value='".$this->options['custom_text']."'>";
		$output.= "<p class='description'>".__('Leave empty to display image size.', 'wpfir')."</p>";
		
		echo $output;
	}


	/**
	 *
	 * Field Select Theme
	 *
	 */

	public function field_theme() 
	{

		// holder.js themes
		$themes = array('gray' => __('Shades of gray', 'wpfir'), 'industrial' => __('Dark grey & green', 'wpfir'), 'social' => __('Blue & white', 'wpfir'));
		
		// prepare output html
		$output = "<select name='wpfir_settings[theme]'>\r\n";

		foreach ($themes as $slug => $theme) :

			$s = ($this->options['theme'] == $slug) ? "selected" : "";
			$output .= "    <option value='".$slug."' ".$s.">".$theme."</option>\r\n";

		endforeach;
	
		$output .= "</select>\r\n";
		$output.= "<p class='description'>".__('WP Fake Image Replacer uses holder.js which provides 3 default themes.', 'wpfir')."</p>";

		echo $output;
	}


	/**
	 *
	 * Field Text Background color
	 *
	 */

	public function field_bg_color() 
	{

		$output = "<input type='text' name='wpfir_settings[background_color]' class='color-field' value='".$this->options['background_color']."'>";
		
		echo $output;   
	}


	/**
	 *
	 * Field Text Foreground color
	 *
	 */

	public function field_fg_color() 
	{

		$output = "<input type='text' name='wpfir_settings[foreground_color]' class='color-field' value='".$this->options['foreground_color']."'>";
		
		echo $output;   
	}


	/**
	 *
	 * Field Text Font size
	 *
	 */

	public function field_font_size() 
	{

		$output = "<input type='text' name='wpfir_settings[font_size]' value='".$this->options['font_size']."'> px";
		
		echo $output;   
	}


	/**
	 *
	 * Field Text Custom text
	 *
	 */

	public function field_search() 
	{

		$output = "<input type='text' name='wpfir_settings[flickr_search]' value='".$this->options['flickr_search']."'>";
		$output.= "<p class='description'>".__('"Forest", "New York", "Kittens"... Leave empty to get popular pictures.', 'wpfir')."</p>";
		
		echo $output;
	}


	/**
	 *
	 * Sanitize values before save
	 * 
	 * Helper. avoid apostrophes problems
	 *
	 * @param array $settings all settings values
	 * @return array sanitized values array
	 *
	 */

	public function sanitize_values($settings)
	{
		
		foreach($settings as $key => $value) {
			$settings[$key] = esc_html($value);
		}

		return $settings;
	}

}

new wpfirOptionsPage();