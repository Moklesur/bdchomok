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

class BDchomok_Recent_Products_Woo extends Widget_Base {

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
        return 'Recent Products';
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
        return __( 'Recent Products', 'bdchomok' );
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
        return 'fa fa-file-text';
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
            'recent_products_woo_section',
            [
                'label' => __( 'Setting', 'bdchomok' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'bdchomok' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Title', 'bdchomok' )
            ]
        );

        $this->add_control(
            'hr2',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_control(
            'limit',
            [
                'label' => __( 'Product Limit', 'bdchomok' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 25,
                'step' => 1,
                'default' => 8,
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Icon BG Color', 'bdchomok' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .category-filter-wrap a .icofont-read-book' => 'background-color: {{VALUE}}',
                ],
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

        ?>
        <div class="product-category-filter">

            <div class="category-filter-wrap mb-3 col-12 cat-tab">
                <div class="d-block text-center">
                    <a class="text-uppercase position-relative" style="color: #000;">
                        <span><?php echo $settings['title']; ?></span>
                        <i class="icofont-read-book"></i>
                    </a>
                    <span class="seperater"></span>
                </div>
            </div>

            <div class="category-filter-wrap cat-filter" data_limit="<?php echo $settings['limit'];?>">
                <?php
                echo do_shortcode( '[recent_products limit="'.$settings['limit'].'" class="category-filter" columns="4"]' );  ?>
            </div>
        </div>
        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new BDchomok_Recent_Products_Woo() );