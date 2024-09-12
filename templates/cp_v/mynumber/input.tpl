{include file="include/header.tpl"}

<body>
<noscript><p style="color:red;font-weight:bold;font-size:1.3em;text-align:center;background-color:white;">当コンテンツをご利用になるにはJavaScriptをONにする必要があります。JavaScriptをONにしてお楽しみ下さい。</p></noscript>
{include file="include/isp_header.tpl"}

<!-- beginning -->
<div id="cpwrapper">
  <div id="cpwrapper_inner">
  
    <div id="contents_base">
      <div id="base">
        <div id="basebdy">
        
          <div id="header">
            <h1><img width="750" height="879" src="{$img_path}/img/header_index-{$category_name}.png" alt="{$menu_title}"></h1>
          </div>
          
          <div id="contents">
            <div id="contents_inner">
              
              
              <!-- 鑑定項目一覧 -->
              <div class="telling">
                <h2>占いマイナンバータイプ診断【無料】</h2>
{include file="include/telling/no_001.tpl"}
              </div>
              <!-- //鑑定項目一覧 -->
                  
              <h2 class="menu_header"><img width="540" height="180" src="{$img_path}/img/input/text1.png" alt="あなたの占いマイナンバーは何番？生年月日を入力してください"></h2>
              
              
              
              {include file="include/form.tpl"}

            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
{if $isp == '11'}
{include file="include/footer.tpl"}
{/if}
<!-- ending -->

</body>
</html>
