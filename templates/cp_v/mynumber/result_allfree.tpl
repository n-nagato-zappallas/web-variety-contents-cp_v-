{include file="include/header.tpl"}

<body>
<noscript><p style="color:red;font-weight:bold;font-size:1.3em;text-align:center;background-color:white;">当コンテンツをご利用になるにはJavaScriptをONにする必要があります。JavaScriptをONにしてお楽しみ下さい。</p></noscript>
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
              <div id="result_single" class="allfree">
{else}
              <div id="result_double" class="allfree">
{/if}

{if $menu_id == 'no_001'}
                <!-- 占いマイナンバー一人用 -->
                
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
                    <h3>{$menu_min_title[3]}</h3>
                    <div class="detail_txt">
                      <p class="text">{$result_menu[3]}</p>
                    </div>
                    <h3>{$menu_min_title[4]}</h3>
                    <div class="detail_txt">
                      <p class="text">{$result_menu[4]}</p>
                    </div>
                  </div>
                </div>
                <!-- //result_basic -->
                
                <!-- シェアボタン -->
                <!--
                <div class="share_area">
                  <a href="https://twitter.com/intent/tweet?text=占いマイナンバー{$base_id_self}のあなたをもっと深堀り！">
                    <div id="share_btn" class="share_btn">診断結果を<span class="icon_x"></span>でポスト</p></div>
                  </a>
                </div>
                -->
                <!-- //シェアボタン -->
                
                <h2 class="text_img"><img width="750" height="660" src="{$img_path}/img/free_group/feature/text{$base_id_self}.png" alt="占いマイナンバー{$base_id_self}のあなたをもっと深堀り！あなたの仕事の才能　あなたの金運、そのお金の使い方　この1年で、あなたが輝く出来事　近い将来のあなたのターニングポイント"></h2>
                
                <!-- 一部見せ -->
                <div class="next_group">
                <form name="frmMain" method="post" action="" onSubmit="return false" accept-charset="euc-jp">
{include file="include/form/param_next.tpl"}
                  <input type="hidden" name="menu_id" value="{$next_list[0]['menu_id']}">
                  
                  <div class="box">
                    <h3>{$next_list[0]['menu_min_title'][6]}</h3>
                    <div class="detail_txt">
                      <p class="text">{$next_list[0]['result_menu'][6]}</p>
                      <div class="text_mos"></div>
                    </div>
                    <div class="mosaic_btn">
                      <a href="javascript:void(0);" class="btn" onclick="click_btn( 0, this );" id="next_btn1"/>結果を見る（有料）</a>
                    </div>
                    <h3>{$next_list[0]['menu_min_title'][8]}</h3>
                    <div class="detail_txt">
                      <p class="text">{$next_list[0]['result_menu'][8]}</p>
                      <div class="text_mos"></div>
                    </div>
                    <div class="mosaic_btn">
                      <a href="javascript:void(0);" class="btn" onclick="click_btn( 0, this );" id="next_btn2"/>結果を見る（有料）</a>
                    </div>
                    <h3>{$next_list[0]['menu_min_title'][13]}</h3>
                    <div class="detail_txt">
                      <p class="text">{$next_list[0]['result_menu'][13]}</p>
                      <div class="text_mos"></div>
                    </div>
                    <div class="mosaic_btn">
                      <a href="javascript:void(0);" class="btn" onclick="click_btn( 0, this );" id="next_btn3"/>結果を見る（有料）</a>
                    </div>
                    <h3>{$next_list[0]['menu_min_title'][15]}</h3>
                    <div class="detail_txt">
                      <p class="text">{$next_list[0]['result_menu'][15]}</p>
                      <div class="text_mos"></div>
                    </div>
                    <div class="mosaic_btn">
                      <a href="javascript:void(0);" class="btn" onclick="click_btn( 0, this );" id="next_btn4"/>結果を見る（有料）</a>
                    </div>
                  </div>
                </div>
                <!-- 一部見せ -->
                
                <h2 class="text_img"><img width="750" height="180" src="{$img_path}/img/free_group/text1.png" alt="占いマイナンバーであなたのことを深堀り！こんなことまでわかります"></h2>
                
                  <!-- 鑑定項目一覧 -->
                  <div class="telling">
{include file="include/telling/no_002.tpl"}
                  </div>
                  <!-- //鑑定項目一覧 -->

                  <div id="frm_btn">
                    <div class="form_btn">
                      <a href="javascript:void(0);" class="btn" onclick="click_btn( 0, this );" id="cp_v_btn_pay_btn1"/>もっと詳しく知りたい（有料）</a>
                    </div>
                  </div>
                  <div class="price_info">
                    <p>ご利用には<strong>{$next_list[0]["price"]}/1回</strong>が必要となります。</p>
                    <p>※ご購入から10日間の閲覧が可能です。</p>
                  </div>
                  <div id="privacy">
{if $isp == '11'}
                    <p>株式会社cocoloniは、ご入力いただいた情報を、占いサービスを提供するためにのみ使用し、情報の蓄積を行ったり、他の目的で使用することはありません。<br><a href="https://cocoloni.com/privacypolicy" target="_blank">当社個人情報保護方針</a>（外部サイト）に同意の上、必要情報をご入力ください。<br>また、ご購入に関しては、cocoloni本格占い館の<a href="/agreement/" target="_privacy">利用規約</a>に同意の上、必要情報をご入力ください。</p>
{else}
                    <p>株式会社cocoloniは、ご入力いただいた情報を、占いサービスを提供するためにのみ使用し、情報の蓄積を行ったり、他の目的で使用することはありません。<br><a href="https://cocoloni.com/privacypolicy" target="_blank">当社個人情報保護方針</a>（外部サイト）に同意の上、必要情報をご入力ください。</p>
{/if}
                  </div>
                  
{include file="include/feature.tpl"}
                  
                  <div id="frm_btn">
                    <div class="form_btn">
                      <a href="javascript:void(0);" class="btn" onclick="click_btn( 0, this );" id="cp_v_btn_pay_btn2"/>もっと詳しく知りたい（有料）</a>
                    </div>
                  </div>
                </form>
{if $isp == '11'}
                <div class="attention">
                  <p>利用推奨環境などの注意事項は<a href="/guide/" target="_blank" class="link_underline">こちら</a></p>
                  <p><a href="/notice/" target="_blank" class="link_underline">特定商取引法に基づく表記</a></p>
                  <p>このサービスのお問い合わせは<a href="/inquiry/?cont_id=50000" target="_50000">こちら</a>をご覧ください。</p>
                </div>
{/if}
{/if}
                
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
{if $isp == '11'}
{include file="include/footer.tpl"}
{/if}
<!-- ending -->

</body>
</html>

