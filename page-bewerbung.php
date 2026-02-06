<?php
/**
 * Template Name: Bewerbung
 *
 * Application page with JotForm embed
 *
 * @package Logopaedie_Langenau
 */

get_header();

// Get values from page meta (editable in page edit screen)
$jotform_url = get_post_meta(get_the_ID(), '_bewerbung_jotform_url', true);
$page_subtitle = get_post_meta(get_the_ID(), '_bewerbung_subtitle', true);
$page_title = get_the_title();

// Defaults
if (empty($jotform_url)) {
    $jotform_url = 'https://eu.jotform.com/form/253174501663353';
}
if (empty($page_subtitle)) {
    $page_subtitle = 'Fülle das Formular aus und wir melden uns bei dir!';
}

// Extract form ID from URL for iframe ID
$form_id = '';
if (preg_match('/form\/(\d+)/', $jotform_url, $matches)) {
    $form_id = $matches[1];
}
?>

<section class="bewerbung-section">
    <div class="bewerbung-container">
        <div class="bewerbung-header">
            <h1><?php echo esc_html($page_title); ?></h1>
            <p><?php echo esc_html($page_subtitle); ?></p>
        </div>

        <div class="bewerbung-form">
            <iframe
                id="JotFormIFrame-<?php echo esc_attr($form_id); ?>"
                title="Bewerbungsformular Logopädie Langenau"
                onload="window.parent.scrollTo(0,0)"
                allowtransparency="true"
                allow="geolocation; microphone; camera; fullscreen"
                src="<?php echo esc_url($jotform_url); ?>"
                frameborder="0"
                scrolling="no"
            ></iframe>
        </div>
    </div>
</section>

<script>
    // JotForm iframe auto-resize
    var jotformId = "<?php echo esc_js($form_id); ?>";
    var ifr = document.getElementById("JotFormIFrame-" + jotformId);
    if (ifr) {
        var src = ifr.src;
        var iframeParams = [];
        if (window.location.href && window.location.href.indexOf("?") > -1) {
            iframeParams = iframeParams.concat(window.location.href.substr(window.location.href.indexOf("?") + 1).split('&'));
        }
        if (iframeParams.length > 0) {
            src = src + (src.indexOf("?") > -1 ? "&" : "?") + iframeParams.join("&");
        }
        ifr.src = src;
    }
    window.handleIFrameMessage = function(e) {
        if (typeof e.data === 'object') { return; }
        var args = e.data.split(":");
        var iframe;
        if (args.length > 2) { iframe = document.getElementById("JotFormIFrame-" + args[(args.length - 1)]); } else { iframe = document.getElementById("JotFormIFrame-" + jotformId); }
        if (!iframe) { return; }
        switch (args[0]) {
            case "scrollIntoView":
                iframe.scrollIntoView();
                break;
            case "setHeight":
                iframe.style.height = args[1] + "px";
                if (!isNaN(args[1]) && parseInt(iframe.style.minHeight) > parseInt(args[1])) {
                    iframe.style.minHeight = args[1] + "px";
                }
                break;
            case "col498telephone":
                window.teleCode = args[1];
                break;
            case "reloadPage":
                window.location.reload();
                break;
            case "loadScript":
                if (!window.isPermitted(e.origin, ['jotform.com', 'jotform.pro'])) { break; }
                var scriptSrc = args[1];
                if (args.length > 3) {
                    scriptSrc = args[1] + ':' + args[2];
                }
                var script = document.createElement('script');
                script.src = scriptSrc;
                script.type = 'text/javascript';
                document.body.appendChild(script);
                break;
            case "exitFullscreen":
                if (window.document.exitFullscreen) window.document.exitFullscreen();
                else if (window.document.mozCancelFullScreen) window.document.mozCancelFullScreen();
                else if (window.document.mozCancelFullscreen) window.document.mozCancelFullScreen();
                else if (window.document.webkitExitFullscreen) window.document.webkitExitFullscreen();
                else if (window.document.msExitFullscreen) window.document.msExitFullscreen();
                break;
        }
        var isJotForm = (e.origin.indexOf("jotform") > -1) ? true : false;
        if (isJotForm && "contentWindow" in iframe && "postMessage" in iframe.contentWindow) {
            var urls = {"docurl":encodeURIComponent(document.URL),"referrer":encodeURIComponent(document.referrer)};
            iframe.contentWindow.postMessage(JSON.stringify({"type":"urls","value":urls}), "*");
        }
    };
    window.isPermitted = function(originUrl, whitelisted_domains) {
        var url = document.createElement('a');
        url.href = originUrl;
        var hostname = url.hostname;
        var result = false;
        if (typeof hostname !== 'undefined') {
            whitelisted_domains.forEach(function(element) {
                if (hostname.slice((-1 * element.length - 1)) === '.'.concat(element) || hostname === element) {
                    result = true;
                }
            });
            return result;
        }
    };
    if (window.addEventListener) {
        window.addEventListener("message", handleIFrameMessage, false);
    } else if (window.attachEvent) {
        window.attachEvent("onmessage", handleIFrameMessage);
    }
</script>

<?php
get_footer();
