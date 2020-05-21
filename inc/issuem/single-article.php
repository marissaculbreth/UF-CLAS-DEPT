<?php
/**
 * IssueM Article template
 *
 * @package UFCLAS_emily
 *
 */
get_header(); ?>

<div id="main" class="container main-content">
<div class="row">
  <div class="col-sm-12">
    <?php
		// Get information about the current article's issue, if set
		$article_issue = ufclas_emily_issuem_issue_data();
		if( $article_issue ){
			printf('<ul class="breadcrumb-wrap"><li><a href="%s">%s</a></li></ul>', $article_issue['url'], $article_issue['title'] );
		}
	?>
    <header class="entry-header">
      <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
    </header>
    <!-- .entry-header -->
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="entry-content">
          	<?php the_content(); ?>
          </div> <!-- .entry-content -->

          <footer class="entry-footer">
               <p class="posted-on">By <?php the_author(); ?>, <?php ufclas_emily_issuem_posted_on(); ?></p>
              <?php if ( $article_issue ): ?>
                  <p><a href="<?php echo $article_issue['url']; ?>" title="<?php echo $article_issue['title']; ?>" class="btn"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back to Issue</a></p>
              <?php endif; ?>
              <?php edit_post_link( __( 'Edit Article', 'ufclas-ufl-emily' ), '<p class="edit-link">', '</p>' ); ?>
          </footer> <!-- .entry-footer -->
        </article>
        <!-- #post-## -->
    <?php endwhile; ?>
  </div>

</div>
</div>

<?php get_footer(); ?>
