<?php get_header();?>
<div class="content">

<?php
$sticky = get_option( 'sticky_posts' );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
'posts_per_page' => 4,
'paged' => $paged,
'post_status' => 'publish',
'post__in' => $sticky,
'caller_get_posts' => 1
);
query_posts( $args );
if($sticky ){
 ?>


  <div class="sticky_post">
  <ul>
<?php

while (have_posts()) : the_post();
$category = get_the_category($post->ID);
 ?>
<li>
<a class="sticky_images" title=" <?php the_title(); ?>"target="_blank"href="<?php the_permalink() ?>"> 

<?php if(get_the_excerpt($post->ID)){ ?>
<div class="sticky_ex">
  <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_excerp',get_the_excerpt($post->ID))),0,200,"..."); ?></p>
 <div class="btn"> read more</div>
</div>
<?php } themepark_thumbnails("case_full"); ?>
</a>
<strong class="sticky_title" title=" <?php the_title(); ?>"><a target="_blank"href="<?php the_permalink() ?>"> <?php the_title(); ?></a></strong>
<a href="<?php echo get_category_link($category[0]->term_id ) ?>" class="cat"><?php echo $category[0]->name;  ?> /  <?php echo $category[0]->slug;  ?></a>
<div class="actor"><a target="_blank" href="<?php echo get_author_posts_url(get_the_author_ID()); ?>"> <?php the_author_nickname(); ?></a> 写在<?php echo get_the_time('Y年m月d日') ; ?></div>
</li>




<?php endwhile; wp_reset_query(); ?>     
 
  </ul>
  </div> 
  <?php }; ?>
  <div class="main_loop">
  
  <ul class="main_loop_ul">
  
  
  
  
  
  <?php
if(get_option('mytheme_from_page')){ include_once("bbs-post.php");}
$args2 = array(
'paged' => $paged,
'post_status' => 'publish',
'post__not_in' => $sticky,
);
query_posts( $args2 );
while (have_posts()) : the_post();
$category = get_the_category($post->ID);
 ?>
<li class="mian_li">
<div class="ajax_content">
<?php if(get_usermeta(get_the_author_ID(),'user_avatar')) {?><a class="actor_avatar" target="_blank" href="<?php echo get_author_posts_url(get_the_author_ID()); ?>"><img  src="<?php echo get_usermeta(get_the_author_ID(),'user_avatar') ?>" alt="<?php the_title(); ?>" /></a><?php } ?>
<a class="main_title" target="_blank"href="<?php the_permalink() ?>"> <?php the_title(); ?></a>

<div class="main_others">
<a class="main_cat" href="<?php echo get_category_link($category[0]->term_id ) ?>" class="main_cat"><?php echo $category[0]->name;  ?> /  <?php echo $category[0]->slug;  ?></a>

<a class="main_actor" target="_blank" href="<?php echo get_author_posts_url(get_the_author_ID()); ?>"> <?php the_author_nickname(); ?></a> 写在<?php echo get_the_time('Y年m月d日  a g：h') ; ?></div>
<div class="main_fenge"></div>
<div class="main_excerp"><p class="index_p_d"><?php echo mb_strimwidth(strip_tags(apply_filters('the_excerp',get_the_excerpt($post->ID))),0,400,"..."); ?></p></div>
<a class="readmore"rel="<?php echo  get_option( 'home' ).'/?p='.$post->ID; ?>"><span>展开全部</span>read more</a>
<div class="readloading"></div>
<div class="main_photos">

<?php 
  $content = get_the_content();
   preg_match('/\[gallery.*ids=.(.*).\]/',  $content , $ids);
  $array_id = $ids;
  if( $array_id ){ 
  foreach($array_id  as $array_id ){
								
                             }
  echo do_shortcode("[gallery ids=". $array_id ."]");}
   else{themepark_thumbnails("main");}
?>


</div>

<div class="moretag">

<span class="main_tag"><?php $posttags = get_the_tags(); if ($posttags) {echo 'TAG：'; foreach($posttags as $tag) { echo '<a title="查看所有' .$tag->name .'" target="_blank" id="tagss" href="'.get_bloginfo('url').'?tag='.$tag->slug.'">' .$tag->name .'</a>';}}?></span>
</div>
 </div>

<div class="pinglun_index"><div class="pinglunload"></div><a rel="<?php echo  get_option( 'home' ).'/?p='.$post->ID; ?>"><span>点击评论</span>（<?php echo get_comments_number(get_the_ID()); ?>评论）</a></div>
<div class="ajaxpinglun">

</div>
 

</li>




<?php endwhile; wp_reset_query(); ?>     
  
  
  
  </ul>
 <?php if( get_next_posts_link()){ ?><div id="pagination"><?php ajax_next($query_string); ?><span>点击加载更多</span></div><?php }else{ ?>
 
 <div id="paginations">已经显示全部文章</div>
 <?php } ?>
  </div>
  
  
  <div class="sidbar"><?php dynamic_sidebar('sidebar-widgets4');?></div>
  
  
  
</div>
<?php  get_footer(); ?>
