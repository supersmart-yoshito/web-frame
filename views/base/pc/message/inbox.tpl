{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl" add_css="" add_js=""}

{include file="`$smarty.const.PATH_ROOT`/views/base/pc/message/menu.parts.tpl" enableOperation="1"}

<div class="layout-3-column-center h100p">
<table id="message">
  <tr>
    <th class="tit w30"></th>
    <th class="tit w30">選択</th>
    <th class="tit w30">添付</th>
    <th class="tit w150">日付</th>
    <th class="tit w100">From</th>
    <th class="tit">件名</th>
  </tr>
  {foreach from=$messages item=message}
  <tr>
    <td class="center">{if $message->getIsOpen() == 0}<p class="bf00 category">new</p>{/if}</td>
    <td class="center"><input type="checkbox" name="check[{$message->getId()}]" value="1" /></td>
    <td class="center">{if $message->getAttachment()}<a href=""></a>{/if}</td>
    <td class="center"><a href="/message/inbox/{$message->getId()}">{$message->getUpdated()|date_format:'%Y/%m/%d %H:%M'}</a></td>
    <td class="center"><a href="/message/inbox/{$message->getId()}" data-account-id="{$message->getFromAccountId()}">{$message->getFromAccountId()|idtoname|truncate:10}</a></td>
    <td><a href="/message/inbox/{$message->getId()}">{$message->getSubject()|truncate:30}</a></td>
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
