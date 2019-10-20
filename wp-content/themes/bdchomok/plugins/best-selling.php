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

class BDchomok_Best_Selling_Woo extends Widget_Base {

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
        return 'Best Selling';
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
        return __( 'Best Selling', 'bdchomok' );
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
        return 'fa fa-filter';
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

            'Best_Selling_Woo_section',
            [
                'label' => __( 'Setting', 'bdchomok' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $product_category_value = $this->prepare_cats_for_select();

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'bdchomok' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Title', 'bdchomok' )
            ]
        );

        $this->add_control(
            'limit',
            [
                'label' => __( 'Limit', 'bdchomok' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 25,
                'step' => 1,
                'default' => 8,
            ]
        );

        $this->add_control(
            'product_category_id',
            [
                'label' => __( 'Select Product Category', 'bdchomok' ),
                'type' => Controls_Manager::SELECT2,
                'dynamic' => [
                    'active' => true,
                ],
                'options' => $product_category_value,
                'multiple' => true
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

        $get_category_list = is_array( $settings['product_category_id'] ) ? implode( ',', $settings['product_category_id'] ) : $settings['product_category_id'];

        ?>
        <div class="product-category-filter">

            <div class="category-filter-wrap mb-3 col-12 cat-tab">
                <div class="d-block text-center">
                    <a style="color: #000;" class="text-uppercase position-relative"><span><?php echo esc_html( $settings['title'] ); ?></span><i class="icofont-read-book"></i></a>
                    <span class="seperater"></span>
                </div>
            </div>

            <div class="category-filter-wrap cat-filter" data_limit="<?php echo $settings['limit'];?>">
                <?php echo do_shortcode('[best_selling_products limit="'.$settings['limit'].'" class="category-filter" columns="5" best_selling="true" category="'. $get_category_list .'" ]' ); ?>
            </div>

        </div>
        <?php
    }

    /**
     * Prepare posts to be used in the SELECT2 field
     */

    private function prepare_cats_for_select() {
        $categories = get_categories( array( 'taxonomy' => 'product_cat' ) );
        $options = ['' => ''];
        foreach ( $categories as $cat ) {
            $options[$cat->term_id] = $cat->name;
        }
        return $options;
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new BDchomok_Best_Selling_Woo() );