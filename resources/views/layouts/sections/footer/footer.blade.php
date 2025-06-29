@php
$containerFooter = !empty($containerNav) ? $containerNav : 'container-fluid';
@endphp

<!-- Footer -->
<footer class="content-footer footer bg-footer-theme text-center">
  <div class="{{ $containerFooter }}">
    <div class="footer-container py-4 d-flex flex-column flex-md-row align-items-center justify-content-center gap-2">
      <div class="text-body">
        © <script>
          document.write(new Date().getFullYear())
        </script>, made with <span class="text-danger"><i class="tf-icons ri-heart-fill"></i></span> by Sicnarf
      </div>
      <!-- Optional footer links -->
      <!--
      <div class="d-none d-lg-inline-block">
        <a href="{{ config('variables.licenseUrl') ?: '#' }}" class="footer-link me-4" target="_blank">License</a>
        <a href="{{ config('variables.moreThemes') ?: '#' }}" target="_blank" class="footer-link me-4">More Themes</a>
        <a href="{{ config('variables.documentation') ? config('variables.documentation').'/laravel-introduction.html' : '#' }}" target="_blank" class="footer-link me-4">Documentation</a>
        <a href="{{ config('variables.support') ?: '#' }}" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
      </div>
      -->
    </div>
  </div>
</footer>
<!--/ Footer -->
