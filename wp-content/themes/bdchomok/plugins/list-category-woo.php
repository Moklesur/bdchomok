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

class BDchomok_List_Category_Woo extends Widget_Base {

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
        return 'List Category';
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
        return __( 'List Category', 'bdchomok' );
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

            'List_Category_Woo_section',
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

        $prod_cat_args = array(
            'taxonomy'     => 'product_cat',
            'orderby'      => 'name',
            'include' => $get_category_list,
            'empty'        => 0
        );

        $woo_categories = get_categories( $prod_cat_args );
        $taxonomy_name = 'product_cat';
        ?>
        <div class="widget-area">
            <section class="widget pr-3">
                <h3 class="category-parent widget-title">
                    <?php echo esc_html( $settings['title'] ); ?>
                </h3>
                <div class="cat-list-items">
                    <?php
                    foreach ( $woo_categories as $woo_cat ) {

                        $term_id = $woo_cat->term_id;
                        $term_children = get_term_children($term_id, $taxonomy_name);

                        foreach ($term_children as $child) {
                            $term = get_term_by('id', $child, $taxonomy_name);
                            ?>
                            <a class="d-block pt-1 pb-1 pr-0" href="<?php echo esc_url( get_term_link( $child, $taxonomy_name ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
                            <?php
                        }

                    }
                    ?>
                </div>
            </section>
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
Plugin::instance()->widgets_manager->register_widget_type( new BDchomok_List_Category_Woo() );