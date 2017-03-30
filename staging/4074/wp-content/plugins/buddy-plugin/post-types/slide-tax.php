<?php 

if ( ! class_exists( 'GhostPool_Slides' ) ) {

	global $dirname; $dirname = 'buddy';	
	
	class GhostPool_Slides {

		public function __construct() {

			global $dirname;
						
			add_action( 'init', array( &$this, 'ghostpool_post_type_slide' ) );	
			add_action( 'manage_posts_custom_column',  array( &$this, 'ghostpool_slide_custom_columns' ) );
			if ( get_option( 'template' ) == $dirname ) {
				add_action( 'admin_menu', array( &$this, 'ghostpool_enable_slide_sort' ) );
				add_action( 'admin_enqueue_scripts', array( &$this, 'ghostpool_enqueue_slide_scripts' ) );
				add_action( 'wp_ajax_slide_sort', array( &$this, 'ghostpool_save_slide_order' ) );
			}
			
		}


		public function ghostpool_post_type_slide() {

			/*--------------------------------------------------------------
			Slide Post Type
			--------------------------------------------------------------*/	
		
			register_post_type( 'slide', array( 
				'labels' => array( 
					'name' => esc_html__( 'Slides', 'buddy-plugin' ),
					'singular_name' => esc_html__( 'Slide', 'buddy-plugin' ),
					'all_items' => esc_html__( 'All Slides', 'buddy-plugin' ),
					'add_new' => _x( 'Add New', 'slide', 'buddy-plugin' ),
					'add_new_item' => esc_html__( 'Add New Slide', 'buddy-plugin' ),
					'edit_item' => esc_html__( 'Edit Slide', 'buddy-plugin' ),
					'new_item' => esc_html__( 'New Slide', 'buddy-plugin' ),
					'view_item' => esc_html__( 'View Slide', 'buddy-plugin' ),
					'search_items' => esc_html__( 'Search Slides', 'buddy-plugin' ),
					'menu_name' => esc_html__( 'Slides', 'buddy-plugin' )
				 ),	
				'public' => true,
				'exclude_from_search' => true,
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'_builtin' => false,
				'_edit_link' => 'post.php?post=%d',
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array( 'slug' => 'slide' ),
				'menu_position' => 20,
				'with_front' => true,
				'supports' => array( 'title', 'thumbnail', 'editor', 'author', 'custom-fields' )
			 ) );
		
			/*--------------------------------------------------------------
			Slide Categories Taxonomy
			--------------------------------------------------------------*/
			
			register_taxonomy( 'slide_categories', 'slide', array( 
				'labels' => array( 
					'name' => esc_html__( 'Slide Categories', 'buddy-plugin' ),
					'singular_name' => esc_html__( 'Slide Category', 'buddy-plugin' ),
					'all_items' => esc_html__( 'All Slide Categories', 'buddy-plugin' ),
					'add_new' => _x( 'Add New', 'slide', 'buddy-plugin' ),
					'add_new_item' => esc_html__( 'Add New Slide Category', 'buddy-plugin' ),
					'edit_item' => esc_html__( 'Edit Slide Category', 'buddy-plugin' ),
					'new_item' => esc_html__( 'New Slide Category', 'buddy-plugin' ),
					'view_item' => esc_html__( 'View Slide Category', 'buddy-plugin' ),
					'search_items' => esc_html__( 'Search Slide Categories', 'buddy-plugin' ),
					'menu_name' => esc_html__( 'Slide Categories', 'buddy-plugin' )
				 ),
				'show_in_nav_menus' => false,
				'hierarchical' => true,
				'rewrite' => array( 'slug' => 'slide-categories' )
			 ) );


			register_taxonomy_for_object_type( 'slide', 'slide_categories' );


			/*--------------------------------------------------------------
			Slide Admin Columns
			--------------------------------------------------------------*/

			if ( ! function_exists( 'ghostpool_slide_edit_columns' ) ) {
				function ghostpool_slide_edit_columns( $columns ) {
						$gp_columns = array( 
							'cb' => '<input type=\"checkbox\" />',
							'title' => esc_html__( 'Title', 'buddy-plugin' ),
							'slide_categories' => esc_html__( 'Categories', 'buddy-plugin' ),
							'slide_image' => esc_html__( 'Image', 'buddy-plugin' ),				
							'date' => esc_html__( 'Date', 'buddy-plugin' )
						 );
						return $gp_columns;
				}
			}
			add_filter( 'manage_edit-slide_columns', 'ghostpool_slide_edit_columns' );
			
		}


		public function ghostpool_slide_custom_columns( $gp_column ) {
			switch ( $gp_column ) {
				case 'slide_categories':
					echo get_the_term_list( get_the_ID(), 'slide_categories', '', ', ', '' );
				break;
				case 'slide_image':
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( array( 50, 50 ) );
					}
				break;					
			}
		}


		/*--------------------------------------------------------------
		Slider Order Menu
		--------------------------------------------------------------*/

		public function ghostpool_enable_slide_sort() {
			add_submenu_page( 'edit.php?post_type=slide', esc_html__( 'Order Slides', 'buddy-plugin' ), esc_html__( 'Order Slides', 'buddy-plugin' ), 'edit_posts', basename( __FILE__ ), array( &$this, 'ghostpool_sort_slides' ) );
		}
 
		public function ghostpool_sort_slides() {
	
			$gp_slides = new WP_Query( 'post_type=slide&posts_per_page=-1&orderby=menu_order&order=ASC' );

		?>

			<div id="gp-theme-options" class="wrap">
	
				<div id="icon-edit" class="icon32"><br></div> 
				
				<h2><?php esc_html_e( 'Order Slides', 'buddy-plugin' ); ?> <img src="<?php echo esc_url( site_url() ); ?>/wp-admin/images/loading.gif" id="loading-animation" /></h2>
		
				<ul id="sort-list">
		
					<?php if ( $gp_slides->have_posts() ) : while ( $gp_slides->have_posts() ) : $gp_slides->the_post(); ?>
			
						<li id="<?php the_ID(); ?>">
					
							<?php if ( has_post_thumbnail() ) { the_post_thumbnail( array( 50,50 ) ); } ?>
					
							<span>
								<h4 style="margin: 0 0 10px 0;"><?php the_title(); ?></h4>
								<a href="<?php echo esc_url( site_url() ); ?>/wp-admin/post.php?post=<?php the_ID(); ?>&action=edit"><?php esc_html_e( 'Edit', 'buddy-plugin' ); ?></a>					
							</span>
					
							<div class="clear"></div>
				
						</li>					
				
					<?php endwhile; endif; wp_reset_query(); ?>
			
				</ul>
		
			</div>
 
		<?php
		}


		public function ghostpool_enqueue_slide_scripts() {
			global $pagenow;
			$gp_pages = array( 'edit.php', 'admin.php' );
			if ( in_array( $pagenow, $gp_pages ) ) {			
				wp_enqueue_style( 'gp-admin', get_template_directory_uri().'/lib/css/admin.css' );
				wp_enqueue_script( 'jquery-ui-sortable' );
				wp_enqueue_script( 'gp-sort-slides', get_template_directory_uri() . '/lib/scripts/sort-slides.js' );
			}
		}

		public function ghostpool_save_slide_order() {
			global $wpdb;
			$gp_order = explode( ',', $_POST['order'] );
			$gp_counter = 0;
			foreach ( $gp_order as $gp_slide_id ) {
				$wpdb->update( $wpdb->posts, array( 'menu_order' => $gp_counter ), array( 'ID' => $gp_slide_id ) );
				$gp_counter++;
			}
			die( 1 );
		}

	}

}

?>