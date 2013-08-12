<?php
/*
Plugin Name: WP Fake Image Replacer
Plugin URI: http://www.dysign.fr/projets/plugin-wordpress-fake-image-replacer/
Description: Replace an empty post thumbnail with a same size fake image. Useful for theme developement. Just activate and it works.
Version: 1.5.1
License: GPL
Author: Maxime BERNARD-JACQUET
Author URI: http://dysign.fr
*/

if ( !defined('ABSPATH')) die();


// constants
define( 'WPFIR_CORE', plugin_dir_path(__FILE__).'/core/' );


// PHP Flickr API
require_once('apis/phpFlickr.php');
$flickr = new phpFlickr("265d04c01db9982fa775a031fcc5e2dc");

// creating options page
require_once('core/controllers/options-page.php');


// WP Fake Image Replacer main class

class WPFakeImageReplacer 
{

    public $img_lib_url = "holder.js";              // name of the js lib
    public $nb_gal_pics = 6 ;                       // number of fake images to put in a gallery
    public $have_custom_theme = false;              // check for custom theme defined in options page
    public $flickr_pics;                            // store api result from intersting Flickr pics
    public $options;                                // retrieve plugin options

    public function __construct()
    {
        // get plugin options values
        $this->options = get_option('wpfir_settings');
        
        
        // load holder.js
        add_action('wp_enqueue_scripts', array($this, 'load_scripts'));


        // add filter for post thumbnails
        add_filter( 'post_thumbnail_html', array($this,'post_thumbnail_html'), 10, 5 );

        // ACF Support    
        global $acf;

        if ($acf) 
        {
            // Image
            add_filter('acf/format_value_for_api/type=image', array($this, 'acf_image_filter'), 11, 3);
            
            // Gallery
            add_filter('acf/format_value_for_api/type=gallery', array($this, 'acf_gallery_filter'), 11, 3);
        }


        // Add holder.js custom theme
        if (!is_admin() and $this->options and is_array($this->options) and $this->options['background_color']!="" and $this->options['foreground_color']!="") {
            
            // activate custom theme
            $this->have_custom_theme = true;

            // add theme script in footer
            add_action('wp_footer', array($this, 'add_custom_theme_js'), 100);
        }

        // Flickr API call to get recent interesting pics
        if (!is_admin() and $this->options and is_array($this->options) and $this->options['mode']=="pres") {            
            
            $this->get_pics_from_flickr();

        }




        // set text domain for i18n
        load_plugin_textdomain('wpfir', false, basename(dirname(__FILE__)).'/languages/');

        // add settings link
        $plugin = plugin_basename( __FILE__ );
        add_filter( "plugin_action_links_$plugin", array($this, 'add_settings_link'));
    }
  

 


    /**
     *
     * Load plugin javascript
     * 
     * Action. Add holder.js script in WP
     *
     */

    public function load_scripts()
    {
        wp_enqueue_script('holder', plugins_url('/js/'.$this->img_lib_url, __FILE__), '', '', true);
    }



    /**
     *
     * Add custom holder.js theme
     * 
     * Action. Get values from
     *
     */

    public function add_custom_theme_js()
    {
        // set default size if not given
        if ($this->options['font_size'] == '') {
            $this->options['font_size'] = 14;
        }

        echo '<script type="text/javascript"> Holder.add_theme("custom", { background: "'.$this->options['background_color'].'", foreground: "'.$this->options['foreground_color'].'", size: '.$this->options['font_size'].' })</script>';
    }



    /**
     *
     * Filter for WP Post Thumbnail
     * 
     * Filter. Replace empty WP image by a fake image
     *
     * @param string $html the original html code to output
     * @param int $post_id id of the post
     * @param int $post_thumbnail_id the post thumbnail id
     * @param array $attr some attributes
     * @return array of the modified value
     *
     */

