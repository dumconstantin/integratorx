<?php

namespace GeneratorX;

class IntegrationParser {

	private $integrator;

	public function __construct(Integrator $integrator) {
		$this->integrator = $integrator;
	}

	public function parsePlugin($parentPluginName,$parentPluginParams) {

		$twig = $this->integrator->getTwig();
		$plugin = include __DIR__.'/../../plugins/'.$parentPluginName.'/settings.php';

		$plugins = [];
		$elements = [];

		foreach ($parentPluginParams['plugins'] as $pluginName => $pluginParams) {
			if (!isset($plugins[$parentPluginName])) $plugins[$parentPluginName] = [];

			$plugins[$parentPluginName][$pluginName] = $this->parsePlugin($pluginName,$pluginParams);

		}

		foreach ($parentPluginParams['elements'] as $elementName => $elementHtml) {
			if (!isset($elements[$parentPluginName])) $elements[$parentPluginName] = [];

			$localProps = [];

			foreach ($plugin['parts'][$elementName] as $propName => $propValue) {
				if (!isset($localProps[$plugin['name']])) $localProps[$plugin['name']] = [];
				if (!isset($localProps[$plugin['name']][$elementName])) $localProps[$plugin['name']][$elementName] = [];

				$localProps[$plugin['name']][$elementName][$propName]=$propValue;
			}

			if (isset($plugin['parts'][$elementName]['_before'])) {
				$elementHtml = $plugin['parts'][$elementName]['_before'].$elementHtml;
			}

			if (isset($plugin['parts'][$elementName]['_after'])) {
				$elementHtml = $elementHtml.$plugin['parts'][$elementName]['_after'];
			}

			$elements[$parentPluginName][$elementName] = $twig->render(
				$elementHtml
				, array_merge($plugins,$localProps));

		}

		var_dump($plugin);

		if (isset($plugin['_before'])) {
//			$parentPluginParams['html'] = $plugin['_before'].$parentPluginParams['html'];

			$elements[$parentPluginName.'_before'] = $plugin['_before'];
		}

		if (isset($plugin['_after'])) {
//			$parentPluginParams['html'] = $parentPluginParams['html'].$plugin['_after'];

			$elements[$parentPluginName.'_after'] = $plugin['_after'];
		}

				echo "\n".'---------------------------------------'."\n";
		var_dump($parentPluginParams['html']);

		$result = $twig->render(
			'{{ '.$parentPluginName.'_before }}'.$parentPluginParams['html'].'{{ '.$parentPluginName.'_after }}'
			, array_merge($plugins,$elements));

		var_dump($result);

//		echo '---------------------------------------'."\n";
//		echo '---------------------------------------'."\n";
//		echo $parentPluginParams['html'];
//		echo "\n".'---------------------------------------'."\n";
//		var_dump($params);
//		echo '---------------------------------------'."\n";
//		var_dump($parentPluginParams['html']);
//		echo "\n".'---------------------------------------'."\n";
//		echo $result;

		return $result;
	}

	public function execute() {

		echo str_replace(['{#','#}'],['',''],$this->parsePlugin('default',$this->integrator->getArray()));

	}

}