<ul class="hlist">
<li><label>男性</label><input type="radio" name="sex" value="m" {if $params.sex == "m" || empty($params.sex)}checked{/if}/></li>
<li><label>女性</label><input type="radio" name="sex" value="f" {if $params.sex == "f"}checked{/if}/></li>
<li><label>その他</label><input type="radio" name="sex" value="x" {if $params.sex == "x"}checked{/if}/></li>
</ul>