    public function post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr )
    {

        // check for empty post thumbnail
        if (empty( $html )) 
        {

            $s = $this->get_thumbnail_size($size);

            // replace with holder image
            $html = $this->generate_image($s['w'], $s['h'], 'html');

        }

        return $html;
    }


    /**
     *
     * Support for ACF Image field
     * 
     * Filter. Replace empty ACF image by a fake image
     *
     * @param array $value the default field value
     * @param int $post_id id of the post
     * @param array $field the field parameters
     * @return array of the modified value
     *
     */

    public function acf_image_filter($value, $post_id, $field)
    {
        
        // if no image is set
        if (!$value) 
        {
            // Save format
            $save_format = $field['save_format'];
            
            // Object
            if ($save_format == "object") 
            {

                // thumbnails sizes
                $s = $this->get_thumbnails_sizes();

                // set this instead of empty datas
                $value = array(
                    'id' => 0,
                    'title' => 'a Fake Image',
                    'caption' => 'a Fake Image',
                    'description' => 'a Fake Image',
                    'url' => $s['large'],
                    'sizes' => $s
                );
            }

            // ** Sorry but I can't do anything more with ID and URL **
            if ($save_format == "url" or $save_format == "id" )
            {
                $value = $this->generate_image('300', '200', 'url');
            }
     
        }

        return $value;
    }


    /**
     *
     * Support for ACF Gallery field
     * 
     * Filter. Replace empty ACF gallery by three fake images
     *
     * @param array $value the default field value
     * @param int $post_id id of the post
     * @param array $field the field parameters
     * @return array of the modified value
     *
     */

    public function acf_gallery_filter($value, $post_id, $field)
    {
        // if gallery is empty
        if (!$value) 
        {

            // insert more than one pic in gallery
            for ($i=0;$i<$this->nb_gal_pics;$i++)
            {

                // thumbnails sizes
                $s = $this->get_thumbnails_sizes();

                // set this instead of empty datas
                $image = array(
                    'id' => 0,
                    'title' => 'a Fake Image',
                    'caption' => 'a Fake Image',
                    'description' => 'a Fake Image',
                    'url' => $s['large'],
                    'sizes' => $s
                );

                $value[$i] = $image;
            }
     
        }

        return $value;
    }


    /**
     *
     * Get a specific thumbnail size
     * 
     * Helper. Get a size from default and Theme added images sizes
     *
     * @param string $size the name of the size
     * @return array of urls
     *
     */

    private function get_thumbnail_size($size)
    {

        $default_wp_sizes = array('thumbnail', 'medium', 'large');

        // default Wordpress Thumb sizes
        if (in_array($size, $default_wp_sizes))
        {

            $s['w'] = get_option($size."_size_w");
            $s['h'] = get_option($size."_size_h");
        }

        // Additionnal size (added in functions.php with set_post_thumbnail_size or add_image_size)
        else {

            global $_wp_additional_image_sizes;

            // get Width and Height
            $s['w'] = $_wp_additional_image_sizes[$size]['width'];
            $s['h'] = $_wp_additional_image_sizes[$size]['height'];

        }

        // fix for some themes using 9999px height for smooth resize (ex)
        if ($s['h'] == '9999') {
            $s['h'] = '390';
        }

        return $s;

    }


    /**
     *
     * Get all Wordpress thumbnail sizes
     * 
     * Helper. Get Default and Theme added images sizes
     *
     * @return array of urls
     *
     */

    private function get_thumbnails_sizes()
    {

        // default Wordpress Thumb sizes

        $default_wp_sizes = array('thumbnail', 'medium', 'large');

        foreach($default_wp_sizes as $size) 
        {

            $w = get_option($size."_size_w");
            $h = get_option($size."_size_h");

            $s[$size] = $this->generate_image($w, $h, 'url');
        }

        // Additionnal size (added in functions.php with set_post_thumbnail_size or add_image_size)

        global $_wp_additional_image_sizes;

        foreach($_wp_additional_image_sizes as $key => $value) 
        {
            $s[$key] = $this->generate_image($value['width'], $value['height'], 'url');
        }

        return $s;
    }


    /**
     *
     * Generates fake image HTML
     * 
     * Helper. Generates fake image according to params and options 
     *
     * @param string $w image width
     * @param string $h image height
     * @param string $type (html or url) type of output
     * @return string html output
     *
     */

    private function generate_image($w = '300', $h = '200', $type = 'html')
    {

        // ** DEV MODE : holder.js **
        if ($this->options['mode'] == 'dev') {
            
            // source library
            $src = $this->img_lib_url;

            // Theme
            if ($this->have_custom_theme) { // customized theme from options
                $t = '/custom';
            }
            elseif ($this->options['theme']!="") { // default theme from default theme select list
                $t = '/'.$this->options['theme'];
            
            } else { // no theme
                $t  = '';
            }

            // Custom text option
            if ($this->options['custom_text']!="") {
                $c = '/text:'.$this->options['custom_text'];
            } else {
                $c  = '';
            }

            // replace with holder image html
            if ($type == 'html') {
                $output = '<img data-src="'.$src.'/'.$w.'x'.$h.$t.$c.'">';
            
            // holder image url
            } else {
                $output = $src.'/'.$w.'x'.$h.$t.$c;
            }


        // ** PRESENTATION MODE : Flickr API **
        } else if ($this->options['mode'] == 'pres') {

            // get random image from interesting Flickr pics
            $r = array_rand($this->flickr_pics, 1);

            // get datas
            $photo = $this->flickr_pics[$r];

            // html
            if ($type == 'html') {
                $output = '<img width="'.$w.'" height="'.$h.'" src="http://farm'.$photo['farm'].'.staticflickr.com/'.$photo['server'].'/'.$photo['id'].'_'.$photo['secret'].'_b.jpg" alt="'.$photo['title'].' par '.$photo['owner'].'">';
            
            // url
            } else {
                $output = 'http://farm'.$photo['farm'].'.staticflickr.com/'.$photo['server'].'/'.$photo['id'].'_'.$photo['secret'].'_b.jpg" alt="'.$photo['title'].' par '.$photo['owner'];
            }

        }
    
        return $output;
    }


    /**
     *
     * Add settings link
     * 
     * Filter. Add a link in plugin list page
     *
     */

    function add_settings_link( $links ) {
        
        $settings_link = '<a href="options-general.php?page=wpfir_settings">'.__('Settings','wpfir').'</a>';
        array_push( $links, $settings_link );
        return $links;
    }



    /**
     *
     * Call Flickr API to get pictures
     *
     * Called one time and get many pics if option mode is presentation
     *
     */  

    public function get_pics_from_flickr()
    {
        global $flickr;

        // default : popular pics
        if ($this->options['flickr_search'] == "") {
            
            $pics = $flickr->interestingness_getList();
            $this->flickr_pics = $pics['photos']['photo'];
        
        // search flickr for given value in option page
        } else {

            $search = $this->options['flickr_search'];
            $pics = $flickr->photos_search(array('text' => $search));
            $this->flickr_pics = $pics['photo'];
        }
    }

}

$wpfir = new WPFakeImageReplacer();
