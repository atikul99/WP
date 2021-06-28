
	$(document).on('click', '.load-more-btn', function(){

		var that = $(this);
		var page = that.data('page');
		var newPage = page+1;
		var ajaxurl = that.data('url');

		$.ajax({
			url : ajaxurl,
			type : 'post',
			data : {
				page : page,
				action : 'multilen_load_more'
			},
			error : function(response){
				console.log(response);
			},
			success : function(response){

				that.data('page', newPage);
				$('.portfolio-grid').append(response);
			}
		});
	});


// Callback function

function multilen_load_more(){
	$paged = $_POST["page"]+1;

	$query = new WP_Query(array(
		'post_type' => 'em_portfolio',
		'paged' => $paged
	));

	if( $query->have_posts() ):
		while( $query->have_posts() ) : $query->the_post();

?>
								<div class="grid-item">
									<div class="portfolio-thumb">
										<?php the_post_thumbnail(); ?>
									</div>
									<div class="content">
										<h5><?php the_title(); ?></h5>
										<p>
											<?php if( $terms ){
												
											foreach( $terms as $single_slugs ){?>
												<span class="category-item-p">
												   <?php echo $single_slugs->name ;?>
												</span>																			
											<?php }}?>
										</p>
									</div>
								</div><!-- .grid-item -->


<?php
		endwhile;
	endif;



	wp_reset_postdata();

	die();
}
add_action( 'wp_ajax_nopriv_multilen_load_more', 'multilen_load_more' );
add_action( 'wp_ajax_multilen_load_more', 'multilen_load_more' );





// html code

								<div class="portfolio-grid">								
								<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();
									$terms = get_the_terms(get_the_ID(), 'em_portfolio_cat');		
									global $post; ?>



								<div class="grid-item">
									<div class="portfolio-thumb">
										<?php the_post_thumbnail(); ?>
									</div>
									<div class="content">
										<h5><?php the_title(); ?></h5>
										<p>
											<?php if( $terms ){
												
											foreach( $terms as $single_slugs ){?>
												<span class="category-item-p">
												   <?php echo $single_slugs->name ;?>
												</span>																			
											<?php }}?>
										</p>
									</div>
								</div><!-- .grid-item -->
									


								<?php endwhile; // while has_post(); ?>								
								</div>

// button container

								<div class="row">
									<div class="col-md-12 text-center">
										

										<a class="btn-default load-more-btn m-4" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>" href="#">Load More</a>


									</div>
								</div>



