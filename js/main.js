$(() => {
    $('.navbar-hamburger').click(() => {
        $('.navbar-elements').toggle();
    });
    $('#color-mode-switcher').click(function (e) {
        e.preventDefault();
        setMode('dark');
    });
});

const setMode = (mode) => {
    const modeName = mode + 'Mode';
    less.modifyVars({ 
        navbarBgc: `@navbarBgcModes[${modeName}]`
    });
}