<?php
/*
PLUGIN NAME: Thematic Visual Hooks
PLUGIN URI: 

DESCRIPTION: Highlight and label the action hooks for the Thematic Theme Framework.

VERSION: 0.1

Author: emhr
Author URI:

LICENSE: GPLv2
LICENSE URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/


class KS_thematic_actions {

	/**
	 * @var array list of bbPress hooks
	 */
	public $ks_thematic_actions = '';

	
	/**
	 * __construct function.
	 *
	 * Hook everything
	 */
	function __construct() {
		add_action( 'get_header', array( $this, 'hook_loop' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueues' ) );
		
		add_action( 'thematic_abovecontainer', array( $this,'open_wrap'), -10000 );
		add_action( 'thematic_belowcontainer', array( $this,'close_wrap'), 10000);
		
		add_action( 'thematic_abovemain', array( $this,'open_wrap'), -10000 );
		add_action( 'thematic_belowmain', array( $this,'close_wrap'), 10000);
		
		add_action( 'thematic_abovemainasides', array( $this,'open_wrap'), -10000 );
		add_action( 'thematic_belowmainasides', array( $this,'close_wrap'), 10000 );
	}
	
	
	/**
	 * enqueues function.
	 */
	function enqueues() {
		wp_register_style( 'ks-thematic-actions', plugin_dir_url( __FILE__ ) . 'style.css' );
	    wp_enqueue_style( 'ks-thematic-actions' );
	}
	
	
	/**
	 * hook_loop function.
	 *
	 */
	function hook_loop() {
		
		$ks_thematic_actions = array(
		'thematic_before',
		// header-extensions.php
		'thematic_aboveheader',
		'thematic_header',
		'thematic_belowheader',
		// content-extensions.php
		'thematic_abovecontainer',
		'thematic_abovecontent',
		'thematic_abovepost',
		'thematic_archives',
		'thematic_navigation_above',
		'thematic_navigation_below',
		'thematic_above_indexloop',
		'thematic_above_archiveloop',
		'thematic_archiveloop',
		'thematic_authorloop',
		'thematic_categoryloop',
		'thematic_indexloop',
		'thematic_searchloop',
		'thematic_singlepost',
		'thematic_tagloop',
		'thematic_below_indexloop',
		'thematic_below_archiveloop',
		'thematic_above_categoryloop',
		'thematic_below_categoryloop',
		'thematic_above_searchloop',
		'thematic_below_searchloop',
		'thematic_above_tagloop',
		'thematic_below_tagloop',
		'thematic_belowpost',
		'thematic_belowcontent',
		'thematic_belowcontainer',
		'thematic_404',
		// discussion-extensions.php
		'thematic_abovecomments',
		'thematic_abovecommentslist',
		'thematic_belowcommentslist',
		'thematic_abovetrackbackslist',
		'thematic_belowtrackbackslist',
		'thematic_abovecommentsform',
		'thematic_belowcommentsform',
		'thematic_belowcomments',
		'thematic_comments_template',
		// discussion.php
		'thematic_abovecomment',
		'thematic_belowcomment',
		// footer-extensions.php
		'thematic_abovemainclose',
		'thematic_abovefooter',
		'thematic_footer',
		'thematic_belowfooter',
		'thematic_after',
		// sidebar-extensions.php
		'thematic_abovemainasides',
		'widget_area_primary_aside',
		'thematic_betweenmainasides',
		'widget_area_secondary_aside',
		'thematic_belowmainasides',
		'thematic_aboveindextop',
		'widget_area_index_top',
		'thematic_belowindextop',
		'thematic_aboveindexinsert',
		'widget_area_index_insert',
		'thematic_belowindexinsert',
		'thematic_aboveindexbottom',
		'widget_area_index_bottom',
		'thematic_belowindexbottom',
		'thematic_abovesingletop',
		'widget_area_single_top',
		'thematic_belowsingletop',
		'thematic_abovesingleinsert',
		'widget_area_single_insert',
		'thematic_belowsingleinsert',
		'thematic_abovesinglebottom',
		'widget_area_single_bottom',
		'thematic_belowsinglebottom',
		'thematic_abovepagetop',
		'widget_area_page_top',
		'thematic_belowpagetop',
		'thematic_abovepagebottom',
		'widget_area_page_bottom',
		'thematic_belowpagebottom',
		'thematic_abovesubasides',
		'thematic_belowsubasides',
		'thematic_before_first_sub',
		'widget_area_subsidiaries',
		'thematic_between_firstsecond_sub',
		'thematic_between_secondthird_sub',
		'thematic_after_third_sub',
		// widgets-extensions.php
		'thematic_presetwidgets',
		);
		
		foreach ( $ks_thematic_actions as $action ) {
			add_action( $action , array( $this, 'start_action' ) , -1 );
			add_action( $action , array( $this, 'end_action' ) , 1000 );
		}

	}
	
	
	/**
	 * start_action function.
	 *
	 * Injects the hook identifiers
	 */
	function start_action() {
		$current_action = current_filter();
		echo '<div class="ks-hook-wrap ' . $current_action . '_wrap"><div class="ks-hook start ' . $current_action . '" title="start ' . $current_action . '">' . $current_action . '</div>';
	}
	
	
	/**
	 * end_action function.
	 */
	function end_action() {
			echo '</div>';
	}

	
	/**
	 * open_wrap function.
	 */
	function open_wrap() {
	?>
		<?php if ( current_filter() == 'thematic_abovecontainer' ) : ?>
			<div id="wrap_container">
			
		<?php elseif ( current_filter() == 'thematic_abovemain' ) : ?>
			<div id="wrap_main">
		<?php else: ?>
			<div id="wrap_sidebar">
		<?php endif ?>
	
	<?php }

	
	/**
	 * close_wrap function.
	 */
	function close_wrap() {
	?>
		
		</div>
	
	<?php }

}


new KS_thematic_actions();