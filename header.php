<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

    
    <title><?php bloginfo('name'); ?></title>
    
    <!-- Favicon -->
    <?php if (function_exists('has_site_icon') && has_site_icon()) : ?>
        <link rel="shortcut icon" href="<?php echo esc_url(site_icon_url()); ?>" type="image/x-icon">
    <?php endif; ?>
    
     <!-- Charset and Viewport -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Includes Wordpress -->
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>