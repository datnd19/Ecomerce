			<nav id="sidebar" class="active">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
						<i class="fa fa-bars"></i>
						<span class="sr-only">Toggle Menu</span>
					</button>
				</div>
				<div class="p-4">
					<h1><a href="index.html" class="logo">Flash</a></h1>
					<ul class="list-unstyled components mb-5">
						<li class="link active">
							<a href="#"><span class="fa-solid fa-chart-line mr-3"></span> Dashboard</a>
						</li>
						<li class="link">
							<a href="listUser.php"><span class="fa fa-user mr-3"></span>Manage User</a>
						</li>
						<li class="link">
							<a href="category.php"><span class="fa fa-briefcase mr-3"></span>Manage Category</a>
						</li>
						<li class="link">
							<a href="product.php"><span class="fa-brands fa-product-hunt mr-3"></span>Manage Product</a>
						</li>
						<li class="link">
							<a href="#"><span class="fa fa-paper-plane mr-3"></span> Contact</a>
						</li>
					</ul>
				</div>
			</nav>


			<!-- <script>
				const listLinks = document.querySelectorAll('.link');
				listLinks.forEach(function(value, key) {
					value.addEventListener('click', function() {
						listLinks.forEach(function(value, key) {
							value.classList.remove('active');
						})
						this.classList.add('active');
					})
				})
			</script> -->