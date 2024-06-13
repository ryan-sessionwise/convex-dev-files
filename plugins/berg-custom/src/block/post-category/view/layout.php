<?php
$post_categories = get_the_category(get_the_ID());

if ($post_categories) {
	?>
	<div class="post-category-wrapper">
		<ul>
			<?php
			foreach ($post_categories as $category) {
				?>
				<li>
					<?php
					echo $category->name;
					?>
				</li>
				<?php
			}
			?>
		</ul>
	</div>
	<?php
}
?>
