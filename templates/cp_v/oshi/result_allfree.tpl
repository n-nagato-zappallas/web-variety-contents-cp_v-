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
            <h1><a href="{$uri_path}/"><img width="750" height="176" src="{$img_path}/img/header-aisho.png" alt="{$menu_title}"></a></h1>
          </div>
          
          <div id="contents">
            <div id="contents_inner">
{if $menu_person == '1'}
              <div id="result_single" class="allfree">
{else}
              <div id="result_double" class="allfree">
{/if}

{if $menu_id == 'oa_001'}
                <!-- 推し相性占い -->
                <div class="menu_header">
                  <p>2人の相性をお伝えする前に、<br>まずは<span class="marker_1">{$name2_other}</span>と<span class="marker_2">{$name2_self}</span>の<br>
それぞれの個性や特徴について<br>
心に潜む赤ちゃんキャラクターから<br>見ていきましょう</p>
                </div>

                <!-- result_basic -->
                <div class="result_basic">
                  <div class="basic_char">
                    <div class="basic_other">
                      <p class="img"><img src="{$img_path}/img/free_group/img/{$base_id_other}.png" alt="{$base_alt_other}"></p>
                      <div class="info">
                        <p>{$name2_other}<br>{$birth_year_other}.{$birth_mon_other}.{$birth_mday_other}<br>{$sex_name_other}</p>
                      </div>
                    </div>
                    <div class="icon_cross"><img src="{$img_path}/img/free_group/icon_cross.png"></div>
                    <div class="basic_self">
                      <p class="img"><img src="{$img_path}/img/free_group/img/{$base_id_self}.png" alt="{$base_alt_self}"></p>
                      <div class="info">
                        <p>{$name2_self}<br>{$birth_year_self}.{$birth_mon_self}.{$birth_mday_self}<br>{$sex_name_self}</p>
                      </div>
                    </div>
                  </div>
                  <div class="box box_white">
                    <p class="midashi_1">
                      <span>{$name2_other}ってこんな人</span>
                    </p>
                    <div class="basic_char2">
                      <div class="basic_other">
                        <p class="img"><img src="{$img_path}/img/free_group/img/{$base_id_other}.png" alt="{$base_alt_other}"></p>
                      </div>
                    </div>
                    <p class="summary">{$result_menu[1]}</p>
                    <p class="text">{$result_menu[2]}</p>
                  </div>
                  <div class="box box_white">
                    <p class="midashi_1">
                      <span>{$name2_self}ってこんな人</span>
                    </p>
                    <div class="basic_char2">
                      <div class="basic_self">
                        <p class="img"><img src="{$img_path}/img/free_group/img/{$base_id_self}.png" alt="{$base_alt_self}"></p>
                      </div>
                    </div>
                    <p class="summary">{$result_menu[3]}</p>
                    <p class="text">{$result_menu[4]}</p>
                  </div>
                </div>
                <!-- //result_basic -->
                
                <!-- result_aisho -->
                <div class="result_aisho">
                  <h2><img width="670" height="180" src="{$img_path}/img/free_group/text.png" alt="そんな2人の運命がどれくらい交わっているのか相性を解き明かしていきましょう"></h2>
                  <p><img width="750" height="226" src="{$img_path}/img/free_group/title1.jpg" alt="推しとあなたの相性は"></p>
                  
                  <div class="box box_pink">
                    <div class="js_bdy aisho">
                      <div class="chart">
                        <div id="g1" class="graph0" data-tens="{$tens_digit}"></div>
                        <div id="g2" class="graph0" data-tens="{$ones_digit}"></div>
                        <div class="percent">
                          <img width="100%" height="auto" src="{$img_path}/img/free_group/number/p.png" alt="%">
                        </div>
                        <canvas id="circle" class="graph_bg" data-value="{$number}"></canvas>
                      </div>
                    </div>
                    <h3>{$result_menu[5]}</h3>
                    <div class="detail_txt">
                      <p class="title"><img width="239" height="36" src="{$img_path}/img/free_group/title2.png" alt="2人の基本相性"></p>
                      <p class="text">{$result_menu[6]}</p>
                    </div>
                  </div>
                </div>
                <!-- //result_aisho -->
                
                <!-- 相性診断書 -->
                <div class="shindan">
                  <h2><img width="750" height="128" src="{$img_path}/img/free_group/section_title.jpg" alt="相性診断書"></h2>
                  <div class="section_bdy">
                    <div class="section_ftr">
                      <div class="section_hdr">
                        <div class="result_percent">
                          <p class="title"><img width="116" height="81" src="{$img_path}/img/free_group/title3.png" alt="診断結果"></p>
                          <p><img width="66" height="96" src="{$img_path}/img/free_group/number/{$tens_digit}.png" alt="{$tens_digit}"></p>
                          <p><img width="66" height="96" src="{$img_path}/img/free_group/number/{$ones_digit}.png" alt="{$ones_digit}"></p>
                          <p class="p"><img width="52" height="52" src="{$img_path}/img/free_group/number/p.png" alt="%"></p>
                        </div>
                        <div class="basic_char">
                          <div class="basic_other">
                            <p class="img"><img src="{$img_path}/img/free_group/img/{$base_id_other}.png" alt="{$base_alt_other}"></p>
                            <div class="info">
                              <p>{$name2_other}<br>{$birth_year_other}.{$birth_mon_other}.{$birth_mday_other}<br>{$sex_name_other}</p>
                            </div>
                          </div>
                          <div class="icon_cross"><img src="{$img_path}/img/free_group/icon_cross.png"></div>
                          <div class="basic_self">
                            <p class="img"><img src="{$img_path}/img/free_group/img/{$base_id_self}.png" alt="{$base_alt_self}"></p>
                            <div class="info">
                              <p>{$name2_self}<br>{$birth_year_self}.{$birth_mon_self}.{$birth_mday_self}<br>{$sex_name_self}</p>
                            </div>
                          </div>
                        </div>
                        <ul class="summary_box">
{section name=i start=1 loop=5}
                          <li><span class="marker_3">{$result_menu[7][$smarty.section.i.index]}</span></li>
{/section}
                        </ul>
                        <p class="end_text">上記の通り診断します</p>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- //相性診断書 -->
                
                <!-- シェアボタン -->
                <div class="share_area">
                  <a href="https://twitter.com/intent/tweet?text={$name2_other}と{$name2_self}の相性は{$number}％です%0D%0A・{$result_menu[7][1]}%0D%0A・{$result_menu[7][2]}%0D%0A・{$result_menu[7][3]}%0D%0A・{$result_menu[7][4]}%0D%0A%23%E6%8E%A8%E3%81%97%E7%9B%B8%E6%80%A7%E8%A8%BA%E6%96%AD%0D%0Ahttps%3A%2F%2Fhonkaku-uranai.jp%2Fcp_v%2Foshi-aisho_v%2F">
                    <div id="cp_v_btn_share_btn" class="share_btn">診断結果を<span class="icon_x"></span>でポスト</p></div>
                  </a>
                </div>
                <!-- //シェアボタン -->
                
                <h2><img width="671" height="377" src="{$img_path}/img/free_group/text2.png" alt="さらに……！推しとあなたの相性診断ではお伝えした基本相性のほかにも6項目の相性分析、さらにあなたと推しの結びつきや推しの知られざる素顔まで徹底解説します！"></h2>
                
                <form name="frmMain" method="post" action="" onSubmit="return false" accept-charset="euc-jp">
{include file="include/form/param_question.tpl"}
                  <div id="frm_btn">
                    <div class="form_btn">
                      <a href="javascript:void(0);" class="btn" onclick="click_btn( 0, this );" id="cp_v_btn_question_btn1"/>質問スタート</a>
                    </div>
                  </div>
                  
                  <div class="text_img">
                    <p><img width="750" height="2650" src="{$img_path}/img/free_group/text3.png" alt="どうしてこんなに惹かれるの？推しと一夜を過ごしたらどうなる……？もし2人が付き合ったら？実は前世から推しと繋がっていた？推しとあなたの意外な共通点とは？あなたの推しは今、どんなことに困っている？推し活に役立つ情報も盛りだくさん！3,000字超の大ボリュームでお届け！"></p>
                  </div>
                  
                  <!-- 鑑定項目一覧 -->
                  <div class="telling">
                    <h2><img width="750" height="120" src="{$img_path}/img/input/telling/section_title.jpg" alt="この先ではこんなことがわかります"></h2>
                    <div class="section_bdy">
                      <div class="section_ftr">
                        <div class="section_hdr">
{include file="include/telling/oa_002.tpl"}
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- //鑑定項目一覧 -->
                  
                  <div class="midashi_2">
                    <span>さっそく質問に答えて<br>詳しい相性をチェックしよう！</span>
                    <div class="underline"></div>
                  </div>
                  <div id="frm_btn">
                    <div class="form_btn">
                      <a href="javascript:void(0);" class="btn" onclick="click_btn( 0, this );" id="cp_v_btn_question_btn2"/>質問スタート</a>
                    </div>
                  </div>
                </form>
{/if}
                
              </div>
              
              {*include file="include/banner_link.tpl"*}
              
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

