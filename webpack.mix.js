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

 mix.js('resources/js/app.js', 'public/js')
//  .vue()
 .sass('resources/sass/app.scss', 'public/css')
 .version()
 .sourceMaps();
mix.disableNotifications();
// mix.version(['public/js/resizeProducts.js', 'public/js/resize.js', 'public/js/resizeAlbum.js', 'public/js/resizeProducts.js', 'public/js/addToAlbum.js', 'public/js/addToProduct.js', 'public/js/uploadAlbum.js', 'public/js/uploadPhoto.js', 'public/js/uploadProduct.js', 'public/js/blockUnblock.js', 'public/js/changePassword.js', 'public/js/comment.js', 'public/js/deleteInvalid.js', 'public/js/detectMobile.js', 'public/js/droparea.js', 'public/js/editbio.js', 'public/js/filterBar.js', 'public/js/followUser.js', 'public/js/like.js', 'public/js/likeOnPhotoThumb.js', 'public/js/profilephoto.js', 'public/js/receiveMessages.js', 'public/js/replyBox.js', 'public/js/reportitem.js', 'public/js/resizeupload.js', 'public/js/sendmessage.js', 'public/js/updateTags.js']);
