<?php

namespace GeneratorX;

class Integrator {

	private $twig;
	private $parser;
	private $json;
	private $array;

	public function __construct() {
		$this->twig = new \Twig_Environment(new \Twig_Loader_String('templates'),array(
			'autoescape' => false
		));

		global $argv;
		if (isset($argv[1])) {

			$this->json = file_get_contents($argv[1]);
			$this->json = str_replace(['{%','%}'],['{{','}}'],$this->json);
			$this->array = json_decode($this->json,true);

		} else throw new \Exception('Integration file not found.');
	}

	public function execute() {
		$parser = new \GeneratorX\IntegrationParser($this,$this->array);
		$parser->execute();
	}

	/**
	 * @return mixed
	 */
	public function getArray() {
		return $this->array;
	}

	/**
	 * @param mixed $array
	 */
	public function setArray( $array ) {
		$this->array = $array;
	}

	/**
	 * @return mixed
	 */
	public function getJson() {
		return $this->json;
	}

	/**
	 * @param mixed $json
	 */
	public function setJson( $json ) {
		$this->json = $json;
	}

	/**
	 * @return mixed
	 */
	public function getParser() {
		return $this->parser;
	}

	/**
	 * @param mixed $parser
	 */
	public function setParser( $parser ) {
		$this->parser = $parser;
	}

	/**
	 * @return mixed
	 */
	public function getTwig() {
		return $this->twig;
	}

	/**
	 * @param mixed $twig
	 */
	public function setTwig( $twig ) {
		$this->twig = $twig;
	}

}