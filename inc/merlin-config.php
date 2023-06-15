<?php
// phpcs:ignoreFile
/**
 * Merlin WP configuration file.
 *
 * @package   Merlin WP
 * @version   @@pkg.version
 * @link      https://merlinwp.com/
 * @author    Rich Tabor, from ThemeBeans.com & the team at ProteusThemes.com
 * @copyright Copyright (c) 2018, Merlin WP of Inventionn LLC
 * @license   Licensed GPLv3 for Open Source Use
 */

if ( ! class_exists( 'Merlin' ) ) {
    return;
}

/**
 * Set directory locations, text strings, and settings.
 */
$wizard = new Merlin(

    $config = array(
        'directory'            => 'merlin', // Location / directory where Merlin WP is placed in your theme.
        'merlin_url'           => 'ulearn_demo_installer', // The wp-admin page slug where Merlin WP loads.
        'parent_slug'          => 'ulearn_demo_installer', // The wp-admin parent page slug for the admin menu item.
        'capability'           => 'manage_options', // The capability required for this menu to be displayed to the user.
        'child_action_btn_url' => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/', // URL for the 'child-action-link'.
        'dev_mode'             => true, // Enable development mode for testing.
        'license_step'         => false, // EDD license activation step.
        'license_required'     => false, // Require the license activation step.
        'license_help_url'     => '', // URL for the 'license-tooltip'.
        'edd_remote_api_url'   => '', // EDD_Theme_Updater_Admin remote_api_url.
        'edd_item_name'        => '', // EDD_Theme_Updater_Admin item_name.
        'edd_theme_slug'       => '', // EDD_Theme_Updater_Admin item_slug.
        'ready_big_button_url' => '/', // Link for the big button on the ready step.
    ),
    $strings = array(
        'admin-menu'               => esc_html__( 'uLearn Setup', 'ulearn' ),

        /* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
        'title%s%s%s%s'            => esc_html__( '%1$s%2$s Themes &lsaquo; ulearn Setup: %3$s%4$s', 'ulearn' ),
        'return-to-dashboard'      => esc_html__( 'Return to the dashboard', 'ulearn' ),
        'ignore'                   => esc_html__( 'Disable this wizard', 'ulearn' ),

        'btn-skip'                 => esc_html__( 'Skip', 'ulearn' ),
        'btn-next'                 => esc_html__( 'Next', 'ulearn' ),
        'btn-start'                => esc_html__( 'Start', 'ulearn' ),
        'btn-no'                   => esc_html__( 'Cancel', 'ulearn' ),
        'btn-plugins-install'      => esc_html__( 'Install', 'ulearn' ),
        'btn-child-install'        => esc_html__( 'Install', 'ulearn' ),
        'btn-content-install'      => esc_html__( 'Install', 'ulearn' ),
        'btn-import'               => esc_html__( 'Import', 'ulearn' ),
        'btn-license-activate'     => esc_html__( 'Activate', 'ulearn' ),
        'btn-license-skip'         => esc_html__( 'Later', 'ulearn' ),

        /* translators: Theme Name */
        'license-header%s'         => esc_html__( 'Activate %s', 'ulearn' ),
        /* translators: Theme Name */
        'license-header-success%s' => esc_html__( '%s is Activated', 'ulearn' ),
        /* translators: Theme Name */
        'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'ulearn' ),
        'license-label'            => esc_html__( 'License key', 'ulearn' ),
        'license-success%s'        => esc_html__( 'uLearn is already registered, so you can go to the next step!', 'ulearn' ),
        'license-json-success%s'   => esc_html__( 'uLearn is activated! Remote updates and theme support are enabled.', 'ulearn' ),
        'license-tooltip'          => esc_html__( 'Need help?', 'ulearn' ),

        /* translators: Theme Name */
        'welcome-header%s'         => esc_html__( 'Welcome to %s', 'ulearn' ),
        'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'ulearn' ),
        'welcome%s'                => esc_html__( 'This wizard will set up your Masterstudy LMS theme, install plugins, and import demo content. It is optional & should take only a few minutes.', 'ulearn' ),
        'welcome-success%s'        => esc_html__( 'You may have already run this starter Theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'ulearn' ),

        'child-header'             => esc_html__( 'Install Child Theme', 'ulearn' ),
        'child-header-success'     => esc_html__( 'You\'re good to go!', 'ulearn' ),
        'child'                    => esc_html__( 'Let\'s build and activate a Child Theme so you may easily make changes to the theme.', 'ulearn' ),
        'child-success%s'          => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'ulearn' ),
        'child-action-link'        => esc_html__( 'Learn about Child Themes', 'ulearn' ),
        'child-json-success%s'     => esc_html__( 'Awesome. uLearn theme has already been installed and is now activated.', 'ulearn' ),
        'child-json-already%s'     => esc_html__( 'Awesome. uLearn theme has been created and is now activated.', 'ulearn' ),

        'plugins-header'           => esc_html__( 'Install Plugins', 'ulearn' ),
        'plugins-header-success'   => esc_html__( 'You\'re up to speed!', 'ulearn' ),
        'plugins'                  => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'ulearn' ),
        'plugins-success%s'        => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'ulearn' ),
        'plugins-action-link'      => esc_html__( 'Advanced', 'ulearn' ),

        'import-header'            => esc_html__( 'Import Demo Content', 'ulearn' ),
        'import'                   => esc_html__( 'Let\'s import demo content to your website, to help you get familiar with the theme.', 'ulearn' ),
        'import-action-link'       => esc_html__( 'Advanced', 'ulearn' ),

        'ready-header'             => esc_html__( 'All done. Have fun!', 'ulearn' ),

        /* translators: Theme Author */
        'ready%s'                  => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'ulearn' ),
        'ready-action-link'        => esc_html__( 'Extras', 'ulearn' ),
        'ready-big-button'         => esc_html__( 'View your website', 'ulearn' ),
        'lms-big-button'           => esc_html__( 'Setup MasterStudy Plugin', 'ulearn' ),
    )
);


/**
 * Demo import
 */

if ( ! function_exists( 'ulearn_demo_import_files' ) ) {
    function ulearn_demo_import_files() {

            $demo  = array(
            array(
                'import_file_name' => esc_html__( 'Demo Content', 'ulearn' ),
                'import_file_url' => 'https://ulearn.uz/demo/demo.xml',
                'import_widget_file_url' => 'https://ulearn.uz/demo/demo.wie',
                'import_customizer_file_url' => 'https://ulearn.uz/demo/demo.dat',
                'preview_url' => '#',
            ),
        );
            return $demo;
    }
}
add_filter( 'merlin_import_files', 'ulearn_demo_import_files' );
add_filter( 'pt-ocdi/import_files', 'ulearn_demo_import_files' );

/**
 * Disable regenerate thumbnails
 */
add_filter( 'ulearn_merlin_regenerate_thumbnails_in_content_import', '__return_false' );
add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
