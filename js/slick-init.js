jQuery(document).ready(function($){
  $('#testimonials').slick({
    dots: true,
    speed: 600,
    autoplaySpeed: 5000,
    autoplay: true,
    arrows: false,
    slidesToShow: 1
	});
	

  // $('.home-posts .home-posts > div').slick({
  //   infinite: true,
	// 	speed: 600,
	// 	autoplaySpeed: 5000,
	// 	autoplay: true,
	// 	arrows: false,
	// 	slidesToShow: 3,
	// 	dots: false,

	// 	responsive: [

	// 			{

	// 					breakpoint: 1169,
	// 					settings: {
	// 							slidesToShow: 2,
	// 							dots: false
	// 					}
	// 			},
	// 			{
	// 					breakpoint: 749,
	// 					settings: {
	// 							slidesToShow: 1,
	// 							dots: true
	// 					}
	// 			}
	// 	]
  // });

  $('#happy-clients > .et_pb_column').slick({
  	infinite: true,
  	dots: false,
  	speed: 600,
  	autoplaySpeed: 500,
  	autoplay: true,
  	arrows: false,
  	responsive: [{
  		breakpoint: 5000,
  		settings: {
  			slidesToShow: 6,
  			slidesToScroll: 1
  		}
  	}, {
  		breakpoint: 1169,
  		settings: {
  			slidesToShow: 3,
  			slidesToScroll: 3
  		}
  	}, {
  		breakpoint: 749,
  		settings: {
  			slidesToShow: 1,
  			slidesToScroll: 1,
  			dots: true
  		}
  	}]
	});
	
	$('.home-case-studies .home-case-studies > div').slick({
		infinite: true,
		responsive: [{

				breakpoint: 5000,
				settings: "unslick"

		},
				{

						breakpoint: 1169,
						settings: {
								dots: true,
								speed: 600,
								autoplaySpeed: 5000,
								autoplay: true,
								arrows: false,
								slidesToShow: 2
						}
				},
				{
						breakpoint: 749,
						settings: {
								dots: true,
								speed: 600,
								autoplaySpeed: 5000,
								autoplay: true,
								arrows: false,
								slidesToShow: 1

						}
				}
		]
	});

	// $('#what-we-do').slick({
	// 	infinite: true,
	// 	speed: 600,
	// 	autoplaySpeed: 5000,
	// 	autoplay: true,
	// 	arrows: false,
	// 	slidesToShow: 4,
	// 	dots: false,

	// 	responsive: [

	// 			{

	// 					breakpoint: 1169,
	// 					settings: {
	// 							slidesToShow: 2,
	// 							dots: false
	// 					}
	// 			},
	// 			{
	// 					breakpoint: 749,
	// 					settings: {
	// 							slidesToShow: 4,
	// 							dots: false
	// 					}
	// 			}
	// 	]
	// });


});
