<?php

if( !class_exists('Customize') ) :

class Customize {

    public function __construct()
    {
        // Init Configurations
        add_action('after_switch_theme', array($this, 'InitThemeConfig'));

        // SMTP
        add_action('phpmailer_init', array($this, 'SmtpConfig'));

        // CMS
        add_action( 'admin_menu', array($this, 'HideMenuOptions'));
        add_filter('allowed_block_types_all', array($this, 'EnableBlocks'), 10, 2);
    }

    /**
     * SmtpConfig
     * @param object $mailer
     * @return boolean true
     */
    public function SmtpConfig($mailer)
    {
        $mailer->isSMTP();
        $mailer->Host = 'sandbox.smtp.mailtrap.io';
        $mailer->SMTPAuth = true;
        $mailer->Port = 2525;
        $mailer->Username = 'c879fd55d581ef';
        $mailer->Password = '04cd959772cdd3';
    }

    /**
     * HideMenuOptions
     * @return boolean true
     */
    public function HideMenuOptions()
    {
        //remove_menu_page( 'plugins.php' ); // Plugins
        //remove_menu_page( 'tools.php' ); // Tools
        //remove_menu_page( 'options-general.php' ); // Settings

        return true;
    }

    /**
     * InitThemeConfig
     */
    function InitThemeConfig() {
        update_option('timezone_string', 'America/Sao_Paulo');
        update_option('date_format', 'd/m/Y');
        update_option('time_format', 'H:i');
        update_option('start_of_week', 0);
        update_option('users_can_register', false);
        update_option('posts_per_page', 20);
        $permalink_structure = '/%postname%/';
        update_option('permalink_structure', $permalink_structure);
        flush_rewrite_rules();
    }

    /**
     * EnableBlocks
     */
    public function EnableBlocks($allowed_blocks, $post) {

        return array(
			'core/paragraph',
			'core/list',
			'core/image',
            'core/separator',
            'core/spacer',
            'core/heading'
		);
    }

}

$Customize = new Customize();

endif;
