const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  // .js('resources/js/app.js', 'public/js')
  // .js('resources/js/app_admin.js', 'public/js');
  // .js('resources/js/databox.js', 'public/js');
  // .js('resources/js/coreui.js', 'public/js');
  // .js('resources/js/nestedSortable.js', 'public/js');
  // .sass('resources/sass/coreui.scss', 'public/css');
  // .sass("resources/sass/home_app.scss", "public/css");
  // .sass("resources/sass/app.scss", "public/css").version();
  // .sass("resources/sass/login.scss", "public/css");
  // .sass("resources/sass/admin.scss", "public/css")
  // .css("resources/sass/bootstrap-multiselect.css", 'public/css/bootstrap-multiselect.css')
  .sass("resources/sass/home_design.scss", "public/css");
  // .sass("resources/sass/login.scss", "public/css").version()
  // .sass("resources/sass/bootstrap-icons.scss", "public/css")
  // .sass("resources/sass/login.scss", "public/css");
//    .sass('resources/sass/system-admin.scss', 'public/css');
//    .sass('resources/sass/gijgo.scss', 'public/css');
// .scripts('resources/js/jquery.mjs.nestedSortable.js', 'public/js/jquery.nestedSortable.js');
// .scripts('resources/js/data-grid.js', 'public/js/data-grid.js').version();
