<?php
/*
Plugin Name: Automatic Image Compression & Bulk Image Compression
Plugin URI: http://www.ramiotis.com
Description: Compress your images automatically on upload to save space and increase your website speed and seo rankings.
Author: Dimos Ramiotis
Version: 1.1.0
Author URI: http://www.ramiotis.com
*/
add_action('plugins_loaded', 'wan_load_textdomain_compression');
function wan_load_textdomain_compression() {
  load_plugin_textdomain( 'image-compression-plugin', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
}
function add_jscroll(){
 wp_enqueue_style( 'image-compression-admin-css-default', plugin_dir_url( __FILE__ ) . 'css/default.css', array(), '1.0.0', 'all' );

  wp_enqueue_script('image-compression-admin-js-scrolljs', plugin_dir_url( __FILE__ ) . 'js/jquery.jscroll.min.js', array(), '2.3.7', true);
  wp_enqueue_script('image-compression-admin-js-process-patch', plugin_dir_url( __FILE__ ) . 'js/jquery.ajax-progress.js', array(), '2.3.7', true);

}



//add_action('admin_enqueue_scripts', 'add_jscroll'); 


require_once( __DIR__ . DIRECTORY_SEPARATOR . 'image-compression-settings.php' );

if (!function_exists('get_home_path')) {
  require_once( ABSPATH . '/wp-admin/includes/file.php' );
}



function compress($source, $destination, $quality) {

  $info = getimagesize($source);

  if ($info['mime'] == 'image/jpeg') 
  {
    $image = imagecreatefromjpeg($source);
    imagejpeg($image, $destination, $quality);

}

  elseif ($info['mime'] == 'image/gif') 
  {
    $image = imagecreatefromgif($source);
    imagegif($image, $destination);

}

  elseif ($info['mime'] == 'image/png') 
  {
    if ($quality==90)
    {
      $quality = 5;


    }
    elseif ($quality==85)
    {
$quality = 5.5;
      
    }
    elseif ($quality==80)
    {
$quality = 6;
      
    }
    elseif ($quality==70)
    {

      $quality = 6.5;
    }
    elseif ($quality==60)
    {
      $quality = 7;

      
    }
    elseif ($quality==50)
    {
      $quality = 7.5;

      
    }
    elseif ($quality==40)
    {
      $quality = 8;

      
    }
    elseif ($quality==30)
    {
      $quality = 8.5;

      
    }
    elseif ($quality==20)
    {
            $quality = 9;

      
    }

       //$quality = $quality/10;

      if ($info['mime'] == 'image/png' || $info['mime'] == 'image/gif') 
      {


      $dimensions = getimagesize($source);
        $x = $dimensions[0];
        $y = $dimensions[1];
        $im = imagecreatetruecolor($x,$y); 
        $src_ = imagecreatefrompng($source); 


         $alpha_channel = imagecolorallocatealpha($im, 0, 0, 0, 127); 
        imagecolortransparent($im, $alpha_channel); 
        // Fill image
        imagefill($im, 0, 0, $alpha_channel); 
        // Copy from other
        imagecopy($im,$src_, 0, 0, 0, 0, $x, $y); 
        // Save transparency
        imagesavealpha($im,true); 
        // Save PNG
        imagepng($im,$destination, $quality); 
        imagedestroy($im); 
      }

      if ($info['mime'] == 'image/jpeg') 
      {

        $img = new Imagick();
$img->readImage($destination);
$img->setImageCompression(Imagick::COMPRESSION_JPEG);
$img->setImageCompressionQuality($quality);
$profiles = $img->getImageProfiles("icc", true);

$img->stripImage();

if(!empty($profiles))
    $img->profileImage("icc", $profiles['icc']);
    $img->writeImage($destination); 
$img->clean();

          //imagejpeg($image, $destination, $quality);

      }


}


  return $destination;




}






function get_image_sizes() {
  global $_wp_additional_image_sizes;

  $sizes = array();

  foreach ( get_intermediate_image_sizes() as $_size ) {
    if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
      $sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
      $sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
      $sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
    } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
      $sizes[ $_size ] = array(
        'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
        'height' => $_wp_additional_image_sizes[ $_size ]['height'],
        'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
      );
    }
  }

  return $sizes;
}
/*Compression Functions*/






