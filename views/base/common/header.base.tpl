<html>
<head>
<title>{$smarty.const.SITE_NAME}{if $pageTitle}&nbsp;|&nbsp;{$pageTitle}{/if}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">

<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="/css/common.css">
<link rel="stylesheet" href="/css/style.css">

{if $add_css}
{assign var="css" value=","|explode:$add_css}
{foreach from=$css item=item}
<link rel="stylesheet" href="/css/{$item}" type="text/css" />
{/foreach}
{/if}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="/js/jquery.hoverpulse.js"></script>

{if $add_js}
{assign var="js" value=","|explode:$add_js}
{foreach from=$js item=item}
<script src="/js/{$item}" type="text/javascript" ></script>
{/foreach}
{/if}

</head>
<body>
<header>
  <ul class="left">
    <li><a href="/"><img src="https://placehold.jp/3d4070/ffffff/150x60.png" alt="logo" /></a></li>
  </ul>
  <ul id="header">
    <li style="vertical-align: middle;">
      <form class="search" action="/search" method="post">
        <input style="height: 30px;" type="text" name="keyword" value="" placeholder="検索キーワード" />
        <button>O</button>
      </form>
    </li>
{if $user}
    <li><a href="/account/mypage/{$user->getId()}">マイページ</a></li>
    <li><a href="/message/inbox" class="{if $isNewMessage}new{/if}">メッセージ</a></li>
{else}
    <li><a href="/account/login">ログイン</a></li>
    <li><a href="/message">メッセージ</a></li>
{/if}
    <li><a href="/help">ヘルプ</a></li>
  </ul>
</header>
<div id="container" class="clearfix">
