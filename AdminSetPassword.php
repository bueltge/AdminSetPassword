<?php

Class AdminSetPasswordPlugin extends MantisPlugin
{

    public $cmv_pages;

    public $current_page;

    /**
     * Plugin registration information, some will be shown on plugin overview.
     *
     * The required minimum MantisBT version can be specified too.
     */
    public function register()
    {
        $this->name = plugin_lang_get('name');
        $this->description = plugin_lang_get('description');;
        $this->version = '1.0.0';
        $this->requires = ['MantisCore' => '2.0.0'];
        $this->url = 'https://github.com/mantisbt-plugins/AdminSetPassword';
    }

    /**
     * Setup of plugin settings.
     */
    public function config()
    {
        return [];
    }

    /**
     *  Overriding this function allows the plugin to set itself up,
     *  include any necessary API‘s, declare or hook events, etc.
     */
    public function init()
    {
        $this->cmv_pages = [
            'manage_user_edit_page.php',
        ];
        $this->current_page = basename($_SERVER['PHP_SELF']);
    }

    /**
     * @return array
     */
    public function hooks()
    {
        return [
            'EVENT_LAYOUT_RESOURCES' => 'enqueueScript',
        ];
    }

    /**
     * Enqueue script to add html inside the back end.
     *
     * @return string
     */
    public function enqueueScript()
    {
        $script = $this->printTranslations();
        $script .= '<script src="'.plugin_file('js/setpassword.js').'"></script>';

        return $script;
    }

    /**
     * Print translated strings in JSON object.
     *
     * @return string
     */
    public function printTranslations()
    {
        return '<script id="adminSetPasswordData" type="application/json">'.json_encode(
                [
                    'change_password' => plugin_lang_get('change_password'),
                    'password_length' => plugin_lang_get('password_length'),
                    'password_success' => plugin_lang_get('password_success'),
                ]
            ).'</script>';
    }
}
