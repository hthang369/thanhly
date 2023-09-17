<header class="container-fluid container-lg">
    <div id="iHeader" class="row">
        <div class="col">
            <div id="ilogo" class="d-flex justify-content-between py-2">
                <a href="/"><x-image src="{{ image_asset(data_get($infoSettings, 'home.web_logo')) }}" fluid lazyload height="110" /></a>
                <a href="/"><x-image src="{{ image_asset(data_get($infoSettings, 'home.web_banner')) }}" fluid lazyload height="110" /></a>
            </div>
        </div>
    </div>
</header>

<nav class="bg-primary">
    <div id="iTopmenu" class="container-lg">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary ps-sm-0 py-1">
            {!! $menus !!}

            <form class="form-inline my-2 my-lg-0 d-none d-lg-block">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </nav>
    </div>
</nav>
