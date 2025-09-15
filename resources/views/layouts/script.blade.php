<script src="{{ asset('theme/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('theme/assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('theme/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('theme/assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('theme/assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('theme/assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('theme/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{ asset('theme/assets/js/custom/utilities/modals/create-app.js') }}"></script>
<script src="{{ asset('theme/assets/js/custom/utilities/modals/users-search.js') }}"></script>
<script src="{{ asset('theme/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('theme/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
<script src="{{ asset('js/custm.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const toggle = document.getElementById("sidebar-toggle");
    const wrapper = document.getElementById("kt_wrapper"); // may be null on some pages
    if (!sidebar || !toggle) return; // safety

    const SIDEBAR_WIDTH = 240;
    const MOBILE_BREAK = 768;
    let sidebarOpen = window.innerWidth > MOBILE_BREAK; // desktop: open by default, mobile: closed

    // Ensure z-index ordering so overlay sits under sidebar but above content
    sidebar.style.zIndex = '1102';
    toggle.style.zIndex = '1103';

    // Create overlay (used on mobile)
    const overlay = document.createElement('div');
    overlay.id = 'sidebar-overlay';
    overlay.style.position = 'fixed';
    overlay.style.top = '0';
    overlay.style.left = '0';
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.background = 'rgba(0,0,0,0.4)';
    overlay.style.opacity = '0';
    overlay.style.pointerEvents = 'none';
    overlay.style.transition = 'opacity 0.25s ease';
    overlay.style.zIndex = '1100';
    document.body.appendChild(overlay);
    overlay.addEventListener('click', function () {
        // clicking overlay closes the sidebar (mobile)
        if (window.innerWidth <= MOBILE_BREAK && sidebarOpen) {
            sidebarOpen = false;
            updateLayout();
        }
    });

    function positionToggle() {
        const toggleWidth = toggle.offsetWidth || 35;
        if (window.innerWidth <= MOBILE_BREAK) {
            // mobile: place at screen edge so it's always clickable
            toggle.style.left = '10px';
        } else {
            // desktop: place inside the sidebar (10px inset from right edge)
            if (sidebarOpen) {
                const left = SIDEBAR_WIDTH - toggleWidth - 10; // e.g., 240 - 35 - 10 = 195
                toggle.style.left = left + 'px';
            } else {
                // Desktop closed case: put toggle at edge so user can re-open
                toggle.style.left = '10px';
            }
        }
    }

    function updateOverlay() {
        if (window.innerWidth <= MOBILE_BREAK && sidebarOpen) {
            overlay.style.opacity = '1';
            overlay.style.pointerEvents = 'auto';
        } else {
            overlay.style.opacity = '0';
            overlay.style.pointerEvents = 'none';
        }
    }

    function updateLayout() {
        if (window.innerWidth <= MOBILE_BREAK) {
            // Mobile: wrapper should not be offset
            wrapper && (wrapper.style.marginLeft = '0');
            sidebar.style.left = sidebarOpen ? '0px' : `-${SIDEBAR_WIDTH}px`;
        } else {
            // Desktop: sidebar can be open or closed (default open)
            if (sidebarOpen) {
                sidebar.style.left = '0px';
                wrapper && (wrapper.style.marginLeft = SIDEBAR_WIDTH + 'px');
            } else {
                sidebar.style.left = `-${SIDEBAR_WIDTH}px`;
                wrapper && (wrapper.style.marginLeft = '0');
            }
        }

        // position toggle and overlay AFTER the sidebar position updates
        // double RAF ensures CSS layout has updated for accurate measurements
        requestAnimationFrame(() => requestAnimationFrame(() => {
            positionToggle();
            updateOverlay();
            // update icon
            const icon = toggle.querySelector('i');
            if (icon) {
                icon.className = sidebarOpen ? 'bi bi-x' : 'bi bi-list';
            }
        }));
    }

    // initial layout
    updateLayout();

    // handle toggle click
    toggle.addEventListener('click', function () {
        sidebarOpen = !sidebarOpen;
        updateLayout();
    });

    // on resize: adjust behavior and default (desktop -> default open; mobile -> default closed)
    let resizeTimeout = null;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function () {
            // reset default open/closed when crossing breakpoint
            const wasDesktop = (window.innerWidth + 1) > MOBILE_BREAK; // +1 to avoid off-by-one glitches
            if (window.innerWidth > MOBILE_BREAK) {
                // prefer open on desktop
                sidebarOpen = true;
            } else {
                // prefer closed on mobile
                sidebarOpen = false;
            }
            updateLayout();
        }, 80); // small debounce
    });
});
</script>

@stack('script')
