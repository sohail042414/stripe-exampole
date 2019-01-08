<?php // Create a customer using a Stripe token

// If you're using Composer, use Composer's autoload:
require_once('vendor/autoload.php');

// Be sure to replace this with your actual test API key
// (switch to the live key later)
\Stripe\Stripe::setApiKey("sk_test_JOpR4SS8QKlHqWAqQMJTfzAv");

try
{

  $customer = \Stripe\Customer::create([
    'email' => $_POST['stripeEmail'],
    'source'  => $_POST['stripeToken'],
  ]);


  $subscription = \Stripe\Subscription::create([
    'customer' => $customer->id,
    'items' => [['plan' => 'monthly-two']],
  ]);


  echo "<pre>";
  print_r($subscription);
  exit;


}
catch(Exception $e)
{
    echo "<pre>";
    print_r($e); 
    exit;

  header('Location:oops.html');
  error_log("unable to sign up customer:" . $_POST['stripeEmail'].
    ", error:" . $e->getMessage());
}