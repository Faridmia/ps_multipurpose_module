<form method="post">
    <div class="panel">
        <div class="panel-heading">
            {l s="Configuration" mod="multipurpose"}
        </div>

        <div class="panel-body">
            <label for="print">{l s="What to print?" mod="multipurpose"}</label>
            <input type="text" name="print" class="form-control" id="print" value="{$MULTIPURPOSE_STR}"/>
            <hr/>
            <label for="print">{l s="Customer Email?" mod="multipurpose"}</label>
            <input type="text" id="customer_email" name="customer_email" class="form-control" id="print" value=""/>
            <hr/>
            
            <a href="index.php?controller=AdminOrders&token={$token}">{$token}</a>
            <br/>
            {foreach from=$images_array item=ia }
                <img src="//{$ia}" alt="alt image"/>
            {/foreach}
        </div>
        <div class="panel-footer">
            <button type="submit" name="savesubmit" class="btn btn-default pull-right">
                <i class="process-icon-save"></i>
                {l s="Save" mod="multipurpose"}
            </button>
        </div>
    </div>
</form>