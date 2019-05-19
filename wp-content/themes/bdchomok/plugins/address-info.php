<?php
/**
 * Displays Services
 *
 */

class BDchomok_Widget_Address_Info extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'bdchomok-widget-address-info',
            'description' => __( 'Displays Services', 'bdchomok' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'bdchomok-widget-address-info', __( 'BDChomok: Address Info', 'bdchomok' ), $widget_ops );
        $this->alt_option_name = 'BDchomok_Widget_Address_Info';
    }
    public function widget( $args, $instance )
    {
        if ( !isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
        for ( $i=1; $i < 4; $i++ ) {
            ${'content' . $i} 	= isset( $instance['content' . $i] ) ? wp_kses_post( $instance['content' . $i] ) : '';
            ${'icon' . $i} 		= isset( $instance['icon' . $i] ) ? esc_html( $instance['icon' . $i] ) : '';
        }

        echo $args['before_widget']; ?>
        <ul class="list-unstyled address-info">
            <li>
                <h5 class="widget-title">Stay With Us!</h5>
            </li>
            <?php for ( $i=1; $i < 4; $i++ ) { ?>

                <li class="media">
                    <p class="mr-3 align-self-center">
                        <i class="<?php echo ${'icon' . $i}; ?>"></i>
                    </p>
                    <div class="media-body">
                        <p><?php echo ${'content' . $i}; ?></p>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <?php echo $args['after_widget'];
    }
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        for ( $i=1; $i < 4; $i++ ) {
            $instance['content' . $i] 	= wp_kses_post( $new_instance['content' . $i] );
            $instance['icon' . $i] 		= sanitize_text_field( $new_instance['icon' . $i] );
        }
        return $instance;
    }
    public function form( $instance ) { ?>
        <div class="bdchomok-wrap">
            <div class="full-width">
                <?php
                for ( $i=1; $i < 4; $i++ ) {
                    ${'content' . $i} = isset($instance['content' . $i]) ? wp_kses_post($instance['content' . $i]) : '';
                    ${'icon' . $i} = isset($instance['icon' . $i]) ? esc_html($instance['icon' . $i]) : '';
                    ?>
                    <div class="col-12">
                        <h3 class="heading-services"><?php echo sprintf( __('Address Info %s', 'bdchomok'), $i ); ?></h3>
                    </div>

                    <div class="col-3">
                        <label for="<?php echo $this->get_field_id( 'content' . $i ); ?>"><?php _e( 'Content', 'bdchomok' ); ?></label>
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