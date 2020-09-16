<?php
/**
 * Custom Woocommerce Widget
 * Features a product on your sidebar
 */

namespace SKELETON_PLUGIN\WIDGETS;

defined( 'ABSPATH' ) or die( 'File cannot be accessed directly' );

use WP_Widget;

class Widget_Woocommerce extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'widget_purchase',
            __( 'Purchase Widget', SKELETON_PLUGIN_TEXT_DOMAIN ),
            array(
                'classname'   => 'purchase-widget',
                'description' => __( 'Widget to Purchase item', SKELETON_PLUGIN_TEXT_DOMAIN ),
            )
        );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args array defined in register_sidebar function.
     * @param array $instance instance of widget.
     */
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $product_id = $instance['product_id'];

        // only display if a product has been selected
        if ( '-1' !== $product_id ) : ?>

            <?php echo $args['before_widget']; ?>

                <?php echo $args['before_title'] . $title . $args['after_title']; ?>
                <div class="widget purchase-form">
                    <?php $product = wc_get_product( $product_id ); ?>
                    <a href="<?php echo get_permalink( $product_id ); ?>" class="thumbnail" title="View Product Page"><?php echo $product->get_image(); ?></a>
                    <br />
                    <strong><?php echo $product->get_name(); ?>, $<?php echo $product->get_price(); ?></strong>
                    <a href="<?php echo site_url(); ?>/cart/?add-to-cart=<?php echo $product_id; ?>" class="add-to-cart">Add to Cart</a>
                </div>

            <?php echo $args['after_widget']; ?>

        <?php
        endif;
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options.
     */
    public function form( $instance ) {
        $title = array(
            'content' => ( isset( $instance['title'] ) ) ? $instance['title'] : '',
            'id'      => $this->get_field_id( 'title' ),
            'name'    => $this->get_field_name( 'title' ),
        );

        // list of all products
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 99999,
            'order'          => 'ASC',
            'orderby'        => 'title',
        );

        $products = new \WP_Query( $args );

        $product_id = array(
            'content' => ( isset( $instance['product_id'] ) ) ? $instance['product_id'] : '',
            'id'      => $this->get_field_id( 'product_id' ),
            'name'    => $this->get_field_name( 'product_id' ),
        );
        ?>

        <p>
            This widget will feature your selected product to add to your cart.
        </p>
        <p>
            <label for="<?php echo $title['id']; ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $title['id']; ?>" name="<?php echo $title['name']; ?>" type="text" value="<?php echo esc_attr( $title['content'] ); ?>" style="margin-top: 5px;" />
        </p>
        <p>
            <label for="<?php echo $product_id['id']; ?>"><?php _e( 'Select Product:' ); ?></label>
            <select id="<?php echo $product_id['id']; ?>" name="<?php echo $product_id['name']; ?>">
                <option value="-1">[No Product Selected]</option>
                <?php foreach( $products->posts as $product ) : ?>
                    <option value="<?php echo $product->ID; ?>" <?php echo ( ! empty( $instance['product_id'] ) ) ? selected( $instance['product_id'], $product->ID ) : ''; ?>><?php echo $product->post_title; ?></option>
                <?php endforeach; ?>
            </select>
        </p>

        <?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options.
     * @param array $old_instance The previous options.
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
        return array(
            'title'      => ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '',
            'product_id' => ( ! empty( $new_instance['product_id'] ) ) ? wp_strip_all_tags( $new_instance['product_id'] ) : '',
        );
    }
}
