<div class="sidebar-footer hidden-small">
    <!-- Loop through all supported locales -->
    <a data-toggle="tooltip" data-placement="top"  >
        <span class="" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top"  >
        <span class="" aria-hidden="true"></span>
    </a>

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <!-- Check if the current locale is not the same as the looped locale -->
        @if( LaravelLocalization::getCurrentLocale() != $localeCode)
            <!-- Generate a link to switch the language -->
            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                {{ $properties['native'] }}
            </a>
        @endif
    @endforeach
    <!-- Logout button with tooltip and icon -->
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{route('logout')}}"
       onclick="event.preventDefault();
       document.getElementById('logout-form').submit();">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
    <!-- Hidden logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