function process_images($results) {
    global $_wp_additional_image_sizes;

  $options_compression = get_option('compression_settings_option_compression');
  $image_quality_level = $options_compression['image_quality_level'];


  $filename = $results[ 'file' ];
  $url = $results[ 'url' ];


 
 compress($results['file'], $results['file'], $image_quality_level-10);



// $all_image_sizes = get_image_sizes();
// foreach($all_image_sizes as $current_image_size){
//   if($current_image_size["width"]!=0 && $current_image_size["height"])
//   {
//     $current_image_path  =$source;

//   $extension_pos = strrpos( $current_image_path ,'.'); // find position of the last dot, so where the extension starts
//   $current_image_path = substr( $current_image_path, 0, $extension_pos) . "-".$current_image_size["width"].'x'. $current_image_size["height"] . substr( $current_image_path, $extension_pos);
// //compress($current_image_path, $current_image_path, $quality-10);

//   }//end if
// }


//print_r($results);
 return $results;

 

}//end function process_images







function process_images_new($metadata, $attachment_id) {
    global $_wp_additional_image_sizes;

  $options_compression = get_option('compression_settings_option_compression');
  $image_quality_level = $options_compression['image_quality_level'];


      $current_image_path = get_attached_file($attachment_id);

      compress($current_image_path, $current_image_path, $image_quality_level);

$image_meta_data =wp_get_attachment_metadata( $attachment_id );
                    foreach($image_meta_data["sizes"] as $key=>$value){

                              // Get the image object
                             $current_image_object = wp_get_attachment_image_src($attachment_id,$key );
                             // Isolate the url
                             $current_image_url = $current_image_object[0];
                             // Using the wp_upload_dir replace the baseurl with the basedir
                             $current_image_path = str_replace( $uploads_folder['baseurl'], $uploads_folder['basedir'], $current_image_url );

                            //compress image//
                            compress($current_image_path, $current_image_path, $image_quality_level_bulk-10);



                    }

      //compression_bulk($current_image_path, $current_image_path, $image_quality_level);


 return $metadata;

}//end function process_images


function process_images_super_new($metadata, $attachment_id)
{
   $uploads_folder = wp_upload_dir();

  $options_compression = get_option('compression_settings_option_compression');
  $image_quality_level = $options_compression['image_quality_level'];
   
 $current_image_object = wp_get_attachment_image_src($attachment_id);
                             // Isolate the url
                             $current_image_url = $current_image_object[0];
                             // Using the wp_upload_dir replace the baseurl with the basedir
                             $current_image_path_initial = str_replace( $uploads_folder['baseurl'], $uploads_folder['basedir'], $current_image_url );

    //error_log(print_r($metadata));



                   // $all_image_sizes = get_image_sizes();
foreach($metadata["sizes"] as $key=> $current_image_size){

                         // $current_image_object = wp_get_attachment_image_src($attachment_id, $key);
                             // Isolate the url
                           //  $current_image_url = $current_image_object[0];
                             // Using the wp_upload_dir replace the baseurl with the basedir
                             //$current_image_path = str_replace( $uploads_folder['baseurl'], $uploads_folder['basedir'], $current_image_url );

                            //  error_log($current_image_path);



  $extension_pos = strrpos( $current_image_path_initial ,'.'); // find position of the last dot, so where the extension starts
  $current_image_path = substr( $current_image_path_initial, 0, $extension_pos) . "-".$current_image_size["width"].'x'. $current_image_size["height"] . substr( $current_image_path_initial, $extension_pos);
error_log($current_image_path);
  compress($current_image_path, $current_image_path, $image_quality_level);


}
    return $metadata;



}



