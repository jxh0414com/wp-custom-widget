<?php

class Sidebar_Widget extends WP_Widget
{

	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'sidebar-widget', // Base ID
			esc_html__('JxH Sidebar Tabs', 'sidebar'), // Name
			array('description' => esc_html__('Customized Sidebar with most commented post, recent post, and recent comments', 'sidebar'),) // Args
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

		// Widget Content Output 
?>
		<ul data-role="tabs" data-expand="true">
			<li><a href="#first">Most Commented</a></li>
			<li><a href="#second">Latest Posts</a></li>
			<li><a href="#third">Recent Posts</a></li>
		</ul>

		<div class="border bd-default no-border-top p-2">
			<div id="first" class="tab-pane">
                <ul data-role="listview" data-view="content">
				<?php
				$query = new WP_Query(array(
					'posts_per_page' => $instance['numberOfItem'],
					'ignore_sticky_posts' => 1,
					'orderby' => 'comment_count'
				));
				if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                    <li>
                        <a href="<?php echo get_permalink() ?>">
                            <?php if (!!get_the_post_thumbnail_url()) {?>
                                <img class="tab-image" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo the_title(); ?>">
                            <?php } else { ?>
                                <img class="tab-image" src="<?php echo plugins_url() . '/custom-widgets/assets/images/no-img.jpg '?>">
                            <?php } ?>

                            <div class="tab-text">
                                <div><?php echo the_title() ?></div>
                                <div><?php echo the_date(); ?></div>
                            </div>
                        </a>
                    </li>
                <?php endwhile; endif; wp_reset_postdata(); ?>
                <ul>
			</div>


			<div id="second" class="tab-pane">
                <ul data-role="listview" data-view="content">
				<?php if (get_posts()) : foreach (get_posts(array('numberposts' => $instance['numberOfItem'])) as $post) : ?>
                    <li>
                        <a href="<?php echo get_permalink() ?>">
                            <?php if (!!get_the_post_thumbnail_url($post)) {?>
                                <img class="tab-image" src="<?php echo get_the_post_thumbnail_url($post); ?>" alt="<?php echo $post->post_title ?>">
                            <?php } else { ?>
                                <img class="tab-image" src="<?php echo plugins_url() . '/custom-widgets/assets/images/no-img.jpg '?>">
                            <?php } ?>

                            <div class="tab-text">
                                <div><?php echo $post->post_title; ?></div>
                                <div><?php echo get_the_date(); ?></div>
                            </div>
                        </a>
                    </li>
                    <?php endforeach; endif; ?>
                <ul>
			</div>


			<div id="third" class="tab-pane">
                <ul data-role="listview" data-view="content">
				<?php if (get_comments()) : foreach (get_comments(array('number'  => $instance['numberOfItem'])) as $comment) : ?>
                    <li>
                        <a href="<?php echo get_permalink($comment->comment_post_ID); ?>">
                                <?php $user = get_userdata($comment->user_id); ?>

                                <?php if (!!get_avatar_url($comment->user_id)) {?>
                                    <img class="tab-image" src="<?php echo get_avatar_url($comment->user_id); ?>">
                                <?php } else { ?>
                                    <img class="tab-image" src="<?php echo plugins_url() . '/custom-widgets/assets/images/no-img.jpg '?>">
                                <?php } ?>

                                <div class="tab-text">
                                    <?php if ($user->first_name && $user->last_name) : ?>
                                        <div><?php echo $user->first_name . ' ' . $user->last_name . ": " . wp_html_excerpt($comment->comment_content, 40) . '...'; ?></div>
                                    <?php else : ?>
                                        <div><?php echo $comment->comment_author . ": " . wp_html_excerpt($comment->comment_content, 40) . '...'; ?></div>
                                    <?php endif; ?>
                                </div>
							</a>
                        </li>
                    <?php endforeach; endif; ?>
                <ul>
			</div>
		</div>

	<?php
		echo $args['after_widget']; // Whatever you want to display after widget (</div>)
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
		$numberOfItem = !empty($instance['numberOfItem']) ? $instance['numberOfItem'] : esc_html__(5, 'sidebar');
	?>

		<!-- Title -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('numberOfItem')); ?>">
				<?php esc_attr_e('Number of Items:', 'sidebar'); ?>
			</label>

			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('numberOfItem')); ?>" name="<?php echo esc_attr($this->get_field_name('numberOfItem')); ?>" type="number" value="<?php echo esc_attr($numberOfItem); ?>">
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
		$instance['numberOfItem'] = (!empty($new_instance['numberOfItem'])) ? sanitize_text_field($new_instance['numberOfItem']) : '';

		return $instance;
	}
}
