{include file="include/header.tpl"}

<body>
{include file="include/isp_header.tpl"}

{if $isp == '11'}
  <!-- 202403_analytics -->
  <input type="hidden" id="cv_menu_id" value="{$menu_id}">
  <!-- 202403_analytics -->
{/if}

  <input type="hidden" name="q_1" value="{$q_1}">
  <input type="hidden" name="q_2" value="{$q_2}">
  <input type="hidden" name="q_3" value="{$q_3}">

<!-- beginning -->
  <div id="cpwrapper">
  <div id="cpwrapper_inner">
<pre>
{*$result_menu|@var_dump*}
</pre>

    <div id="contents_base">
      <div id="base">
        <div id="basebdy">
          <div id="header">
            <h1><a href="{$uri_path}/"><img width="750" height="176" src="{$img_path}/img/header-aisho.png" alt="{$menu_title}"></a></h1>
          </div>
          
          <div id="contents">
            <div id="contents_inner">
              
{if $menu_person == '1'}
              <div id="result_single">
{else}
              <div id="result_double">
{/if}

                {include file="include/maintext/{$menu_id}.tpl"}
                
                <h2><img width="670" height="197" src="{$img_path}/img/result/text6.png" alt="結果はいかがでしたか。これであなたの推し活がさらに楽しくなることを願っています！"></h2>
                
                <div id="frm_btn">
                  <div class="form_btn">
                    <a href="{$uri_path}/" class="btn gototop" id="cp_v_btn_goto_top">トップページに戻る</a>
                  </div>
                </div>
                 
              </div>
            </div>
          </div>
          
{if $isp != '11'}
{include file="include/footer.tpl"}
{else}
{*include file="include/isp/attention2_$isp.tpl"*}
{/if}
          
        </div>
      </div>
    </div>
  </div>
  </div>
<!-- ending -->
{if $isp == '11'}
{include file="include/footer.tpl"}
{/if}

</body>
</html>

