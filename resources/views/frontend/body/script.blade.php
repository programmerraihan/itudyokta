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

<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
</script>

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

    var mybutton = document.getElementById("bottomToTop");

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

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>



<script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "297138164208387");
    chatbox.setAttribute("attribution", "biz_inbox");
</script>

{{-- <!-- Your SDK code -->
<script>
    window.fbAsyncInit = function() {
        FB.init({
            xfbml: true,
            version: 'v16.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script> --}}



<script>
    ! function() {
        var e, t, n, a;
        window.MyAliceWebChat || ((t = document.createElement("div")).id = "myAliceWebChat", (n = document
                .createElement("script")).type = "text/javascript", n.async = !0, n.src =
            "https://myalice-widget.netlify.app/index.js", (a = (e = document.body.getElementsByTagName("script"))[e
                .length - 1]).parentNode.insertBefore(n, a), a.parentNode.insertBefore(t, a), n.addEventListener(
                "load", (function() {
                    MyAliceWebChat.init({
                        selector: "myAliceWebChat",
                        number: "+8801835816389",
                        message: "Message Us",
                        color: "#25D366",
                        channel: "wa",
                        boxShadow: "none",
                        text: "Message Us",
                        theme: "light",
                        position: "right",
                        mb: "20px",
                        mx: "20px",
                        radius: "20px"
                    })
                })))
    }();
</script>



{{-- <script src="https://apps.elfsight.com/p/platform.js" defer></script> --}}
{{-- <div class="elfsight-app-0d9f3d8d-7154-4aed-b227-113c05688383"></div> --}}
