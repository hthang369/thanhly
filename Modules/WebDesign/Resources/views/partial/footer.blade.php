<footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>{{ data_get($infoSettings, 'info.web_name') }}</h3>
              <p> {{ data_get($infoSettings, 'info.web_address') }}<br>
                <strong>Phone:</strong> {{ data_get($infoSettings, 'info.web_phone') }}<br>
                <strong>Email:</strong> {{ data_get($infoSettings, 'info.web_email') }}<br>
              </p>
              <div class="social-links mt-3">
                @widget('text_footer_social')
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 col-6 footer-links">
            <h4>Useful Links</h4>
            {!! $footerMenu !!}
          </div>

          <div class="col-lg-3 col-md-6 col-6 footer-links">
            <h4>Our Services</h4>
            {!! $footerOurMenu !!}
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <div class="widget_content">@widget('text_ournews')</div>
          </div>

        </div>
      </div>
    </div>

    <div class="container text-center">
      <div class="copyright">
        @widget('text_copyright')
      </div>
      <div class="credits">
          @widget('text_footer')
      </div>
    </div>
  </footer>
