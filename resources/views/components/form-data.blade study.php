<form :method="$method" :action="$action" class="w-full mx-[auto] my-7 max-w-sm">
    {{-- $method, $action are component's constructor parameters so we can use them like this --}}
    <!-- When there is no desire, all things are at peace. - Laozi -->
    {
    @csrf
    {{-- @method($httpMethod) --}}

    {{-- $variable -> part of component's constructor --}}
    {{-- {{$variable}} -> inject by <x-slot> --}}
    {{-- :attr="$value" -> inject when `$value` is part of component's constructor --}}
    {{-- att="{{value}}" -> Equivalent to above --}}

    
    @method($attributes["http-method"] ?? "GET")
    {{-- since `http-method` is not part of component's constructor parameters, then all props that not part of it, will be "in" $attributes --}}

    {{-- Any code inside <x-form-data></x-form-data> will be injected into $slot --}}
    {{ $slot }}

    {{-- this way can be inject $value with <x-slot name="value"></x-slot> --}}
    <input type="submit" class="py-2 px-4 bg-slate-400" value="{{$btnValue}}"/>

    {{-- this way need variable to inject $value not by <x-slot> !--}}
    {{-- <input type="submit" class="py-2 px-4 bg-slate-400" :value="$value"/> --}}
</form>