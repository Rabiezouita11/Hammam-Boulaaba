@php
$menuCollapsed = ($configData['menuCollapsed'] === 'layout-menu-collapsed') ? json_encode(true) : false;
@endphp
<!-- laravel style -->
<script src="/assets/vendor/js/helpers.js"></script>
<!-- beautify ignore:start -->
@if ($configData['hasCustomizer'])
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
  <script src="/assets/vendor/js/template-customizer.js"></script>
@endif

  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="/assets/js/config.js"></script>

@if ($configData['hasCustomizer'])
  <script>
    window.templateCustomizer = new TemplateCustomizer({
      cssPath: '',
      themesPath: '',
      defaultStyle: "{{$configData['style']}}",
      defaultContentLayout: "{{($configData['contentLayout'] ?? '')}}",
      defaultShowDropdownOnHover: {{$configData['showDropdownOnHover']}}, // true/false (for horizontal layout only)
      displayCustomizer: {{$configData['displayCustomizer']}},
      defaultMenuCollapsed: "{{$menuCollapsed}}",
      lang: '{{ app()->getLocale() }}',
      pathResolver: function(path) {
        var resolvedPaths = {
          // Core stylesheets
          @foreach (['core'] as $name)
            '{{ $name }}.css': '"/assets/vendor/css/{$name}.css"',
            '{{ $name }}-dark.css': '"/assets/vendor/css/{$name}-dark.css"',
          @endforeach

          // Themes
          @foreach (['default', 'bordered', 'semi-dark'] as $name)
            'theme-{{ $name }}.css': '"/assets/vendor/css/theme-{$name}.css"',
            'theme-{{ $name }}-dark.css':
            '"/assets/vendor/css{$configData['rtlSupport']}/theme-{$name}-dark.css"',
          @endforeach
        }
        return resolvedPaths[path] || path;
      },
      'controls': <?php echo json_encode($configData['customizerControls']); ?>,
    });
  </script>
@endif
