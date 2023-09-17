<?php

use  WHMCS\Module\Addon\YandexMetrika\Config;

if (!defined('WHMCS')) {
    die('This file cannot be accessed directly');
}

/**
 * @param $vars
 * @return string
 */
function addYandexMetrika($vars)
{
    $rtn = '';

    $config = new Config();
    $id = !empty($config['id']) && is_numeric($config['id'])
        ? $config['id']
        : 0;
    $alternativeCdn = !empty($config['alternative_cdn']) && $config['alternative_cdn'] === 'on'
        ? 'https://cdn.jsdelivr.net/npm/yandex-metrica-watch/tag.js'
        : 'https://mc.yandex.ru/metrika/tag.js';

    if ($id) {
        ob_start(); ?>

	<!-- Yandex.Metrika counter -->
	<script type="text/javascript" >
	(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
		m[i].l=1*new Date();
		for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
		k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
	(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(<?= $id; ?>, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true,
            trackHash:true
        });
	</script>
        <?php if ($config['xml_site'] !== 'on') { ?>
			<noscript><img src="https://mc.yandex.ru/watch/<?= $id; ?>" style="position:absolute; left:-9999px;"></noscript>
		<?php } ?>
		<!-- /Yandex.Metrika counter -->

        <?php $rtn = ob_get_clean();
    }

    return $rtn;
}

add_hook('ClientAreaFooterOutput', 1, 'addYandexMetrika');
