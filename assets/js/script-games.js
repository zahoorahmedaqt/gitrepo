const elem = document.getElementById('gameBox');
document.getElementById('fullscreen').addEventListener('click', () => {
	if (screenfull.enabled) {
		screenfull.request(elem);
	}
});
if (screenfull.enabled) {
	document.addEventListener(screenfull.raw.fullscreenchange, () => {
		if (screenfull.isFullscreen) {
			jQuery(".background")
				.css('display', 'block');
			jQuery(".topbar, .hideFull")
				.css('display', 'none');
		}else{
			jQuery(".background")
				.css('display', 'none');
			jQuery(".topbar, .hideFull")
				.css('display', 'inline-block');
		}
	});
}
