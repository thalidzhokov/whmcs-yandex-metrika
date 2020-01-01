<?php

if (!defined('WHMCS')) {
    die('This file cannot be accessed directly');
}

/**
 * @return array
 */
function yandex_metrika_config()
{
    $configArray = [
        'name' => 'Яндекс.Метрика',
        'description' => 'Данное дополнение позволяет интегрировать Яндекс.Метрику в WHMCS',
        'author' => 'Albert Thalidzhokov',
        'language' => 'russian',
        'version' => '1.0',
        'fields' => [
            'id' => [
                'FriendlyName' => 'Номер счетчика',
                'Type' => 'text',
                'Size' => '30',
            ],
            'xml_site' => [
                'FriendlyName' => 'Для XML сайтов',
                'Type' => 'yesno',
                'Description' => 'Элемент noscript не должен использоваться в XML-документах (Content‑Type:application/xhtml+xml).',
            ],
            'alternative_cdn' => [
                'FriendlyName' => 'Альтернативный CDN',
                'Type' => 'yesno',
                'Description' => 'Позволяет корректно учитывать посещения из регионов, в которых ограничен доступ к ресурсам Яндекса. Использование этой опции может снизить скорость загрузки кода счётчика.',
            ],
        ]
    ];

    return $configArray;
}

/**
 * @param $vars
 */
function yandex_metrika_output($vars)
{
    $url = !empty($vars['id']) && is_numeric($vars['id'])
        ? 'https://metrika.yandex.ru/dashboard?id=' . $vars['id']
        : 'https://metrika.yandex.ru/'; ?>

	<br>
	<br>
	<p align="center">
		<input type="button"
			   value="Перейти в Яндекс.Метрику"
			   onclick="window.open('<?= $url; ?>','ymetrika');"
			   class="btn btn-primary btn-lg">
	</p>
	<br>
	<br>
	<p>Настроить модуль Яндекс.Метрики вы можете перейдя в <a href="configaddonmods.php"><b>Настройки &gt; Дополнительные модули</b></a>. Убедитесь, что в вашем шаблоне в footer.tpl содержится тег {$footeroutput}, если этого тега в шаблоне нет, то счетчик не будет устанвлен</p>

<?php }
