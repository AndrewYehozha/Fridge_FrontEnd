var
	images = document.images,
	images_total_count = images.length,
	images_loaded_count = 0,
	perc_display = document.getElementById('load_perc');
	

for(var i = 0; i < images_total_count; i++){
	images_clone = new Image();
	images_clone.onload = images_loaded;
	images_clone_onerror = images_loaded;
	images_clone.src = images[i].src;
}

function images_loaded(){
	images_loaded_count++;
	perc_display.innerHTML = (((100/images_total_count) * images_loaded_count) << 0) + '%';
	if(images_loaded_count >= images_total_count){
		setTimeout(function(){
		var preloader = document.getElementById('page_preloader');
			if(!preloader.classList.contains('done')){
				preloader.classList.add('done');
			}
		}, 1000);
	}
}