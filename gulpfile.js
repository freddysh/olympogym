const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.copy('node_modules/fullcalendar/dist/fullcalendar.css','resources/assets/css/vendors');
mix.copy('node_modules/fullcalendar/dist/fullcalendar.print.css','resources/assets/css/vendors');
    mix.copy('node_modules/fullcalendar/dist/fullcalendar.js','resources/assets/js/vendors');
mix.copy('node_modules/fullcalendar/dist/locale/es.js','resources/assets/js/vendors');
    mix.copy('node_modules/moment/min/moment.min.js','resources/assets/js/vendors');
mix.styles([
    'vendors/sweetalert2.css',
    'resources/assets/css/vendors/mis_estilos.css',
    // 'resources/assets/css/vendors/fullcalendar.css',
], 'public/css/stilos.css');
mix.styles([
    'resources/assets/css/vendors/fullcalendar.css'
], 'public/css/fullcalendar.css');
mix.styles([
    'resources/assets/css/vendors/fullcalendar.print.css'
], 'public/css/fullcalendar.print.css');
mix.scripts([
    'vendors/sweetalert2.js',
], 'public/js/funciones.js');
mix.scripts([
    'resources/assets/js/vendors/moment.min.js'
], 'public/js/moment.min.js');
mix.scripts([
    'resources/assets/js/vendors/fullcalendar.js',
    'resources/assets/js/vendors/es.js'
], 'public/js/fullcalendar.js');
mix.sass('app.scss')
        // .sass('plugins/jvectormap/jquery-jvectormap-1.2.2.css')
        // .sass('dist/css/AdminLTE.min.css')
    .webpack('app.js'),
    mix.scripts([
        'resources/assets/js/myjava.js',
        // 'resources/assets/js/vendors/fullcalendar.js'
    ], 'public/js/myjava.js')
    // mix.scripts([
    //     'plugins/jQuery/jquery-2.2.3.min.js',
    //     'bootstrap/js/bootstrap.min.js',
    //     'plugins/fastclick/fastclick.min.js',
    //     'dist/js/app.min.js',
    //     'plugins/sparkline/jquery.sparkline.min.js',
    //     'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
    //     'plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
    //     'plugins/slimScroll/jquery.slimscroll.min.js',
    //     'plugins/chartjs/Chart.min.js',
    //     'dist/js/pages/dashboard2.js',
    //     'dist/js/demo.js',
    // ], 'public/js/mesclas.js');

});
