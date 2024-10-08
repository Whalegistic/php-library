﻿# Welcome to WHALEGISTIC 

This is a platform to help E-Commerce businesses, Wholesalers, Distributors and developers to start selling products as fast as possible and to manage their products, promotions, stocks and everything related with an E-Commerce store. [Whalegistic](https://whalegistic.com/) is currently evolving to bring a better experience for people that want to start their Online Store.

With this in mind, we created a way for developers to connect with our platform and fetch all the information necessary to build an online store in no time. Get the products, group them by color or size, search for promotions, show your clients the available stock, fetch all your product collections, create orders and search for already existing order for specific clients.

## Quickstart

In order for you to be able to use this tool you will need to create an account at Whalegistic. To do soo, navigate to our website [Whalegistic Website](https://whalegistic.com) and create an account in this url [Whalegistic Registration](https://whalegistic.com/register) (Note: if is asking for you to send a registration request is because we are still in the Beta phase and we need to review your application). 

After you have an account create an Store > then go to settings > navigate to API > and create your first API keys. You will need those keys in order to access your account through the API. Don't show them to anyone out of your trust!

To install Whalegistic API tool just run the following command: 

    composer require whalegistic/api

After that you can connect with your account using Whalegistic API library and your API keys. In the following sections it will be explained how to do that!

## Connect to Whalegistic

In order to connect to Whalegistic you will need both the secret and the public key. This is your login method to Whalegistic. From then on you will be able to connect to Whalegistic using the  `whale` variable:

    use Whalegistic\API\Whalegistic;
    
    $whale = new Whalegistic($WHALEGISTIC_SECRET_KEY, $WHALEGISTIC_PUBLIC_KEY)

It is only necessary to do this once, in order to receive the necessary credentials to be used with Whalegistic API.

## Requests

<br>

#### Get Brands

Get all the Brands created on your Whalegistic Store.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array() // no parameters

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			brands => // array of all brands objects
		)

Send request code:

	$response = $whale->getBrands($request_parameters)

<br>
 
#### Get Categories

Get all the Product's Categories created on your Whalegistic Store.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			language => // 2 digit language code for translation ex: "EN", "FR", ...
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			categories => // array of all categories objects
		)

Send request code:

	$response = $whale->getCategories($request_parameters)

<br>

#### Get Collections

Get all the Product's Collections created on your Whalegistic Store.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			language => // 2 digit language code for translation ex: "EN", "FR", ...
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			collections => // array of all collections objects
		)

Send request code:

	$response = $whale->getCollections($request_parameters)

<br>

#### Get Store

Get all the necessary information to display on your Online Store. Normally this is the stepping stone for starting showing all the different filters like the different brands, categories, collections and products. This is a combination of multiple functions.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			min_price => // lowest price for the searched products
			max_price => // highest price for the searched products
			offset => // offset of products ex: 20 will skip the first 20 products
			limit => // limit of products ex: 40 will send back 40 products
			promotions => //
			search_by_names: array(
				Products => // name of products searching for
				Brands => // brand name of products searching for
				Categories => // categories name of products searching for
				Collections => // collections name of products searching for
			)
			language => // 2 digit language code for translation ex: "EN", "FR", ...
		)

This is what the return object looks like:

	Return:
		array(
			products => // array of products objects
			max_product_price => // the highest product price
			number_products => // total number of products
			brands => // array of all the brands objects
			categories => // array of all the categories objects
			collections => // array of all the collections objects
		)

Send request code:

	$response = $whale->getStore($request_parameters)

<br>

#### Get Products

Get all the products created on your Whalegistic Store and filtered by the parameters sent by the request. It is returned an Array of products, the highest priced product price and the total number of products you have available.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			min_price => // lowest price for the searched products
			max_price => // highest price for the searched products
			offset => // offset of products ex: 2 will skip the first 2 products
			limit => // limit of products ex: 4 will send back 4 products
			promotions => //
			search_obj: array(
				Products_IDs => // array of products ids ex: [1, 2, 3, ...]
				Name => // name of products searching for
				SKU => // SKU of product searching for
				Models_IDs => // array of models ids of products searching for ex: [1, 2, 3, ...]
				Brands => // array of brands ids of products searching for ex: [1, 2, 3, ...]
				Categories => // array of categories ids of products searching for ex: [1, 2, 3, ...]
			)
			search_by_names: array(
				Products => // name of products searching for
				Brands => // brand name of products searching for
				Categories => // categories name of products searching for
				Collections => // collections name of products searching for
			)
			language => // 2 digit language code for translation ex: "EN", "FR", ...
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			products => // array of products objects
			max_product_price => // the highest product price
			number_products => // total number of products
		)

