{* ★Rakuten★ *}
{if $isp == '10'}
<!-- ========== header ========== -->
<script type="text/javascript" src="https://lovefortune.zappallas.com/rakuten/common/source/js/analyzer1.js"></script>
<script type="text/javascript" src="https://lovefortune.zappallas.com/sp/rakuten/event/{$event}/js_sp/rakuten_sp.js"></script>
<link rel="stylesheet" type="text/css" href="https://checkout.rakuten.co.jp/fortune/merchant/css/merchant_header.css">
<div id="isp_header" style="display:none;"></div>
<!-- ========== /header ========== -->
{/if}

{* ★cp_zap★ *}
{if $isp == '11'}
{literal}
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MV3KXWG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
{/literal}

<script type="text/javascript">
{literal}
<!---
if ((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf('iPad') == -1) || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {
    var script = document.createElement('script'); 
    script.src = "https://lw6nr4oyej.user-space.cdn.idcfcloud.net/cp_zap/common/source/js/cp_zap_sp.js";
    //script.src = "https://test-honkaku.cocoloni.jp/cp_zap/common/source/js/cp_zap_sp.js";
    document.head.appendChild(script);
} else {
    var css=document.createElement("link");
    css.setAttribute("rel","stylesheet");
    css.setAttribute("type","text/css");
    css.setAttribute("href","https://lw6nr4oyej.user-space.cdn.idcfcloud.net/cp_zap/common/source/css/merchant_header.css");
    document.getElementsByTagName("head")[0].appendChild(css);

    var script = document.createElement('script'); 
    //script.src = "/cp_zap/common/source/js/cp_zap_utf8.js";
    script.src = "https://lw6nr4oyej.user-space.cdn.idcfcloud.net/cp_zap/common/source/js/cp_zap.js";
    //script.src = "https://test-honkaku.cocoloni.jp/cp_zap/common/source/js/cp_zap.js";
    script.setAttribute("charset","euc-jp");
    document.head.appendChild(script);
}
{/literal}
//--->
</script>
  <div id="isp_header" style="display:none;"></div>

{/if}

