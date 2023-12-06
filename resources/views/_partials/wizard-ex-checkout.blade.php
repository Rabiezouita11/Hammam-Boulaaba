<!-- Checkout Wizard -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<script src=" https://code.jquery.com/jquery-3.5.1.min.js"></script>

<div id="wizard-checkout" class="bs-stepper wizard-icons wizard-icons-example mb-5">
  <div class="bs-stepper-header m-auto border-0 py-4">
    <div class="step" data-target="#checkout-cart">
      <button type="button" class="step-trigger">
        <span class="bs-stepper-icon">
          <svg viewBox="0 0 58 54">
            <use xlink:href="/assets/svg/icons/wizard-checkout-cart.svg#wizardCart"></use>
          </svg>
        </span>
        <span class="bs-stepper-label">Cart</span>
      </button>
    </div>
    <div class="line">
      <i class="ti ti-chevron-right"></i>
    </div>
    <div class="step" data-target="#checkout-payment">
      <button type="button" class="step-trigger">
        <span class="bs-stepper-icon">
          <svg viewBox="0 0 58 54">
            <use xlink:href="/assets/svg/icons/wizard-checkout-payment.svg#wizardPayment"></use>
          </svg>
        </span>
        <span class="bs-stepper-label">Payment</span>
      </button>
    </div>
    <div class="line">
      <i class="ti ti-chevron-right"></i>
    </div>


    <div class="step" data-target="#checkout-confirmation">
      <button type="button" class="step-trigger">
        <span class="bs-stepper-icon">
          <svg viewBox="0 0 58 54">
            <use xlink:href="/assets/svg/icons/wizard-checkout-confirmation.svg#wizardConfirm"></use>
          </svg>
        </span>
        <span class="bs-stepper-label">Confirmation</span>
      </button>
    </div>
  </div>
  <div class="bs-stepper-content border-top">
    <form id="wizard-checkout-form" onSubmit="return false">

      <!-- Cart -->
      <div id="checkout-cart" class="content">
        <div class="row">
          <!-- Cart left -->
          <div class="col-xl-8 mb-3 mb-xl-0">

            <!-- Offer alert -->


            <!-- Shopping bag -->
            <h5>Mon panier ({{$panierCount}} Services)</h5>
            <ul class="list-group mb-3">


              @forelse ($cartItems as $item)

              <li class="list-group-item p-4">
                <div class="d-flex gap-3">
                  <div class="flex-shrink-0 d-flex align-items-center">
                    <img src="{{ asset('storage/' . $item->service->image) }}" alt="google home" class="w-px-100">
                  </div>
                  <div class="flex-grow-1">
                    <div class="row">
                      <div class="col-md-8">
                        <p class="me-3"><a href="javascript:void(0)" class="text-body">{{ $item->service->Designations }}</a></p>
                        <!-- <span class="badge bg-label-success">In Stock</span> -->
                        <input type="number" class="form-control form-control-sm w-px-100 mt-2" data-item-id="{{ $item->id }}" value="{{ $item->nombre_de_place }}" min="1">
                      </div>
                      <div class="col-md-4">
                        <div class="text-md-end">
                          <button type="button" class="btn-close btn-pinned" aria-label="Close"></button>
                          <div class="my-2 my-md-4 mb-md-5"><span class="text-primary">{{ $item->service->prix }} TND</span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              @empty
              <li>Votre panier est vide..</li>
              @endforelse
            </ul>

            <!-- Wishlist -->

          </div>

          <!-- Cart right -->
          <div class="col-xl-4">
            <div class="border rounded p-4 mb-3 pb-3">

              <!-- Offer -->

              <!-- <div class="row g-3 mb-3">
                <div class="col-8 col-xxl-8 col-xl-12">
                  <input type="text" class="form-control" placeholder="Enter Promo Code" aria-label="Enter Promo Code">
                </div>
                <div class="col-4 col-xxl-4 col-xl-12">
                  <div class="d-grid">
                    <button type="button" class="btn btn-label-primary">Apply</button>
                  </div>
                </div>
              </div> -->

              <!-- Gift wrap -->



              <!-- Price Details -->



              <hr class="mx-n4">
              <dl class="row mb-0">
                <dt class="col-6 text-heading">Total</dt>
                <dd class="col-6 fw-medium text-end text-heading mb-0" id="subtotal">{{ $subtotal }}TND</dd>
              </dl>
            </div>
            <div class="d-grid">
              <button class="btn btn-primary btn-next" >Passer la commande</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Address -->
      <div id="checkout-address" class="content">
        <div class="row">
          <!-- Address left -->
          <div class="col-xl-8  col-xxl-9 mb-3 mb-xl-0">

            <!-- Select address -->
            <p>Select your preferable address</p>
            <div class="row mb-3">
              <div class="col-md mb-md-0 mb-2">
                <div class="form-check custom-option custom-option-basic checked">
                  <label class="form-check-label custom-option-content" for="customRadioAddress1">
                    <input name="customRadioTemp" class="form-check-input" type="radio" value="" id="customRadioAddress1" checked="">
                    <span class="custom-option-header mb-2">
                      <span class="fw-medium text-heading mb-0">John Doe (Default)</span>
                      <span class="badge bg-label-primary">Home</span>
                    </span>
                    <span class="custom-option-body">
                      <small>4135 Parkway Street, Los Angeles, CA, 90017.<br> Mobile : 1234567890 Card / Cash on delivery available</small>
                      <span class="my-2 border-bottom d-block"></span>
                      <span class="d-flex">
                        <a class="me-2" href="javascript:void(0)">Edit</a> <a href="javascript:void(0)">Remove</a>
                      </span>
                    </span>
                  </label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-check custom-option custom-option-basic">
                  <label class="form-check-label custom-option-content" for="customRadioAddress2">
                    <input name="customRadioTemp" class="form-check-input" type="radio" value="" id="customRadioAddress2">
                    <span class="custom-option-header mb-2">
                      <span class="fw-medium text-heading mb-0">ACME Inc.</span>
                      <span class="badge bg-label-success">Office</span>
                    </span>
                    <span class="custom-option-body">
                      <small>87 Hoffman Avenue, New York, NY, 10016.<br>Mobile : 1234567890 Card / Cash on delivery available</small>
                      <span class="my-2 border-bottom d-block"></span>
                      <span class="d-flex">
                        <a class="me-2" href="javascript:void(0)">Edit</a> <a href="javascript:void(0)">Remove</a>
                      </span>
                    </span>
                  </label>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#addNewAddress">Add new address</button>

            <!-- Choose Delivery -->
            <p>Choose Delivery Speed</p>
            <div class="row mt-2">
              <div class="col-md mb-md-0 mb-2">
                <div class="form-check custom-option custom-option-icon position-relative checked">
                  <label class="form-check-label custom-option-content" for="customRadioDelivery1">
                    <span class="custom-option-body">
                      <i class="ti ti-users ti-lg"></i>
                      <span class="custom-option-title mb-1">Standard</span>
                      <span class="badge bg-label-success btn-pinned">FREE</span>
                      <small>Get your product in 1 Week.</small>
                    </span>
                    <input name="customRadioIcon" class="form-check-input" type="radio" value="" id="customRadioDelivery1" checked="">
                  </label>
                </div>
              </div>
              <div class="col-md mb-md-0 mb-2">
                <div class="form-check custom-option custom-option-icon position-relative">
                  <label class="form-check-label custom-option-content" for="customRadioDelivery2">
                    <span class="custom-option-body">
                      <i class="ti ti-crown ti-lg"></i>
                      <span class="custom-option-title mb-1">Express</span>
                      <span class="badge bg-label-secondary btn-pinned">$10</span>
                      <small>Get your product in 3-4 days.</small>
                    </span>
                    <input name="customRadioIcon" class="form-check-input" type="radio" value="" id="customRadioDelivery2">
                  </label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-check custom-option custom-option-icon position-relative">
                  <label class="form-check-label custom-option-content" for="customRadioDelivery3">
                    <span class="custom-option-body">
                      <i class="ti ti-brand-telegram ti-lg"></i>
                      <span class="custom-option-title mb-1">Overnight</span>
                      <span class="badge bg-label-secondary btn-pinned">$15</span>
                      <small>Get your product in 0-1 days.</small>
                    </span>
                    <input name="customRadioIcon" class="form-check-input" type="radio" value="" id="customRadioDelivery3">
                  </label>
                </div>
              </div>
            </div>
          </div>

          <!-- Address right -->
          <div class="col-xl-4 col-xxl-3">
            <div class="border rounded p-4 pb-3 mb-3">

              <!-- Estimated Delivery -->
              <h6>Estimated Delivery Date</h6>
              <ul class="list-unstyled">
                <li class="d-flex gap-3 align-items-center">
                  <div class="flex-shrink-0">
                    <img src="/assets/img/products/1.png" alt="google home" class="w-px-50">
                  </div>
                  <div class="flex-grow-1">
                    <p class="mb-0"><a class="text-body" href="javascript:void(0)">Google - Google Home - White</a></p>
                    <p class="fw-medium">18th Nov 2021</p>
                  </div>
                </li>
                <li class="d-flex gap-3 align-items-center">
                  <div class="flex-shrink-0">
                    <img src="/assets/img/products/2.png" alt="google home" class="w-px-50">
                  </div>
                  <div class="flex-grow-1">
                    <p class="mb-0"><a class="text-body" href="javascript:void(0)">Apple iPhone 11 (64GB, Black)</a></p>
                    <p class="fw-medium">20th Nov 2021</p>
                  </div>
                </li>
              </ul>

              <hr class="mx-n4">

              <!-- Price Details -->
              <h6>Price Details</h6>
              <dl class="row mb-0">

                <dt class="col-6 fw-normal text-heading">Order Total</dt>
                <dd class="col-6 text-end">$1198.00</dd>

                <dt class="col-6 fw-normal text-heading">Delivery Charges</dt>
                <dd class="col-6 text-end"><s class="text-muted">$5.00</s> <span class="badge bg-label-success ms-1">Free</span></dd>

              </dl>
              <hr class="mx-n4">
              <dl class="row mb-0">
                <dt class="col-6 text-heading">Total</dt>
                <dd class="col-6 fw-medium text-end text-heading mb-0">$1198.00</dd>
              </dl>
            </div>
            <div class="d-grid">
              <button class="btn btn-primary btn-next" >Passer la commande</button>
            </div>
          </div>
        </div>
      </div>
      @php
      $configData = Helper::appClasses();
      @endphp
      <!-- Payment -->
      <div id="checkout-payment" class="content">
        
          <div class="container mt-2">
            <div class="card px-3">
              <div class="row">
                <div class="col-lg-7 card-body border-end">
                  <h4 class="mb-2">Checkout</h4>
                  <p class="mb-0">All plans include 40+ advanced tools and features to boost your product. <br>
                    Choose the best plan to fit your needs.</p>
                  <div class="row py-4 my-2">
                    <div class="col-md mb-md-0 mb-2">
                      <div class="form-check custom-option custom-option-basic checked">
                        <label class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center" for="customRadioVisa">
                          <input name="customRadioTemp" class="form-check-input" type="radio" value="credit-card" id="customRadioVisa" checked />
                          <span class="custom-option-body">
                            <img src="{{ asset('/assets/img/icons/payments/visa-'.$configData['style'].'.png') }}" alt="visa-card" width="58" data-app-light-img="icons/payments/visa-light.png" data-app-dark-img="icons/payments/visa-dark.png">
                            <span class="ms-3">Credit Card</span>
                          </span>
                        </label>
                      </div>
                    </div>
                    <div class="col-md mb-md-0 mb-2">
                      <div class="form-check custom-option custom-option-basic">
                        <label class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center" for="customRadioPaypal">
                          <input name="customRadioTemp" class="form-check-input" type="radio" value="paypal" id="customRadioPaypal" />
                          <span class="custom-option-body">
                            <img src="{{ asset('/assets/img/icons/payments/paypal-'.$configData['style'].'.png') }}" alt="paypal" width="58" data-app-light-img="icons/payments/paypal-light.png" data-app-dark-img="icons/payments/paypal-dark.png">
                            <span class="ms-3">Paypal</span>
                          </span>
                        </label>
                      </div>
                    </div>
                  </div>
                  <h4 class="mt-2 mb-4">Détails de la facturation</h4>
                  <form>
                    <div class="row g-3">
                      <div class="col-md-6">
                        <label class="form-label" for="billings-email">Email Address</label>
                        <input type="text" id="billings-email" class="form-control" value="{{Auth::user()->email}}" readonly/>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label" for="billings-password">Nom </label>
                        <input type="text" id="billings-password" class="form-control" value="{{Auth::user()->name}}" />
                      </div>
                      <div class="col-md-6">
                        <label class="form-label" for="billings-country">Country</label>
                        <select id="billings-country" class="form-select" data-allow-clear="true">
                          <option value="">Select</option>
                          <option value="Australia">Australia</option>
                          <option value="Brazil">Brazil</option>
                          <option value="Canada">Canada</option>
                          <option value="China">China</option>
                          <option value="France">France</option>
                          <option value="Germany">Germany</option>
                          <option value="India">India</option>
                          <option value="Turkey">Turkey</option>
                          <option value="Ukraine">Ukraine</option>
                          <option value="United Arab Emirates">United Arab Emirates</option>
                          <option value="United Kingdom">United Kingdom</option>
                          <option value="United States">United States</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label" for="billings-zip">Billing Zip / Postal Code</label>
                        <input type="text" id="billings-zip" class="form-control billings-zip-code" placeholder="Zip / Postal Code">
                      </div>
                    </div>
                  </form>
                  <div id="form-credit-card">
                    <h4 class="mt-4 pt-2">Credit Card Info</h4>
                    <form>
                      <div class="row g-3">
                        <div class="col-12">
                          <label class="form-label" for="billings-card-num">Card number</label>
                          <div class="input-group input-group-merge">
                            <input type="text" id="billings-card-num" class="form-control billing-card-mask" placeholder="7465 8374 5837 5067" aria-describedby="paymentCard" />
                            <span class="input-group-text cursor-pointer p-1" id="paymentCard"><span class="card-type"></span></span>

                          </div>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label" for="billings-card-name">Name</label>
                          <input type="text" id="billings-card-name" class="form-control" placeholder="John Doe" />
                        </div>
                        <div class="col-md-3">
                          <label class="form-label" for="billings-card-date">EXP. Date</label>
                          <input type="text" id="billings-card-date" class="form-control billing-expiry-date-mask" placeholder="MM/YY" />
                        </div>
                        <div class="col-md-3">
                          <label class="form-label" for="billings-card-cvv">CVV</label>
                          <input type="text" id="billings-card-cvv" class="form-control billing-cvv-mask" maxlength="3" placeholder="965" />
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-lg-5 card-body">
                  <h4 class="mb-2">Récapitulatif de la commande</h4>
                
                
                  <div>
                 
                    
                   
                    <div class="d-flex justify-content-between align-items-center mt-3 pb-1">
                      <p class="mb-0">Total</p>
                      <h6 class="mb-0">{{$subtotal}}TND</h6>
                    </div>
                    <div class="d-grid mt-3">
                      <button class="btn btn-success">
                        <span class="me-2">Proceed with Payment</span>
                        <i class="ti ti-arrow-right scaleX-n1-rtl"></i>
                      </button>
                    </div>

                    <p class="mt-4 pt-2">By continuing, you accept to our Terms of Services and Privacy Policy. Please note that payments are non-refundable.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
       
      </div>

      <!-- Confirmation -->
      <div id="checkout-confirmation" class="content">
        <div class="row mb-3">
          <div class="col-12 col-lg-8 mx-auto text-center mb-3">
            <h4 class="mt-2">Thank You! 😇</h4>
            <p>Your order <a href="javascript:void(0)">#1536548131</a> has been placed!</p>
            <p>We sent an email to <a href="mailto:john.doe@example.com">john.doe@example.com</a> with your order confirmation and receipt. If the email hasn't arrived within two minutes, please check your spam folder to see if the email was routed there.</p>
            <p><span class="fw-medium"><i class="ti ti-clock me-1"></i> Time placed:&nbsp;</span> 25/05/2020 13:35pm</p>
          </div>
          <!-- Confirmation details -->
          <div class="col-12">
            <ul class="list-group list-group-horizontal-md">
              <li class="list-group-item flex-fill p-4 text-heading">
                <h6 class="d-flex align-items-center gap-1"><i class="ti ti-map-pin"></i> Shipping</h6>
                <address class="mb-0">
                  John Doe <br />
                  4135 Parkway Street,<br />
                  Los Angeles, CA 90017,<br />
                  USA
                </address>
                <p class="mb-0 mt-3">
                  +123456789
                </p>
              </li>
              <li class="list-group-item flex-fill p-4 text-heading">
                <h6 class="d-flex align-items-center gap-1"><i class="ti ti-credit-card"></i> Billing Address</h6>
                <address class="mb-0">
                  John Doe <br />
                  4135 Parkway Street,<br />
                  Los Angeles, CA 90017,<br />
                  USA
                </address>
                <p class="mb-0 mt-3">
                  +123456789
                </p>
              </li>
              <li class="list-group-item flex-fill p-4 text-heading">
                <h6 class="d-flex align-items-center gap-1"><i class="ti ti-ship"></i> Shipping Method</h6>
                <p class="fw-medium mb-3">Preferred Method:</p>
                Standard Delivery<br />
                (Normally 3-4 business days)
              </li>
            </ul>
          </div>
        </div>

        <div class="row">
          <!-- Confirmation items -->
          <div class="col-xl-9 mb-3 mb-xl-0">
            <ul class="list-group">
              <li class="list-group-item p-4">
                <div class="d-flex gap-3">
                  <div class="flex-shrink-0">
                    <img src="/assets/img/products/1.png" alt="google home" class="w-px-75">
                  </div>
                  <div class="flex-grow-1">
                    <div class="row">
                      <div class="col-md-8">
                        <a href="javascript:void(0)" class="text-body">
                          <p>Google - Google Home - White</p>
                        </a>
                        <div class="text-muted mb-1 d-flex flex-wrap"><span class="me-1">Sold by:</span> <a href="javascript:void(0)" class="me-3">Apple</a> <span class="badge bg-label-success">In Stock</span></div>
                      </div>
                      <div class="col-md-4">
                        <div class="text-md-end">
                          <div class="my-2 my-lg-4"><span class="text-primary">$299/</span><s class="text-muted">$359</s></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="list-group-item p-4">
                <div class="d-flex gap-3">
                  <div class="flex-shrink-0">
                    <img src="/assets/img/products/2.png" alt="google home" class="w-px-75">
                  </div>
                  <div class="flex-grow-1">
                    <div class="row">
                      <div class="col-md-8">
                        <a href="javascript:void(0)" class="text-body">
                          <p>Apple iPhone 11 (64GB, Black)</p>
                        </a>
                        <div class="text-muted mb-1 d-flex flex-wrap"><span class="me-1">Sold by:</span> <a href="javascript:void(0)" class="me-3">Apple</a> <span class="badge bg-label-success">In Stock</span></div>
                      </div>
                      <div class="col-md-4">
                        <div class="text-md-end">
                          <div class="my-2 my-lg-4"><span class="text-primary">$299/</span><s class="text-muted">$359</s></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <!-- Confirmation total -->
          <div class="col-xl-3">
            <div class="border rounded p-4 pb-3">
              <!-- Price Details -->
              <h6>Price Details</h6>
              <dl class="row mb-0">

                <dt class="col-6 fw-normal text-heading">Order Total</dt>
                <dd class="col-6 text-end">$1198.00</dd>

                <dt class="col-sm-6 text-heading fw-normal">Delivery Charges</dt>
                <dd class="col-sm-6 text-end"><s class="text-muted">$5.00</s> <span class="badge bg-label-success ms-1">Free</span></dd>
              </dl>
              <hr class="mx-n4">
              <dl class="row mb-0">
                <dt class="col-6 text-heading">Total</dt>
                <dd class="col-6 fw-medium text-end text-heading mb-0">$1198.00</dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<!--/ Checkout Wizard -->


<script>
  // Function to update cart item quantity
  function updateCartItemQuantity(itemId, newQuantity) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: 'POST',
      url: '/update-cart-item-quantity', // Replace with your route
      data: {
        item_id: itemId,
        new_quantity: newQuantity
      },
      success: function(response) {
        // Update the UI with the updated cart data
        console.log(response); // Log the response from the server

        // Example: Update the subtotal on the page
        $('#subtotal').text(response.total + 'TND'); // Concatenate 'TND' to the updated subtotal

        // You can update other elements or the entire cart content as needed
      },
      error: function(error) {
        console.error(error);
      }
    });
  }

  // Attach change event listener to input fields
  $('input[data-item-id]').on('change', function() {
    var itemId = $(this).data('item-id');
    var newQuantity = $(this).val();
    updateCartItemQuantity(itemId, newQuantity);
  });
</script>