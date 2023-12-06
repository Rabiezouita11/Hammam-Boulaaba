<!-- BEGIN: Vendor JS-->
<script src="/assets/vendor/libs/popper/popper.js"></script>
<script src="/assets/vendor/js/bootstrap.js"></script>
<script src="/assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/assets/vendor/libs/hammer/hammer.js"></script>
<script src="/assets/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="/assets/vendor/js/menu.js"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="/assets/js/main.js"></script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
