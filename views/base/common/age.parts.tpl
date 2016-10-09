<select name="age">
  <option value="1" {if $params.age == 1}selected{/if}>10代</option>
  <option value="2" {if $params.age == 2}selected{/if}>20代</option>
  <option value="3" {if $params.age == 3}selected{/if}>30代</option>
  <option value="4" {if $params.age == 4}selected{/if}>40代</option>
  <option value="5" {if $params.age == 5}selected{/if}>50代</option>
  <option value="6" {if $params.age == 6}selected{/if}>60代</option>
  <option value="7" {if $params.age == 7}selected{/if}>70代</option>
  <option value="8" {if $params.age == 8}selected{/if}>80代</option>
  <option value="9" {if $params.age == 9}selected{/if}>90代</option>
  <option value="10" {if $params.age == 10}selected{/if}>10歳未満</option>
  <option value="11" {if $params.age == 11}selected{/if}>100歳以上</option>
</select><!-- name=age -->
