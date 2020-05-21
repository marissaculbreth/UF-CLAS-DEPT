<?php
/**
 * Issue Page
 *
 * @package UFCLAS_emily
 *
 */
get_header(); ?>

<?php get_template_part('inc/issuem/issuem','header'); ?>

<div id="main" class="container main-content">
<div class="row">
  <div class="col-sm-12">
    <?php
		// Change the query if this is an issue page
		if ( issuem_is_articles_page() ){
			$issue_args = array(
				'post_type' => 'article',
				'orderby' => 'menu_order date',
				'order' => 'ASC',
				'posts_per_page' => -1,
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'issuem_issue',
						'field' => 'slug',
						'terms' => get_active_issuem_issue()
					),
				),
			);
			$issue_query = new WP_Query( $issue_args );
		}
		else {
			$issue_query = $wp_query;
		}

		 /* Display each article */
		while( $issue_query->have_posts() ) : $issue_query->the_post();

		if( has_post_thumbnail() ){
			$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
			$article_background = ' style="background-image: url(' . $image_url[0] . ');"';
		}
		else {
			$article_background = '';
		}
	?>

    <article id="issuem-article-<?php the_ID(); ?>" class="issuem-article col-lg-4 col-md-6" aria-label="<?php echo get_the_title(); ?>">
    <div class="big-stat-wrap big-stat-img four gradient-bg"<?php echo $article_background; ?>>
    <div class="big-stat-copy">
        <h2><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></h2>
    </div>
    <?php
        if( has_term('', 'issuem_issue_categories') ){
            $article_terms = get_the_terms( get_the_ID(), 'issuem_issue_categories' );
            echo '<a href="' . get_term_link( $article_terms[0]->term_id, 'issuem_issue_categories' ) . '" class="category-tag">' . $article_terms[0]->name . '</a>';
        }
    ?>
    </div>
    </article>
    <?php endwhile; ?>
  </div>
</div>
</div>

<?php get_footer(); ?>
