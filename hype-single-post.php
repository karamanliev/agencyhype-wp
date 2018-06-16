<?php
/*
 * Template Name: Agency Hype Post
 * Template Post Type: post
 */

get_header();

$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>

<div id="main-content">
	<?php
		if ( et_builder_is_product_tour_enabled() ):
			// load fullwidth page in Product Tour mode
			while ( have_posts() ): the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
					<?php
						the_content();
					?>
					</div> <!-- .entry-content -->

				</article> <!-- .et_pb_post -->

		<?php endwhile;
		else:
	?>
	<div class="blog-jumbotron-wrap jumbotron-wrapper">
		<section class="jumbotron blog-article-jumbotron" style="background-image: url('<?php echo $thumb['0'];?>')">
			<div class="colorOverlay">
				<div class="container">
					<div class="col-lg-8 col-md-10 col-sm-10 col-centered">
						<h1 class="jumbotron-heading"><?php single_post_title(); ?></h1>
					</div>
				</div>
			</div>
		</section>
	</div><!-- header end -->
	<div class="container">
		<div id="content-area" class="clearfix row pull-center frame">
			<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php if (et_get_option('divi_integration_single_top') <> '' && et_get_option('divi_integrate_singletop_enable') == 'on') echo(et_get_option('divi_integration_single_top')); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
						<div class="post-content">
							<div class="text-center">
								<div class="author-info up">
								<img src="<?php echo get_avatar_url( get_the_author_meta ( 'ID' )); ?>" alt="<?php the_author_meta( 'display_name' ); ?>" title="<?php the_author_meta( 'display_name' ); ?>" class="profile-pic"> <span class=
									"author-name bolded-text"><?php the_author_meta( 'display_name' ); ?></span> <span class="reads-count"><?php echo get_post_meta($post->ID, 'read-time', true); ?></span>
								</div>
							</div>
						<?php
							do_action( 'et_before_content' );

							the_content();

							wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
						?>
						</div> <!-- .post-content -->
						<div class="author-info">
							<h6 class="section-title text-left">about the author</h6>
							<div class="row">
								<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"><img alt="<?php the_author_meta( 'display_name' ); ?>" class="profile-pic pull-left" src="<?php echo get_avatar_url( get_the_author_meta ( 'ID' )); ?>"
								title="<?php the_author_meta( 'display_name' ); ?>"></div>
								<div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
									<p class="profile-info"><span class="author-name bolded-text pull-left"><?php the_author_meta( 'display_name' ); ?></span> <span class="author-descr pull-right"><?php the_author_meta( 'description' ); ?></span></p>
								</div>
							</div>
						</div><!-- author info end -->
						<div class="et_post_meta_wrapper">
						<?php
						if ( et_get_option('divi_468_enable') == 'on' ){
							echo '<div class="et-single-post-ad">';
							if ( et_get_option('divi_468_adsense') <> '' ) echo( et_get_option('divi_468_adsense') );
							else { ?>
								<a href="<?php echo esc_url(et_get_option('divi_468_url')); ?>"><img src="<?php echo esc_attr(et_get_option('divi_468_image')); ?>" alt="468" class="foursixeight" /></a>
					<?php 	}
							echo '</div> <!-- .et-single-post-ad -->';
						}
					?>

						<?php if (et_get_option('divi_integration_single_bottom') <> '' && et_get_option('divi_integrate_singlebottom_enable') == 'on') echo(et_get_option('divi_integration_single_bottom')); ?>

						<?php
							if ( ( comments_open() || get_comments_number() ) && 'on' == et_get_option( 'divi_show_postcomments', 'on' ) ) {
								comments_template( '', true );
							}
						?>
						</div> <!-- .et_post_meta_wrapper -->
					</article> <!-- .et_pb_post -->

				<?php endwhile; ?>
			</div> <!-- post content column end -->
			
			<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 post-sidebar affix-bottom">
				<div class="row sidebar-content">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-12 post-categories">
						<h6 class="section-title text-left">article categories</h6>
						<ul class="nav-list">
							<?php
								$category = get_the_category($post->ID);
								foreach ($category as $catVal) :
								$category_link = get_category_link($catVal->cat_ID);
							?>
							<li>
								<a href="<?php echo esc_url( $category_link ); ?>"><?php echo $catVal->name; ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
					</div><!-- post categories column end -->
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-12 latest-posts">
						<h6 class="section-title text-left">Latest blog posts</h6>
						<ul class="nav-list">
							<!-- Define our WP Query Parameters -->
							<?php 
							$currentID = get_the_ID();
							$args = array(
								'post_type' => 'post' ,
								'order' => 'DESC' ,
								'posts_per_page' => 3,
								'cat'  => -13,
								'post__not_in' => array($currentID),
							); ?>
							<?php $the_query = new WP_Query( $args ); ?>
							
							<!-- Start our WP Query -->
							<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
							
							<!-- Display the Post Title with Hyperlink -->
							<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
							
							<!-- Repeat the process and reset once it hits the limit -->
							<?php 
							endwhile;
							wp_reset_postdata();
							?>
						</ul>
					</div><!-- latest-posts column end -->
				</div> <!-- sidebar content end -->
			</div> <!-- sidebar column end -->
		</div> <!-- #content-area -->
	</div> <!-- .container -->
	<?php endif; ?>

	<section class="cta-free-copy-bg new-banner">
		<div class="container">
		<div class="badge-wrapper">
			<span class="badge">FREE E-BOOK</span>
		</div>
		<h3 class="free-copy-title">Essential Guide to Website Redesign for Marketers</h3>
		<div class="text-left">
			<a class="btn btn-info text-center text-uppercase" href="https://www.agencyhype.com/b2b-website-design-audit" target="_blank">get your free copy <span class=
			"svg-icon down-arrow"><img alt="" src="../img/icons/arrow-down.png"></span></a>
		</div><img alt="" class="phones" src="../img/green-banner-phone.png"></div>
	</section><!-- cta end -->

	<section class="resources-wrapper latest-blog-posts">
		<div class="container">
			<h6 class="section-title text-center">more articles from our blog</h6>
			<div class="row clear-margins" id="resources">
				<!-- Define our WP Query Parameters -->
				<?php 
					$currentID = get_the_ID();
					$args = array(
						'post_type' => 'post' ,
						'orderby' => 'date' ,
						'order' => 'DESC' ,
						'posts_per_page' => 3 ,
						'cat'  => -13 ,
						'post__not_in' => array($currentID),
					); ?>
					<?php $the_query = new WP_Query( $args ); ?>

					<!-- Start our WP Query -->
					<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

					<!-- Display the Post Title with Hyperlink -->
						<div class="col-lg-4 col-sm-6 col-xs-12">
							<a href="<?php esc_url( the_permalink() ); ?>" class="resource-article blue-tag-type">
								<?php echo '<img src="'.get_the_post_thumbnail_url().'" alt="'.get_the_title().'" class="resource-img" />'; ?>
								<div class="resource-content-wrap">
									<ul class="badges text-uppercase">
										<?php
										$category = get_the_category($post->ID);
										foreach ($category as $catVal) {
											echo '<li class="resource-badge">'.$catVal->name.'</li>'; 
										}
										?>
									</ul>
									<div class="col-xs-12 resource-content">
										<h5 class="resource-title">
											<?php the_title(); ?>
										</h5>
										<p class="resourse-text visible-lg visible-md"><?php echo  get_the_excerpt(); ?></p>
										<div class="author-info">
											<img src="<?php echo get_avatar_url( get_the_author_meta ( 'ID' )); ?>" alt="<?php the_author_meta( 'display_name' ); ?>" class="profile-pic pull-left" />
											<span class="author-name bolded-text pull-left"><?php the_author_meta( 'display_name' ); ?></span>
											<span class="reads-count pull-right"><?php echo get_post_meta($post->ID, 'read-time', true); ?></span>
										</div>
									</div>
								</div>
								<div class="call-to-view"> Read more <span class="svg-icon arrow-right-white"><img src="<?php echo get_home_url(); ?>/img/icons/arrow-right.png" alt="read more"></span></div>
							</a>
						</div>

					<!-- Repeat the process and reset once it hits the limit -->
					<?php 
					endwhile;
					wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
	
</div> <!-- #main-content -->

<?php

get_footer();