function compression_bulk($source, $destination, $quality){
$all_image_sizes = get_image_sizes();
foreach($all_image_sizes as $current_image_size){
  if($current_image_size["width"]!=0 && $current_image_size["height"])
  {
    $current_image_path  =$source;

  $extension_pos = strrpos( $current_image_path ,'.'); // find position of the last dot, so where the extension starts
  $current_image_path = substr( $current_image_path, 0, $extension_pos) . "-".$current_image_size["width"].'x'. $current_image_size["height"] . substr( $current_image_path, $extension_pos);
compress($current_image_path, $current_image_path, $quality);

  }//end if
}
compress($source, $destination, $quality);



}//end function compress bulk

$options_compression = get_option('compression_settings_option_compression');


####   ##                         ##       ######
##  ##  ##                         ##       ##   ##
##       ######    #####    #####   ##  ##   ##   ##   #####   ##  ##    #####    #####
##       ##   ##  ##   ##  ##       ## ##    ######   ##   ##   ####    ##   ##  ##
##       ##   ##  #######  ##       ####     ##   ##  ##   ##    ##     #######   ####
##  ##  ##   ##  ##       ##       ## ##    ##   ##  ##   ##   ####    ##           ##
####   ##   ##   #####    #####   ##  ##   ######    #####   ##  ##    #####   #####




//checking if  image compression checkbox  has value else set 0//
if(isset($options_compression['image_compression_enable']) && $options_compression['image_compression_enable'] != "" )
{

  $image_compression_enable = $options_compression['image_compression_enable'];

}
else{

  $image_compression_enable = "0";

}
//checking if  image compression checkbox  has value else set 0//





####                                                                    ##
##  ##
##        #####   ### ##   ######   ## ###    #####    #####    #####   ####      #####   ## ###
##       ##   ##  ## # ##  ##   ##  ###      ##   ##  ##       ##         ##     ##   ##  ###  ##
##       ##   ##  ## # ##  ##   ##  ##       #######   ####     ####      ##     ##   ##  ##   ##
##  ##  ##   ##  ## # ##  ##   ##  ##       ##           ##       ##     ##     ##   ##  ##   ##
####    #####   ##   ##  ######   ##        #####   #####    #####    ######    #####   ##   ##
##
/*Checking if Checkbox to Enable Linkwise Conversion Tracking is Checked*/
if ($image_compression_enable)
{

// add_filter('attachment_fields_to_save', '' );

  add_action('wp_handle_upload', 'process_images');

 //add_action('add_attachment','process_images_new');


 add_filter( 'wp_generate_attachment_metadata', 'process_images_super_new', 10, 2 );




//add_filter('wp_handle_upload_prefilter', 'custom_upload_filter' );

}




/*    ___      _               ___        __  _
   /   |    (_)___ __  __   /   | _____/ /_(_)___  ____
  / /| |   / / __ `/ |/_/  / /| |/ ___/ __/ / __ \/ __ \
 / ___ |  / / /_/ />  <   / ___ / /__/ /_/ / /_/ / / / /
/_/  |_|_/ /\__,_/_/|_|  /_/  |_\___/\__/_/\____/_/ /_/
      /___/*/




add_action( 'wp_ajax_pagination_action_icp', 'pagination_action_icp' );

