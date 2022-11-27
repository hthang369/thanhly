<footer class="mt-2 bg-dark">
    <div id="iFooter">
        <div class="container-fluid container-lg pt-4">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-12 text-white">
                    @widget('text_footer_info')
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    {!! $footerMenu !!}

                    @widget('text_copyright')
                </div>
                <div class="col-md-3 col-sm-12">
                    @widget('text_ournews')
                </div>
            </div>
        </div>
    </div>
</footer>
<div id="lkw" class="text-center bg-secondary">
    @widget('text_footer')
</div>
