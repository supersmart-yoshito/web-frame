
{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl"}


<div class="layout-3-column-left left">
<p>test</p>
</div> <!-- div.layout-3-column-left -->

<div class="layout-3-column-center left">
<div class="center w100p">
<p>confirm</p>
<form action="/account/create/complete" method="post">
<table class="bg-gray">
<tr><th class="w100">ログインID</th><td class="pl20"><span>{$params.user_id|escape}</span></td></tr>
<tr><th class="w100">パスワード</th><td class="pl20"><span>{$params.user_pass|escape}</span></td></tr>
<tr><th class="w100">ニックネーム</th><td class="pl20"><span>{$params.user_nickname|escape}</span></td></tr>
<tr><th class="w100">誕生日</th><td class="pl20"><span>{$params.birth_year}/{$params.birth_month}/{$params.birth_day}</span></td></tr>
<tr><th class="w100">性別</th><td class="pl20"><span>{if $params.sex == 'm'}男性{elseif $params.sex == 'f'}女性{else}その他{/if}</span></td></tr>
<tr><th class="w100">都道府県</th><td class="pl20"><span>{$params.prefectures}</span></td></tr>
<tr><th class="w100">プロフィール</th><td class="pl20"><span>{$params.profile|escape|nl2br}</span></td></tr>
</table>
<input type="submit" value="登録する" class="btn" />
<a href="javascript:history.back();" class="btn">キャンセル </a>
<input type="hidden" name="user_id" value="{$params.user_id}" />
<input type="hidden" name="user_pass" value="{$params.user_pass}" />
<input type="hidden" name="user_nickname" value="{$params.user_nickname}" />
<input type="hidden" name="user_birthday" value="{$params.birth_year}-{$params.birth_month|string_format:"%02d"}-{$params.birth_day|string_format:"%02d"}" />
<input type="hidden" name="user_sex" value="{$params.sex}" />
<input type="hidden" name="user_prefectures" value="{$params.prefectures}" />
<input type="hidden" name="user_profile" value="{$params.profile}" />
<input type="hidden" name="confirm" value="1" />
<input type="hidden" name="__time" value="{$__time}" />
<input type="hidden" name="__token" value="{$__token}" />
</form>
</div>
</div> <!-- div.layout-3-column-center -->

<div class="layout-3-column-right left">
<p>test</p>
</div> <!-- div.layout-3-column-left -->

{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
