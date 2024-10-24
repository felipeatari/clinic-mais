<?php

$title_page = "Blog | ";
include dirname(__FILE__) . '/../includes/header.php';
include dirname(__FILE__) . '/service.php';

$pagina = $_GET['pagina'] ?? 0;
$search = $_POST['buscar'] ?? '';

$newsData = [];

$totalPages = 0;
$currentPage = 1;

if ($search) {
	$newsData = newsSearch($search, $base);
} else {
	$newsAll = newsAll($pagina, $base);
	$newsData = $newsAll['data'] ?? [];

	if ($newsData) {
		$totalPages = $newsAll['last_page'];
		$currentPage = $newsAll['current_page'];
	}
}
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

	<section class=" mb-0">
		<div class="container">

			<div class="row">

				<div class="col-12 mb-4">
					<form class="row" method="POST">
						<div class="col-lg-9 col-8">
							<input class="form-control form-control-lg" style="border: 1px solid #98a8b1;padding: 11px;" type="text" name="buscar" placeholder="Buscar">
						</div>
						<div class="col-lg-3 col-4">
							<button type="submit" class="btn btn-primary w-100">BUSCAR</button>
						</div>
					</form>
				</div>

				<?php if ($newsData) { ?>
					<?php foreach ($newsData as $news) { ?>
						<div class="col-lg-4 mb-5">
							<div class="blog_content box-shadow mb-3">
								<a href="blog/<?= $news['id'] ?>" class="zoom_image mb-3">
									<img src="<?= $base . '/' . $news['banner'] ?>" alt="" />
								</a>

								<div class="chamada_blog">
									<h3 class=""><?= $news['title'] ?></h3>
									<p><?= $news['legend'] ?></p>
								</div>
							</div>
							<a href="blog/<?= $news['id'] ?>" class="leia">Saiba mais</a>
						</div><!-- col-lg-4 -->
					<?php } ?>
				<?php } else { ?>
					<p style="padding-left: 20px">Nenhuma noticia encontrada!</p>
				<?php } ?>

				<?php if ($newsData and $totalPages) { ?>
					<div class="col-12 my-3">

						<nav aria-label="Paginação">
							<ul class="pagination justify-content-center">

								<li class="page-item">
									<?php if ($currentPage > 1) { ?>
										<a class="page-link" href="blog?pagina=<?= ($currentPage - 1) ?>">Anterior</a>
									<?php } ?>
								</li>

								<?php
								$startPage = 1;
								$endPage = 3;

								if ($currentPage > 3) {
									$startPage = $currentPage - 2;
									$endPage = $currentPage;
								}
								?>

								<?php for ($i = $startPage; $i <= $endPage; $i++) { ?>
									<?php
									$active = '';

									if ($i == $currentPage) {
										$active = 'active';
									}
									?>

									<li class="page-item <?= $active ?>">
										<a class="page-link" href="blog?pagina=<?= $i ?>"><?= $i ?></a>
									</li>
								<?php } ?>

								<li class="page-item">
									<?php if ($currentPage < $totalPages) { ?>
										<a class="page-link" href="blog?pagina=<?= ($currentPage + 1) ?>">Próximo</a>
									<?php } ?>
								</li>
							</ul>
						</nav>
					</div>
				<?php } ?>

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