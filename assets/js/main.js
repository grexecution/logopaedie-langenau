/**
 * Main JavaScript file for Logopädie Langenau Theme
 *
 * @package Logopaedie_Langenau
 */

(function() {
    'use strict';

    /**
     * DOM Ready
     */
    document.addEventListener('DOMContentLoaded', function() {
        initMobileMenu();
        initStickyHeader();
        initSmoothScroll();
        initAccessibility();
        initJobFunnel();
    });

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        const menuToggle = document.querySelector('.menu-toggle');
        const navigation = document.querySelector('.header-nav');

        if (!menuToggle || !navigation) {
            return;
        }

        menuToggle.addEventListener('click', function() {
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';

            menuToggle.setAttribute('aria-expanded', !isExpanded);
            navigation.classList.toggle('is-active');
            document.body.classList.toggle('menu-open');

            // Toggle menu icon animation
            menuToggle.classList.toggle('is-active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!navigation.contains(event.target) && !menuToggle.contains(event.target)) {
                menuToggle.setAttribute('aria-expanded', 'false');
                navigation.classList.remove('is-active');
                document.body.classList.remove('menu-open');
                menuToggle.classList.remove('is-active');
            }
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && navigation.classList.contains('is-active')) {
                menuToggle.setAttribute('aria-expanded', 'false');
                navigation.classList.remove('is-active');
                document.body.classList.remove('menu-open');
                menuToggle.classList.remove('is-active');
                menuToggle.focus();
            }
        });

        // Handle sub-menu toggle on mobile
        const menuItemsWithChildren = navigation.querySelectorAll('.menu-item-has-children > a');

        menuItemsWithChildren.forEach(function(menuItem) {
            menuItem.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    const parent = this.parentElement;
                    const subMenu = parent.querySelector('.sub-menu');

                    if (subMenu) {
                        event.preventDefault();
                        parent.classList.toggle('sub-menu-open');
                    }
                }
            });
        });
    }

    /**
     * Sticky Header on Scroll
     */
    function initStickyHeader() {
        const header = document.querySelector('.site-header');

        if (!header) {
            return;
        }

        let lastScrollTop = 0;
        const scrollThreshold = 100;

        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // Add scrolled class when scrolled past threshold
            if (scrollTop > scrollThreshold) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            // Optional: Hide header on scroll down, show on scroll up
            // Uncomment if you want this behavior
            /*
            if (scrollTop > lastScrollTop && scrollTop > 200) {
                header.classList.add('header-hidden');
            } else {
                header.classList.remove('header-hidden');
            }
            */

            lastScrollTop = scrollTop;
        }, { passive: true });
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]:not([href="#"])');

        anchorLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    event.preventDefault();

                    const headerHeight = document.querySelector('.site-header').offsetHeight || 0;
                    const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Update URL without jumping
                    history.pushState(null, null, targetId);
                }
            });
        });
    }

    /**
     * Accessibility Enhancements
     */
    function initAccessibility() {
        // Add focus styles for keyboard navigation
        document.body.addEventListener('keydown', function(event) {
            if (event.key === 'Tab') {
                document.body.classList.add('keyboard-navigation');
            }
        });

        document.body.addEventListener('mousedown', function() {
            document.body.classList.remove('keyboard-navigation');
        });

        // Skip link functionality
        const skipLink = document.querySelector('.skip-link');
        if (skipLink) {
            skipLink.addEventListener('click', function(event) {
                event.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.setAttribute('tabindex', '-1');
                    target.focus();
                }
            });
        }
    }

    /**
     * Lazy Load Images (if not using native lazy loading)
     */
    function initLazyLoad() {
        if ('IntersectionObserver' in window) {
            const lazyImages = document.querySelectorAll('img[data-src]');

            const imageObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        if (img.dataset.srcset) {
                            img.srcset = img.dataset.srcset;
                        }
                        img.classList.add('loaded');
                        imageObserver.unobserve(img);
                    }
                });
            });

            lazyImages.forEach(function(img) {
                imageObserver.observe(img);
            });
        }
    }

    /**
     * Animate Elements on Scroll
     */
    function initScrollAnimations() {
        if ('IntersectionObserver' in window) {
            const animateElements = document.querySelectorAll('.animate-on-scroll');

            const animateObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                        animateObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            animateElements.forEach(function(element) {
                animateObserver.observe(element);
            });
        }
    }

    /**
     * Job Funnel Multi-Step Form
     */
    function initJobFunnel() {
        const funnelSection = document.querySelector('.jobfunnel-section');
        if (!funnelSection) return;

        // Generate or retrieve session ID
        let sessionId = localStorage.getItem('jobfunnel_session');
        if (!sessionId) {
            sessionId = 'jf_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
            localStorage.setItem('jobfunnel_session', sessionId);
        }

        // State
        let currentStep = 1;
        let selectedRole = null;
        const answers = {};

        // DOM Elements
        const steps = funnelSection.querySelectorAll('.funnel-step');
        const progressFill = funnelSection.querySelector('.progress-fill');
        const progressSteps = funnelSection.querySelectorAll('.progress-step');

        // Reaction messages
        const reactions = {
            1: {
                'leeres_blatt': 'Ein guter Moment. Wir geben dir Sicherheit und ein ruhiges Ankommen.',
                'guter_text': 'Schöne Haltung. Entwicklung bekommt bei uns echten Raum.',
                'weiterschreiben': 'Verstanden. Dann schauen wir, wie ein Wechsel sich stimmig anfühlt.',
                'notizen': 'Alles gut. Wir gehen das klar und ohne Hektik an.'
            },
            2: {
                'struktur': 'Genau das ist unser Anspruch im Alltag.',
                'team': 'Das ist bei uns kein Wunsch – das ist unsere Basis.',
                'impulse': 'Tiefe statt Konkurrenzdenken — das können wir gut.',
                'ruhe': 'Zeit für gute Arbeit ist uns wichtig.',
                'abwechslung': 'Bekommst du — ohne Chaos.',
                'entwicklung': 'Entwicklungsgespräche und Fortbildung sind bei uns verlässlich.'
            },
            3: {
                'zeit_fuer_mich': 'Zeit für sich ist ein wichtiger Ausgleich – das unterstützen wir bewusst.',
                'weniger_hinher': 'Ein klarer, gut planbarer Alltag hilft enorm beim Durchatmen.',
                'flexibilitaet': 'Flexibilität ist bei uns keine Ausnahme, sondern Teil der Organisation.',
                'leichte_arbeit': 'Wir achten auf ein Tempo, das realistisch und gut machbar ist.'
            }
        };

        // Initialize option listeners
        funnelSection.querySelectorAll('.funnel-option input').forEach(function(input) {
            input.addEventListener('change', function() {
                const step = this.closest('.funnel-step');
                const stepNum = step.dataset.step;
                const nextBtn = step.querySelector('.funnel-next');

                // Enable next button
                if (nextBtn) {
                    nextBtn.disabled = false;
                }

                // Store answer
                answers[stepNum] = this.value;

                // Show reaction message for steps 1-3
                if (['1', '2', '3'].includes(stepNum) && reactions[stepNum]) {
                    const reactionDiv = step.querySelector('.funnel-reaction');
                    if (reactionDiv && reactions[stepNum][this.value]) {
                        reactionDiv.textContent = reactions[stepNum][this.value];
                        reactionDiv.style.display = 'block';
                    }
                }

                // Save step to server
                saveStep(stepNum, this.value);
            });
        });

        // Next button listeners
        funnelSection.querySelectorAll('.funnel-next').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const currentStepEl = this.closest('.funnel-step');
                const stepNum = currentStepEl.dataset.step;

                // Determine next step
                let nextStep;

                if (stepNum === '3') {
                    nextStep = '3b';
                } else if (stepNum === '3b') {
                    nextStep = '4';
                } else if (stepNum === '4') {
                    nextStep = '5';
                } else if (stepNum === '5') {
                    nextStep = '6';
                } else {
                    nextStep = String(parseInt(stepNum) + 1);
                }

                goToStep(nextStep);
            });
        });

        // Back button listeners
        funnelSection.querySelectorAll('.funnel-back').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const currentStepEl = this.closest('.funnel-step');
                const stepNum = currentStepEl.dataset.step;

                // Determine previous step
                let prevStep;

                if (stepNum === '3b') {
                    prevStep = '3';
                } else if (stepNum === '4') {
                    prevStep = '3b';
                } else if (stepNum === '5') {
                    prevStep = '4';
                } else if (stepNum === '6') {
                    prevStep = '5';
                } else {
                    prevStep = String(parseInt(stepNum) - 1);
                }

                goToStep(prevStep);
            });
        });

        // Initialize progress bar for step 1
        updateProgress('1');

        // Contact form submission
        const contactForm = document.getElementById('funnel-contact-form');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const name = formData.get('name');
                const email = formData.get('email');
                const phone = formData.get('phone');
                const message = formData.get('message');

                // Save contact info
                saveContactInfo(name, email, phone, message);
            });
        }

        // Go to step function
        function goToStep(stepId) {
            // Hide all steps
            steps.forEach(function(step) {
                step.classList.remove('active');
            });

            // Show target step
            const targetStep = funnelSection.querySelector('.funnel-step[data-step="' + stepId + '"]');
            if (targetStep) {
                targetStep.classList.add('active');

                // Scroll to funnel section
                const headerHeight = document.querySelector('.site-header')?.offsetHeight || 80;
                const funnelTop = funnelSection.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                window.scrollTo({ top: funnelTop, behavior: 'smooth' });
            }

            // Update progress
            updateProgress(stepId);
        }

        // Update progress bar
        function updateProgress(stepId) {
            // Calculate progress percentage
            const stepMap = {
                '1': 0.5, '2': 1, '3': 2, '3b': 2.5, '4': 3, '5': 4, '6': 5
            };
            const progressNum = stepMap[stepId] || 0;
            const percentage = (progressNum / 5) * 100;

            progressFill.style.width = percentage + '%';

            // Update step indicators
            progressSteps.forEach(function(step, index) {
                const stepNum = index + 1;
                step.classList.remove('active', 'completed');

                if (progressNum >= stepNum) {
                    step.classList.add('completed');
                }
                if (Math.floor(progressNum) + 1 === stepNum || stepId === '3b' && stepNum === 3) {
                    step.classList.add('active');
                }
            });
        }

        // Save step to server
        function saveStep(step, answer) {
            if (typeof logopaedie_ajax === 'undefined') return;

            const formData = new FormData();
            formData.append('action', 'jobfunnel_save_step');
            formData.append('nonce', logopaedie_ajax.nonce);
            formData.append('session_id', sessionId);
            formData.append('step', step);
            formData.append('answer', answer);

            fetch(logopaedie_ajax.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Step ' + step + ' saved');
                }
            })
            .catch(error => {
                console.error('Error saving step:', error);
            });
        }

        // Save contact info
        function saveContactInfo(name, email, phone, message) {
            if (typeof logopaedie_ajax === 'undefined') return;

            const submitBtn = contactForm.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Wird gesendet...';

            const formData = new FormData();
            formData.append('action', 'jobfunnel_save_step');
            formData.append('nonce', logopaedie_ajax.nonce);
            formData.append('session_id', sessionId);
            formData.append('step', '6');
            formData.append('answer', selectedRole || '');
            formData.append('name', name);
            formData.append('email', email);
            formData.append('phone', phone);
            formData.append('message', message);

            fetch(logopaedie_ajax.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Clear session for new submissions
                    localStorage.removeItem('jobfunnel_session');
                    // Go to thank you step
                    goToStep('7');
                } else {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Absenden';
                    alert('Ein Fehler ist aufgetreten. Bitte versuche es erneut.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                submitBtn.disabled = false;
                submitBtn.textContent = 'Absenden';
                alert('Ein Fehler ist aufgetreten. Bitte versuche es erneut.');
            });
        }
    }

})();
