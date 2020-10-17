{*
* Copyright (C) 2015-2018 Brainify - All Rights Reserved
*
* @author Brainify <tech@brainify.it>
* @copyright 2015-2018 Brainify
*}

<div >
    <div >
        {if isset($debugError)}
            <h1>Exception</h1>
            <pre>{$debugError|escape:'htmlall':'UTF-8'}</pre>
        {else}
            An error occurred.

            Please try to refresh this page.
        {/if}
    </div>
</div>