function pagination_action_icp() {
  global $wpdb; 
  
  // this is how you get access to the database

  

if(isset($_POST['page'])){
    //Include Pagination class file
    include('Pagination.php');
    
    
    $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit = 40;
    

$args = array(
        'post_type' => 'attachment',
        'post_mime_type' => array( 'image/jpeg', 'image/gif', 'image/png' ),
        'post_status' => 'inherit',
        'posts_per_page' => -1,
        'orderby'        => 'ID',
        'order'          => 'DESC'
        );
    $query_images_all = new WP_Query( $args );


  
    
    //initialize Pagination class
    $pagConfig = array('baseURL'=>'', 'totalRows'=>$query_images_all->post_count, 'currentPage'=>$start, 'perPage'=>$limit, 'contentDiv'=>'media-gallery');
    $pagination =  new Pagination($pagConfig);
    

$args_current = array(
        'post_type' => 'attachment',
        'post_mime_type' => array( 'image/jpeg', 'image/gif', 'image/png' ),
        'post_status' => 'inherit',
        'posts_per_page' => $limit,
        'paged' => ($start/$limit)+1,
        'orderby'        => 'ID',
        'order'          => 'DESC'
        );


    //get rows
    $query_images_current =   new WP_Query( $args_current );
    
    if($query_images_current->post_count > 0){ ?>
        <div class="posts_list">
              <?php while ($query_images_current->have_posts()) : $query_images_current->the_post(); ?>

            <div class="image-container">
            <div class="image-size">Size:'<?php echo size_format(filesize(get_attached_file(get_the_ID())), 2); ?></div>
<div style="width:100px;height:100px;background:url(<?php echo wp_get_attachment_thumb_url(get_the_ID()); ?>);background-size: cover; background-position: center;"></div>
            <input type="checkbox" class="image-checkbox" name="img_ids[]" value="<?php echo get_the_ID(); ?>" id="<?php echo get_the_ID(); ?>"/>
            </div>

<?php endwhile; ?>

        <?php } ?>

        </div>
        <?php echo $pagination->createLinks(); ?>
<?php }

 wp_die(); // this is required to terminate immediately and return a proper response
} //end pagination_action_cip function//





add_action( 'wp_ajax_bulk_compress_all_icp', 'bulk_compress_all_icp' );

function bulk_compress_all_icp() {
  global $wpdb; 
  
  // this is how you get access to the database

  

if(isset($_POST['bulk_compress_all'])){
    //Include Pagination class file
   // include('Pagination.php');
 $image_quality_level_bulk = $_POST["bulk_compress_all"];
    
   // $start = !empty($_POST['page'])?$_POST['page']:0;
   // $limit = 40;
    

$args = array(
        'post_type' => 'attachment',
        'post_mime_type' => array( 'image/jpeg', 'image/gif', 'image/png' ),
        'post_status' => 'inherit',
        'posts_per_page' => -1,
        'orderby'        => 'ID',
        'order'          => 'DESC'
        );
    $query_images_all = new WP_Query( $args );


  
 $uploads_folder = wp_upload_dir();

    if($query_images_all->post_count > 0){ ?>

              <?php while ($query_images_all->have_posts()) : $query_images_all->the_post(); ?>

            <?php

            $image_meta_data =wp_get_attachment_metadata( get_the_ID() );
                    foreach($image_meta_data["sizes"] as $key=>$value){


                              // Get the image object
                             $current_image_object = wp_get_attachment_image_src(get_the_ID(),$key );
                             // Isolate the url
                             $current_image_url = $current_image_object[0];
                             // Using the wp_upload_dir replace the baseurl with the basedir
                             $current_image_path = str_replace( $uploads_folder['baseurl'], $uploads_folder['basedir'], $current_image_url );

                            //compress image//
                            compress($current_image_path, $current_image_path, $image_quality_level_bulk-10);
                            
                            printf( esc_attr__( ' %s has been compressed. ', 'image-compression-plugin' ), '<code>'.$current_image_path.'</code>');
                             echo "<br/>";


                    }
                            
                compress(get_attached_file(get_the_ID()), get_attached_file(get_the_ID()), $image_quality_level_bulk);
                printf( esc_attr__( ' %s has been compressed. ', 'image-compression-plugin' ), '<code>'.get_attached_file(get_the_ID()).'</code>');
                            echo "<br/>";

            ?>

<?php endwhile; ?>
        <?php } ?>

        </div>
<?php } //end if isset

 wp_die(); // this is required to terminate immediately and return a proper response
} //end pagination_action_cip function//

 add_action( 'wp_ajax_bulk_compress_selected_icp', 'bulk_compress_selected_icp' );

