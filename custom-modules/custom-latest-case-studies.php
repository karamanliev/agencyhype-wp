<?php

class Custom_ET_Builder_Module_Portfolio extends ET_Builder_Module_Type_PostBased {
	function init() {
		$this->name       = esc_html__( 'Custom HYPE Case Studies', 'et_builder' );
		$this->slug       = 'et_pb_portfolio_2';
		$this->vb_support = 'on';

		$this->main_css_element = '%%order_class%% .et_pb_portfolio_item';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Content', 'et_builder' ),
					'elements'     => esc_html__( 'Elements', 'et_builder' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'layout'  => esc_html__( 'Layout', 'et_builder' ),
					'overlay' => esc_html__( 'Overlay', 'et_builder' ),
					'image' => array(
						'title' => esc_html__( 'Image', 'et_builder' ),
					),
					'text'    => array(
						'title'    => esc_html__( 'Text', 'et_builder' ),
						'priority' => 49,
					),
				),
			),
		);

		$this->advanced_fields = array(
			'fonts'                 => array(
				'title'   => array(
					'label'    => esc_html__( 'Title', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} h2, {$this->main_css_element} h2 a, {$this->main_css_element} h1.et_pb_module_header, {$this->main_css_element} h1.et_pb_module_header a, {$this->main_css_element} h3.et_pb_module_header, {$this->main_css_element} h3.et_pb_module_header a, {$this->main_css_element} h4.et_pb_module_header, {$this->main_css_element} h4.et_pb_module_header a, {$this->main_css_element} h5.et_pb_module_header, {$this->main_css_element} h5.et_pb_module_header a, {$this->main_css_element} h6.et_pb_module_header, {$this->main_css_element} h6.et_pb_module_header a",
						'important' => 'all',
					),
					'header_level' => array(
						'default' => 'h2',
					),
				),
				'caption' => array(
					'label'    => esc_html__( 'Meta', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} .post-meta, {$this->main_css_element} .post-meta a",
					),
				),
				'pagination' => array(
					'label'    => esc_html__( 'Pagination', 'et_builder' ),
					'css'      => array(
						'main' => function_exists( 'wp_pagenavi' ) ? "%%order_class%% .wp-pagenavi a, %%order_class%% .wp-pagenavi span" : "%%order_class%% .pagination a",
						'important'  => function_exists( 'wp_pagenavi' ) ? 'all' : array(),
						'text_align' => '%%order_class%% .wp-pagenavi',
					),
					'hide_text_align' => ! function_exists( 'wp_pagenavi' ),
					'text_align' => array(
						'options' => et_builder_get_text_orientation_options( array( 'justified' ), array() ),
					),
				),
			),
			'background'            => array(
				'settings' => array(
					'color' => 'alpha',
				),
			),
			'borders'               => array(
				'default' => array(
					'css' => array(
						'main' => array(
							'border_radii'  => $this->main_css_element,
							'border_styles' => $this->main_css_element,
						),
					),
				),
				'image' => array(
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .et_portfolio_image",
							'border_styles' => "{$this->main_css_element} .et_portfolio_image",
						)
					),
					'label_prefix' => esc_html__( 'Image', 'et_builder' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'image',
				),
			),
			'box_shadow'            => array(
				'default' => array(),
				'image'   => array(
					'label'           => esc_html__( 'Image Box Shadow', 'et_builder' ),
					'option_category' => 'layout',
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'image',
					'css'             => array(
						'main'         => '%%order_class%% .project .et_portfolio_image',
						'custom_style' => true,
					),
					'default_on_fronts'  => array(
						'color'    => '',
						'position' => '',
					),
				),
			),
			'margin_padding' => array(
				'css' => array(
					'main' => '%%order_class%%',
					'important' => array( 'custom_margin' ), // needed to overwrite last module margin-bottom styling
				),
			),
			'text'                  => array(
				'use_background_layout' => true,
				'options' => array(
					'background_layout' => array(
						'default' => 'light',
					),
				),
			),
			'filters'               => array(
				'css' => array(
					'main' => '%%order_class%%',
				),
				'child_filters_target' => array(
					'tab_slug' => 'advanced',
					'toggle_slug' => 'image',
				),
			),
			'image'                 => array(
				'css' => array(
					'main' => '%%order_class%% .et_portfolio_image',
				),
			),
			'button'                => false,
		);

		$this->custom_css_fields = array(
			'portfolio_image' => array(
				'label'    => esc_html__( 'Portfolio Image', 'et_builder' ),
				'selector' => '.et_portfolio_image',
			),
			'overlay' => array(
				'label'    => esc_html__( 'Overlay', 'et_builder' ),
				'selector' => '.et_overlay',
			),
			'overlay_icon' => array(
				'label'    => esc_html__( 'Overlay Icon', 'et_builder' ),
				'selector' => '.et_overlay:before',
			),
			'portfolio_title' => array(
				'label'    => esc_html__( 'Portfolio Title', 'et_builder' ),
				'selector' => '.et_pb_portfolio_item h2',
			),
			'portfolio_post_meta' => array(
				'label'    => esc_html__( 'Portfolio Post Meta', 'et_builder' ),
				'selector' => '.et_pb_portfolio_item .post-meta',
			),
			'pagination' => array(
				'label'    => esc_html__( 'Portfolio Pagination', 'et_builder' ),
				'selector' => function_exists( 'wp_pagenavi' ) ? '%%order_class%% .wp-pagenavi a, %%order_class%% .wp-pagenavi span' : '%%order_class%% .pagination a',
			),
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( '6NpHdiLciDU' ),
				'name' => esc_html__( 'An introduction to the Portfolio module', 'et_builder' ),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'fullwidth' => array(
				'label'           => esc_html__( 'Layout', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'on'  => esc_html__( 'Fullwidth', 'et_builder' ),
					'off' => esc_html__( 'Grid', 'et_builder' ),
				),
				'default_on_front' => 'on',
				'affects' => array(
					'hover_icon',
					'zoom_icon_color',
					'hover_overlay_color',
				),
				'description'       => esc_html__( 'Choose your desired portfolio layout style.', 'et_builder' ),
				'computed_affects' => array(
					'__projects',
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'layout',
			),
			'posts_number' => array(
				'default'           => 10,
				'label'             => esc_html__( 'Posts Number', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Define the number of projects that should be displayed per page.', 'et_builder' ),
				'computed_affects' => array(
					'__projects',
				),
				'toggle_slug'       => 'main_content',
			),
			'include_categories' => array(
				'label'            => esc_html__( 'Include Categories', 'et_builder' ),
				'type'             => 'categories',
				'option_category'  => 'basic_option',
				'description'      => esc_html__( 'Select the categories that you would like to include in the feed.', 'et_builder' ),
				'toggle_slug'      => 'main_content',
				'computed_affects' => array(
					'__projects',
				),
				'taxonomy_name' => 'project_category',
			),
			'show_title' => array(
				'label'           => esc_html__( 'Show Title', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'     => 'elements',
				'description'     => esc_html__( 'Turn project titles on or off.', 'et_builder' ),
			),
			'show_categories' => array(
				'label'           => esc_html__( 'Show Categories', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'     => 'elements',
				'description'     => esc_html__( 'Turn the category links on or off.', 'et_builder' ),
			),
			'show_pagination' => array(
				'label'           => esc_html__( 'Show Pagination', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'     => 'elements',
				'description'     => esc_html__( 'Enable or disable pagination for this feed.', 'et_builder' ),
			),
			'zoom_icon_color' => array(
				'label'             => esc_html__( 'Zoom Icon Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'depends_show_if'   => 'off',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'overlay',
			),
			'hover_overlay_color' => array(
				'label'             => esc_html__( 'Hover Overlay Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'depends_show_if'   => 'off',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'overlay',
			),
			'hover_icon' => array(
				'label'               => esc_html__( 'Hover Icon Picker', 'et_builder' ),
				'type'                => 'select_icon',
				'option_category'     => 'configuration',
				'class'               => array( 'et-pb-font-icon' ),
				'depends_show_if'     => 'off',
				'tab_slug'            => 'advanced',
				'toggle_slug'         => 'overlay',
			),
			'__projects'          => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'ET_Builder_Module_Portfolio', 'get_portfolio_item' ),
				'computed_depends_on' => array(
					'posts_number',
					'include_categories',
					'fullwidth',
					'__page',
				),
			),
			'__page'          => array(
				'type'              => 'computed',
				'computed_callback' => array( 'ET_Builder_Module_Portfolio', 'get_portfolio_item' ),
				'computed_affects'  => array(
					'__projects',
				),
			),
		);

		return $fields;
	}

	/**
	 * Get portfolio objects for portfolio module
	 *
	 * @param array $args             arguments that affect et_pb_portfolio query
	 * @param array $conditional_tags conditional tag for update process
	 * @param array $current_page     current page params
	 *
	 * @return mixed portfolio item data
	 */
	static function get_portfolio_item( $args = array(), $conditional_tags = array(), $current_page = array() ) {
		global $et_fb_processing_shortcode_object;

		$global_processing_original_value = $et_fb_processing_shortcode_object;

		$defaults = array(
			'posts_number'       => 10,
			'include_categories' => '',
			'fullwidth'          => 'on',
		);

		$args          = wp_parse_args( $args, $defaults );

		// Native conditional tag only works on page load. Data update needs $conditional_tags data
		$is_front_page = et_fb_conditional_tag( 'is_front_page', $conditional_tags );
		$is_search     = et_fb_conditional_tag( 'is_search', $conditional_tags );
		$currentID = get_the_ID();
		// Prepare query arguments
		$query_args    = array(
			'posts_per_page' => (int) $args['posts_number'],
			'post_type'      => 'project',
			'post_status'    => 'publish',
			'post__not_in'   => array($currentID),
		);

		// Conditionally get paged data
		if ( defined( 'DOING_AJAX' ) && isset( $current_page[ 'paged'] ) ) {
			$et_paged = intval( $current_page[ 'paged' ] );
		} else {
			$et_paged = $is_front_page ? get_query_var( 'page' ) : get_query_var( 'paged' );
		}

		if ( $is_front_page ) {
			global $paged;
			$paged = $et_paged;
		}

		// support pagination in VB
		if ( isset( $args['__page'] ) ) {
			$et_paged = $args['__page'];
		}

		if ( ! is_search() ) {
			$query_args['paged'] = $et_paged;
		}

		// Passed categories parameter
		$include_categories = self::filter_invalid_term_ids( explode( ',', $args['include_categories'] ), 'project_category' );

		if ( ! empty( $include_categories ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'project_category',
					'field'    => 'id',
					'terms'    => $include_categories,
					'operator' => 'IN',
				)
			);
		}

		// Get portfolio query
		$query = new WP_Query( $query_args );

		// Format portfolio output, and add supplementary data
		$width     = 'on' === $args['fullwidth'] ?  1080 : 400;
		$width     = (int) apply_filters( 'et_pb_portfolio_image_width', $width );
		$height    = 'on' === $args['fullwidth'] ?  9999 : 284;
		$height    = (int) apply_filters( 'et_pb_portfolio_image_height', $height );
		$classtext = 'on' === $args['fullwidth'] ? 'et_pb_post_main_image' : '';
		$titletext = get_the_title();

		// Loop portfolio item data and add supplementary data
		if ( $query->have_posts() ) {
			$post_index = 0;
			while( $query->have_posts() ) {
				$query->the_post();

				$categories = array();

				$categories_object = get_the_terms( get_the_ID(), 'project_category' );

				if ( ! empty( $categories_object ) ) {
					foreach ( $categories_object as $category ) {
						$categories[] = array(
							'id' => $category->term_id,
							'label' => $category->name,
							'permalink' => get_term_link( $category ),
						);
					}
				}

				// need to disable processnig to make sure get_thumbnail() doesn't generate errors
				$et_fb_processing_shortcode_object = false;

				// Get thumbnail
				$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );

				$et_fb_processing_shortcode_object = $global_processing_original_value;

				// Append value to query post
				$query->posts[ $post_index ]->post_permalink 	= get_permalink();
				$query->posts[ $post_index ]->post_thumbnail 	= print_thumbnail( $thumbnail['thumb'], $thumbnail['use_timthumb'], $titletext, $width, $height, '', false, true );
				$query->posts[ $post_index ]->post_categories 	= $categories;
				$query->posts[ $post_index ]->post_class_name 	= get_post_class( '', get_the_ID() );

				$post_index++;
			}

			$query->posts_next = array(
				'label' => esc_html__( '&laquo; Older Entries', 'et_builder' ),
				'url' => next_posts( $query->max_num_pages, false ),
			);

			$query->posts_prev = array(
				'label' => esc_html__( 'Next Entries &raquo;', 'et_builder' ),
				'url' => ( $et_paged > 1 ) ? previous_posts( false ) : '',
			);

			// Added wp_pagenavi support
			$query->wp_pagenavi = function_exists( 'wp_pagenavi' ) ? wp_pagenavi( array(
				'query' => $query,
				'echo' => false
			) ) : false;
		} else if ( wp_doing_ajax() ) {
			// This is for the VB
			$query = array( 'posts' => self::get_no_results_template() );
		}

		wp_reset_postdata();

		return $query;
	}

	function render( $attrs, $content = null, $render_slug ) {
		$fullwidth          = $this->props['fullwidth'];
		$posts_number       = $this->props['posts_number'];
		$include_categories = $this->props['include_categories'];
		$show_title         = $this->props['show_title'];
		$show_categories    = $this->props['show_categories'];
		$show_pagination    = $this->props['show_pagination'];
		$background_layout  = $this->props['background_layout'];
		$zoom_icon_color     = $this->props['zoom_icon_color'];
		$hover_overlay_color = $this->props['hover_overlay_color'];
		$hover_icon          = $this->props['hover_icon'];
		$header_level        = $this->props['title_level'];

		global $paged;

		$processed_header_level = et_pb_process_header_level( $header_level, 'h2' );

		// Set inline style
		if ( '' !== $zoom_icon_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .et_overlay:before',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $zoom_icon_color )
				),
			) );
		}

		if ( '' !== $hover_overlay_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .et_overlay',
				'declaration' => sprintf(
					'background-color: %1$s;
					border-color: %1$s;',
					esc_html( $hover_overlay_color )
				),
			) );
		}

		$container_is_closed = false;

		// Get loop data
		$portfolio = self::get_portfolio_item( array(
			'posts_number'       => $posts_number,
			'include_categories' => $include_categories,
			'fullwidth'          => $fullwidth,
		) );

		// setup overlay
		if ( 'on' !== $fullwidth ) {
			$data_icon = '' !== $hover_icon
				? sprintf(
					' data-icon="%1$s"',
					esc_attr( et_pb_process_font_icon( $hover_icon ) )
				)
				: '';

			$overlay = sprintf( '<span class="et_overlay%1$s"%2$s></span>',
				( '' !== $hover_icon ? ' et_pb_inline_icon' : '' ),
				$data_icon
			);
		}

		ob_start();

		if ( $portfolio->have_posts() ) {
			while( $portfolio->have_posts() ) {
				$portfolio->the_post();

				// Get $post data of current loop
				global $post;

				array_push( $post->post_class_name, 'et_pb_portfolio_item' );

				if ( 'on' !== $fullwidth ) {
					array_push( $post->post_class_name, 'et_pb_grid_item' );
				}

				?>
				<div id="post-<?php echo esc_attr( $post->ID ); ?>" class="<?php echo esc_attr( join( $post->post_class_name, ' ' ) ); ?>">

					<?php if ( '' !== $post->post_thumbnail ) { ?>
					<!-- CUSTOM PROJECT  -->
					<a class="work-item small" href="<?php echo esc_url( $post->post_permalink ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
						<?php if ( 'on' === $fullwidth ) { ?>
							<div class="work-img-holder">
								<img src="<?php echo esc_url( $post->post_thumbnail ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="img-responsive" />
							</div>
						<?php } else { ?>
						<?php } ?>
						<div class="work-item-content">
							<h4 class="h4"><?php echo esc_attr( get_the_title() ); ?></h4>
							<p class="paragraph-small"><?php echo esc_attr( get_the_excerpt() ); ?></p>
              <div class="hidden-xs hidden-sm hidden-md">
                <div class="work-details-wrap">
                  <div class="work-detail-title">Services:</div>
                  <span class="work-details-list">
                  <?php $services = get_post_meta($post->ID, 'services', false); ?>
                    <?php foreach($services as $service) {
                      echo '<span class="work-details-list">'.$service.'</span>';
                    } ?>
                  </span>
                </div>
                <div class="work-details-wrap">
                  <div class="work-detail-title">Industry:</div>
                  <span class="work-details-list"><?php echo get_post_meta($post->ID, 'industry', true); ?></span>
                </div>
              </div>
              <span class="work-item-arrow"></span>
						</div>
						<div class="call-to-view">
						View Case Study <span class="svg-icon arrow-right-white"><img alt="view case study" src="<?php echo get_home_url(); ?>/img/icons/arrow-right.png"></span>
						</div>
					</a>
					<?php } ?>

					<?php if ( 'on' === $show_title ) { ?>
						<<?php echo $processed_header_level; ?> class="et_pb_module_header">
							<a href="<?php echo esc_url( $post->post_permalink ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
								<?php echo esc_html( get_the_title() ); ?>
							</a>
						</<?php echo $processed_header_level; ?>>
					<?php } ?>


					<?php if ( 'on' === $show_categories && ! empty( $post->post_categories ) ) : ?>
						<p class="post-meta">
							<?php
								$category_index = 0;
								foreach( $post->post_categories as $category ) {
									$category_index++;
									$separator =  $category_index < count(  $post->post_categories ) ? ', ' : '';
									echo '<a href="'. esc_url( $category['permalink'] ) .'" title="' . esc_attr( $category['label'] ) . '">' . esc_html( $category['label'] ) . '</a>' . $separator;
								}
							?>
						</p>
					<?php endif; ?>

				</div><!-- .et_pb_portfolio_item -->
				<?php
			}

			if ( 'on' === $show_pagination && ! is_search() ) {
				if ( function_exists( 'wp_pagenavi' ) ) {
					$pagination = wp_pagenavi( array( 'query' => $portfolio, 'echo' => false ) );
				} else {
					$next_posts_link_html = $prev_posts_link_html = '';

					if ( ! empty( $portfolio->posts_next['url'] ) ) {
						$next_posts_link_html = sprintf(
							'<div class="alignleft">
								<a href="%1$s">%2$s</a>
							</div>',
							esc_url( $portfolio->posts_next['url'] ),
							esc_html( $portfolio->posts_next['label'] )
						);
					}

					if ( ! empty( $portfolio->posts_prev['url'] ) ) {
						$prev_posts_link_html = sprintf(
							'<div class="alignright">
								<a href="%1$s">%2$s</a>
							</div>',
							esc_url( $portfolio->posts_prev['url'] ),
							esc_html( $portfolio->posts_prev['label'] )
						);
					}

					$pagination = sprintf(
						'<div class="pagination clearfix">
							%1$s
							%2$s
						</div>',
						$next_posts_link_html,
						$prev_posts_link_html
					);
				}
			}
		}

		// Reset post data
		wp_reset_postdata();

		if ( ! $posts = ob_get_clean() ) {
			$posts = self::get_no_results_template();
		}

		$video_background = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();

		$fullwidth = 'on' === $fullwidth;

		// Images: Add CSS Filters and Mix Blend Mode rules (if set)
		if ( array_key_exists( 'image', $this->advanced_fields ) && array_key_exists( 'css', $this->advanced_fields['image'] ) ) {
			$this->add_classname( $this->generate_css_filters(
				$render_slug,
				'child_',
				self::$data_utils->array_get( $this->advanced_fields['image']['css'], 'main', '%%order_class%%' )
			) );
		}

		// Module classnames
		$this->add_classname( array(
			$this->get_text_orientation_classname(),
			"et_pb_bg_layout_{$background_layout}",
		) );

		if ( ! $fullwidth ) {
			$this->add_classname( array(
				'et_pb_portfolio_grid',
				'clearfix',
			) );

			$this->remove_classname( $render_slug );
		}

		$output = sprintf(
			'<div%4$s class="%1$s">
				<div class="et_pb_ajax_pagination_container">
					%6$s
					%5$s
					%7$s
						%2$s
					%8$s
					%9$s
				</div>
			%3$s',
			$this->module_classname( $render_slug ),
			$posts,
			( ! $container_is_closed ? '</div> <!-- .et_pb_portfolio -->' : '' ),
			$this->module_id(),
			$video_background,
			$parallax_image_background,
			$fullwidth ? '' : '<div class="et_pb_portfolio_grid_items">',
			$fullwidth ? '' : '</div>',
			isset( $pagination ) ? $pagination : ''
		);

		return $output;
	}
}

new Custom_ET_Builder_Module_Portfolio;