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

class BDchomok_Product_Filter extends Widget_Base {

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
        return 'WooCommerce Product Filter';
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
        return __( 'WooCommerce Product Filter', 'bdchomok' );
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

            'product_filter_section',
            [
                'label' => __( 'Setting', 'bdchomok' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $product_category_value = $this->prepare_cats_for_select();

        $this->add_control(
            'product_category_id',
            [
                'label' => __( 'Select Product Category', 'bdchomok' ),
                'type' => Controls_Manager::SELECT2,
                'dynamic' => [
                    'active' => true,
                ],
                'options' => $product_category_value,
                'multiple' => false
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

        $category_slider = is_array( $settings['product_category_id'] ) ? implode( ',', $settings['product_category_id'] ) : $settings['product_category_id'];
        ?>
        <div class="product-category-filter">

            <div class="category-filter-wrap mb-3 col-12 cat-tab">
                <div class="d-block text-center">

                    <?php
                    $prod_cat_args = array(
                        'taxonomy'     => 'product_cat',
                        'orderby'      => 'name',
                        'include' => $category_slider,
                        'empty'        => 0
                    );
                    $woo_categories = get_terms( $prod_cat_args );
                    foreach ( $woo_categories as $woo_cat ) {
                        $woo_cat_name = $woo_cat->name; //category name
                        echo '<a class="text-uppercase position-relative" href="'. get_term_link($woo_cat->slug, 'product_cat').'" data-filter=".product_cat"><span>'. $woo_cat_name.'</span><i class="icofont-read-book"></i></a>';
                    }
                    ?>
                    <span class="seperater"></span>
                </div>
            </div>

            <div class="category-filter-wrap cat-filter" data_limit="<?php echo $settings['limit'];?>">
                <?php
                echo do_shortcode( '[products  limit="'.$settings['limit'].'" class="category-filter" columns="4" category="' .$category_slider. '"]' );  ?>
            </div>

            <div class="cat-link text-center text-uppercase">
                <a href="<?php echo get_term_link($woo_cat->slug, 'product_cat'); ?>"><?php esc_html_e( 'সব দেখুন', 'bdchomok' ); ?></a>
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
Plugin::instance()->widgets_manager->register_widget_type( new BDchomok_Product_Filter() );