function bulk_compress_selected_icp() {
  global $wpdb; 
 $bulk_compress_selected_imgs = $_POST["bulk_compress_selected_imgs"];
//print_r()
 //print_r($_POST["bulk_compress_selected_imgs"]);
    if(!empty($bulk_compress_selected_imgs)){

            $image_quality_level_bulk = $_POST["image_quality_level_bulk"];


// Loop to store and display values of individual checked checkbox.
            $size_before_compression = 0;

            $size_after_compression = 0;
            $uploads_folder = wp_upload_dir();
            $current_photo = 1;
            $total_photos = count($bulk_compress_selected_imgs);
            $total_compressed_photos = 0;
            foreach($bulk_compress_selected_imgs as $selected){

                $size_before_compression = filesize(get_attached_file($selected));

                    $image_meta_data =wp_get_attachment_metadata( $selected );
                    foreach($image_meta_data["sizes"] as $key=>$value){

                              // Get the image object
                             $current_image_object = wp_get_attachment_image_src($selected,$key );
                             // Isolate the url
                             $current_image_url = $current_image_object[0];
                             // Using the wp_upload_dir replace the baseurl with the basedir
                             $current_image_path = str_replace( $uploads_folder['baseurl'], $uploads_folder['basedir'], $current_image_url );

                            //compress image//
                            compress($current_image_path, $current_image_path, $image_quality_level_bulk-10);



                    }
                compress(get_attached_file($selected), get_attached_file($selected), $image_quality_level_bulk);



                $size_after_compression = filesize(get_attached_file($selected));


                printf( esc_attr__( ' %s has been compressed. ', 'image-compression-plugin' ), '<code>'.get_attached_file($selected).'</code>');
                echo "<br/>";




$current_photo++;
$total_compressed_photos++;
}//end foreach


}//end if not empty post
 wp_die(); // this is required to terminate immediately and return a proper response

}//end function



add_action( 'wp_ajax_bulk_compress_selected_single', 'bulk_compress_selected_single' );

function bulk_compress_selected_single() {
  global $wpdb; 
 $bulk_compress_selected_single_image = $_POST["bulk_compress_selected_single_image"];
//print_r()
 //print_r($_POST["bulk_compress_selected_imgs"]);
    if(!empty($bulk_compress_selected_single_image)){

            $image_quality_level_bulk = $_POST["image_quality_level_bulk"];


// Loop to store and display values of individual checked checkbox.
            $size_before_compression = 0;

            $size_after_compression = 0;
            $uploads_folder = wp_upload_dir();
            $current_photo = 1;
           // $total_photos = count($bulk_compress_selected_imgs);
            $total_compressed_photos = 0;
            $selected = $bulk_compress_selected_single_image;

            
                $size_before_compression = filesize(get_attached_file($selected));

                    $image_meta_data =wp_get_attachment_metadata( $selected );
                    foreach($image_meta_data["sizes"] as $key=>$value){

                              // Get the image object
                             $current_image_object = wp_get_attachment_image_src($selected,$key );
                             // Isolate the url
                             $current_image_url = $current_image_object[0];
                             // Using the wp_upload_dir replace the baseurl with the basedir
                             $current_image_path = str_replace( $uploads_folder['baseurl'], $uploads_folder['basedir'], $current_image_url );

                            //compress image//
                            compress($current_image_path, $current_image_path, $image_quality_level_bulk-10);



                    }
                compress(get_attached_file($selected), get_attached_file($selected), $image_quality_level_bulk);



                $size_after_compression = filesize(get_attached_file($selected));


                printf( esc_attr__( ' (%s has been compressed. )', 'image-compression-plugin' ), ''.get_attached_file($selected).'');
                //echo "<br/>";






}//end if not empty post
wp_die(); // this is required to terminate immediately and return a proper response

}//end function




?>