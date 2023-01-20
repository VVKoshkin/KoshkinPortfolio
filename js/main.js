$(() => {
    let pageTheme = localStorage.getItem('page-theme');
    if (pageTheme == null) pageTheme = 'theme-light';
    setTheme(pageTheme);
    $('.navbar-hamburger').click(() => {
        $('.navbar-elements').toggle();
    });
    $('#color-mode-switcher').click(function (e) {
        e.preventDefault();
        $('html').toggleClass('theme-light theme-dark');
        localStorage.setItem('page-theme', $('html').attr('class'));
    });
});

const setTheme = (themeClass) => {
    $('html').removeClass();
    $('html').addClass(themeClass);
} 