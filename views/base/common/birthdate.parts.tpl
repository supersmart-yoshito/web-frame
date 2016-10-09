<select name="birth_year">
  {section name=birth_year loop=(1+$smarty.now|date_format:'%Y') step=-1 max=120}
  <option value="{$smarty.section.birth_year.index}" {if $params.birth_year == $smarty.section.birth_year.index}selected{/if}>{$smarty.section.birth_year.index}</option>
  {/section}
</select><!-- name=birth_year -->
<select name="birth_month">
  <option value="1" {if $params.birth_month == 1}selected{/if}>1</option>
  <option value="2" {if $params.birth_month == 2}selected{/if}>2</option>
  <option value="3" {if $params.birth_month == 3}selected{/if}>3</option>
  <option value="4" {if $params.birth_month == 4}selected{/if}>4</option>
  <option value="5" {if $params.birth_month == 5}selected{/if}>5</option>
  <option value="6" {if $params.birth_month == 6}selected{/if}>6</option>
  <option value="7" {if $params.birth_month == 7}selected{/if}>7</option>
  <option value="8" {if $params.birth_month == 8}selected{/if}>8</option>
  <option value="9" {if $params.birth_month == 9}selected{/if}>9</option>
  <option value="10" {if $params.birth_month == 10}selected{/if}>10</option>
  <option value="11" {if $params.birth_month == 11}selected{/if}>11</option>
  <option value="12" {if $params.birth_month == 12}selected{/if}>12</option>
</select><!-- name=birth_month -->
<select name="birth_day">
  <option value="1" {if $params.birth_day == 1}selected{/if}>1</option>
  <option value="2" {if $params.birth_day == 2}selected{/if}>2</option>
  <option value="3" {if $params.birth_day == 3}selected{/if}>3</option>
  <option value="4" {if $params.birth_day == 4}selected{/if}>4</option>
  <option value="5" {if $params.birth_day == 5}selected{/if}>5</option>
  <option value="6" {if $params.birth_day == 6}selected{/if}>6</option>
  <option value="7" {if $params.birth_day == 7}selected{/if}>7</option>
  <option value="8" {if $params.birth_day == 8}selected{/if}>8</option>
  <option value="9" {if $params.birth_day == 9}selected{/if}>9</option>
  <option value="10" {if $params.birth_day == 10}selected{/if}>10</option>
  <option value="11" {if $params.birth_day == 11}selected{/if}>11</option>
  <option value="12" {if $params.birth_day == 12}selected{/if}>12</option>
  <option value="13" {if $params.birth_day == 13}selected{/if}>13</option>
  <option value="14" {if $params.birth_day == 14}selected{/if}>14</option>
  <option value="15" {if $params.birth_day == 15}selected{/if}>15</option>
  <option value="16" {if $params.birth_day == 16}selected{/if}>16</option>
  <option value="17" {if $params.birth_day == 17}selected{/if}>17</option>
  <option value="18" {if $params.birth_day == 18}selected{/if}>18</option>
  <option value="19" {if $params.birth_day == 19}selected{/if}>19</option>
  <option value="20" {if $params.birth_day == 20}selected{/if}>20</option>
  <option value="21" {if $params.birth_day == 21}selected{/if}>21</option>
  <option value="22" {if $params.birth_day == 22}selected{/if}>22</option>
  <option value="23" {if $params.birth_day == 23}selected{/if}>23</option>
  <option value="24" {if $params.birth_day == 24}selected{/if}>24</option>
  <option value="25" {if $params.birth_day == 25}selected{/if}>25</option>
  <option value="26" {if $params.birth_day == 26}selected{/if}>26</option>
  <option value="27" {if $params.birth_day == 27}selected{/if}>27</option>
  <option value="28" {if $params.birth_day == 28}selected{/if}>28</option>
  <option value="29" {if $params.birth_day == 29}selected{/if}>29</option>
  <option value="30" {if $params.birth_day == 30}selected{/if}>30</option>
  <option value="31" {if $params.birth_day == 31}selected{/if}>31</option>
</select><!-- name=birth_day -->
