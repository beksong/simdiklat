const mix = require('laravel-mix');

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

// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');
mix.styles([
   'public/bootstrap/dist/css/bootstrap.min.css',
   'public/font-awesome/css/font-awesome.css',
   'public/Ionicons/css/ionicons.min.css',
   'public/datatables.net-bs/css/dataTables.bootstrap.min.css',
   'public/datatables-buttons/buttons.dataTables.min.css',
   'public/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
   'public/bootstrap-daterangepicker/daterangepicker.css',
   'public/select2/dist/css/select2.min.css',
   'public/dist/css/AdminLTE.min.css',
   'public/dist/css/skins/_all-skins.min.css'
],'public/css/app.css')
   .scripts([
      'public/jquery/dist/jquery.min.js',
      'public/jquery-ui/jquery-ui.min.js',
      'public/bootstrap/dist/js/bootstrap.min.js',
      'public/datatables.net/js/jquery.dataTables.min.js',
      'public/datatables.net-bs/js/dataTables.bootstrap.min.js',
      'public/datatables-buttons/dataTables.buttons.min.js',
      'public/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
      'public/bootstrap-daterangepicker/moment.min.js',
      'public/bootstrap-daterangepicker/daterangepicker.js',
      'public/select2/dist/js/select2.full.min.js',
      'public/fastclick/lib/fastclick.js',
      'public/dist/js/adminlte.min.js',
      'public/jquery-sparkline/dist/jquery.sparkline.min.js',
      'public/jquery-slimscroll/jquery.slimscroll.min.js'
   ],'public/js/app.js');