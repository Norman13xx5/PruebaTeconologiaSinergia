<ul id="js-nav-menu" class="nav-menu">

    @foreach (session('user_modules') as $module)
        <li>
            <a title="{{ $module->descripcion }}" data-filter-tags="{{ $module->titulo }}">
                <i class="{{ $module->icono }}"></i>
                <span class="nav-link-text" data-i18n="nav.theme_settings">{{ $module->titulo }}</span>
            </a>
            <ul>

                @foreach ($module->subModulos as $submodule)
                    <li id="menu_{{ $submodule->page }}">
                        <a href="{{ env('APP_URL') . $submodule->page }}" title="{{ $submodule->descripcion }}"
                            data-filter-tags="{{ $submodule->titulo }}">
                            <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">
                                {{ $submodule->titulo }}
                            </span>
                        </a>
                    </li>
                @endforeach

            </ul>
        </li>
    @endforeach

</ul>
