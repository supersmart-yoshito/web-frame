{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl"}

<div class="left3column">
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

<div class="centert3column">
{foreach from=$usersArticle item=userArticle}
<li><a href="/blog/detail/{$userArticle->getUserId()}/{$userArticle->getId()}">{$userArticle->getTitle()}</a></li>
{/foreach}
</ul>
</div>

<div class="right3column">
</div>


{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
