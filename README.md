
# Uddokta Pay Payment Gateway Integration

Uddoktapay is an amazing payment gateway where we can transfer money on our own personal number and which is fully automatic. We will see the integration that how can we integrate uddoktapay payment gateway in Laravel.

## Installation

We will test our application in sandbox. Developer guide - https://developer.uddoktapay.com/

1. At first copy `library` folder on your `app` folder.

2. Then copy `UddoktapayController.php` on `app/Http/Controllers` folder.

3. Copy these routes on `routes/web.php`

```bash
  Route::get( 'pay', [UddoktapayController::class, 'show'] )->name( 'uddoktapay.payment-form' );
  Route::post( 'pay', [UddoktapayController::class, 'pay'] )->name( 'uddoktapay.pay' );
  Route::get( 'success', [UddoktapayController::class, 'success'] )->name( 'uddoktapay.success' );
  Route::get( 'cancel', [UddoktapayController::class, 'cancel'] )->name( 'uddoktapay.cancel' );
```

4. Copy these routes on `routes/api.php`

```bash 
  Route::post( 'webhook', [UddoktapayController::class, 'webhook'] )->name( 'uddoktapay.webhook' );
```

5. Then copy `payment-form.blade.php` to `resources/views/uddoktapay`

6. Set these environment variable to your `.env` files.

```bash 
  UDDOKTAPAY_API_KEY=982d381360a69d419689740d9f2e26ce36fb7a50
  UDDOKTAPAY_PAYMENT_DOMAIN='https://sandbox.uddoktapay.com' // your payment panel here
```

And Contratulations! you're done.
## Authors
- [Nibir Ahmed](https://nibirahmed.com)
- [Rasel Islam](https://rtrasel.com)
