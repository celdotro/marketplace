<?php

namespace celmarket\Products;

use celmarket\Dispatcher;


class ProductsStatus
{

	/**
	 * [RO] Verifica status import produse (https://github.com/celdotro/marketplace/wiki/Adauga-o-noua-oferta-unui-produs-existent)
	 * [EN] Check products import status (https://github.com/celdotro/marketplace/wiki/Add-offer-to-existing-product)
	 * @param $products_model
	 * @param $stoc
	 * @param $pret
	 * @param $overridePrice
	 * @return mixed
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function getProductImportStatus($products)
	{
		// Sanity check - for older versions of PHP
		if (!isset($products)) throw new \Exception('Specificati lista de produse');

		// Set method and action
		$method = 'import';
		$action = 'productImportStatus';

		// Set data
		$data = array(
			'products' => json_encode($products)
		);

		// Send request and retrieve response
		$result = Dispatcher::send($method, $action, $data);

		return $result;
	}
}
