
{include file="`$smarty.const.PATH_VIEWS`/common/header.tpl"}


<p>confirm</p>
<form action="" method="post">
<table>
<tr><td><input type="text" name="user_id" value="{$user_id}" placeholder="id"/></td></tr>
<tr><td><input type="text" name="user_pass" value="{$user_pass}" placeholder="pass"/></td></tr>
</table>
<input type="submit" value="submit" />
<input type="hidden" name="confirm" value="1" />
<input type="hidden" name="__time" value="{$__time}" />
<input type="hidden" name="__token" value="{$__token}" />
</form>


{include file="`$smarty.const.PATH_VIEWS`/common/footer.tpl"}
