
    // document.addEventListener('DOMContentLoaded', function () {
    //     const swiper = new Swiper('.bg-slider', {
    //         loop: true, // Enable looping
    //         effect: 'fade', // Add a fade effect between slides
    //         autoplay: {
    //             delay: 5000, // Delay between slides (in milliseconds)
    //             disableOnInteraction: false, // Allow autoplay to continue after user interaction
    //         },
    //         pagination: {
    //             el: '.swiper-pagination', // Add pagination if needed
    //             clickable: true,
    //         },
    //         navigation: {
    //             nextEl: '.swiper-button-next', // Add next button if needed
    //             prevEl: '.swiper-button-prev', // Add previous button if needed
    //         },
    //         on: {
    //             // Play video when the slide becomes active
    //             slideChange: function () {
    //                 const activeSlide = this.slides[this.activeIndex];
    //                 const video = activeSlide.querySelector('video');
    //                 if (video) {
    //                     video.play();
    //                 }
    //             },
    //             // Pause video when leaving the slide
    //             slideChangeTransitionEnd: function () {
    //                 const previousSlide = this.slides[this.previousIndex];
    //                 const video = previousSlide.querySelector('video');
    //                 if (video) {
    //                     video.pause();
    //                     video.currentTime = 0; // Reset video to the start
    //                 }
    //             },
    //         },
    //     });
    // });


    document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('.bg-slider', {
            loop: true, // Enable looping
            effect: 'fade', // Add a fade effect between slides
            autoplay: {
                delay: 5000, // Delay between slides (in milliseconds)
                disableOnInteraction: false, // Allow autoplay to continue after user interaction
            },
            pagination: {
                el: '.swiper-pagination', // Add pagination if needed
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next', // Add next button if needed
                prevEl: '.swiper-button-prev', // Add previous button if needed
            },
            on: {
                // Play video when the slide becomes active
                slideChange: function () {
                    const activeSlide = this.slides[this.activeIndex];
                    const video = activeSlide.querySelector('video');
                    if (video) {
                        video.play();
                    }
                },
                // Pause video when leaving the slide
                slideChangeTransitionEnd: function () {
                    const previousSlide = this.slides[this.previousIndex];
                    const video = previousSlide.querySelector('video');
                    if (video) {
                        video.pause();
                        video.currentTime = 0; // Reset video to the start
                    }
                },
            },
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const navMenuBtn = document.querySelector(".nav-menu-btn");
        const navCloseBtn = document.querySelector(".nav-close-btn");
        const navigation = document.querySelector(".navigation");
    
        if (navMenuBtn && navCloseBtn && navigation) {
            // Open menu on click
            navMenuBtn.addEventListener("click", function () {
                navigation.classList.add("active");
            });
    
            // Close menu on click
            navCloseBtn.addEventListener("click", function () {
                navigation.classList.remove("active");
            });
    
            // Close menu when clicking outside
            document.addEventListener("click", function (event) {
                if (!navigation.contains(event.target) && !navMenuBtn.contains(event.target)) {
                    navigation.classList.remove("active");
                }
            });
        } else {
            console.error("Navigation elements not found. Check your class names.");
        }
    });
    