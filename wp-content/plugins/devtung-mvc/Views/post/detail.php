<article class="oo-single-post">
	<header class="oo-post-header">
		<h1 class="oo-post-title"><?php echo get_the_title($post); ?></h1>
		
		<div class="oo-post-meta">
			<?php
			$categories = get_the_category($post->ID);
			if ( ! empty( $categories ) ) :
				$cat = $categories[0];
				?>
				<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="oo-post-meta-category">
					<?php echo esc_html( $cat->name ); ?>
				</a>
			<?php endif; ?>
			<span class="oo-post-meta-item">
				<i class="far fa-calendar"></i> <?php echo get_the_date( 'd/m/Y', $post ); ?>
			</span>
			<span class="oo-post-meta-item">
				<i class="far fa-clock"></i> 
				<?php
				$content_text = get_the_content( null, false, $post );
				$word_count = count( preg_split( '~[^\p{L}\p{N}\']+~u', strip_tags( $content_text ) ) );
				$read_time = ceil( $word_count / 250 );
				if ($read_time < 1) $read_time = 1;
				echo $read_time . ' phút đọc';
				?>
			</span>
		</div>
		
		<?php if ( has_post_thumbnail( $post ) ) : ?>
			<div class="oo-post-featured-image">
				<?php echo get_the_post_thumbnail( $post, 'large', array( 'alt' => esc_attr( get_the_title( $post ) ) ) ); ?>
			</div>
		<?php endif; ?>
	</header>

	<div style="margin-top: -20px !important; padding-top: 0px !important" class="entry-content oo-prose"><?php echo apply_filters( 'the_content', get_the_content( null, false, $post ) ); ?></div>
</article>

<section class="DtSection DtSection--Border">
	<h3 class="DtSection-Title">Bài viết liên quan</h3>
	<?php if ($related_posts && $related_posts->have_posts()): ?>
		<div class="grid grid--three">
			<?php 
			$count = 0;
			while ($related_posts->have_posts() && $count < 3): $related_posts->the_post(); 
				$thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
				$link  = get_permalink();
				$title = get_the_title();
				$excerpt = get_the_excerpt();
				$count++;
			?>
				<a class="ProductCard" href="<?php echo esc_url($link); ?>">
					<?php if ($thumb): ?>
						<img class="ProductCard-Image" src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($title); ?>">
					<?php endif; ?>
					<div class="ProductCard-Tilte">
						<h3 class="ProductCard-Content"><?php echo esc_html($title); ?></h3>
						<p class="ProductCard-Text"><?php echo esc_html($excerpt); ?></p>
					</div>
				</a>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<?php 
		// Lấy category của bài viết hiện tại
		$categories = get_the_category();
		if ($categories) {
			$category_link = get_category_link($categories[0]->term_id);
			?>
			<div class="view-more-wrapper" style="text-align:center; margin-top:20px;">
				<a class="button view-more-button" href="<?php echo esc_url($category_link); ?>">
					Xem tất cả
				</a>
			</div>
		<?php } ?>

	<?php endif; ?>
</section>


<section class="DtSection DtSection--Border">
	<h3 class="DtSection-Title">Tìm văn phòng tại Hà Nội</h3>
	<!-- Danh sách districts dưới dạng tag -->
	<div class="DtSectionGrid DtSectionGrid--Frour">
		<?php foreach ($tagData as $district): ?>
			<div class="DtSectionGrid-Item">
				<a class="DtDistrictLink" href="<?= htmlspecialchars($district['link']) ?>">
					Văn phòng quận <?= htmlspecialchars($district['name']) ?>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
</section>
