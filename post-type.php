
				
// Display Custom post type category

<?php while ($the_query->have_posts()) : $the_query->the_post(); 						
  $terms = get_the_terms(get_the_ID(), 'em_portfolio_cat');
?>


<p>
  <?php if( $terms ){
    foreach( $terms as $single_slugs ){?>
      <span class="category-item-p">
        <?php echo $single_slugs->name ;?>
      </span>																			
  <?php }}?>
</p>
