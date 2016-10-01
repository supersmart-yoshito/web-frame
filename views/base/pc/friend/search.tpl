{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl" add_css="" add_js=""}
{include file="`$smarty.const.PATH_VIEWS`/common/menu.parts.tpl"}

<div class="layout-3-column-center h100p">
<form action="" method="post">
  <table>
    <tr>
      <th>性別</th>
      <td>{include file="`$smarty.const.PATH_ROOT`/views/base/common/sex.parts.tpl"}</td>
    </tr>
    <tr>
      <th>都道府県</th>
      <td>{include file="`$smarty.const.PATH_ROOT`/views/base/common/prefectures.parts.tpl"}</td>
    </tr>
    <tr>
      <th>キーワード</th>
      <td><input type="text" name="keyword" value="" /></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="検索" /></td>
    </tr>
  </table>
</form>
</div><!-- .layout-3-column-center-->

{include file="`$smarty.const.PATH_ROOT`/views/base/pc/parts/profile.parts.tpl"}
{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
