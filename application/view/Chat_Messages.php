{foreach from=$messages item=message}
	<div>{$message['message_from']} : {$message['message']}</div>
{/foreach}