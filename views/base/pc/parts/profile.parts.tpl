<div class="parts">
<ul id="profile-list">
<li id="profile-image"><a href="/"><img src="https://placehold.jp/3d4070/ffffff/75x75.png"/></a></li>
{if !$myprofile}
{if $smarty.const.ENABLE_FRIEND}
<li><a href="/friend/index" class="btn {if $isNewFriend}new{/if}">友達{if $requestCount}({$requestCount}){/if}</a></li>
{/if}
{if $smarty.const.ENABLE_GROUP}
<li><a href="/group/index" class="btn {if $isNewGroup}new{/if}">グループ{if $joinCount}({$joinCount}){/if}</a></li>
{/if}
{if $smarty.const.ENABLE_MESSAGE}
<li><a href="/message/index" class="btn {if $isNewMessage}new{/if}">メッセージ{if $unreadCount}({$unreadCount}){/if}</a></li>
{/if}
{if $smarty.const.ENABLE_BLOG}
<li><a href="/blog/index" class="btn {if $isNewBlog}new{/if}">ブログ{if $blogUnreadCount}({$blogUnreadCount}){/if}</a></li>
{/if}
{if $smarty.const.ENABLE_PHOTO}
<li><a href="/photo/index" class="btn {if $isNewPhoto}new{/if}">写真{if $photoUnreadCount}({$photoUnreadCount}){/if}</a></li>
{/if}
{if $smarty.const.ENABLE_EVENT}
<li><a href="/event/index" class="btn {if $isNewEvent}new{/if}">イベント{if $eventUnreadCount}({$eventUnreadCount}){/if}</a></li>
{/if}
{if $smarty.const.ENABLE_TRADE}
<li><a href="/trade/index" class="btn {if $isNewTrade}new{/if}">トレード{if $tradeUnreadCount}({$tradeUnreadCount}){/if}</a></li>
{/if}
{else}{*<!-- !$myprofile --*}
<li><a href="/user/{$myprofile->getid()}/follow" class="btn">フォローする</a></li>
{if $smarty.const.ENABLE_FRIEND}
<li><a href="/user/{$myprofile->getid()}/friend" class="btn">友達になる</a></li>
{/if}
{if $smarty.const.ENABLE_GROUP}
<li><a href="/user/{$myprofile->getid()}/group" class="btn">グループをみる</a></li>
{/if}
{if $smarty.const.ENABLE_MESSAGE}
<li><a href="/user/{$myprofile->getId()}/message" class="btn">メッセージを送る</a></li>
{/if}
{if $smarty.const.ENABLE_BLOG}
<li><a href="/user/{$myprofile->getid()}/blog" class="btn">ブログをみる</a></li>
{/if}
{if $smarty.const.ENABLE_PHOTO}
<li><a href="/user/{$myprofile->getid()}/photo" class="btn">写真をみる</a></li>
{/if}
{if $smarty.const.ENABLE_EVENT}
<li><a href="/user/{$myprofile->getid()}/event" class="btn">イベントをみる</a></li>
{/if}
{if $smarty.const.ENABLE_TRADE}
<li><a href="/user/{$myprofile->getid()}/trade" class="btn">トレードをみる</a></li>
{/if}
{/if}
</ul>
</div>{*<!-- #profile.parts -->*}
