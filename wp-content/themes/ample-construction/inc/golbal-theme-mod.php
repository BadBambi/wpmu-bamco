<?php
/**
 * Functions for get_theme_mod()
 *
 
 */
if (!function_exists('ample_construction_get_option')) :

    /**
     * Get theme option.
     *
     * @since 1.0.0
     *
     * @param string $key Option key.
     * @return mixed Option value.
     */
    function ample_construction_get_option($key = '')
    {
        if (empty($key)) {
            return;
        }
        $ample_construction_default_options = ample_construction_get_default_theme_options();

        $default = (isset($ample_construction_default_options[$key])) ? $ample_construction_default_options[$key] : '';

        $theme_option = get_theme_mod($key, $default);

        return $theme_option;

    }

endif;

