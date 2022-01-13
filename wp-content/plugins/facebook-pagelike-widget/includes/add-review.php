<?php
/**
 * Rview class.
 * Ask users to give a review of the plugin on WordPress.org.
 *
 * @package   Widget for Social Page Feeds
 
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

if ( ! class_exists( 'Fb_Widget_Review' ) ) :
	
	class Fb_Widget_Review {

		private $slug;
		private $name;
		public $nobug_option;
		public $date_option;
		private $time_limit;

		public function __construct( $args ) {

			$this->slug         = $args['slug'];
			$this->name         = $args['name'];
			$this->nobug_option = $this->slug . '_no_bug';
			$this->date_option  = 'fb-widget-activation-date';

			if ( isset( $args['time_limit'] ) ) {
				$this->time_limit = $args['time_limit'];
			} else {
				$this->time_limit = WEEK_IN_SECONDS;
			}

			add_action( 'admin_init', array( $this, 'show_review_notice' ) );
			add_action( 'admin_init', array( $this, 'set_no_bug' ), 5 );
			add_action( 'admin_head', array( $this, 'admin_assets' ) );

		}

		public function admin_assets()
		{
			wp_enqueue_style( 'add-review-style', FB_WIDGET_PLUGIN_URL.'assets/css/add-review.css', array(), '1.0' );
		}

		// We will use this function in future
		public function calculate_time( $seconds ) {
			$years = ( intval( $seconds ) / YEAR_IN_SECONDS ) % 100;
			if ( $years > 0 ) {
				return sprintf( _n( 'a year', '%s years', $years, 'facebook-pagelike-widget' ), $years );
			}
			$weeks = ( intval( $seconds ) / WEEK_IN_SECONDS ) % 52;
			if ( $weeks > 1 ) {
				return sprintf( __( 'a week', '%s weeks', $weeks, 'facebook-pagelike-widget' ), $weeks );
			}
			$days = ( intval( $seconds ) / DAY_IN_SECONDS ) % 7;
			if ( $days > 1 ) {
				return sprintf( __( '%s days', 'facebook-pagelike-widget' ), $days );
			}
			$minutes = ( intval( $seconds ) / MINUTE_IN_SECONDS ) % 60;
			if($minutes > 1 ) {
				return sprintf( __( '%s minutes', 'facebook-pagelike-widget' ), $minutes );
			}
		}

		public function show_review_notice() {

			if ( ! get_site_option( $this->nobug_option ) || false === get_site_option( $this->nobug_option ) ) {
				add_site_option( $this->date_option, time() );
				$install_date = get_site_option( $this->date_option );
				//if ( ( time() - $install_date ) > $this->time_limit ) {
				add_action( 'admin_notices', array( $this, 'display_admin_notice' ) );
				//}
			}

		}

		public function display_admin_notice() {

			$this->show_review();

		}

		public function show_review() {

			$scriptname	=	explode('/',$_SERVER['SCRIPT_NAME']);
			$no_bug_url =	wp_nonce_url( admin_url( end($scriptname).'?' . $this->nobug_option . '=true' ), 'fbwidget-notification-nounce' );
			$time 		=	$this->calculate_time( time() - get_site_option( $this->date_option ) );
			?>
			<div class="notice updated fb-widget-notice">
				<div class="fb-widget-notice-inner">
					<div class="fb-widget-notice-icon">
						<img src="https://ps.w.org/facebook-pagelike-widget/assets/icon-128x128.png" alt="<?php echo esc_attr__( 'Facebook Page Feeds WordPress Plugin', 'facebook-pagelike-widget' ); ?>" />
					</div>
					<div class="fb-widget-notice-content">
						<h3><?php echo esc_html__( 'Are you enjoying using Facebook Page Feeds Widget?', 'facebook-pagelike-widget' ); ?></h3>
						<p>
							<?php printf( __( 'You have been using <strong><a href="https://wordpress.org/plugins/facebook-pagelike-widget/" target="_blank">%1$s</a></strong> for sometime now! Could you please do me a favor and give it a 5-star rating on WordPress to help us spread the word and encourage my hardwork?', 'facebook-pagelike-widget' ), esc_html( $this->name ), esc_html( $time ) );?>
						</p>
					</div>
					<div class="fb-widget-install-now">
						<?php printf( '<a href="%1$s" class="button button-primary fb-widget-install-button" target="_blank">%2$s</a>', esc_url( 'https://wordpress.org/support/view/plugin-reviews/facebook-pagelike-widget#new-post' ), esc_html__( 'Leave a Review', 'facebook-pagelike-widget' ) ); ?>
						<a href="<?php echo esc_url( $no_bug_url ); ?>" class="no-thanks">
							<?php echo esc_html__( 'No thanks / I already have', 'facebook-pagelike-widget' ); ?>
						</a>
					</div>
				</div>
			</div>
			<?php

		}

		public function set_no_bug() {

			if ( ! isset( $_GET['_wpnonce'] ) || ( ! wp_verify_nonce( $_GET['_wpnonce'], 'fbwidget-notification-nounce' ) || ! is_admin() || ! isset( $_GET[ $this->nobug_option ] ) || ! current_user_can( 'manage_options' ) ) ) {
				return;
			}
			add_site_option( $this->nobug_option, true );

		}

	}
endif;

/*
* Instantiate the Fb_Widget_Review class.
*/
new Fb_Widget_Review (

	array(
		'slug'       => 'fbwidget',
		'name'       => __( 'Facebook Page Feeds Widget for WordPress', 'facebook-pagelike-widget' ),
		//'time_limit' => MINUTE_IN_SECONDS,
	)

);