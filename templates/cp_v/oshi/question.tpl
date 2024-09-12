{include file="include/header.tpl"}

<body>
<noscript><p style="color:red;font-weight:bold;font-size:1.3em;text-align:center;background-color:white;">当コンテンツをご利用になるにはJavaScriptをONにする必要があります。JavaScriptをONにしてお楽しみ下さい。</p></noscript>
{include file="include/isp_header.tpl"}
    
{if $isp == '11'}
  <!-- 202403_analytics ★比嘉ちゃんに確認-->
  <input type="hidden" id="cv_menu_id" value="{$menu_id}">
  <!-- 202403_analytics -->
{/if}

<!-- beginning -->
<div id="cpwrapper">
  <div id="cpwrapper_inner">

    <div id="contents_base">
      <div id="base">
        <div id="basebdy">
          <div id="header">
            <h1><a href="{$uri_path}/"><img width="750" height="176" src="{$img_path}/img/header-{$category_name}.png" alt="{$menu_title}"></a></h1>
          </div>
          
          <div id="contents">
            <div id="contents_inner">
              
              <div class="q_box_wrapper">
                <form name="frmMain" method="post" action="" onSubmit="return false" accept-charset="euc-jp">
{include file="include/form/param_question2.tpl"}
                
                <div id="q_1">
                  <div class="step_nav">
                    <h2><img width="445" height="84" src="{$img_path}/img/question/step1.png" alt="Q1"></h2>
                    <p>まずは今の推しとあなたについて<br><span class="marker_1">最も当てはまるもの</span>をお選びください</p>
                  </div>
                  <div class="q_box">
                    <h3>Q1.推しとあなたは出会ってどれくらい？</h3>
                    <ul>
                      <li id="cp_v_btn_q1_a">
                        <input id="item-1-1" class="radio-inline__input" type="radio" name="q_1" value="item-1-1" checked="checked"/>
                        <label class="radio-inline__label" for="item-1-1">
                            <span class="number">A</span><p>1年未満</p>
                        </label>
                      </li>
                    </ul>
                    <ul>
                      <li id="cp_v_btn_q1_b">
                        <input id="item-1-2" class="radio-inline__input" type="radio" name="q_1" value="item-1-2"/>
                        <label class="radio-inline__label" for="item-1-2">
                            <span class="number">B</span><p>1年以上～3年未満</p>
                        </label>
                      </li>
                    </ul>
                    <ul>
                      <li id="cp_v_btn_q1_c">
                        <input id="item-1-3" class="radio-inline__input" type="radio" name="q_1" value="item-1-3"/>
                        <label class="radio-inline__label" for="item-1-3">
                            <span class="number">C</span><p>3年以上～5年未満</p>
                        </label>
                      </li>
                    </ul>
                    <ul>
                      <li id="cp_v_btn_q1_d">
                        <input id="item-1-4" class="radio-inline__input" type="radio" name="q_1" value="item-1-4"/>
                        <label class="radio-inline__label" for="item-1-4">
                            <span class="number">D</span><p>5年以上</p>
                        </label>
                      </li>
                    </ul>
                  </div>
                </div>
                
                <div id="q_2">
                  <div class="step_nav">
                    <h2><img width="445" height="84" src="{$img_path}/img/question/step2.png" alt="Q2"></h2>
                    <p>まずは今の推しとあなたについて<br><span class="marker_1">最も当てはまるもの</span>をお選びください</p>
                  </div>
                  <div class="q_box">
                    <h3>Q2.推しとあなたの距離感はどれくらい？</h3>
                    <ul>
                      <li id="cp_v_btn_q2_a">
                        <input id="item-2-1" class="radio-inline__input" type="radio" name="q_2" value="item-2-1" checked="checked"/>
                        <label class="radio-inline__label" for="item-2-1">
                            <span class="number">A</span><p>まだ会ったことはない</p>
                        </label>
                      </li>
                    </ul>
                    <ul>
                      <li id="cp_v_btn_q2_b">
                        <input id="item-2-2" class="radio-inline__input" type="radio" name="q_2" value="item-2-2"/>
                        <label class="radio-inline__label" for="item-2-2">
                            <span class="number">B</span><p>会ったことはあるけど<br>覚えられていない</p>
                        </label>
                      </li>
                    </ul>
                    <ul>
                      <li id="cp_v_btn_q2_c">
                        <input id="item-2-3" class="radio-inline__input" type="radio" name="q_2" value="item-2-3"/>
                        <label class="radio-inline__label" for="item-2-3">
                            <span class="number">C</span><p>推しに名前は覚えてもらっている</p>
                        </label>
                      </li>
                    </ul>
                    <ul>
                      <li id="cp_v_btn_q2_d">
                        <input id="item-2-4" class="radio-inline__input" type="radio" name="q_2" value="item-2-4"/>
                        <label class="radio-inline__label" for="item-2-4">
                            <span class="number">D</span><p>世間話もできちゃう仲</p>
                        </label>
                      </li>
                    </ul>
                    <p class="tab_nav"><span class="back_link" >< 前の質問に戻る</span></p>
                  </div>
                </div>
                
                <div id="q_3">
                  <div class="step_nav">
                    <h2><img width="445" height="84" src="{$img_path}/img/question/step3.png" alt="Q3"></h2>
                    <p>まずは今の推しとあなたについて<br><span class="marker_1">最も当てはまるもの</span>をお選びください</p>
                  </div>
                  <div class="q_box">
                    <h3>Q3.あなたにとって推しとは？</h3>
                    <ul>
                      <li id="cp_v_btn_q3_a">
                        <input id="item-3-1" class="radio-inline__input" type="radio" name="q_3" value="item-3-1" checked="checked"/>
                        <label class="radio-inline__label" for="item-3-1">
                            <span class="number">A</span><p>私の理想を詰め込んだような人</p>
                        </label>
                      </li>
                    </ul>
                    <ul>
                      <li id="cp_v_btn_q3_b">
                        <input id="item-3-2" class="radio-inline__input" type="radio" name="q_3" value="item-3-2"/>
                        <label class="radio-inline__label" for="item-3-2">
                            <span class="number">B</span><p>この世で一番好きな人</p>
                        </label>
                      </li>
                    </ul>
                    <ul>
                      <li id="cp_v_btn_q3_c">
                        <input id="item-3-3" class="radio-inline__input" type="radio" name="q_3" value="item-3-3"/>
                        <label class="radio-inline__label" for="item-3-3">
                            <span class="number">C</span><p>生きる希望。エネルギー源</p>
                        </label>
                      </li>
                    </ul>
                    <ul>
                      <li id="cp_v_btn_q3_d">
                        <input id="item-3-4" class="radio-inline__input" type="radio" name="q_3" value="item-3-4"/>
                        <label class="radio-inline__label" for="item-3-4">
                            <span class="number">D</span><p>尊い存在。<br>生まれてきてくれてありがとう</p>
                        </label>
                      </li>
                    </ul>
                    <p class="tab_nav"><span class="back_link" >< 前の質問に戻る</span></p>
                  </div>
                </div>
                
                <div id="q_4">
                  <div class="step_nav">
                    <h2><img width="445" height="84" src="{$img_path}/img/question/step4.png" alt=""></h2>
                  </div>
                  <h3><img width="750" height="128" src="{$img_path}/img/question/section_title.jpg" alt="結果診断中"></h3>
                  <div class="section_bdy">
                    <div class="section_ftr">
                      <div class="section_hdr">
                        <div class="loading_box">
                          <div class="loader">Loading...</div>
                          <div id="frm_btn">
                            <div class="form_btn">
                              <a href="javascript:void(0);" class="btn q_btn" onclick="click_btn( 0, this );" id="cp_v_btn_pay_btn"/>結果を見る（有料）</a>
                            </div>
                          </div>
                        </div>
                        <div class="price_info">
                          <p>ご利用には<strong>{$menu_price}/1回</strong>が必要となります。</p>
                          <p>※ご購入から10日間の閲覧が可能です。</p>
                        </div>
                        <div id="privacy">
{if $isp == '11'}
                          <p>株式会社cocoloniは、ご入力いただいた情報を、占いサービスを提供するためにのみ使用し、情報の蓄積を行ったり、他の目的で使用することはありません。<br><a href="https://cocoloni.com/privacypolicy" target="_blank">当社個人情報保護方針</a>（外部サイト）に同意の上、必要情報をご入力ください。<br>また、ご購入に関しては、cocoloni本格占い館の<a href="/agreement/" target="_privacy">利用規約</a>に同意の上、必要情報をご入力ください。</p>
{else}
                          <p>株式会社cocoloniは、ご入力いただいた情報を、占いサービスを提供するためにのみ使用し、情報の蓄積を行ったり、他の目的で使用することはありません。<br><a href="https://cocoloni.com/privacypolicy" target="_blank">当社個人情報保護方針</a>（外部サイト）に同意の上、必要情報をご入力ください。</p>
{/if}
                        </div>
                        <p class="tab_nav"><span class="back_link" >< 前の質問に戻る</span></p>
                      </div>
                    </div>
                  </div>
                </div>
                
                </form>
              </div>
              
              <!-- 鑑定項目一覧 -->
              <div class="telling">
{if $isp == '11'}
                <div class="attention">
                  <p>利用推奨環境などの注意事項は<a href="/guide/" target="_blank" class="link_underline">こちら</a></p>
                  <p><a href="/notice/" target="_blank" class="link_underline">特定商取引法に基づく表記</a></p>
                  <p>このサービスのお問い合わせは<a href="/inquiry/?cont_id=50000" target="_50000">こちら</a>をご覧ください。</p>
                </div>
{/if}
                <h2><img width="750" height="120" src="{$img_path}/img/input/telling/section_title.jpg" alt="この先ではこんなことがわかります"></h2>
                <div class="section_bdy">
                  <div class="section_ftr">
                    <div class="section_hdr">
{include file="include/telling/q_{$menu_id}.tpl"}
                    </div>
                  </div>
                </div>
              </div>
              <!-- //鑑定項目一覧 -->
              
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

