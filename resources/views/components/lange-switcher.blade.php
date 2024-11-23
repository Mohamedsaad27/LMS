<div class="dropdown-item d-flex align-items-center">
    @foreach ($locales as $code => $locale)
        <div class="form-check d-flex justify-content-center w-50">
            {{-- <a href=""> --}}
            <form action="{{ LaravelLocalization::getLocalizedURL($code) }}" onchange="submit()">
                <input class="form-check-input" type="radio" name="lang" id="{{ $code }}"
                    @checked(LaravelLocalization::getCurrentLocale() == $code)>
                <label class="form-check-label" for="{{ $code }}">
                    {{ $code }}
                </label>
                {{-- </a> --}}
            </form>
        </div>
    @endforeach
</div>
