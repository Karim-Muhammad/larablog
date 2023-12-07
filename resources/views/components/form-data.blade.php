<form method="{{$method}}" action="{{$action}}" enctype="{{$attributes["enctype"]}}" class="{{$attributes['class']}}">
    @csrf
    @method($httpMethod)
    {{ $slot }}
    <input type="submit" class="{{$btnClass ?? "bg-slate-400"}} py-2 px-4 text-gray-100 block w-full" value="{{$btnValue}}"/>
</form>