
<noscript>
  <p class="noscript_caption">当コンテンツをご利用になるにはJavaScriptをONにする必要があります。JavaScriptをONにしてお楽しみ下さい。</p>
</noscript>
<div id="frmInput">
  <form name="frmMain" method="post" action="" onSubmit="return false" accept-charset="euc-jp">
{include file="include/form/param_input.tpl"}
  
{if $menu_person == '2' }
    <div class="input_other">
      <h3><img width="100%" height="auto" src="{$img_path}/img/section_hdr_other.png" alt="私の推しはこの人です！"></h3>
      <table class="input_tbl" cellspacing="0">
        <tr class="tr_name">
          <th class="ttl_font">お名前（ニックネームでも可）</th>
        </tr>
        <tr class="tr_name">
          <td>
            <input type="text" id="name_other" name="name_other" data-length="8" size="36" maxlength="16" class="input_name" placeholder="推しのお名前">
            <p class="count_num"></p>
            <p class="err_txt" id="err_name_other"></p>
            <button type="button" class="form_close" id="name_form_close_other" onclick="reset_nameForm('other')"></button>
          </td>
        </tr>
        <tr class="tr_birthday">
          <th class="ttl_font">生年月日<span class="hissu">必須</span></th>
        </tr>
        <tr class="tr_birthday">
          <td>
            <div class="calenderForm">
              <input name="birth_year_other" id="birth_year_other" type="tel" placeholder="1999" autocomplete="off" maxlength="4" value="">
              <span class="date_unit">/</span>
              <input name="birth_mon_other" id="birth_mon_other" type="tel" placeholder="01" autocomplete="off" maxlength="2" value="">
              <span class="date_unit">/</span>
              <input name="birth_mday_other" id="birth_mday_other" type="tel" placeholder="01" autocomplete="off" maxlength="2" value="">
              <button type="button" class="form_close" id="birth_form_close_other" onclick="reset_calenderForm('other')"></button>
            </div>
            <p class="err_txt" id="err_birth_year_other"></p>
          </td>
        </tr>
        <tr class="tr_sex">
          <th class="ttl_font">性別<span class="hissu">必須</span></th>
        </tr>
        <tr class="tr_sex">
          <td>
            <select id="sex_other" name="sex_other" class="sexSelect" required>
              <option value="">選択してください</option>
              <option value="1">男性として占う</option>
              <option value="2">女性として占う</option>
            </select>
            <p class="err_txt" id="err_sex_other"></p>
          </td>
        </tr>
      </table>
    </div>
{/if}
    <div class="input_self">
      <h3><img width="100%" height="auto" src="{$img_path}/img/section_hdr_self.png" alt="あなたについて教えて下さい"></h3>
      <table class="input_tbl" cellspacing="0">
        <tr class="tr_name">
          <th class="ttl_font">お名前（ニックネームでも可）</th>
        </tr>
        <tr class="tr_name">
          <td>
            <input type="text" id="name_self" name="name_self" data-length="8" size="36" maxlength="16" class="input_name" placeholder="あなたのお名前">
            <p class="count_num"></p>
            <p class="err_txt" id="err_name_self"></p>
            <button type="button" class="form_close" id="name_form_close_self" onclick="reset_nameForm('self')"></button>
          </td>
        </tr>
        <tr class="tr_birthday">
          <th class="ttl_font">生年月日<span class="hissu">必須</span></th>
        </tr>
        <tr class="tr_birthday">
          <td>
            <div class="calenderForm">
              <input name="birth_year_self" id="birth_year_self" type="tel" placeholder="1999" autocomplete="off" maxlength="4" value="">
              <span class="date_unit">/</span>
              <input name="birth_mon_self" id="birth_mon_self" type="tel" placeholder="01" autocomplete="off" maxlength="2" value="">
              <span class="date_unit">/</span>
              <input name="birth_mday_self" id="birth_mday_self" type="tel" placeholder="01" autocomplete="off" maxlength="2" value="">
              <button type="button" class="form_close" id="birth_form_close_self" onclick="reset_calenderForm('self')"></button>
            </div>
            <p class="err_txt" id="err_birth_year_self"></p>
          </td>
        </tr>
        <tr class="tr_sex">
          <th class="ttl_font">性別<span class="hissu">必須</span></th>
        </tr>
        <tr class="tr_sex">
          <td>
            <select id="sex_self" name="sex_self" class="sexSelect" required>
              <option value="">選択してください</option>
              <option value="1">男性として占う</option>
              <option value="2">女性として占う</option>
            </select>
            <p class="err_txt" id="err_sex_self"></p>
          </td>
        </tr>
      </table>
    </div>
    <div id="frm_btn">
{if $isp == '11'}
<!--
      <div class="cookie_check">入力した情報を記録しますか？<br>
      <label><input name="cwflg" value="ok" type="checkbox" checked>&nbsp;記録する</label>　　　
      <input type="button" value="記録を削除する" onclick="resetCookie()"></div>
-->
{/if}
{if $free_flag == 'free'}
      <div class="form_btn">
        <a href="javascript:void(0);" class="btn" onclick="click_btn( 0, this );" id="cp_v_btn_free_btn"/>無料で結果を見る</a>
      </div>
{/if}
{if $free_flag != 'free'}
<!--
      <div id="privacy">
{if $isp == '11'}
        <p>株式会社cocoloniは、ご入力いただいた情報を、占いサービスを提供するためにのみ使用し、情報の蓄積を行ったり、他の目的で使用することはありません。<br><a href="https://cocoloni.com/privacypolicy" target="_blank">当社個人情報保護方針</a>（外部サイト）に同意の上、必要情報をご入力ください。<br>また、ご購入に関しては、cocoloni本格占い館の<a href="/agreement/" target="_privacy">利用規約</a>に同意の上、必要情報をご入力ください。</p>
{else}
        <p>株式会社cocoloniは、ご入力いただいた情報を、占いサービスを提供するためにのみ使用し、情報の蓄積を行ったり、他の目的で使用することはありません。<br><a href="https://cocoloni.com/privacypolicy" target="_blank">当社個人情報保護方針</a>（外部サイト）に同意の上、必要情報をご入力ください。</p>
{/if}
      </div>
-->
{/if}
    </div>
  </form>
</div>
