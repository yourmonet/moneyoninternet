<style>
/* NProgress CSS */
#nprogress { pointer-events: none; }
#nprogress .bar { background: #0ea5e9; position: fixed; z-index: 9999; top: 0; left: 0; width: 100%; height: 4px; }
#nprogress .peg { display: block; position: absolute; right: 0px; width: 100px; height: 100%; box-shadow: 0 0 10px #0ea5e9, 0 0 5px #0ea5e9; opacity: 1.0; transform: rotate(3deg) translate(0px, -4px); }
/* Custom button loading state */
.btn-loading { position: relative !important; color: transparent !important; pointer-events: none !important; }
.btn-loading::after {
    content: ''; position: absolute; left: 50%; top: 50%;
    width: 20px; height: 20px; border: 2px solid rgba(255,255,255,0.3);
    border-radius: 50%; border-top-color: #fff;
    animation: spin 0.8s linear infinite; transform: translate(-50%, -50%);
}
@keyframes spin { to { transform: translate(-50%, -50%) rotate(360deg); } }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    if (typeof NProgress !== 'undefined') {
        NProgress.configure({ showSpinner: false });
        
        // Bind Toploader to all links
        document.querySelectorAll('a:not([target="_blank"]):not([href^="#"]):not([href^="javascript:"]):not([onclick])').forEach(link => {
            link.addEventListener('click', (e) => {
                if(!e.ctrlKey && !e.metaKey && !e.defaultPrevented) NProgress.start();
            });
        });

        // Button spinners for all forms
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if(!e.defaultPrevented) {
                    NProgress.start();
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if(submitBtn) {
                        submitBtn.classList.add('btn-loading');
                    }
                }
            });
        });
    }
});
window.addEventListener('pageshow', function(e) {
    if (typeof NProgress !== 'undefined') {
        NProgress.done();
        document.querySelectorAll('.btn-loading').forEach(btn => btn.classList.remove('btn-loading'));
    }
});
</script>
