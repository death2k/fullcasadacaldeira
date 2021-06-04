<?php
class Image_Compression_Settings
{
/**
* Holds the values to be used in the fields callbacks
*/
private $options_compression;


/**
* Start up
*/

public function __construct()
{
    add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
    add_action( 'admin_init', array( $this, 'page_init' ) );
}

/**
* Add options page
*/
public function add_plugin_page()
{


    add_submenu_page( 'upload.php', 'Image Compression Settings', 'Image Compression Settings', 'manage_options', 'image-compression-setting-admin', 
        array( $this, 'create_admin_page' )
        ); 

}




/**
* Options page callback
*/
public function create_admin_page()
{
     wp_enqueue_style( 'image-compression-admin-css-default', plugin_dir_url( __FILE__ ) . 'css/default.css', array(), '1.0.0', 'all' );

  wp_enqueue_script('image-compression-admin-js-scrolljs', plugin_dir_url( __FILE__ ) . 'js/jquery.jscroll.min.js', array(), '2.3.7', true);
  wp_enqueue_script('image-compression-admin-js-process-patch', plugin_dir_url( __FILE__ ) . 'js/jquery.ajax-progress.js', array(), '2.3.7', true);

  
// Set class property
    $this->options_compression = get_option( 'compression_settings_option_compression' );


    ?>
    <div class="wrap">
        <h2><?php _e('Image Compression Settings', 'image-compression-plugin'); ?></h2>  



        <?php
        if( isset( $_GET[ 'tab' ] ) ) {
            $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'linkwise';
        } 
        else 
        {
            $active_tab ="compression";
        }

        ?>
        <?php if( isset($_GET['settings-updated']) ) { ?>
        <div id="message" class="updated">
            <p><strong><?php _e(ucfirst($active_tab).' Settings Updated.') ?></strong></p>
        </div>
                  

        <?php } ?>
 <div class="notice notice-info is-dismissible notice-overflow bulk-images-notice" style="display:none;">
                   </div>


      



<?php settings_errors($this); ?>
<h2 class="nav-tab-wrapper">

    <a href="?page=image-compression-setting-admin&tab=compression" class="nav-tab <?php echo $active_tab == 'compression' ? 'nav-tab-active' : ''; ?>"><span class="dashicons dashicons-editor-code"></span>Compression Settings</a>
    <a href="?page=image-compression-setting-admin&tab=bulk" class="nav-tab <?php echo $active_tab == 'bulk' ? 'nav-tab-active' : ''; ?>"><span class="dashicons dashicons-editor-code"></span>Bulk Image Compression</a>
</h2>



<?php
if( $active_tab == 'compression' ) {
    echo '<form method="post" action="options.php">';
    settings_fields( 'image_compression_group_compression' );
    do_settings_sections( 'compression-setting-admin-compression' );
    submit_button(); 
} 
if( $active_tab == 'bulk' ) {
    echo '<form method="post">';
    settings_fields( 'image_compression_group_bulk' );
    do_settings_sections( 'compression-setting-admin-bulk' );
   // submit_button( __("Compress Selected Images", "image-compression-plugin") );

} 

?>
</form>






</div><!--#wrap -->
<?php
}

/**
* Register and add settings
*/
public function page_init()
{        
    register_setting(
'image_compression_group_compression', // Option group
'compression_settings_option_compression', // Option name
array( $this, 'sanitize' ) // Sanitize
);

    register_setting(
'image_compression_group_bulk', // Option group
'compression_settings_option_bulk', // Option name
array( $this, 'sanitize' ) // Sanitize
);


    add_settings_section(
'setting_section_quality_level_lw', // Image Compression  Enable Checkbox
__("Quality Level", "image-compression-plugin"), // Title
array( $this, 'print_image_quality_level_info' ), // Callback
'compression-setting-admin-compression' // Page
); 
    add_settings_field(
'image_quality_level', // Image Compression  Enable Checkbox
__("Quality Level", "image-compression-plugin"), // Title 
array( $this, 'image_quality_level_callback' ), // Callback
'compression-setting-admin-compression', // Page
'setting_section_quality_level_lw' // Section           
);  



    add_settings_section(
'setting_section_compression_enable_lw', // Image Compression  Enable Checkbox
__("Enable Image Compression on Upload", "image-compression-plugin"), // Title
array( $this, 'print_image_compression_enable_info' ), // Callback
'compression-setting-admin-compression' // Page
); 
    add_settings_field(
'image_compression_enable', // Image Compression  Enable Checkbox
__("Enable Image Compression on Upload", "image-compression-plugin"), // Title 
array( $this, 'image_compression_enable_callback' ), // Callback
'compression-setting-admin-compression', // Page
'setting_section_compression_enable_lw' // Section           
);  


    /* Basic Settings Sections and Fields*/

    /*Bulk Image Compression Level*/
    add_settings_section(
'setting_section_quality_level_bulk_lw', // Bulk Image Compression  Level 
__("Quality Level", "image-compression-plugin"), // Title
array( $this, 'print_image_quality_level_bulk_info' ), // Callback
'compression-setting-admin-bulk' // Page
); 
    add_settings_field(
'image_quality_level_bulk', // Bulk Image Compression  Level 
__("Quality Level", "image-compression-plugin"), // Title 
array( $this, 'image_quality_level_bulk_callback' ), // Callback
'compression-setting-admin-bulk', // Page
'setting_section_quality_level_bulk_lw' // Section           
);  


    add_settings_section(
'setting_section_select_images_bulk_lw', // Bulk Image Compression  Level 
__("Select Images", "image-compression-plugin"), // Title
array( $this, 'print_image_select_images_bulk_info' ), // Callback
'compression-setting-admin-bulk' // Page
); 
    add_settings_field(
'image_select_images_bulk', // Bulk Image Compression  Level 
__("Select Images", "image-compression-plugin"), // Title 
array( $this, 'image_select_images_bulk_callback' ), // Callback
'compression-setting-admin-bulk', // Page
'setting_section_select_images_bulk_lw' // Section           
);  

    /*Bulk Image Compression Level*/




} //page init closing here

/**
* Sanitize each setting field as needed
*
* @param array $input Contains all settings fields as array keys
*/
public function sanitize( $input )
{
    $new_input = array();

    /*    Basic Settings inputs*/   
    if( isset( $input['image_quality_level'] ) )
    {
        $new_input['image_quality_level'] =  $input['image_quality_level'];
    }
    else
    {

        $new_input['image_quality_level'] =  "90";

    }

    if( isset( $input['image_compression_enable'] ) )
    {
        $new_input['image_compression_enable'] =  $input['image_compression_enable'];
    }
    else
    {
        $new_input['image_compression_enable'] = "0";
    }


    if( isset( $input['image_quality_level_bulk'] ) )
    {
        $new_input['image_quality_level_bulk'] =  $input['image_quality_level_bulk'];
    }
    else
    {

        $new_input['image_quality_level_bulk'] =  "90";

    }

    /*    Basic Settings inputs*/   




    return $new_input;
}

/** 
* Print the Section text
*/

/*Basic Settings Section Text*/

public function print_image_quality_level_info()
{
    _e('Select Image Quality. Select  quality above 70% . Below 70% the compression is lossy', 'image-compression-plugin');
}
/*Basic Settings Section Text*/

/*Basic Settings Section Text*/

public function print_image_compression_enable_info()
{
    _e('Enable Image Compression on Upload.', 'image-compression-plugin');
}
/*Basic Settings Section Text*/


/*Bulk Settings Section Text*/
public function print_image_quality_level_bulk_info()
{
    _e('Select Image Quality. A quality of 70%-80% is suggested.', 'image-compression-plugin');
}

public function print_image_select_images_bulk_info()
{
    _e('Select Images to Compress.<br/>
        <b>Attention</b>: Compress All Images Button  will compress all images in your media gallery.', 'image-compression-plugin');
}
/*Bulk Settings Section Text*/


/*Basic Settings Callback*/


public function image_quality_level_callback()
{
    printf('<select name="compression_settings_option_compression[image_quality_level]">
        <option value="90"  '.selected( "90", $this->options_compression['image_quality_level'], false ).' >90</option>
        <option value="85" '.selected("85",$this->options_compression['image_quality_level'], false ).' >85</option>
        <option value="80" '.selected("80", $this->options_compression['image_quality_level'], false ).' >80</option>
        <option value="70"  '.selected( "70", $this->options_compression['image_quality_level'], false ).' >70</option> 
        <option value="60"  '.selected( "60", $this->options_compression['image_quality_level'], false ).' >60</option> 
        <option value="50"  '.selected( "50", $this->options_compression['image_quality_level'], false ).' >50</option> 
        <option value="40"  '.selected( "40", $this->options_compression['image_quality_level'], false ).' >40</option> 
        <option value="30"  '.selected( "30", $this->options_compression['image_quality_level'], false ).' >30</option> 
        <option value="20"  '.selected( "20", $this->options_compression['image_quality_level'], false ).' >20</option> 

    </select>',
    isset( $this->options_compression['image_quality_level'] ) ? esc_attr( $this->options_compression['image_quality_level']) : ''
    );
}


public function image_compression_enable_callback()
{
    printf(
        '<input type="checkbox" id="image_compression_enable" name="compression_settings_option_compression[image_compression_enable]" value="1" '. checked( 1, $this->options_compression['image_compression_enable'], false ) .' />',
        isset( $this->options_compression['image_compression_enable'] ) ? esc_attr( $this->options_compression['image_compression_enable']) : ''
        );
}

/*Basic Settings Callback*/



/*Bulk Settings Callback*/
public function image_quality_level_bulk_callback()
{
    printf('<select name="image_quality_level_bulk" id="image_quality_level_bulk">
        <option value="90">90</option>
         <option value="85">85</option>
        <option value="80">80</option>
        <option value="70">70</option>
        <option value="60">60</option> 
         <option value="50">50</option>
         <option value="40">40</option>
         <option value="30">30</option>
         <option value="20">20</option>

    </select>',
    ''
    );
}


public function image_select_images_bulk_callback()
{
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' => array( 'image/jpeg', 'image/gif', 'image/png' ),
        'post_status' => 'inherit',
        'posts_per_page' => -1,
        'fields' => 'ids',
        'orderby'        => 'ID',
        'order'          => 'DESC',

        );
    $query_images = new WP_Query( $args );
    $images = array();


 echo  "<script>
    jQuery(document).ready(function(){
     jQuery('#checkall').toggle(function(){
         jQuery('input:checkbox').attr('checked','checked');
        jQuery(this).val('uncheck all')
    },function(){
         jQuery('input:checkbox').removeAttr('checked');
         jQuery(this).val('check all');        
    })
})
    </script>";

   echo '  <input type="button" class="button button-primary" id="checkall" value="check all" />';
   /*echo "<a href=\"javascript:void(0);\" class=\"button button-primary\" style=\"margin-left:10px; \"
                onclick=\"jQuery.post(ajaxurl, {'action': 'bulk_compress_all_icp','bulk_compress_all' : jQuery('#image_quality_level_bulk').val()}, function(data){
                       jQuery('.bulk-images-notice').html(data); jQuery('.bulk-images-notice').css('display', 'block');}); \">Compress All Images(<b>".$query_images->post_count."</b> in total) </a>";*/

                        echo "<a href=\"#\" class=\"button button-primary\" style=\"margin-left:10px; \"
                onclick=\"compress_all_imgs_new();return false;\">Compress All Images(<b>".$query_images->post_count."</b> in total) </a>";



                            echo "<script>

                            jQuery(document).ready(function(){
                                    var selected_img_ids = new Array();

                            });
                            
                                 function compress_sellected_imgs() {
                                   selected_img_ids = [];
                                    jQuery('input[name=\"img_ids[]\"]:checked').each(function(){
    selected_img_ids.push(jQuery(this).val());
});

                            jQuery.ajax({
                                 


    type: \"POST\",
    url: ajaxurl,
    traditional:true,
    cache: false,
    data: {'action': 'bulk_compress_selected_icp','image_quality_level_bulk' : jQuery('#image_quality_level_bulk').val(), 'bulk_compress_selected_imgs[]' :selected_img_ids},

    

     success: function(data, textStatus, jqXHR){


jQuery('.bulk-images-notice').html(data); 
jQuery('.loading-overlay-icp').hide();
jQuery('.bulk-images-notice').css('display', 'block');
    },
     beforeSend: function(){

       jQuery('.loading-overlay-icp').show();
              jQuery('.icp-text-load').html('Compressing '+selected_img_ids.length +' photos');


    }




});

}





function compress_sellected_imgs_new()

 {
    jQuery('.compress-status').css('display', 'block');

    jQuery('.icp-text-load').html('Loading...');

jQuery('.compress-progress').css('display', 'block');

jQuery('.loading-overlay-icp').removeClass('hidden');
  jQuery('.loading-overlay-icp').addClass('visible');

    jQuery('.compress-progress').css({ width: '10%'});


                                   selected_img_ids = [];
                                    jQuery('input[name=\"img_ids[]\"]:checked').each(function(){
    selected_img_ids.push(jQuery(this).val());
});

                                  

var total_progress = 0;

var total_images = selected_img_ids.length;
var total_compressed = 0;
for (var i = 0; i < total_images; i++) {
    (function (i) {
            var dfd = jQuery.Deferred();



                            jQuery.ajax({
                                 


    type: \"POST\",
    url: ajaxurl,
    traditional:false,
    cache:false,
    data: {'action': 'bulk_compress_selected_single','image_quality_level_bulk' : jQuery('#image_quality_level_bulk').val(), 'bulk_compress_selected_single_image' :selected_img_ids[i]},

    

     success: function(data, textStatus, jqXHR){
                dfd.resolve(data);

        total_compressed++;

       jQuery('.icp-text-load').html('Compressing '+total_compressed +' from '+total_images +' ('+Math.round( total_progress * 10 ) / 10 + '%)...');
        jQuery('.compress-status').html('Compressing '+data +'');

 total_progress = (total_compressed/total_images)*100;
jQuery('.compress-progress').css({ width: total_progress + '%'  });

if (total_progress == 100){


jQuery('.loading-overlay-icp').removeClass('visible');
  jQuery('.loading-overlay-icp').addClass('hidden');
jQuery('.compress-progress').css('display', 'none');
jQuery('.compress-status').css('display', 'none');

}
//jQuery('.bulk-images-notice').html(data); 
//jQuery('.loading-overlay-icp').hide();
//jQuery('.bulk-images-notice').css('visibility', 'visible');


    },
     beforeSend: function(){

       

    }




});

 }) (i);
}//end for image


}





function compress_all_imgs() {
                                

                            jQuery.ajax({



    type: \"POST\",
    url: ajaxurl,
    traditional: true,
    data: {'action': 'bulk_compress_all_icp','bulk_compress_all' : jQuery('#image_quality_level_bulk').val()},
     success: function(data, textStatus, jqXHR){
jQuery('.bulk-images-notice').html(data); 
jQuery('.loading-overlay-icp').hide();
jQuery('.bulk-images-notice').css('display', 'block');
    },
     beforeSend: function(){
       jQuery('.loading-overlay-icp').show();
              jQuery('.icp-text-load').html('Compressing ".$query_images->post_count." photos');


    },




});

}

var createGroupedArray = function(arr, chunkSize) {
    var groups = [], i;
    for (i = 0; i < arr.length; i += chunkSize) {
        groups.push(arr.slice(i, i + chunkSize));
    }
    return groups;
}


function compress_all_imgs_new() {
                                

                

     var all_imgs = ".json_encode($query_images->posts).";       
               var total_images = all_imgs.length;
                    
     all_imgs = createGroupedArray(all_imgs, 5);

   jQuery('.compress-status').css('display', 'block');

    jQuery('.icp-text-load').html('Loading...');

jQuery('.compress-progress').css('display', 'block');

jQuery('.loading-overlay-icp').removeClass('hidden');
  jQuery('.loading-overlay-icp').addClass('visible');

    jQuery('.compress-progress').css({ width: '10%'});


                    
                                  

var total_progress = 0;

var total_compressed = 0;
    for (var i = 0; i < total_images; i++) {
    !function (i) {
            var dfd = jQuery.Deferred();

if (all_imgs[i].length >= 1 && all_imgs[i])
{

                            jQuery.ajax({
                                 


    type: \"POST\",
    url: ajaxurl,
    traditional:false,
    cache:false,
    data: {'action': 'bulk_compress_selected_icp','image_quality_level_bulk' : jQuery('#image_quality_level_bulk').val(), 'bulk_compress_selected_imgs[]' :all_imgs[i]},

    

     success: function(data, textStatus, jqXHR){
                dfd.resolve(data);
               
                            total_compressed = total_compressed + all_imgs[i].length;
                             jQuery('.icp-text-load').html('Compressing '+ total_compressed +' from '+total_images +' ('+Math.round( total_progress * 10 ) / 10 + '%)...');
        jQuery('.compress-status').html('Compressing '+data +'');

 total_progress = (total_compressed/total_images)*100;



         



      
jQuery('.compress-progress').css({ width: total_progress + '%'  });

if (total_progress == 100){


jQuery('.loading-overlay-icp').removeClass('visible');
  jQuery('.loading-overlay-icp').addClass('hidden');
jQuery('.compress-progress').css('display', 'none');
jQuery('.compress-status').css('display', 'none');

}
//jQuery('.bulk-images-notice').html(data); 
//jQuery('.loading-overlay-icp').hide();
//jQuery('.bulk-images-notice').css('visibility', 'visible');


    },
     beforeSend: function(){

       

    }




});

}//end if length is not bigger or equal to 1

 } (i);
}//end for image

}


                            </script>";



                       echo "<a href=\"#\" class=\"button button-primary\" style=\"margin-left:10px; \"
                onclick=\"compress_sellected_imgs_new();\">Compress Selected Images </a>";

echo '<div class="loading-overlay-icp hidden"><div class="overlay-content-icp"><img src="'.plugin_dir_url( __FILE__ ).'/Spinner.gif"/><div class="icp-text-load">Loading.....</div><div class="compress-progress">
</div> <div class="compress-status"></div></div></div>

<div id="media-gallery">';

 //Include Pagination class file
    include('Pagination.php');
    

    
    $limit = 40;
    
    
    //Initialize Pagination class and create object
    $pagConfig = array('baseURL'=>'', 'totalRows'=>$query_images->post_count, 'perPage'=>$limit, 'contentDiv'=>'media-gallery');
    $pagination =  new Pagination($pagConfig);
    
    //Get rows

$args_current = array(
        'post_type' => 'attachment',
        'post_mime_type' => array( 'image/jpeg', 'image/gif', 'image/png' ),
        'post_status' => 'inherit',
        'posts_per_page' => $limit,
        'paged'=> 0,
        'orderby'        => 'ID',
        'order'          => 'DESC'
        );
    $query_images_current = new WP_Query( $args_current );


     if($query_images_current->post_count > 0){ ?>
        <div class="posts_list">
        <?php while ($query_images_current->have_posts()) : $query_images_current->the_post(); ?>


              
           <div class="image-container">
            <div class="image-size">Size:'<?php echo size_format(filesize(get_attached_file(get_the_ID())), 2); ?></div>
            
            <div style="width:100px;height:100px;background:url(<?php echo wp_get_attachment_thumb_url(get_the_ID()); ?>);background-size: cover; background-position: center;"></div>
            <input type="checkbox" class="image-checkbox" name="img_ids[]" value="<?php echo get_the_ID(); ?>" id="<?php echo get_the_ID(); ?>"/>
            </div>



<?php endwhile; ?>
        <?php }//end if ?>

        </div>
        <?php echo $pagination->createLinks(); ?>
   
  </div> 

<script type="text/javascript">
// Show loading overlay when ajax request starts
jQuery( document ).ajaxStart(function() {
    //jQuery('.loading-overlay-icp').show();
});
// Hide loading overlay when ajax request completes
jQuery( document ).ajaxStop(function() {
    //jQuery('.loading-overlay-icp').hide();
});
</script>



<?php
}//end callback here

/*Bulk Settings Callback*/





} // Class ends here

/** 
* Get the settings option array and print one of its values
*/

if( is_admin() )

    $compression_settings = new Image_Compression_Settings();

