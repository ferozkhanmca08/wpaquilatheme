<!doctype html>
<html lang="en">
<?php  get_header();  ?>
<?php the_post() ?>
<h1><?php the_title()?>:</h1>
<?php $imagepath = wp_get_attachment_image_src(get_post_thumbnail_id(),'large');
//echo $imagepath[0]; ?>
<div><?php the_post_thumbnail('thumbnail'); ?></div>
<hp><a href="<?php echo site_url(); ?>">Home</a>/<?php the_title()?></hp>
<div><?php the_content() ?></div>
 
<?php get_footer();  ?>

</html>