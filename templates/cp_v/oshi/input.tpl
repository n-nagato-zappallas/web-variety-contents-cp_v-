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
              
              <h2 class="menu_header"><img width="540" height="180" src="{$img_path}/img/input/text2.png" alt="診断結果は全部で729通り！これは推し×あなたの真面目な相性診断2人の相性は何パーセントでしょうか？"></h2>
              <h2><img width="634" height="200" src="{$img_path}/img/input/text1.png" alt="推しとあなたについて教えてください"></h2>
              
              
              {include file="include/form.tpl"}
              
              
              <h2 class="sample_img1"><img width="572" height="90" src="{$img_path}/img/input/text3.png" alt="こんなことがわかります"></h2>
              <h2 class="sample_img2"><img width="669" height="510" src="{$img_path}/img/input/img.png" alt=""></h2>
              <h2 class="sample_img3"><img width="277" height="48" src="{$img_path}/img/input/text4.png" alt="診断サンプル"></h2>
              
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
