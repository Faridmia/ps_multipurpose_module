{extends file='page.tpl'}
{block name='page_content_container'}
    <div class="container">
        <select name="cats" id="cats">
            <option value="">select</option>
            
                {foreach from=$categories item=$cat}
                    <option value="{$cat['id_category']}">{$cat['name']}</option>
                {/foreach}
        </select>
    </div>
    

    <table id="producttable" class="table table-hover ajax-table">
        <thead>
            <tr>
                <th>id</th>
                <th>product name</th>
                <th>price</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
{/block}