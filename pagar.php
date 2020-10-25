<?php

$title=$_GET['title'];
$price=$_GET['price'];
$unit=$_GET['unit'];
$img=$_GET['img'];
$desc=$_GET['desc'];
$external=$_GET['external'];

// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';


// Agrega credenciales
MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');

MercadoPago\SDK::setIntegratorId("dev_24c65fb163bf11ea96500242ac130004");


// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->id = "1234";
$item->title = $title;
$item->description = $desc;
$item->picture_url = $img;
$item->quantity = $unit;
$item->currency_id = "ARS";
$item->unit_price = $price;
$preference->items = array($item);

$preference->notification_url = "https://www.lavillademerlo.com.ar/mercadopago/noti.php?source_news=webhooks";

$preference->payment_methods = array(

    "excluded_payment_methods" => array(
    array("id" => "amex" ) ),

    "excluded_payment_types" => array(
    array("id" => "atm" ) ),

    "installments" => 6
);

$preference->external_reference = "hernandosolis@hotmail.com";

$preference->back_urls = array(
    "success" => "https://www.lavillademerlo.com.ar/mercadopago/success.php?collection_id=[PAYMENT_ID]&external_reference=[EXTERNAL_REFERENCE]&payment_type=[PAYMENT_METHOD_ID]",
    "failure" => "https://www.lavillademerlo.com.ar/mercadopago/failure.php",
    "pending" => "https://www.lavillademerlo.com.ar/mercadopago/pending.php"
);



$preference->auto_return = "approved";
$preference->save();

  $payer = new MercadoPago\Payer();
  $payer->name = "Lalo";
  $payer->surname = "Landa";
  $payer->email = "test_user_63274575@testuser.com";
  $payer->date_created = "2020-09-29T23:58:41.425-03:00";
  $payer->phone = array(
    "area_code" => "11",
    "number" => "22223333"
  );

  $payer->address = array(
    "street_name" => "False",
    "street_number" => 123,
    "zip_code" => "1111"
    );

?>
