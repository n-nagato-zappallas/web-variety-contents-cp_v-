{include file="include/header.tpl"}

<body>
{include file="include/isp_header.tpl"}

{if $isp == '11'}
  <!-- 202403_analytics -->
  <input type="hidden" id="cv_menu_id" value="{$menu_id}">
  <!-- 202403_analytics -->
{/if}

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
            <h1><a href="{$uri_path}/"><img width="750" height="180" src="{$img_path}/img/header-{$category_name}.png" alt="{$menu_title}"></a></h1>
          </div>
          
          <div id="contents">
            <div id="contents_inner">
              
{if $menu_person == '1'}
              <div id="result_single">
{else}
              <div id="result_double">
{/if}

{if $menu_id == 'no_002'}
                <!-- result_basic -->
                <div class="result_basic">
                  <div class="basic_self">
                    <div class="info">
                      <p>{$birth_year_self}/{$birth_mon_self}/{$birth_mday_self}　{$name2_self}の<br><b>占いマイナンバーは</b></p>
                    </div>
                    <p class="img"><img src="{$img_path}/img/free_group/img/{$base_id_self}.png" alt="{$base_id_self}　一言でいうと"></p>
                    <p class="summary"><span class="marker_1">{$result_menu[1]}</span></p>
                  </div>
                  <div class="box">
                    <h3>{$menu_min_title[2]}</h3>
                    <div class="detail_txt">
                      <p class="text">{$result_menu[2]}</p>
                    </div>
                  </div>
                </div>
                <!-- //result_basic -->
                
                <h2 class="text_img"><img width="750" height="620" src="{$img_path}/img/result/text{$base_id_self}.png" alt="占いマイナンバー{$base_id_self}のあなたをもっと深堀り！では早速、見ていきましょう！"></h2>
{/if}

                {include file="include/maintext/{$menu_id}.tpl"}
                
{include file="include/banner_link.tpl"}
                
                <div class="goto_top_btn">
                  <div class="form_btn">
                    <a href="{$uri_path}/" class="btn" id="goto_top1">占いマイナンバーTopへ戻る</a>
                  </div>
                </div>
                
{include file="include/feature.tpl"}
                
                <div class="goto_top_btn">
                  <div class="form_btn">
                    <a href="{$uri_path}/" class="btn" id="goto_top1">占いマイナンバーTopへ戻る</a>
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

