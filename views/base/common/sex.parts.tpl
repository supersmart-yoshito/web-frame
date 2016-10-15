<ul class="hlist">
<li><input type="radio" name="sex" value="m" {if $params.sex == "m" || empty($params.sex)}checked{/if}/><label>男性</label></li>
<li><input type="radio" name="sex" value="f" {if $params.sex == "f"}checked{/if}/><label>女性</label></li>
<li><input type="radio" name="sex" value="x" {if $params.sex == "x"}checked{/if}/><label>その他</label></li>
</ul>
