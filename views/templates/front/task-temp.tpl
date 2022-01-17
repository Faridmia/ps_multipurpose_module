{extends file='page.tpl'}
{block name='page_content_container'}
   <ul>
        <li>
            {l s='Number of Products: ' mod='multipurpose'}&nbsp;{$nb_product}
        </li>
        <li>
            Categories:
            <u>
                {foreach from=$categories item=$cat}
                    <li>{$cat['name']}</li>
                {/foreach}
            </ul>
        </li>
        <li>{$shop_name}</li>
        <li>{$manufacturer['name']}</li>
   </ul>
{/block}