Send request code:

	$response = $whale->getProducts($request_parameters)

<br>

#### Get Models

Get all the Models created on your Whalegistic Store. The Models are the parent Product that can store all your products information, photos and video to make easier to create new products that are associated to a specific Model.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			offset => // offset of products ex: 2 will skip the first 2 products
			limit => // limit of products ex: 4 will send back 4 products
			search_obj: array(
				model_name => // name of models searching for
				model_mid => // MID of models searching for
				brand_name => // brand name of models searching for
				category_name => // categories of models searching for
			)
			language => // 2 digit language code for translation ex: "EN", "FR", ...
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			models => // array of all models objects
		)

Send request code:

	$response = $whale->getModels($request_parameters)

<br>

#### Get Products from Collection

Get all the products on a Collection created on your Whalegistic Store.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			collections => // array of collections id's ex: [1, 2, 3, ...]
			offset => // offset of products ex: 2 will skip the first 2 products
			limit => // limit of products ex: 4 will send back 4 products
			language => // 2 digit language code for translation ex: "EN", "FR", ...
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			products => // array of all products objects
			total_products_count => // total number of products on that collection
			max_price => // highest price of a product on that collection
		)

Send request code:

	$response = $whale->getCollectionProducts($request_parameters)

<br>

#### Get Related Products

Get all the products that are related to a specific product that is sent as a request parameter. This related products are chosen based on the amount of purchases were made together with the target product. If there is no products that were purchase together with the target product, this will be filled with random products until there is a specific pattern of related products.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			product_id => // desired product id
			offset => // offset of products ex: 2 will skip the first 2 products
			limit => // limit of products ex: 4 will send back 4 products
			language => // 2 digit language code for translation ex: "EN", "FR", ...
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			products => // array of all products objects
		)

Send request code:

	$response = $whale->getRelatedProducts($request_parameters)

<br>

#### Get Product by Slug

Get a specific products, created on your Whalegistic Store, based on its customized URL Slug. This is ideal for Webstores that want to have the name of the desire product on the website url for better SEO.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			product_slug => // desired product's url slug
			language => // 2 digit language code for translation ex: "EN", "FR", ...
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			product => // product's object
		)

Send request code:

	$response = $whale->getProductBySlug($request_parameters)

<br>

#### Get Client

Get a specific Client object created on your Whalegistic Store or by the API.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			client_id => // id of the desired client
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			client => // client's object
		)

Send request code:

	$response = $whale->getClient($request_parameters)

<br>

#### Create New Client

Create a new Client object on your Whalegistic Store.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			name => // client's name
			email => // client's email
			phone => // client's phone
			del_address => // client's delivery address
			del_city => // client's delivery city
			del_country => // client's delivery country
			del_zip => // client's delivery zip code
			vat_num => // client's delivery VAT number
			inv_name => // client's invoice name
			inv_address => // client's invoice address
			inv_city => // client's invoice city
			inv_country => // client's invoice country
			inv_zip_code => // client's invoice zip code
			inv_vat_number => // client's invoice VAT number
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			obj_insert => // object that was inserted with its ID
		)

Send request code:

	$response = $whale->createClient($request_parameters)

<br>

#### Update Client

Update a new Client object on your Whalegistic Store.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			client_id => // id of the desired client
			client_name => // client's name
			client_email => // client's email
			client_phone => // client's phone contact
			client_vat_number => // client's VAT number
			delivery_address => // client's delivery address
			delivery_city => // client's delivery city
			delivery_country => // client's delivery country
			delivery_zip_code => // client's delivery zip code
			invoice_address => // client's invoice address
			invoice_city => // client's invoice city
			invoice_country => // client's invoice country
			invoice_zip_code => // client's invoice zip code
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
		)

Send request code:

	$response = $whale->updateClient($request_parameters)

<br>

#### Get Client's Orders

Get a specific Client's orders objects created on your Whalegistic Store or by the API.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			client_id => // id of the desired client
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			orders => // array of all orders objects
		)

Send request code:

	$response = $whale->getClientOrders($request_parameters)

<br>

#### Get Client Profile

Get a specific Client's orders objects and its profile as well created on your Whalegistic Store or by the API.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			client_id => // id of the desired client
		)

This is what the return object looks like:

	Return:
		array(
			client => // the client's object
			client_orders => // an array of the client's orders objects
		)

Send request code:

	$response = $whale->getClientProfile($request_parameters)

<br>

#### Create New Contact

Create a new contact from a client on your Whalegistic Store.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			name => // contact name
			email => // valid contact email
			about => // what the contact is about
			message => // the contact message
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			obj_insert => // object that was inserted with its ID
		)

Send request code:

	$response = $whale->createContact($request_parameters)

