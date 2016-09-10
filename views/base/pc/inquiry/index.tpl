{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl"}


<form action="/inquiry/submit" method="post">
<dl>
<dt>お問合せカテゴリ</dt>
<dd>
<select name="category">
<option value="サービスについて">サービスについて</option>
<option value="改善や要望について">改善やご要望について</option>
<option value="その他">その他</option>
</select>
</dd>
<dt>お問合せ内容</dt>
<dd>
<textarea cols="40" rows="8">{$text}</textarea>
</dd>
</dl>
<input type="submit" value="送信" />
</form>

{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
