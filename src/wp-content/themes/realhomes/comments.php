<?php
/**
 * Comments Template
 *
 * @package realhomes
 */

global $post;

?>

<section id="comments">

<?php
	if ( post_password_required() ) {
?>
<p class="nopassword"><?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'framework' ); ?></p>
</section><!-- end of comments -->
<?php
return;
}
if ( have_comments() ) {
	?>
	<div class="rh_comments__header">
		<h3 id="comments-title">
			<i class="fa fa-comments" aria-hidden="true"></i>
			<?php comments_number( __( 'No Comment', 'framework' ), __( 'One Comment', 'framework' ), __( '% Comments', 'framework' ) ); ?>
		</h3>
		<?php if ( 'property' === $post->post_type && 'true' === get_option( 'inspiry_property_ratings', 'false' ) ) : ?><?php inspiry_rating_average(); ?><?php endif; ?>
	</div>
	<ol class="commentlist">
		<?php
			wp_list_comments(
				array(
					'callback' => 'theme_comment',
				)
			);
		?>
	</ol>

	<?php
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
		?>
		<nav class="pagination comments-pagination">
			<?php paginate_comments_links(); ?>
		</nav>
		<?php
	}
}

if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
	?><p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'framework' ); ?></p><?php
}
comment_form();
?>
</section><!-- end of comments -->
