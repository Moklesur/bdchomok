<?phpnamespace Elementor;if ( ! defined( 'ABSPATH' ) ) {    exit; // Exit if accessed directly.}/** * Blog block * * @since 1.0.0 */class BDchomok_Author_List extends Widget_Base {    /**     * Get widget name.     *     * Retrieve oEmbed widget name.     *     * @since 1.0.0     * @access public     *     * @return string Widget name.     */    public function get_name() {        return 'Author List';    }    /**     * Get widget title.     *     * Retrieve oEmbed widget title.     *     * @since 1.0.0     * @access public     *     * @return string Widget title.     */    public function get_title() {        return __( 'Author List', 'bdchomok' );    }    /**     * Get widget icon.     *     * Retrieve oEmbed widget icon.     *     * @since 1.0.0     * @access public     *     * @return string Widget icon.     */    public function get_icon() {        return 'fa fa-file-text';    }    /**     * Get widget categories.     *     * Retrieve the list of categories the oEmbed widget belongs to.     *     * @since 1.0.0     * @access public     *     * @return array Widget categories.     */    public function get_categories() {        return [ 'bdchomok' ];    }    /**     * Register oEmbed widget controls.     *     * Adds different input fields to allow the user to change and customize the widget settings.     *     * @since 1.0.0     * @access protected     */    protected function _register_controls() {        $this->start_controls_section(            'author_list_section',            [                'label' => __( 'Setting', 'bdchomok' ),                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,            ]        );        $this->add_control(            'title',            [                'label' => __( 'Title', 'bdchomok' ),                'type' => \Elementor\Controls_Manager::TEXT,                'default' => __( 'Title', 'bdchomok' )            ]        );        $this->add_control(            'hr2',            [                'type' => \Elementor\Controls_Manager::DIVIDER,                'style' => 'thick',            ]        );        $this->add_control(            'title_color',            [                'label' => __( 'Icon BG Color', 'bdchomok' ),                'type' => \Elementor\Controls_Manager::COLOR,                'scheme' => [                    'type' => \Elementor\Scheme_Color::get_type(),                    'value' => \Elementor\Scheme_Color::COLOR_1,                ],                'selectors' => [                    '{{WRAPPER}} .category-filter-wrap a .icofont-read-book' => 'background-color: {{VALUE}}',                ],            ]        );        $this->end_controls_section();    }    /**     * Render oEmbed widget output on the frontend.     *     * Written in PHP and used to generate the final HTML.     *     * @since 1.0.0     * @access protected     */    protected function render() {        $settings = $this->get_settings_for_display();        ?>        <div class="category-filter-wrap mb-3 col-12 cat-tab">            <div class="d-block text-center">                <a class="text-uppercase position-relative">                    <span><?php echo $settings['title']; ?></span>                    <i class="icofont-read-book"></i>                </a>                <span class="seperater"></span>            </div>        </div>        <!-- ul.author-meta -->        <ul class="list-inline author-meta">            <?php            $get_author = get_users( 'role=author' );            foreach ( $get_author as $user ) {                ?>                <li class="list-inline-item text-center">                    <a href="<?php echo esc_url( get_author_posts_url( $user->id, $user->nickname ) ); ?>">                        <img class="author-pic" src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" />                        <p>                            <?php                            echo esc_html( $user->first_name .' '. $user->last_name );                            ?>                        </p>                    </a>                </li>                <?php            }            ?>        </ul>        <!-- ul.author-meta -->        <?php    }}Plugin::instance()->widgets_manager->register_widget_type( new BDchomok_Author_List() );