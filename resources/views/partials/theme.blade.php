{{-- resources/views/partials/theme.blade.php --}}
@if(isset($theme))
<style>
    body {
        background-color: {{ $theme->primary_color }};
        color: {{ $theme->text_color }};
    }
    .navbar, .sidebar {
        background-color: {{ $theme->secondary_color }};
    }
    .navbar a, .sidebar a, .content {
        color: {{ $theme->text_color }};
    }
</style>
@endif
