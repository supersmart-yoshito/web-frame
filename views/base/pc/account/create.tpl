{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl"}

<div class="layout-3-column-left left">
<p>test</p>
</div> <!-- div.layout-3-column-left -->

<div class="layout-3-column-center left">
<div class="w100p">
<h1>プロフィール入力</h1>
<form action="/account/create/confirm" method="post" class="dib">
<table id="form">
<tr><th class="tit w100">ログインID</th><td><input class="w300 fs12" type="text" placeholder="半角英数4文字以上16文字以下" name="user_id" value="{$params.user_id}" />{if $error.user_id}<span class="warn">{$error.user_id}</span>{/if}</td></tr>
<tr><th class="tit w100">パスワード</th><td><input class="w300 fs12" type="text" placeholder="半角英数6文字以上16文字以下" name="user_pass" value="{$params.user_pass}" />{if $error.user_pass}<span class="warn">{$error.user_pass}</span>{/if}</td></tr>
<tr><th class="tit w100">ニックネーム</th><td><input class="w300 fs12" type="text" placeholder="32文字以内" name="user_nickname" value="{$params.user_nickname}" />{if $error.user_nickname}<span class="warn">{$error.user_nickname}</span>{/if}</td></tr>
<tr><th class="tit w100">誕生日</th><td>{include file="`$smarty.const.PATH_ROOT`/views/base/common/birthdate.parts.tpl"}</td></tr>
<tr><th class="tit w100">性別</th><td>{include file="`$smarty.const.PATH_ROOT`/views/base/common/sex.parts.tpl"}</td></tr>
<tr><th class="tit w100">都道府県</th><td>{include file="`$smarty.const.PATH_ROOT`/views/base/common/prefectures.parts.tpl"}</td></tr>
<tr><th class="tit w100">職業</th><td>{include file="`$smarty.const.PATH_ROOT`/views/base/common/job.parts.tpl"}</td></tr>
<tr><th class="tit w100">プロフィール</th><td><textarea name="profile" class="w100p fs12" rows="10">{$params.profile}</textarea></td></tr>
</table>
<input type="submit" value="確認する" />
<input type="hidden" name="__time" value="{$__time}" />
<input type="hidden" name="__token" value="{$__token}" />
</form>
</div>
</div> <!-- div.layout-3-column-center -->

<div class="layout-3-column-right left">
<p>test</p>
</div> <!-- div.layout-3-column-left -->

{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
