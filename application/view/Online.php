{foreach from=$online_reps item=reps}
    {if $reps['status'] == 'Online'}
        <li id="{$reps['user_id']}" onclick="{if $support_clicked == 0}openChatInquiryWindow({$reps['user_id']},'{$base_url}',event);{else}{/if}">{$reps['name']}</li>
    {/if}
{/foreach}