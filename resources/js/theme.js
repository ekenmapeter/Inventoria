// Theme management
(function() {
    const themeKey = 'theme';
    const darkModeClass = 'dark';

    function getTheme() {
        return localStorage.getItem(themeKey) || 
               (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    }

    function setTheme(theme) {
        localStorage.setItem(themeKey, theme);
        if (theme === 'dark') {
            document.documentElement.classList.add(darkModeClass);
        } else {
            document.documentElement.classList.remove(darkModeClass);
        }
    }

    // Initialize theme
    setTheme(getTheme());

    // Expose to window
    window.theme = {
        get: getTheme,
        set: setTheme,
        toggle: () => {
            const newTheme = getTheme() === 'dark' ? 'light' : 'dark';
            setTheme(newTheme);
            return newTheme;
        }
    };
})();

