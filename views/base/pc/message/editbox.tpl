{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl" add_css="" add_js=""}
{include file="`$smarty.const.PATH_ROOT`/views/base/pc/message/menu.parts.tpl"}

<div class="layout-3-column-center left">
<table id="message" class="frame">
  <tr>
    <th>選択</th><th>添付</th><th>日付</th><th>To</th><th>件名</th>
  </tr>
  {foreach from=$messages item=message}
  <tr>
    <td><input type="checkbox" name="check[{$message->getId()}]" value="1" /></td>
    <td>{if $message->getAttachment()}<a href=""></a>{/if}</td>
    <td><a href="/message/editbox/{$message->getId()}">{$message->getCreated()|date_format:'%Y/%m/%d %H:%M'}</a></td>
    <td><a href="/message/editbox/{$message->getId()}">{$message->getToAccountId()}</a></td>
    <td><a href="/message/editbox/{$message->getId()}">{$message->getSubject()|truncate:30}</a></td>
  </tr>
  {foreachelse}
  <tr class="h300">
  <td>メッセージはありません</td>
  </tr>
  {/foreach}
</table>{*<!-- #message -->*}
</div><!-- .layout-3-column-center-->

{include file="`$smarty.const.PATH_ROOT`/views/base/pc/parts/profile.parts.tpl"}

{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
