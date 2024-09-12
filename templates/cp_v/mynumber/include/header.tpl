<!DOCTYPE html>
<html lang="ja">
  <head>
{literal}
<script type="text/javascript">
<!---
if (!(navigator.userAgent.indexOf('iPhone') > 0 || navigator.userAgent.indexOf('iPad') > 0 || navigator.userAgent.indexOf('Android') > 0 || navigator.userAgent.indexOf('Mobile') > 0 ) || !(window.screen.width < 640 || window.screen.height < 640))  {
  document.getElementsByTagName("html")[0].setAttribute("class","disp_pc");
  document.write('<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">');
}else{
  document.getElementsByTagName("html")[0].setAttribute("class","disp_sp");
  document.write('<meta name="viewport" content="width=375,user-scalable=no">');
}
//--->
</script>
{/literal}
    <meta http-equiv="Content-Type" content="text/html; charset={$charset}">
    <meta name="copyright" content="(C)cocoloni,Inc">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Content-Language" content="ja">
    <meta name="Cache-Control" content="no-cache">
    <meta name="Pragma" content="no-cache">
{if $result_flag}
    <meta name="robots" content="noindex">
{/if}
    <meta http-equiv="Content-Script-Type" content="text/javascript">
    <meta http-equiv="Content-Style-Type" content="text/css">
{if !$result_flag}
    <meta name="Keywords" content="{$meta_keywords}">
    <meta name="Description" content="{$meta_description}">
{/if}
{if $isp =="11"}
    <meta property="og:title" content="{$special_title}　|　cocoloni占い館">
    <meta property="og:description" content="{$meta_description}">
    <meta property="og:url" content="https://honkaku-uranai.jp/cp_v/{$event}-{$menu_category_name}_v/">
    <meta property="og:type" content="article"/>
{if $result_flag && $menu_category_name == 'aisho' }
    <meta property="og:image" content="https://honkaku-uranai.jp/cp_v/{$event}-{$menu_category_name}_v/img/{$event}-{$menu_category_name}-sns.jpg" />
{else}
    <meta property="og:image" content="https://honkaku-uranai.jp/cp_v/{$event}-{$menu_category_name}_v/img/banner.jpg" />
{/if}
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:locale" content="ja_JP">
    <link rel="canonical" href="https://honkaku-uranai.jp/cp_v/{$event}-{$menu_category_name}_v/">
{include file="include/isp/cp_zap_gtm_header.tpl"}
{/if}

    <title>{$special_title}{if $isp =="11"}　|　cocoloni占い館 Moon{/if}</title>
{if $preview}
<!--- SMARTY TEMPLATE テンプレート確認用のタグです削除してください --->
<script type="text/javascript">alert("\"webadmin system\" preview mode!");</script>
{if $isp == '11'}
<!--<base href="http://web-fortune51-dev.ura.pga.jp/public/cp_zap/cp_v/mynumber/" />-->
{/if}
<!--- /SMARTY TEMPLATE テンプレート確認用のタグです削除してください --->
{/if}
{if !$result_flag}
{literal}
<script type="text/javascript">
<!--
window.onunload = function () {}
// -->
</script>
{/literal}
{/if}

{if $isp == '11'}
    <script type="text/javascript" src="{$img_path}/js/jquery.js"></script>
    <script type="text/javascript" src="{$uri_path}/js/effect.js"></script>
    <script type="text/javascript" src="{$img_path}/js/validation.js"></script>
    <script type="text/javascript" src="{$img_path}/js/special.js"></script>
{else}
    <script type="text/javascript" src="{$uri_path}/js/jquery.js"></script>
    <script type="text/javascript" src="{$uri_path}/js/effect.js"></script>
    <script type="text/javascript" src="{$uri_path}/js/validation.js"></script>
    <script type="text/javascript" src="{$uri_path}/js/special.js"></script>
{/if}

    <link rel="stylesheet" type="text/css" href="{$img_path}/css/contents.css">
{if $result_flag}
    <link rel="stylesheet" type="text/css" href="{$img_path}/css/result.css">
{/if}


{if !$result_flag}
{if $isp =="11"}
    <link rel="canonical" href="https://honkaku-uranai.jp/cp_zap/{$event}-{$menu_category_name}_v/">
{/if}
{/if}

</head>

