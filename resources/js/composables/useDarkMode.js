import { ref, watch, onMounted } from 'vue';

const isDark = ref(false);

export function useDarkMode() {
    const getInitialDarkMode = () => {
        // Check localStorage first
        const stored = localStorage.getItem('darkMode');

        if (stored !== null) {
            return stored === 'true';
        }

        // Fall back to system preference
        return window.matchMedia('(prefers-color-scheme: dark)').matches;
    };

    const applyDarkMode = (dark) => {
        if (dark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    };

    const toggleDarkMode = () => {
        isDark.value = !isDark.value;
    };

    // Watch for changes and persist to localStorage
    watch(isDark, (newValue) => {
        localStorage.setItem('darkMode', newValue.toString());
        applyDarkMode(newValue);
    });

    // Initialize on first use
    const initialize = () => {
        isDark.value = getInitialDarkMode();
        applyDarkMode(isDark.value);

        // Optional: Listen for system preference changes
        const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
        const handleChange = (e) => {
            // Only update if user hasn't set a preference
            if (localStorage.getItem('darkMode') === null) {
                isDark.value = e.matches;
            }
        };

        mediaQuery.addEventListener('change', handleChange);
    };

    return {
        isDark,
        toggleDarkMode,
        initialize
    };
}
