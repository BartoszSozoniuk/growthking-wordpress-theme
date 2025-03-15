/**
 * GrowthKing Theme Main JS File
 */

(function($) {
    "use strict";
    
    // Header scroll effect
    $(window).on('scroll', function() {
        const header = $('.header');
        
        // Update header style
        if ($(window).scrollTop() > 100) {
            header.addClass('scrolled');
        } else {
            header.removeClass('scrolled');
        }
    });

    // Mobile menu toggle
    const mobileMenuBtn = $('.mobile-menu-btn');
    const navLinks = $('.nav-links');

    if (mobileMenuBtn.length && navLinks.length) {
        mobileMenuBtn.on('click', function() {
            navLinks.toggleClass('active');
        });
    }
    
    // Workflow animation
    $(document).ready(function() {
        // Obserwator do wykrywania widoczności elementów
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.3 });
            
            // Obserwuj wszystkie kroki procesu
            const steps = document.querySelectorAll('.workflow-step');
            steps.forEach(step => {
                observer.observe(step);
            });
        } else {
            // Fallback dla starszych przeglądarek
            $('.workflow-step').addClass('visible');
        }
        
        // Animacja linii postępu podczas przewijania
        function updateProgressLine() {
            const container = $('.workflow-container');
            const progressLine = $('.workflow-line-progress');
            
            if (!container.length || !progressLine.length) return;
            
            const containerTop = container.offset().top;
            const containerHeight = container.height();
            const windowHeight = $(window).height();
            const scrollTop = $(window).scrollTop();
            
            let progress = 0;
            
            if (containerTop < windowHeight + scrollTop) {
                // Oblicz postęp na podstawie przewinięcia
                const visiblePart = windowHeight + scrollTop - containerTop;
                progress = Math.min(visiblePart / containerHeight * 1.5, 1);
            }
            
            progressLine.css('height', `${progress * 100}%`);
        }
        
        // Wywołaj funkcję przy przewijaniu
        $(window).on('scroll', updateProgressLine);
        // Wywołaj raz na starcie
        updateProgressLine();
    });
    
    // Theme Toggle
    $(document).ready(function() {
        const themeToggle = $('.theme-toggle');
        const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
        
        // Sprawdź preferencje systemu lub zapisane ustawienia
        if (localStorage.getItem('theme') === 'dark' || 
            (prefersDarkScheme.matches && !localStorage.getItem('theme'))) {
            $('body').addClass('dark-mode');
            updateToggleIcon(true);
        } else {
            $('body').removeClass('dark-mode');
            updateToggleIcon(false);
        }
        
        // Obsługa kliknięcia przycisku
        themeToggle.on('click', function() {
            if ($('body').hasClass('dark-mode')) {
                $('body').removeClass('dark-mode');
                localStorage.setItem('theme', 'light');
                updateToggleIcon(false);
            } else {
                $('body').addClass('dark-mode');
                localStorage.setItem('theme', 'dark');
                updateToggleIcon(true);
            }
        });
        
        // Aktualizacja ikony w zależności od trybu
        function updateToggleIcon(isDark) {
            const icon = themeToggle.find('svg');
            if (isDark) {
                icon.html('<circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>');
            } else {
                icon.html('<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>');
            }
        }
        
        // Obsługa zmiany preferencji systemu
        if (prefersDarkScheme.addEventListener) {
            prefersDarkScheme.addEventListener('change', function(e) {
                if (e.matches) {
                    $('body').addClass('dark-mode');
                    updateToggleIcon(true);
                } else {
                    $('body').removeClass('dark-mode');
                    updateToggleIcon(false);
                }
            });
        }
    });
    
})(jQuery);
