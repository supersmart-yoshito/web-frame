<select name="job">
  <option value="1" {if $params.job == 1}selected{/if}>非公開</option>
  <option value="2" {if $params.job == 2}selected{/if}>会社員</option>
  <option value="3" {if $params.job == 3}selected{/if}>会社役員</option>
  <option value="4" {if $params.job == 4}selected{/if}>公務員</option>
  <option value="5" {if $params.job == 5}selected{/if}>学生</option>
  <option value="6" {if $params.job == 6}selected{/if}>自営業</option>
  <option value="7" {if $params.job == 7}selected{/if}>フリーター</option>
  <option value="8" {if $params.job == 8}selected{/if}>専業主婦（主夫）</option>
  <option value="9" {if $params.job == 9}selected{/if}>その他</option>
</select><!-- name=job-->
