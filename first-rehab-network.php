<?php

/**
 *
 * @link              http://trepidation.co.uk
 * @since             1.0.0
 * @package           first_rehab_network
 *
 * @wordpress-plugin
 * Plugin Name:       Network Sites First Rehab Plugin
 * Plugin URI:        http://trepidation.co.uk
 * Description:       First Rehab Master Network Plugin.
 * Version:           1.0.0
 * Author:            Colin Gell
 * Author URI:        First Rehab Network Plugin
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       first-rehab-network
 * Domain Path:       /languages
 * Network:           False
 */
  
 	 add_action('network_admin_menu', 'add_network_menu_companies');
     function add_network_menu_companies() {
	 add_menu_page( "Companies List", "Companies List", 'create_sites', 'gen-companies', 'add_network_menu_companies_cb');	
	 }
	 
	 function add_network_menu_companies_cb()
	 {

	 
	 ?>	 
	 <h2>List of Companies</h2>
	 <ul class='postlist no-mp'>

<?php 

$blogs = get_blog_list( 0, 'all' );

if ( 0 < count( $blogs ) ) :
    foreach( $blogs as $blog ) : 
        switch_to_blog( $blog[ 'blog_id' ] );

        if ( get_theme_mod( 'show_in_home', 'on' ) !== 'on' ) {
            continue;
        }

        $blog_details = get_blog_details( $blog[ 'blog_id' ] );
        ?>
        <li class="no-mp">
		<div style="display: flow-root;">
            <h2 class="no-mp blog_title">
                    <a href="<?php echo $blog_details->path ?>"><?php echo  $blog_details->blogname; ?></a>
            </h2>
			
			
			
	    <div style="float:left; padding-right: 10px;"><h2>Solicitors</h2>

            <?php
        global $wpdb;
        // Add table name as variable to include prefix 		
        $frsolicitor = $wpdb->prefix . 'frsolicitor';
		$solresults =  $wpdb->get_results("SELECT `solicitorname` FROM $frsolicitor ");

    /** Loop through the $results and display */
        foreach($solresults as $solresult) :
        $solicitorresult = sprintf("\t".'<div>%1$s%2$s</div>'."\n", $solresult->ID, $solresult->solicitorname);
        echo $solicitorresult;
	    endforeach;
    ?>  </div>
			
			
			
			
			
            <div style="float: left; padding-right: 10px;"><h2>Fee Earners</h2>

            <?php
        global $wpdb;
        // Add table name as variable to include prefix 		
        $frfeeearner = $wpdb->prefix . 'frfeeearner';
		$feeresults =  $wpdb->get_results("SELECT `feeearnername` FROM $frfeeearner ");

    /** Loop through the $results and display */
        foreach($feeresults as $feeresult) :
        $feeearnerresult = sprintf("\t".'<div>%1$s%2$s</div>'."\n", $feeresult->ID, $feeresult->feeearnername);
        echo $feeearnerresult;
	    endforeach;
    ?>  </div>
	    </div>
		 
		 
		 
		 
		 
		 
		</div> 
        </li>
<?php endforeach;
endif; ?>
</ul>
	 <?php
	 }