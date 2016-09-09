{include file="`$smarty.const.PATH_VIEWS`/common/header.tpl"}

<ul>
{if $user}
  {if $myblog}
  <li><a href="/blog/edit">{$lang->convert('ブログ編集')}</a></li>
  <li><a href="/blog/post">{$lang->convert('ブログ投稿')}</a></li>
  {else}
  <li><a href="/blog/open">{$lang->convert('ブログ開設')}</a></li>
  {/if}
{else}
  <li><a href="/user/login?r={$smarty.server.REQUEST_URI|urlencode}">{$lang->convert('ログイン')}</a></li>
{/if}


{foreach from=$usersArticle item=userArticle}
<li><a href="/blog/detail/{$userArticle->getUserId()}/{$userArticle->getId()}">{$userArticle->getTitle()}</a></li>
{/foreach}
</ul>



{include file="`$smarty.const.PATH_VIEWS`/common/footer.tpl"}
