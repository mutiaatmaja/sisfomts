window.addEventListener("load", function(){

    // Remove Loader
    var load_screen = document.getElementById("load_screen");
    document.body.removeChild(load_screen);

    var layoutName = 'Modern Light Menu';

    var settingsObject = {
        admin: 'Admin Template',
        settings: {
            layout: {
                name: layoutName,
                toggle: true,
                darkMode: false,
                boxed: true,
                logo: {
                    darkLogo: window.appLogos.dark,
                    lightLogo: window.appLogos.light
                }
            }
        },
        reset: false
    }
    var corkThemeObject = {
        admin: 'Admin Template',
        settings: {
            layout: {
                name: layoutName,
                toggle: true,
                darkMode: false,
                boxed: true,
                logo: {
                    darkLogo: window.appLogos.dark,
                    lightLogo: window.appLogos.light
                }
            }
        },
        reset: false
    }


    if (settingsObject.reset) {
        localStorage.clear()
    }

    if (localStorage.length === 0) {
        corkThemeObject = settingsObject;
    } else {

        getcorkThemeObject = localStorage.getItem("theme");
        getParseObject = JSON.parse(getcorkThemeObject)
        ParsedObject = getParseObject;

        if (getcorkThemeObject !== null) {

            if (ParsedObject.admin === 'Cork Admin Template') {

                if (ParsedObject.settings.layout.name === layoutName) {

                    corkThemeObject = ParsedObject;
                } else {
                    corkThemeObject = settingsObject;
                }

            } else {
                if (ParsedObject.admin === undefined) {
                    corkThemeObject = settingsObject;
                }
            }

        }  else {
            corkThemeObject = settingsObject;
        }
    }

    // Get Dark Mode Information i.e darkMode: true or false

    if (corkThemeObject.settings.layout.darkMode) {
        localStorage.setItem("theme", JSON.stringify(corkThemeObject));
        getcorkThemeObject = localStorage.getItem("theme");
        getParseObject = JSON.parse(getcorkThemeObject)

        if (getParseObject.settings.layout.darkMode) {
            ifStarterKit = document.body.getAttribute('page') === 'starter-pack' ? true : false;
            document.body.classList.add('dark');
            if (ifStarterKit) {
                if (document.querySelector('.navbar-logo')) {
                    document.querySelector('.navbar-logo').setAttribute('src', getParseObject.settings.layout.logo.darkLogo)
                }
            } else {
                if (document.querySelector('.navbar-logo')) {
                    document.querySelector('.navbar-logo').setAttribute('src', getParseObject.settings.layout.logo.darkLogo)
                }
            }
        }
    } else {
        localStorage.setItem("theme", JSON.stringify(corkThemeObject));
        getcorkThemeObject = localStorage.getItem("theme");
        getParseObject = JSON.parse(getcorkThemeObject)

        if (!getParseObject.settings.layout.darkMode) {
            ifStarterKit = document.body.getAttribute('page') === 'starter-pack' ? true : false;
            document.body.classList.remove('dark');
            if (ifStarterKit) {
                if (document.querySelector('.navbar-logo')) {
                    document.querySelector('.navbar-logo').setAttribute('src', getParseObject.settings.layout.logo.darkLogo)
                }
            } else {
                if (document.querySelector('.navbar-logo')) {
                    document.querySelector('.navbar-logo').setAttribute('src', getParseObject.settings.layout.logo.lightLogo)
                }
            }

        }
    }

    // Get Layout Information i.e boxed: true or false

    if (corkThemeObject.settings.layout.boxed) {

        localStorage.setItem("theme", JSON.stringify(corkThemeObject));
        getcorkThemeObject = localStorage.getItem("theme");
        getParseObject = JSON.parse(getcorkThemeObject)

        if (getParseObject.settings.layout.boxed) {

            if (document.body.getAttribute('layout') !== 'full-width') {
                document.body.classList.add('layout-boxed');
                if (document.querySelector('.header-container')) {
                    document.querySelector('.header-container').classList.add('container-xxl');
                }
                if (document.querySelector('.middle-content')) {
                    document.querySelector('.middle-content').classList.add('container-xxl');
                }
            } else {
                document.body.classList.remove('layout-boxed');
                if (document.querySelector('.header-container')) {
                    document.querySelector('.header-container').classList.remove('container-xxl');
                }
                if (document.querySelector('.middle-content')) {
                    document.querySelector('.middle-content').classList.remove('container-xxl');
                }
            }

        }

    } else {

        localStorage.setItem("theme", JSON.stringify(corkThemeObject));
        getcorkThemeObject = localStorage.getItem("theme");
        getParseObject = JSON.parse(getcorkThemeObject)

        if (!getParseObject.settings.layout.boxed) {

            if (document.body.getAttribute('layout') !== 'boxed') {
                document.body.classList.remove('layout-boxed');
                if (document.querySelector('.header-container')) {
                    document.querySelector('.header-container').classList.remove('container-xxl');
                }
                if (document.querySelector('.middle-content')) {
                    document.querySelector('.middle-content').classList.remove('container-xxl');
                }
            } else {
                document.body.classList.add('layout-boxed');
                if (document.querySelector('.header-container')) {
                    document.querySelector('.header-container').classList.add('container-xxl');
                }
                if (document.querySelector('.middle-content')) {
                    document.querySelector('.middle-content').classList.add('container-xxl');
                }
            }
        }
    }





});

