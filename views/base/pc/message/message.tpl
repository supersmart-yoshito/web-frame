{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl" add_css="" add_js=""}

{include file="`$smarty.const.PATH_ROOT`/views/base/pc/message/menu.parts.tpl"}

<div class="layout-3-column-center h100p">
<table class="w100p">
  <tr>
    <th class="w100 h50">To</th>
    <td>{$message->getToAccountId()|idtoname|escape}</td>
  </tr>
  <tr>
    <th class="w100 h50">From</th>
    <td>{$message->getFromAccountId()|idtoname|escape}</td>
  </tr>
  <tr>
    <th class="w100 h50">件名</th>
    <td>{$message->getSubject()|escape}</td>
  </tr>
  <tr>
    <th class="w100 h50">添付</th>
    <td><input class="" type="file" name="attachment" /></td>
  </tr>
  <tr>
    <td colspan="2">{$message->getBody()|escape|nl2br}</td>
  </tr>
</table>
</div><!-- .layout-3-column-center-->
</form>

{include file="`$smarty.const.PATH_ROOT`/views/base/pc/parts/profile.parts.tpl"}

{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
