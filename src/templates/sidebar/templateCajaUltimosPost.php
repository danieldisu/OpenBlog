<?php 
    use src\helpers\pathGen;
?>
<div class="cajaUltimosPost">
	<h3> Ultimos Post </h3>
	<ul>
		<?php
		foreach ($posts as $post){
			echo '<li><a href="'.pathGen::pathVerPost($post->getId()).'">'.$post->getTitulo().'</a></li>';	
		}
		?>		
	</ul>
</div>