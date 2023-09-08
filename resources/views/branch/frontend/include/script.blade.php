<script src="  {{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="  {{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="../code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="../cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
<script src="  {{ asset('frontend/assets/js/jquery.countup.min.js') }}"></script>
<script type="text/javascript" src="  {{ asset('frontend/assets/fontawesome/js/all.js') }}"></script>
<script>
    $('.counter').countUp();
</script>
<!-- carousel -->
<link rel="stylesheet" href="../cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
<link rel="stylesheet" href="../cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
<script type="text/javascript" src="  {{ asset('frontend/assets/js/jquery-1.9.0.min.html') }}"></script>
<script type="text/javascript" src="  {{ asset('frontend/assets/js/jquery.nivo.slider.pack.html') }}"></script>
<script type="text/javascript" src="../cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
<script>
    $(document).ready(function() {
        $("#testimonial-slider").owlCarousel({
            items: 2,
            itemsDesktop: [1000, 2],
            itemsDesktopSmall: [979, 2],
            itemsTablet: [768, 1],
            itemsMobile: [650, 1],
            pagination: true,
            autoPlay: true,
            dotsContainer: false
        });
    });
</script>
<script src="../unpkg.com/aos%402.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="../cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
<script src="  {{ asset('frontend/assets/js/filter-tags.js') }}"></script>
<script src="../cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>


 

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>     
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>


<script type="text/javascript">
    var a = Math.floor(Math.random() * 10);
    var b = Math.floor(Math.random() * 10);
    var c = a + b;
    $("label[for='search_result']").text(a + ' + ' + b + ' = ?');

    function result_search() {
        var captcha = $("#search_result").val();
        if (captcha == c) {
            document.form.submit();
            return true;
        } else {
            alert('Wrong Captcha! Please try again!');
            return false;
        }
    }
</script>

<script>
    //Get the button
    var mybutton = document.getElementById("bottomToTop");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
