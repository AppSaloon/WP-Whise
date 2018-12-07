<?php
namespace wp_whise\view\admin\project;
global $post;

use wp_whise\model\Project;

$project = new Project();
$project->set_post( $post->ID );

?>
<fieldset>

    <div>
        <?php
        /**
         * The actual field that will hold the URL for our file
         */
        ?>
        <input type="hidden" class="large-text" name="_search_media" id="_search_media" value="<?php echo esc_attr( $project->get_meta('_search_media') ); ?>"><br>
        <?php if(!empty($project->get_meta('_search_media'))){
            $url = wp_get_attachment_url( $project->get_meta('_search_media') );
            ?>
            <img src="<?php echo $url; ?>" alt="search thumbnail" id="search_image_thumb"  style="width: 250px; height: auto;" />
        <?php } ?>
        <?php
        /**
         * The button that opens our media uploader
         * The `data-media-uploader-target` value should match the ID/unique selector of your field.
         * We'll use this value to dynamically inject the file URL of our uploaded media asset into your field once successful (in the myplugin-media.js file)
         */
        ?>
        <button type="button" class="button" id="events_video_upload_btn" data-media-uploader-target="#_search_media"><?php _e( 'Upload Image', 'sage' )?></button>
    </div>

</fieldset>

<?php
