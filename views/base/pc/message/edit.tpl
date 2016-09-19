
{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl" add_css="" add_js=""}

<form action="/message/post" method="post" enctype="multipart/form-data">
{include file="`$smarty.const.PATH_ROOT`/views/base/pc/message/menu.parts.tpl"}

<div class="layout-3-column-center left">
<table class="w100p">
  <tr>
    <th class="w100 h50">TO</th>
    <td><input class="h30 fs12" type="text" name="to" value="{$params.to}" /></td>
  </tr>
  <tr>
    <th class="w100 h50">件名</th>
    <td><input class="h30 fs12" type="text" name="subject" value="{$params.subject}" /></td>
  </tr>
  <tr>
    <th class="w100 h50">添付</th>
    <td><input class="" type="file" name="attachment" /></td>
  </tr>
  <tr>
    <td colspan="2">
      <textarea name="body" class="w100p fs12" rows="20">{$params.body}</textarea>
    </td>
  </tr>
</table>
</div><!-- .layout-3-column-center-->
</form>

{include file="`$smarty.const.PATH_ROOT`/views/base/pc/parts/profile.parts.tpl"}

{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
