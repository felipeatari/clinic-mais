<?php

$title_page = "Blog | ";
include dirname(__FILE__) . '/../includes/header.php';
include dirname(__FILE__) . '/service.php';

$id = $_GET['id'] ?? 0;
$newsOne = newsOne($id, $base);
$comments = $newsOne['comments'] ?? [];
?>

<main class="main mb-0" data-animate="top" data-delay="3">
	<aside class="banner_topo bnr-blog"></aside>

	<header class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1>
						<span>Blog</span>
					</h1>
				</div>
			</div>
		</div>
	</header>

	<section class=" mb-4">
		<div class="container">

			<div class="row">
				<article class="col-12">
					<div class="cabecalho mb-4 pb-2">
						<h2 class="topic5"><?= $newsOne['title'] ?></h2>
						<time style="color:#3056bb"><img src="assets/img/icones/calendar.jpg" style="vertical-align: baseline;" alt=""> <?= $newsOne['date'] ?></time>

						<hr class="">
					</div>


					<p class="text-center">
						<img src="<?= $base . '/' . $newsOne['banner'] ?>" alt="" class="img-fluid mb-3">
					</p>

					<p>
						<?= $newsOne['content'] ?>
					</p>

					<p>
						<a href="javascript:history.go(-1);" class="btn btn-1 mt-3"> &laquo; Voltar</a>
					</p>
				</article>

				<div class="col-md-12 mt-4 col-lg-10 col-xl-8">
					<h5 class="topic5">Comentários</h5>
					<?php foreach ($comments as $comment) { ?>
						<div class="comentario mb-3">
							<div class="d-block">
								<h6 class="fw-bold text-primary mb-1"><?= $comment['author'] ?></h6>
								<p class="text-muted small mb-0"><?= $comment['comment'] ?></p>
							</div>
						</div>
					<?php } ?>

					<!-- <form class=" py-3 border-0" action="blog/2" method="POST"> -->
					<form class=" py-3 border-0">
						<h5 class="topic5">Deixe um comentário</h5>
						<div class="row ">
							<div class="col-md-12">
								<div class="form-group">
									<input class="form-control" id="nome" type="text" name="nome" placeholder="Nome" style="border: 1px solid #98a8b1;">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<textarea class="form-control" id="mensagem" name="mensagem" placeholder="Mensagem" rows="4" style="border: 1px solid #98a8b1;"></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="float-right pt-1">
									<button type="button" class="btn btn-primary btn-sm" data-mdb-button-initialized="true" id="btn-publicar">PUBLICAR</button>
								</div>
							</div>
						</div>
					</form>

					<script>
						const url = '<?= $base ?>/api/comment'

						let btnPublicar = document.querySelector('#btn-publicar')
						let nome = document.querySelector('#nome')
						let mensagem = document.querySelector('#mensagem')

						btnPublicar.addEventListener('click', ()=> {
							let data = {
								news_id: <?= $id ?>,
								nome: nome.value,
								mensagem: mensagem.value,
							}
							
							fetch(url, {
								method: 'POST',
								body: JSON.stringify(data)
							})
							.then(response => {return response.json()})
							.then(json => {
								location.reload()
							})
							.catch(error => {
								alert('Falha ao comentar!');
							})
						})
					</script>
					<script src="/clinic-mais/pages/blog/js/service.js"></script>
				</div>
			</div>

		</div><!-- row -->

		</div> <!-- container -->
	</section>

	<aside>
		<?php
		$banner = rand(1, 6);
		?>
		<a href="<?= $config['whatsapp']; ?>" target="_blank">
			<img src="assets/img/banner/0<?= $banner; ?>.png" class="d-none d-md-block w-100">
			<img src="assets/img/banner/mobile0<?= $banner; ?>.jpg" class="d-block d-md-none w-100">
		</a>
	</aside>
</main>


<?php

include dirname(__FILE__) . '/../includes/footer.php';

?>