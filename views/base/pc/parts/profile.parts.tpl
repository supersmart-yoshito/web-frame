<div class="parts">
<ul id="profile-list">
<li id="profile-image"><a href="/"><img src="https://placehold.jp/3d4070/ffffff/75x75.png"/></a></li>
{if !$myprofile}
<li><a href="/friend/index" class="btn {if $isNewFriend}new{/if}">友達</a></li>
<li><a href="/group/index" class="btn {if $isNewGroup}new{/if}">グループ</a></li>
<li><a href="/message/index" class="btn {if $isNewMessage}new{/if}">メッセージ</a></li>
<li><a href="/blog/index" class="btn {if $isNewBlog}new{/if}">ブログ</a></li>
<li><a href="/photo/index" class="btn {if $isNewPhoto}new{/if}">写真</a></li>
<li><a href="/event/index" class="btn {if $isNewEvent}new{/if}">イベント</a></li>
<li><a href="/trade/index" class="btn {if $isNewTrade}new{/if}">トレード</a></li>
{else}{*<!-- !$myprofile --*}
<li><a href="/user/{$myprofile->getid()}/follow" class="btn">フォローする</a></li>
<li><a href="/user/{$myprofile->getid()}/friend" class="btn">友達になる</a></li>
<li><a href="/user/{$myprofile->getid()}/group" class="btn">グループをみる</a></li>
<li><a href="/user/{$myprofile->getId()}/message" class="btn">メッセージを送る</a></li>
<li><a href="/user/{$myprofile->getid()}/blog" class="btn">ブログをみる</a></li>
<li><a href="/user/{$myprofile->getid()}/photo" class="btn">写真をみる</a></li>
<li><a href="/user/{$myprofile->getid()}/event" class="btn">イベントをみる</a></li>
<li><a href="/user/{$myprofile->getid()}/trade" class="btn">トレードをみる</a></li>
{/if}
</ul>
</div>{*<!-- #profile.parts -->*}
