<?php

class Subscribe_Widget extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
        parent::__construct(
            'subscribe-widget', // Base ID
            esc_html__('JxH Subscribe', 'social_icons'), // Name
            array('description' => esc_html__('Connect with Social Media with Icons', 'social_icons'),) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {
        echo $args['before_widget']; // Whatever you want to display before widget (<div> etc.)
        if (!empty($instance['numberOfItem'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Widget Content Output 
    ?>
        <div class="subscribe-container">
            <?php if ($instance['twitter']) :  ?>
                <a href="<?php $instance['twitter'] ?>"><span class="mif-twitter" aria-label="Twitter"></span></a>
            <?php endif; ?>

            <?php if ($instance['facebook']) :  ?>
                <a href="<?php $instance['facebook'] ?>"><span class="mif-facebook" aria-label="Facebook"></span></a>
            <?php endif; ?>

            <?php if ($instance['youtube']) :  ?>
                <a href="<?php $instance['youtube'] ?>"><span class="mif-youtube" aria-label="YouTube"></span></a>
            <?php endif; ?>

            <?php if ($instance['linkedin']) :  ?>
                <a href="<?php $instance['linkedin'] ?>"><span class="mif-linkedin" aria-label="LinkedIn"></span></a>
            <?php endif; ?>

            <?php if ($instance['vimeo']) :  ?>
                <a href="<?php $instance['vimeo'] ?>"><span class="mif-vimeo" aria-label="Vimeo"></span></a>
            <?php endif; ?>

            <?php if ($instance['pinterest']) :  ?>
                <a href="<?php $instance['pinterest'] ?>"><span class="mif-pinterest" aria-label="Pinterest"></span></a>
            <?php endif; ?>
        </div>

    <?php echo $args['after_widget']; // Whatever you want to display after widget (</div>) 
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance)
    {
        $twitter = !empty($instance['twitter']) ? $instance['twitter'] : esc_html__('', 'social_icons');
        $facebook = !empty($instance['facebook']) ? $instance['facebook'] : esc_html__('', 'social_icons');
        $youtube = !empty($instance['youtube']) ? $instance['youtube'] : esc_html__('', 'social_icons');
        $linkedin = !empty($instance['linkedin']) ? $instance['linkedin'] : esc_html__('', 'social_icons');
        $vimeo = !empty($instance['vimeo']) ? $instance['vimeo'] : esc_html__('', 'social_icons');
        $pinterest = !empty($instance['pinterest']) ? $instance['pinterest'] : esc_html__('', 'social_icons');
    ?>

        <!-- Title -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>">
                <?php esc_attr_e('Connect Twitter:', 'social_icons'); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_attr($twitter); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>">
                <?php esc_attr_e('Connect Facebook:', 'social_icons'); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_attr($facebook); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('youtube')); ?>">
                <?php esc_attr_e('Connect Youtube:', 'social_icons'); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>" type="text" value="<?php echo esc_attr($youtube); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>">
                <?php esc_attr_e('Connect Linked-In:', 'social_icons'); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('vimeo')); ?>">
                <?php esc_attr_e('Connect Vimeo:', 'social_icons'); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('vimeo')); ?>" name="<?php echo esc_attr($this->get_field_name('vimeo')); ?>" type="text" value="<?php echo esc_attr($vimeo); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>">
                <?php esc_attr_e('Connect Pinterest:', 'social_icons'); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>">
        </p>
<?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['twitter'] = (!empty($new_instance['twitter'])) ? sanitize_text_field($new_instance['twitter']) : '';
        $instance['facebook'] = (!empty($new_instance['facebook'])) ? sanitize_text_field($new_instance['facebook']) : '';
        $instance['youtube'] = (!empty($new_instance['youtube'])) ? sanitize_text_field($new_instance['youtube']) : '';
        $instance['linkedin'] = (!empty($new_instance['linkedin'])) ? sanitize_text_field($new_instance['linkedin']) : '';
        $instance['vimeo'] = (!empty($new_instance['vimeo'])) ? sanitize_text_field($new_instance['vimeo']) : '';
        $instance['pinterest'] = (!empty($new_instance['pinterest'])) ? sanitize_text_field($new_instance['pinterest']) : '';

        return $instance;
    }
}
