{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl" add_css="" add_js=""}

<form action="/message/post" method="post" enctype="multipart/form-data">
{include file="`$smarty.const.PATH_ROOT`/views/base/pc/message/menu.parts.tpl" enableSend="true"}

{if $params.messageId}
<input type="hidden" name="messageId" value="{$params.messageId}" />
{/if}

<div class="layout-3-column-center left">
{if $params.error}
<p>{$params.error}</p>
{/if}
<table class="w100p">
  <tr>
    <th class="w100 h50">TO</th>
    <td><select name="to">
      {foreach from=$params.toList item=to}
      {if count($params.toList) == 1}
      <option value="{$to->getId()}" selected>{$to->getId()|escape|idtoname}</option>
      {else}
      <option value="{$to->getFriendId()}" {if $params.to == $to}selected{/if}>{$to->getFriendId()|escape|idtoname}</option>
      {/if}
      {/foreach}
    </select></td>
  </tr>
  <tr>
    <th class="w100 h50">件名</th>
    <td><input class="h30 fs12" type="text" name="subject" value="{$params.subject|escape}" /></td>
  </tr>
  <tr>
    <th class="w100 h50">添付</th>
    <td><input class="" type="file" name="attachment" /></td>
  </tr>
  <tr>
    <td colspan="2">
      <textarea name="body" class="w100p fs12" rows="20">{$params.body|escape}</textarea>
    </td>
  </tr>
</table>
</div><!-- .layout-3-column-center-->
<input type="hidden" name="__time" value="{$__time}" />
<input type="hidden" name="__token" value="{$__token}" />
</form>

{include file="`$smarty.const.PATH_ROOT`/views/base/pc/parts/profile.parts.tpl"}

{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
