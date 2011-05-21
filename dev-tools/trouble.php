<script type="text/javascript">
	var state = 'hide';
	function accordian() {
		switch (state) {
		 case 'hide':
			$('.body').show();
			state = 'show';
			$('#show_hide').html('Collapse all');
			break;
		case 'show':
			$('.body').hide();
			state = 'hide';
			$('#show_hide').html('Expand all');
			break;
		}
	}
</script>

<p class="buttons"><a href="javascript:accordian()"><span id="show_hide">Expand all</span></a></p>
<br clear="left" />
<?php
$catobj = new ZenpageCategory('troubleshooting');
$cats = $catobj->getSubCategories();
?>
<ol class="index">
<?php
foreach ($cats as $cat) {
	$catobj = new ZenpageCategory($cat);
	$h4 = $catobj->getTitle();
	?>
	<li><a href="#<?php echo $catobj->getTitlelink(); ?>"><?php echo $h4; ?></a></li>
	<?php
}
?>
</ol>
<?php
foreach ($cats as $cat) {
	$catobj = new ZenpageCategory($cat);
	$h4 = $catobj->getTitle();
	?>
	<h4><a name="<?php echo $catobj->getTitlelink(); ?>"></a><?php echo $h4; ?></h4>
	<?php
	listArticles($catobj);
}

function listArticles($cat) {
	$articles = $cat->getArticles();
	if (!empty($articles)) {
		?>
		<ol class="trouble">
		<?php
		foreach ($articles as $titlelink) {
			$titlelink = $titlelink['titlelink'];
			$article = new ZenpageNews($titlelink);
			?>
				<li>
				<h5><a name="<?php echo $titlelink; ?>"><a href="javascript:toggle('<?php echo $titlelink; ?>_body');"><?php echo $article->getTitle(); ?></a></h5>
				<div id="<?php echo html_encode($titlelink)?>_body" style="display:none;" class="body">
					<?php echo $article->getContent(); ?>
				</div>
				<?php
				?>
			</li>
			<?php
		}
		?>
		</ol>
		<?php
	}
}
?>