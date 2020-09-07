<?php

function init_func(){
	add_theme_support('title-tag');
	add_theme_support( 'post-thumbnails' );
}
add_action('init','init_func');


if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'id' => 'sidebar-1',
        'before_widget' => '<div class="side_wrapper">',
        'after_widget' => '</div>',
        'before_title' => '<div class="side_top">',
        'after_title' => '</div>',
    ));

/*  最近の更新記事ウィジェット
---------------------------------------------*/
class widget_modify_update extends WP_Widget {
/*コンストラクタ*/
function __construct() {
	parent::__construct(
		'widget_modify_update',
		'*最近の更新記事ウィジェット*',
		array( 'description' => '最近更新した記事一覧を表示' )
	);
}

/*ウィジェット追加画面でのカスタマイズ欄の追加*/
function form($instance) {
	?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('タイトル:'); ?></label>
		<input type="text" class="side_top" id="<?php echo $this->get_field_id('title'); ?>"
		name="<?php echo $this->get_field_name('title'); ?>"
		value="<?php echo esc_attr( $instance['title'] ); ?>">
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('記事表示件数:'); ?></label>
		<input type="number" min="1" max="10" id="<?php echo $this->get_field_id('limit'); ?>"
		name="<?php echo $this->get_field_name('number'); ?>"
		value="<?php echo esc_attr( $instance['number'] ); ?>" size="3">
	</p>
	<?php
}

/*カスタマイズ欄の入力内容が変更された場合の処理*/
function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['number'] = is_numeric($new_instance['number']) ? $new_instance['number'] : 5;
	return $instance;
}

/*ウィジェットに出力される要素の設定*/
function widget($args, $instance) {
	extract($args);
	echo $before_widget;
	if(!empty($instance['title'])) {
		$title = apply_filters('widget_title', $instance['title'] );
	}
	if ($title) {
		echo $before_title . $title . $after_title;
	} else {
		echo '<h3 class="widget-title">最近の更新記事</h3>';
	}
	$number = !empty($instance['number']) ? $instance['number'] : get_option('number');
	?>
<!-- ウィジェットとして呼び出す要素 -->
<aside class="widget_modify_update">
	<ul>
		<?php
		$args = array(
			'order' => 'DESC',
			'orderby' => 'modified',
			'posts_per_page' => $number
		);
		$my_query = new WP_Query( $args );?>
		<?php
		$posts = get_posts($args);
		if($posts) : ?>
			<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
				<li class="clr">
					<a href="<?php the_permalink(); ?>">

						<!--サムネイル画像の追加-->
						<?php if (has_post_thumbnail()): // Check if Thumbnail exists?>
							<span class ="thumbnails-background" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>)"></span>
						<?php endif; ?>
						<div class="widget_modify_update-title">
							<?php the_title(); ?>
						</div>
					</a>
				</li>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
	</ul>
</aside>
<?php echo $after_widget;
}
}
register_widget('widget_modify_update');


//youtubeにタグ付け
function iframe_in_div($the_content) {
if ( is_singular() ) {
$the_content = preg_replace('/<iframe/i', '<div class="youtube"><iframe', $the_content);
$the_content = preg_replace('/<\/iframe>/i', '</iframe></div>', $the_content);
}
return $the_content;
}
add_filter('the_content','iframe_in_div');



// ショートコード /

//ショートコードで「hello shortcode!」と出力
add_shortcode( 'fukidashi-m-left', function( $atts, $content = null ) {
	$before = '<div class="balloon-left"><div class="balloon-img-left">';

	if( isset( $atts['img'] ) ) {
		$before .= '<figure><img src="' . $atts['img'] . '" width="60" height="60" alt="';
		$before .= '" /></figure>';
	}

	if( isset( $atts['name'] ) ) {
		$before .= '<p class="character_name">' . $atts['name'] . '</p>';
	}

	$before .= '</div><div class="balloon-left-line">';

	$after = '</div></div>';

	return $before . $content . $after;
});

add_shortcode( 'fukidashi-f-left', function( $atts, $content = null ) {
	$before = '<div class="balloon-left"><div class="balloon-img-left">';

	if( isset( $atts['img'] ) ) {
		$before .= '<figure><img src="' . $atts['img'] . '" width="60" height="60" alt="';
		$before .= '" /></figure>';
	}

	if( isset( $atts['name'] ) ) {
		$before .= '<p class="character_name">' . $atts['name'] . '</p>';
	}

	$before .= '</div><div class="balloon-left-line female-left">';

	$after = '</div></div>';

	return $before . $content . $after;
});


add_shortcode( 'fukidashi-m-right', function( $atts, $content = null ) {
	$before = '<div class="balloon-right"><div class="balloon-img-right">';

	if( isset( $atts['img'] ) ) {
		$before .= '<figure><img src="' . $atts['img'] . '" width="60" height="60" alt="';
		$before .= '" /></figure>';
	}

	if( isset( $atts['name'] ) ) {
		$before .= '<p class="character_name">' . $atts['name'] . '</p>';
	}

	$before .= '</div><div class="balloon-right-line">';

	$after = '</div></div>';

	return $before . $content . $after;
});

add_shortcode( 'fukidashi-f-right', function( $atts, $content = null ) {
	$before = '<div class="balloon-right"><div class="balloon-img-right">';

	if( isset( $atts['img'] ) ) {
		$before .= '<figure><img src="' . $atts['img'] . '" width="60" height="60" alt="';
		$before .= '" /></figure>';
	}

	if( isset( $atts['name'] ) ) {
		$before .= '<p class="character_name">' . $atts['name'] . '</p>';
	}

	$before .= '</div><div class="balloon-right-line female-right">';

	$after = '</div></div>';

	return $before . $content . $after;
});

?>