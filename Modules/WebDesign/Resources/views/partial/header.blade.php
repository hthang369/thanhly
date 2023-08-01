<section id="topbar" class="d-flex align-items-center bg-white">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            @widget('text_top_herder')
        </div>

        <div class="social-links d-none d-md-flex">
            @widget('text_header_social')
        </div>
    </div>
</section>

<header id="header" class="d-flex align-items-center bg-white sticky-top">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="logo d-none d-md-block">
            <a href="/"><img src="{{ asset("storage/images/$webLogo") }}" /></a>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav id="navbar" class="navbar navbar-expand-lg navbar-light">
            <div class="logo d-block d-sm-none">
                <a href="/"><img src="{{ asset("storage/images/$webLogo") }}" /></a>
            </div>
            {!! $menus !!}
        </nav><!-- .navbar -->
        </div>
</header>
