    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/semantic.min.js') }}"></script>

    <script>
		$(document).ready(function() {
            $('#scroll-to-top').click(function(){
                $('html, body').animate({scrollTop : 0}, 1200);
                return false;
            });

			setTimeout(function() {
				$('.error.message').fadeOut();
			}, 1200);

			$('.close.icon').on('click', function() {
				$(this).parent().fadeOut();
			});

			$('.copy.icon').parent().on('click', function() {
                $(this).siblings('input').select();

                document.execCommand('copy');

				$('#copied').show().delay(600).fadeOut();
			});

			if($('.success.message').length) {
				setTimeout(function () {
					$('#loading').hide();
					$('.success.message').removeAttr('hidden');
				}, 200);
			}
		});

		$(document).on('click', '.pagination a', function(event) {
			event.preventDefault();
			
			const page = $(this).attr('href').split('page=')[1];

			getLinks(page);
		});

		$(window).on('hashchange', function() {
			if (window.location.hash) {
				const page = parseInt(window.location.hash.replace('#', ''));

				if (isNaN(page) || page < 1)
					return false;
				else
                	getLinks(page);
			}
		});

		function getLinks(page) {
			$.ajax({
				url: '?page=' + page,
			})
			.done(function(data) {
				$('#links').html(data);

				location.hash = page;
			});
		}
  	</script>
	  
 	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117292723-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-117292723-1');
    </script>
