
                        <input type="hidden" name="isp" value="{$isp}">
                        <input type="hidden" name="event" value="{$event}">
                        <input type="hidden" name="menu_id" value="{$menu_id}">
{if $free_flag == 'free'}
                        <input type="hidden" name="t" value="result_allfree">
{else}
                        <input type="hidden" name="t" value="result">
{/if}
                        <input type="hidden" name="menu_person" value="{$menu_person}">

