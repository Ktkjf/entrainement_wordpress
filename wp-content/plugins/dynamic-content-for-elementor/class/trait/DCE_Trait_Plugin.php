<?php
namespace DynamicContentForElementor;
/**
 * Description of DCE_Trait_Plugin
 *
 * @author francesco
 */
trait DCE_Trait_Plugin {
    
    public static $checked_plugins = [];
    
    public static function is_plugin_active($plugin) {        
        if (isset(self::$checked_plugins[$plugin])) {
            return self::$checked_plugins[$plugin];
        }
        
        self::$checked_plugins[$plugin] = $is_active = self::is_acf_pro($plugin) || self::is_plugin_must_use($plugin) || self::is_plugin_active_for_local($plugin) || self::is_plugin_active_for_network($plugin);
        return $is_active;
    }
    public static function is_acf_pro($plugin) {
        //var_dump($plugin);
       
        if ($plugin == 'acf') {
            if (defined('ACF')) {
                return ACF;
            }
        }
        if ($plugin == 'advanced-custom-fields-pro') {
            if (defined('ACF_PRO')) {
                return ACF_PRO;
            }
        }
        return false;
    }
    public static function is_plugin_must_use($plugin) {
        $mu_plugins = wp_get_mu_plugins(); // Must Use
        if ( is_dir( WPMU_PLUGIN_DIR ) ) {
            $mu_dir_plugins = glob(WPMU_PLUGIN_DIR.'/*/*.php'); // Must Use
            //var_dump( $mu_dir_plugins );
            if (!empty($mu_dir_plugins)) {
                foreach ($mu_dir_plugins as $aplugin) {
                    $mu_plugins[] = $aplugin;
                }
            }
        }
        //var_dump($mu_plugins); die();
        require_once ABSPATH.'wp-admin/includes/plugin.php';
        if (!empty($mu_plugins)) {
            foreach($mu_plugins as $aplugin) {
                $plugin_data = get_plugin_data($aplugin);
                if (!empty($plugin_data['Name']) && $plugin_data['Name'] == 'Advanced Custom Fields PRO') {
                    $mu_plugins[] = str_replace('acf.php', 'advanced-custom-fields-pro.php', $aplugin);
                    break;
                }
            }
        }
        return self::check_plugin($plugin, $mu_plugins);
    }
    public static function is_plugin_active_for_local($plugin) {
        $active_plugins = get_option('active_plugins', array());
        //var_dump($active_plugins);
        return self::check_plugin($plugin, $active_plugins);
    }
    public static function is_plugin_active_for_network($plugin) {
        $active_plugins = get_site_option('active_sitewide_plugins');
        if (!empty($active_plugins)) {
            $active_plugins = array_keys($active_plugins);
            return self::check_plugin($plugin, $active_plugins);
        }
        return false;
    }
    public static function check_plugin($plugin, $active_plugins = array()) {
        if (in_array($plugin, (array) $active_plugins)) {
            return true;
        }
        if (!empty($active_plugins)) {
            foreach ($active_plugins as $aplugin) {
                $tmp = basename($aplugin);
                $tmp = pathinfo($tmp, PATHINFO_FILENAME);
                if ($plugin == $tmp) {
                    return true;
                }
            }
        }
        if (!empty($active_plugins)) {
            foreach ($active_plugins as $aplugin) {
                $pezzi = explode('/', $aplugin);
                $tmp = reset($pezzi);
                if ($plugin == $tmp) {
                    return true;
                }
            }
        }
        return false;
    }
    
}