<div class="bg-home-video max-h-[800px] h-[800px] absolute left-0 top-0 w-full">
	<video class="lazy absolute left-0 top-0 w-full object-cover h-full"
		   data-src="/api/video/background.mp4"
		   autoplay
		   muted
		   loop
		   preload="none"
		   disablepictureinpicture
		   disableremoteplayback></video>
	<div class="absolute left-0 top-0 w-full h-full bg-gradient-to-b from-transparent to-primary-900">&nbsp;</div>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const videoEl = document.querySelector('.bg-home-video video')
			let userHasLeaveWindow = false
			const playVideo = () => {
				if (videoEl && videoEl.classList.contains('loaded')) {
					videoEl.play()
				}
			}
			const pauseVideo = () => {
				if (videoEl && videoEl.classList.contains('loaded')) {
					videoEl.pause()
				}
			}
			const videObserver = new IntersectionObserver((entries) => {
				entries.forEach(entry => {
					if (userHasLeaveWindow) return

					if (entry.isIntersecting) {
						playVideo()
					} else {
						pauseVideo()
					}
				})
			})

			window.addEventListener('focus', e => {
				userHasLeaveWindow = false
				playVideo()
			}, false)
			window.addEventListener('blur', e => {
				userHasLeaveWindow = true
				pauseVideo()
			}, false)
			videObserver.observe(videoEl)
		})
	</script>
</div>
