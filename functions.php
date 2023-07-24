<?php

if( !class_exists('Functions') ) :

class Functions {

    public $include;
    private static $instance = null;

    public function __construct()
    {
        $this->include = get_template_directory() . '/' . 'inc/';
        $this->includes();
    }

    private function includes()
    {
        require_once $this->include . "customize.php";
        require_once $this->include . "enqueues.php";
        require_once $this->include . "theme.php";
        require_once $this->include . "user.php";
        require_once $this->include . "security.php";
    }

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}

$Functions = new Functions();

endif;