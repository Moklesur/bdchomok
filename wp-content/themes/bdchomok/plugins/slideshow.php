<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Blog block
 *
 * @since 1.0.0
 */

class BDchomok_Slideshow extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'Slider';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return __( 'Slider', 'bring-back' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */

    public function get_icon() {
        return 'fa fa-cog';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */

    public function get_categories() {
        return [ 'bdchomok' ];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */


    protected function _register_controls() {

        $this->start_controls_section(
            'slider_section',
            [
                'label' => __( 'Setting', 'bring-back' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'slider', [
                'label' => __( 'Slider Image', 'bring-back' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label_block' => true
            ]
        );
        $repeater->add_control(
            'slider_url', [
                'label' => __( 'URL', 'bring-back' ),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true
            ]
        );
        $this->add_control(
            'list',
            [
                'label' => __( 'List', 'bring-back' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls()
            ]
        );
        $this->end_controls_section();
    }

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function render() {
        $settings = $this->get_settings_for_display();
        $list = $settings['list'];
        $target = $settings['slider_url']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['slider_url']['nofollow'] ? ' rel="nofollow"' : '';
        ?>
        <div class="bdchomok-slider-wrap">
            <?php

            if ( $list ) {
                echo '<div class="bdchomok-slider-js">';
                foreach (  $settings['list'] as $item ) {

                    echo '<div class="slideshow-item-' . $item['_id'] . '"><a href="'. $item['slider_url']['url']  . '" '.$target.$nofollow.'>' . wp_get_attachment_image( $item['slider']['id'], 'full' ) . '</a></div>';

                }
                echo '</div>';
            }
            ?>
        </div>
        <?php
    }


}

Plugin::instance()->widgets_manager->register_widget_type( new BDchomok_Slideshow() );