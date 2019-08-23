<?php
/**
 * Displays Services
 *
 */

class BDchomok_Widget_Social_links extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'bdchomok-widget-social-links',
            'description' => __( 'Displays Services', 'bdchomok' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'bdchomok-widget-social-links', __( 'BDChomok: Social Links', 'bdchomok' ), $widget_ops );
        $this->alt_option_name = 'BDchomok_Widget_Social_links';
    }
    public function widget( $args, $instance )
    {
        if ( !isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
        for ( $i=1; $i < 6; $i++ ) {
            ${'content' . $i} 	= isset( $instance['content' . $i] ) ? wp_kses_post( $instance['content' . $i] ) : '';
            ${'icon' . $i} 		= isset( $instance['icon' . $i] ) ? esc_html( $instance['icon' . $i] ) : '';
        }


        echo $args['before_widget']; ?>
        <ul class="list-inline social-links">
            <?php for ( $i=1; $i < 6; $i++ ) { ?>
                <li class="list-inline-item">
                    <a class="<?php echo ${'icon' . $i}; ?>" href="<?php echo ${'content' . $i}; ?>"><i class="icofont-<?php echo ${'icon' . $i}; ?>"></i></a>
                </li>
            <?php } ?>
        </ul>
        <?php echo $args['after_widget'];
    }
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        for ( $i=1; $i < 6; $i++ ) {
            $instance['content' . $i] 	= wp_kses_post( $new_instance['content' . $i] );
            $instance['icon' . $i] 		= sanitize_text_field( $new_instance['icon' . $i] );
        }
        return $instance;
    }
    public function form( $instance ) { ?>
        <div class="bdchomok-wrap">
            <div class="full-width">
                <?php
                for ( $i=1; $i < 6; $i++ ) {
                    ${'content' . $i} = isset($instance['content' . $i]) ? wp_kses_post($instance['content' . $i]) : '';
                    ${'icon' . $i} = isset($instance['icon' . $i]) ? esc_html($instance['icon' . $i]) : '';
                    ?>
                    <div class="col-12">
                        <h3 class="heading-services"><?php echo sprintf( __('Links %s', 'bdchomok'), $i ); ?></h3>
                    </div>
                    <div class="col-3">
                        <label for="<?php echo $this->get_field_id( 'content' . $i ); ?>"><?php _e( 'URL', 'bdchomok' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id( 'content' . $i ); ?>" name="<?php echo $this->get_field_name( 'content' . $i ); ?>" type="text" value="<?php echo ${'content' . $i}; ?>" />
                    </div>
                    <div class="col-3">
                        <label for="<?php echo $this->get_field_id( 'icon' . $i ); ?>"><?php _e( 'icon', 'bdchomok' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id( 'icon' . $i ); ?>" name="<?php echo $this->get_field_name( 'icon' . $i ); ?>" type="text" value="<?php echo ${'icon' . $i}; ?>" />
                        <small>
                            <?php esc_html_e( 'For the icon Please', 'bdchomok'); ?>
                            <a href="<?php echo esc_url( 'https://icofont.com/icons' ); ?>" target="_blank">
                                <?php esc_html_e( ' Click Here', 'bdchomok' );?>
                            </a>
                        </small>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }
}