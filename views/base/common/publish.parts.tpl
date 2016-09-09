<select name="publish">
<option value="1"{if $publish == 0 || $publish == 1} selected{/if}>{$lang->convert('全体に公開')}</option>
<option value="2"{if $publish == 2} selected{/if}>{$lang->convert('友達に公開')}</option>
<option value="3"{if $publish == 3} selected{/if}>{$lang->convert('グループに公開')}</option>
<option value="4"{if $publish == 4} selected{/if}>{$lang->convert('非公開')}</option>
</select>