<br>

#### Create New Newsletter

Submit a new Newsletter subscription from a client on your Whalegistic Store.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			email => // desired email to add to the newsletter list
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			obj_insert => // object that was inserted with its ID
		)

Send request code:

	$response = $whale->createNewsletter($request_parameters)

<br>

#### Get Shipping Rates

Get all the Shipping Costs Rates available on your Whalegistic Store.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array() // no parameters

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			shipping_costs => // array of all shipping costs objects
		)

Send request code:

	$response = $whale->getShippingRates($request_parameters)

<br>

#### Get a specific Shipping Rate

Get a specific Shipping Cost Rate and its Tax Conversions available on your Whalegistic Store.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array( // it's necessary to choose one of the two
			country_name => // value of the country name
			country_code => // 2 digit country indentifier ex: "US", "GB", ...
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			shipping => // shipping cost object
			conversion_taxes => // array of all tax conversions objects
		)

Send request code:

	$response = $whale->getShippingRate($request_parameters)

<br>

#### Get Promo Code

Get a specific Promo Code on your Whalegistic Store. Basically this could be used to verify if the promo code exists.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			promo_code => // target promo code value
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			promo_code => // promo code object
		)

Send request code:

	$response = $whale->getPromoCode($request_parameters)

<br>

#### Get Order

Get a specific order created on your Whalegistic Store, by the platform or by the API.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			order_id => // id of the desired order
			language => // 2 digit language code for translation ex: "EN", "FR", ...
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			order => // order object
		)

Send request code:

	$response = $whale->getOrder($request_parameters)

<br>

#### Get Order Total

This function simply calculates the total price, tax, shipping and promotions based on the different parameters sent. It returns also all the products with all the necessary information needed for creating that order from that specific products and characteristics.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			products: array( // array of products ID's as an object
				array(
					id => // id of the product
					quantity => // quantity of the product
				), 
				array(...) // other object
			)
			shipping_country => // shipping country name to where this order will be sent
			shipping => // default shipping cost if there is no shipping country
			language => // 2 digit language code for translation ex: "EN", "FR", ...
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			total_value => // total price for this order
			vat_value => // total VAT value for this order
			shipping => // shipping price for this order
			currency => // currency of this order
			products => // array of products objects on this order
			promo_code => // promo code this order
		)

Send request code:

	$response = $whale->getTotal($request_parameters)

<br>

#### Create New Order

Create a new order based on the parameters sent. This will also create the client if there is no information already in the system on your Whalegistic Store. The client is created and connected to this order by the email address.

This is what the request parameters looks like:

	Parameters:
		$request_parameters = array(
			products: array( // array of products ID's as an object
				array(
					id => // id of the product
					quantity => // quantity of the product
				), 
				array(...) // other object
			)
			del_name => // delivery client's name
			del_email => // delivery client's email
			del_phone => // delivery client's phone contact
			del_address => // delivery client's address
			del_city => // delivery client's city
			del_country => // delivery client's country
			del_zip_code => // delivery client's zip code
			inv_name => // invoice client's name
			inv_address => // invoice client's address
			inv_city => // invoice client's city
			inv_country => // invoice client's country
			inv_zip_code => // invoice client's zip code
			inv_vat_number => // invoice client's VAT number
			payment_status => // "paid" or "not paid"
			shipping => // default shipping cost if the country is not found
			promo_code_id // order promo code id value (don't need to send both promo_code_id and promo_code together)
			promo_code // order promo code value
			is_pvp => // True for an PVP priced or False for a reseller priced order
		)

This is what the return object looks like:

	Return:
		array(
			succ => // true or false if request was successfull. If false it sends the Error
			new_order => // order object
			order_products => // array of products objects on the new order
			promo_code => // promo code object
		)

Send request code:

	$response = $whale->createOrder($request_parameters)

<br>

## Report Errors

If, during the utilization of Whalegistic App any error is found, please let us know! We depend on testers and developers to help us develop our platform and libraries.

You can contact us by email or by the contact form located on Whalegistic's Website specific for reporting errors - [Error Reporting](https://whalegistic.com/report-errors). 

You can also contact Whalegistic with our normal contact form for suggestions that you may have for our platform - [Contact Form](https://whalegistic.com/contact-us).


## Final Thoughts

Whalegistic is still an young project with big projects and plans ahead. If you would like what we are developing and want to help us develop Whalegistic and improve our project please feel free to contact us whenever you wish with any suggestions and solutions.

We also have our Slack Site if anyone that want to join our team and discuss further Whalegistic application and how it can grow into a better and bigger platform for E-Commerce.

Any help is welcomed and necessary!

In name of all the Whalegistic Team, 
Many thanks for your support!

