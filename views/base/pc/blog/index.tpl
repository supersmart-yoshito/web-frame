{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl"}

<div class="">
  <ul>
  {if $user}
  {if $myblog}
  <li><a href="/blog/edit">ブログ編集</a></li>
  <li><a href="/blog/post">ブログ投稿</a></li>
  {else}
  <li><a href="/blog/open">ブログ開設</a></li>
  {/if}
  {else}
  <li><a href="/account/login?r={$smarty.server.REQUEST_URI|urlencode}">ログイン</a></li>
  {/if}
</div>


{foreach from=$usersArticle item=userArticle}
<li><a href="/blog/detail/{$userArticle->getUserId()}/{$userArticle->getId()}">{$userArticle->getTitle()}</a></li>
{/foreach}
</ul>



{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
