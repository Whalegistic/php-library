<?php

use \GuzzleHttp\Client;
use \GuzzleHttp\Promise\Utils;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class Whalegistic{
	
	protected string $pub_key;
    protected string $pri_key;
    protected string $token;
    protected $client;

    public function __construct(string $pk, string $sk) {
        $this->pub_key = $pk;
        $this->pri_key = $sk;

        $this->client = new GuzzleHttp\Client();

        $payload = [
        	"public_key" => $pk
        ];

        $this->token = JWT::encode($payload, $sk, 'HS256');
    }

    public function getBrands($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	    $brands_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/get-brands', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$brands_obj = json_decode(((string) $brands_obj->getBody()), true);

	    return $brands_obj['brands'];

	}

	public function getCategories($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	    $categories_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/get-categories', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$categories_obj = json_decode(((string) $categories_obj->getBody()), true);

	    return $categories_obj['categories'];

	}

	public function getCollections($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	    $collections_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/get-collections', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$collections_obj = json_decode(((string) $collections_obj->getBody()), true);

	    return $collections_obj['collections'];

	}

	public function getStore($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

		$products_obj = $this->client->postAsync(
			'https://whalegistic.com/api/get-products', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$brands_obj = $this->client->postAsync(
			'https://whalegistic.com/api/get-brands', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$categories_obj = $this->client->postAsync(
			'https://whalegistic.com/api/get-categories', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$collections_obj = $this->client->postAsync(
			'https://whalegistic.com/api/get-collections', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$promises = [$products_obj, $brands_obj, $categories_obj, $collections_obj];

		$results = GuzzleHttp\Promise\Utils::settle(
		    GuzzleHttp\Promise\Utils::unwrap($promises),
		)->wait();

		$products_obj = json_decode($results[0]['value']->getBody()->getContents(), true);
		$brands_obj = json_decode($results[1]['value']->getBody()->getContents(), true);
		$categories_obj = json_decode($results[2]['value']->getBody()->getContents(), true);
		$collections_obj = json_decode($results[3]['value']->getBody()->getContents(), true);

		$response = [];
		$response["products"] = $products_obj["products"];
		$response["max_product_price"] = $products_obj["max_price"];
		$response["number_products"] = $products_obj["total_products_count"];
		$response["brands"] = $brands_obj["brands"];
		$response["categories"] = $categories_obj["categories"];
		$response["collections"] = $collections_obj["collections"];

		return $response;

	}

	public function getProducts($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

		$products_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/get-products', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$products_obj = json_decode(((string) $products_obj->getBody()), true);

	    return $products_obj['products'];

	}

	public function getCollectionProducts($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	   	$products_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/get-collections-products', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$products_obj = json_decode(((string) $products_obj->getBody()), true);

	    return $products_obj['products'];

	}

	public function getRelatedProducts($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	    $products_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/get-related-products', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$products_obj = json_decode(((string) $products_obj->getBody()), true);

	    return $products_obj['products'];

	}

	public function getProductBySlug($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	    $products_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/get-product-by-slug', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$products_obj = json_decode(((string) $products_obj->getBody()), true);

	    return $products_obj['products'][0];

	}

	public function getClient($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	    $client_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/get-client', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$client_obj = json_decode(((string) $client_obj->getBody()), true);

	    return $client_obj['client'];

	}

	public function createClient($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	    $client_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/create-client', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$client_obj = json_decode(((string) $client_obj->getBody()), true);

	    return $client_obj;

	}

	public function updateClient($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	    $client_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/update-client', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$client_obj = json_decode(((string) $client_obj->getBody()), true);

	    return $client_obj['succ'];

	}

	public function getClientOrders($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	    $client_orders_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/get-client-orders', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$client_orders_obj = json_decode(((string) $client_orders_obj->getBody()), true);

	    return $client_orders_obj['orders'];

	}

	public function getClientProfile($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

		$client_obj = $this->client->postAsync(
			'https://whalegistic.com/api/get-client', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$client_orders_obj = $this->client->postAsync(
			'https://whalegistic.com/api/get-client-orders', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$promises = [$client_obj, $client_orders_obj];

		$results = GuzzleHttp\Promise\Utils::settle(
		    GuzzleHttp\Promise\Utils::unwrap($promises),
		)->wait();

		$client_obj = json_decode($results[0]['value']->getBody()->getContents(), true);
		$client_orders_obj = json_decode($results[1]['value']->getBody()->getContents(), true);

		$response = [];
		$response["client"] = $client_obj["client"];
		$response["client_orders"] = $client_orders_obj["orders"];

		unset($response["client"]["ID"]);
		unset($response["client"]["Store_ID"]);

		return $response;

	}

	public function createContact($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	    $contact_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/create-contact', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$contact_obj = json_decode(((string) $contact_obj->getBody()), true);

	    return $contact_obj['succ'];

	}

	public function createNewsletter($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	    $newsletter_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/create-newsletter', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$newsletter_obj = json_decode(((string) $newsletter_obj->getBody()), true);

	    return $newsletter_obj['succ'];

	}

	public function getShippingRates($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	    $shipping_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/get-shipping-rates', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$shipping_obj = json_decode(((string) $shipping_obj->getBody()), true);

	    return $shipping_obj['shipping_costs'];

	}

	public function getShippingRate($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	    $shipping_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/get-shipping-rate', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$shipping_obj = json_decode(((string) $shipping_obj->getBody()), true);

	    return $shipping_obj['shipping'];

	}

	public function getPromoCode($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	    $promo_code_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/search-promo-code', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$promo_code_obj = json_decode(((string) $promo_code_obj->getBody()), true);

	    return $promo_code_obj['promo_code'];

	}

	public function getOrder($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	    $order_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/get-order', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$order_obj = json_decode(((string) $order_obj->getBody()), true);

	    return $order_obj['order'];

	}

	public function getTotal($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	    $total_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/get-total', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$total_obj = json_decode(((string) $total_obj->getBody()), true);

	    return $total_obj;

	    return $total_obj;

	}

	public function createOrder($send_obj){

		if($send_obj == null) $send_obj = [];

		$send_obj["public_key"] = $this->pub_key;

	    $order_obj = $this->client->request(
			'POST', 
			'https://whalegistic.com/api/create-order', 
			[
				'headers' => [
					'Content-Type' => 'application/json',
		        	'Authorization' => 'Bearer ' . $this->token
				],
				'json' => $send_obj
			]
		);

		$order_obj = json_decode(((string) $order_obj->getBody()), true);

	    return $order_obj;

	}

}

?>