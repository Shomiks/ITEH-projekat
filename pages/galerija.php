<section id = "middle">

		<div class="wrap">
			<div id="arrow-left" class="arrow">

			</div>
				<div class="gallery">
					<div class="slide slide1">
						<div class="slide-content">
						</div>
					</div>
					<div class="slide slide2">
						<div class="slide-content">
						</div>
					</div>
					<div class="slide slide3">
						<div class="slide-content">
						</div>
					</div>
					<div class="slide slide4">
						<div class="slide-content">
						</div>
					</div>
					<div class="slide slide5">
						<div class="slide-content">
						</div>
					</div>
				</div>
			<div id="arrow-right" class="arrow">
			</div>
		</div>
		<script>
			let galleryImages = document.querySelectorAll('.slide'),
				arrowLeft = document.querySelector('#arrow-left'),
				arrowRight = document.querySelector('#arrow-right'),
				current = 0;

				function reset(){
					for(let i=0;i<galleryImages.length;i++){
						galleryImages[i].style.display='none';
					}
				}

				function startSlide(){
					reset();
					galleryImages[0].style.display='block';
				}

				function slideLeft(){
					reset();
					galleryImages[current-1].style.display = 'block';
					current--;
				}

				function slideRight(){
					reset();
					galleryImages[current+1].style.display = 'block';
					current++;
				}

				arrowLeft.addEventListener('click',function(){
					if(current==0){
						current = galleryImages.length;
					}
					slideLeft();
				});


				arrowRight.addEventListener('click',function(){
					if(current==galleryImages.length-1){
						current = -1;
					}
					slideRight();
				});
				startSlide();
		</script>
			</section>
