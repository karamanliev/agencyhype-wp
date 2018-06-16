<?php get_header(); ?>

<div id="main-content">
	<section class="jumbotron-wrapper">
		<div class="jumbotron dont-scale-bg blog-jumbotron">
			<div class="container">
				<div class="col-lg-8 col-md-10 col-sm-10 col-centered">
					<h1 class="jumbotron-heading">Our Insights</h1>
					<p class="text-center heading-descr">Best practices in Web Design, User Experience, Content Marketing and Branding</p>
				</div>
			</div>
		</div>
	</section>
	<div class="container resources-wrapper blog-section">
		<div id="content-area row" class="clearfix">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 blog-content">
				<div id="postHolder">
					<?php query_posts($query_string . '&cat=-13'); ?>
					<?php
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();
								$post_format = et_pb_post_format(); ?>
								
								<?php	if ( $postCount == 0 ) { ?>	
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post clearfix blog-post big' . $no_thumb_class . $overlay_class  ); ?>>
								<?php } else { ?>
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post clearfix blog-post small' . $no_thumb_class . $overlay_class  ); ?>>
								<?php }?>	

							<?php
								$thumb = '';

								$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

								$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
								$classtext = 'et_pb_post_main_image';
								$titletext = get_the_title();
								$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
								$thumb = $thumbnail["thumb"];

								et_divi_post_format_content();

								if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) {
									if ( 'video' === $post_format && false !== ( $first_video = et_get_first_video() ) ) :
										printf(
											'<div class="et_main_video_container">
												%1$s
											</div>',
											$first_video
										);
									elseif ( ! in_array( $post_format, array( 'gallery' ) ) && 'on' === et_get_option( 'divi_thumbnails_index', 'on' ) && '' !== $thumb ) : ?>
										<?php	if ( $postCount == 0 ) { ?>
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
													<div class="resource-content">
														<h5 class="resource-title">
															<?php the_title(); ?>
														</h5>
														<p class="resourse-text paragraph-small"><?php echo  get_the_excerpt(); ?></p>
														<div class="author-info">
															<img src="<?php echo get_avatar_url( get_the_author_meta ( 'ID' )); ?>" alt="<?php the_author_meta( 'display_name' ); ?>" class="profile-pic pull-left" />
															<span class="author-name bolded-text pull-left"><?php the_author_meta( 'display_name' ); ?></span>
															<span class="reads-count pull-right"><?php echo get_post_meta($post->ID, 'read-time', true); ?></span>
														</div>
													</div>
												</div>
												<div class="call-to-view"> View Blog Post <span class="svg-icon arrow-right-white"><img src="<?php echo get_home_url(); ?>/img/icons/arrow-right.png" alt="read more"></span></div>
											</a>

										<?php } else { ?>
											<a href="<?php esc_url( the_permalink() ); ?>" class="resource-article blue-tag-type">
												<ul class="badges text-uppercase">
													<?php
													$category = get_the_category($post->ID);
													foreach ($category as $catVal) {
														echo '<li class="resource-badge">'.$catVal->name.'</li>'; 
													}
													?>
												</ul>
												<div class="resource-content-wrap">
													<div class="resource-content">
														<h5 class="resource-title">
															<?php the_title(); ?>
														</h5>
														<p class="resourse-text paragraph-small"><?php echo  get_the_excerpt(); ?></p>
														<div class="author-info">
															<img src="<?php echo get_avatar_url( get_the_author_meta ( 'ID' )); ?>" alt="<?php the_author_meta( 'display_name' ); ?>" class="profile-pic pull-left" />
															<span class="author-name bolded-text pull-left"><?php the_author_meta( 'display_name' ); ?></span>
															<span class="reads-count pull-right absolute-right"><?php echo get_post_meta($post->ID, 'read-time', true); ?></span>
														</div>
													</div>
												</div>
												<div class="call-to-view"> View Blog Post <span class="svg-icon arrow-right-white"><img src="<?php echo get_home_url(); ?>/img/icons/arrow-right.png" alt="read more"></span></div>
											</a>
										<?php } 
										$postCount++; ?>
										
								<?php
									elseif ( 'gallery' === $post_format ) :
										et_pb_gallery_images();
									endif;
								} ?>

							<?php if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) : ?>
							
							<?php endif; ?>

								</article> <!-- .et_pb_post -->
						<?php
								endwhile;

								if ( function_exists( 'wp_pagenavi' ) )
									wp_pagenavi();
								else
									get_template_part( 'includes/navigation', 'index' );
							else :
								get_template_part( 'includes/no-results', 'index' );
							endif;
						?>
				</div>
			</div> <!-- #left-area -->
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 blog-sidebar affix-top">
			<?php get_sidebar(); ?>
		</div>
		</div> <!-- #content-area -->
		<div class="row">
			<div class="col-xs-12 visible-xs sidebar no-margin-bottom">
				<div class="col-xs-12">
					<h6 class="section-title text-left">newsletter</h6>
					<div class="step-register">
						<div class="subscription-message-wrap">
							<p class="paragraph-small step-get-registered-mobile">Get curated useful industry insights from our team right in your inbox:</p>
							<div class="step-confirm-registration-mobile">
								<p class="paragraph-small"><span class="svg-icon register-success"><img alt="" src="img/icons/register-success.png"></span> Thanks, check your inbox to confirm your
								subscription.</p>
							</div>
						</div>
						<form data-parsley-validate="" id="email-subscription-mobile" method="post" name="email-subscription-mobile" novalidate="">
							<div class="form-group">
								<input class="custom-email-control input-animation-trigger" data-parsley-trigger="change" data-parsley-type="email" id="email-responsive" name="email" required="true" type=
								"email"> <label class="footer-label" for="email-responsive">Your e-mail</label>
							</div><button class="col-xs-12 btn blue-button" form="email-subscription-mobile" type="submit">subscribe</button>
						</form>
					</div>
				</div>
			</div>
		</div> <!-- CTA -->
	</div> <!-- .container -->
	<section class="cta-free-copy-bg no-margin-bottom new-banner">
		<div class="container">
		<div class="badge-wrapper">
			<span class="badge">FREE E-BOOK</span>
		</div>
		<h3 class="free-copy-title">Essential Guide to Website Redesign for Marketers</h3>
		<div class="text-left">
			<a class="btn btn-info text-center text-uppercase" href="https://www.agencyhype.com/b2b-website-design-audit" target="_blank">get your free copy <span class=
			"svg-icon down-arrow"><img alt="" src="//develop.karamanliev.com/agencyhype/img/icons/arrow-down.png"></span></a>
		</div><img alt="" class="phones" src="//develop.karamanliev.com/agencyhype/img/green-banner-phone.png"></div>
	</section>
</div> <!-- #main-content -->

<?php

get_footer();
