<?php

$id = the_author_meta( 'ID' );
$img = get_field('headshot', $id);

echo $img;

<div class="author-box">

	<div class="author-contact">
	</div>
	<div class="author-photo">
	</div>
</div>

?>