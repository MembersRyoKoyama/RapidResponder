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

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/sendAnswerForm.js", "public/js")
    .js("resources/js/questionTag.js", "public/js")
    .js("resources/js/remodal/remodal.min.js", "public/js")
    .sass("resources/sass/question/index.scss", "public/css")
    .sass("resources/sass/question/confirm.scss", "public/css")
    .sass("resources/sass/question/send.scss", "public/css")
    .sass("resources/sass/staff/login.scss", "public/css")
    .sass("resources/sass/staff/logout.scss", "public/css")
    .sass("resources/sass/staff/email.scss", "public/css")
    .sass("resources/sass/staff/end.scss", "public/css")
    .sass("resources/sass/staff/reset.scss", "public/css")
    .sass("resources/sass/staff/change.scss", "public/css")
    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/sass/answers/confirmation.scss", "public/css")
    .sass("resources/sass/answers/stateChangeButton.scss", "public/css")
    .sass("resources/sass/answers/pagingButton.scss", "public/css")
    .sass("resources/sass/answers/button.scss", "public/css")
    .sass("resources/sass/answers/listItem.scss", "public/css")
    .sass("resources/sass/answers/endIcon.scss", "public/css")
    .sass("resources/sass/answers/questionList.scss", "public/css")
    .sass("resources/sass/answers/questionView.scss", "public/css");
