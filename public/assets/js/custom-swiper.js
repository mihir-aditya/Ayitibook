(function(){
    
	function scriptFixedHeader(){
		var header = document.querySelector('.sticky-header');
		var scrollPosition = window.scrollY;
		
		if (scrollPosition > 300){
			header.classList.add('sticky');
		}else{
			header.classList.remove('sticky');
		}
	}
	
	function scriptNavbarToggler(){
		var navbarToggler = document.querySelector('.navbar-toggler');
		var darkOverlay = document.querySelector('.dark-overlay');
		var navbar = document.querySelector('.navbar');
		var body = document.querySelector('body');

		navbarToggler.addEventListener('click', function() {
			darkOverlay.classList.add('active');
			body.classList.add('screen-fixed');
		});

		darkOverlay.addEventListener('click', function() {
			darkOverlay.classList.remove('active');
			navbar.classList.remove('show');
			body.classList.remove('screen-fixed');
		});
	}
	

	function bnrSwiper(){		
		var swiper = new Swiper(".bnr-swiper", {
			spaceBetween: 0,
			pagination: {
				el: ".swiper-pagination",
				clickable: true,
			},
			mousewheel: true,
			keyboard: true,
		});
	}

	function counterCountdown() {
		let days = 3; // Starting days
		let hours = 23; // Starting hours
		let minutes = 19; // Starting minutes
		let seconds = 56; // Starting seconds
	
		const second = 1000, minute = second * 60, hour = minute * 60, day = hour * 24;
	
		const x = setInterval(() => {
		// Decrement the time
		if (seconds > 0) {
			seconds--;
		} else if (minutes > 0) {
			minutes--;
			seconds = 59;
		} else if (hours > 0) {
			hours--;
			minutes = 59;
			seconds = 59;
		} else if (days > 0) {
			days--;
			hours = 23;
			minutes = 59;
			seconds = 59;
		}
	
		// Update the countdown display
		document.getElementById("days1").innerText = String(days).padStart(2, "0");
		document.getElementById("hours2").innerText = String(hours).padStart(2, "0");
		document.getElementById("minutes3").innerText = String(minutes).padStart(2, "0");
		document.getElementById("seconds4").innerText = String(seconds).padStart(2, "0");

		}, 1000);
	}
	  
	  
	
	// Window load event
    window.addEventListener('load', () => {
		scriptNavbarToggler();
		bnrSwiper();
		counterCountdown();
	});

	// Window scroll event
    window.addEventListener('scroll', () => {
        scriptFixedHeader();
	});
	
})();



//  section 2  my swiper

  var swiper = new Swiper(".mySwiper", {
	slidesPerView: 4,
	spaceBetween: 30,
	pagination: {
	  el: ".swiper-pagination",
	  clickable: true,
	},
	// autoplay: {
	// delay: 2500,
	// disableOnInteraction: false,
	// },
	  navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	  },
	breakpoints: {
	  320: {
		slidesPerView: 1,
			
	  },

	  480: {
		slidesPerView: 2,
	  },

	  768: {
		slidesPerView: 2,
	  },

	  991: {
		slidesPerView: 3,
	  },

	  1024: {
		slidesPerView: 3,
	  },
	  1200: {
		slidesPerView: 4,
	  },
	}
  });

	// section 3 Category-swiper
 
    var swiper = new Swiper(".Category-swiper", {
      slidesPerView: 6,
      spaceBetween: 30,
      /*autoplay: {
          delay: 2500,
          disableOnInteraction: false,
      },*/
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        320: {
          slidesPerView: 2,
        },

        480: {
          slidesPerView: 2,
        },

        768: {
          slidesPerView: 3,
        },

        1024: {
          slidesPerView: 4,
        },

        1024: {
          slidesPerView: 4,
        },

        1200: {
          slidesPerView: 6,
        },
      }
    });
  
	//  section 4  product-sale

	var swiper = new Swiper(".product-sale", {
		slidesPerView: 4,
		spaceBetween: 30,
		pagination: {
		  el: ".swiper-pagination",
		  clickable: true,
		},
		/*autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		  },*/
	
		  breakpoints: {
			320: {
			  slidesPerView: 1,
			},
	  
			480: {
			  slidesPerView: 2,
			},
	  
			768: {
			  slidesPerView: 2,
			},
	  
			991: {
			  slidesPerView: 3,
			},
	  
			1024: {
			  slidesPerView: 3,
			},
			1200: {
			  slidesPerView: 4,
			},
		  }
	  });

	//  our product 
		var swiper = new Swiper(".our-product-slider", {
		  slidesPerView: 4,
		  spaceBetween: 30,
		  pagination: {
			el: ".swiper-pagination",
			clickable: true,
		  },
		  /*autoplay: {
			  delay: 2500,
			  disableOnInteraction: false,
			},*/
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			  },
			breakpoints: {
				320: {
				  slidesPerView: 1,
				},
		  
				480: {
				  slidesPerView: 2,
				},
		  
				768: {
				  slidesPerView: 2,
				},
		  
				991: {
				  slidesPerView: 3,
				},
		  
				1024: {
				  slidesPerView: 3,
				},
				1200: {
				  slidesPerView: 4,
				},
			  }
		});
	  

		$(function() {
			var $clientslider = $('#clientlogo');
			var clients = $clientslider.children().length;
			var clientwidth = (clients * 220); 
			$clientslider.css('width', clientwidth);
			var rotating = true;
			var clientspeed = 1800;
			var seeclients = setInterval(rotateClients, clientspeed);
			$(document).on({
			  mouseenter: function() {
				rotating = false;
			  },
			  mouseleave: function() {
				rotating = true;
			  }
			}, '#ourclients');
			function rotateClients() {
			  if (rotating != false) {
				var $first = $('#clientlogo li:first');
				$first.animate({
				  'margin-left': '-220px'
				}, 2000, function() {
				  $first.remove().css({
					'margin-left': '0px'
				  });
				  $('#clientlogo li:last').after($first);
				});
			  }
			}
		  });

		  // wishlist-page swiper
		  var swiper = new Swiper(".wishlist-swiper", {
			slidesPerView: 4,
			spaceBetween: 30,
			pagination: {
				el: ".swiper-pagination",
				clickable: true,
			},
			// autoplay: {
			// delay: 2500,
			// disableOnInteraction: false,
			// },
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			breakpoints: {
				320: {
					slidesPerView: 1,
	
				},
	
				480: {
					slidesPerView: 1,
				},
	
				768: {
					slidesPerView: 2,
				},
	
				991: {
					slidesPerView: 2,
				},
	
				1024: {
					slidesPerView: 2,
				},
				1200: {
					slidesPerView: 3,
				},
				1400: {
					slidesPerView: 4,
				},
			}
		});
	
    //just for you / more product swiper
    var swiper = new Swiper(".more-product", {
        slidesPerView: 4,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        autoplay: {
        delay: 2500,
        disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            320: {
                slidesPerView: 1,

            },

            480: {
                slidesPerView: 2,
            },

            768: {
                slidesPerView: 2,
            },

            991: {
                slidesPerView: 3,
            },

            1024: {
                slidesPerView: 3,
            },
            1200: {
                slidesPerView: 3,
            },
            1400: {
                slidesPerView: 4,
            },
        }
    });
