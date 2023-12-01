<form method="{{$method}}" action="{{$action}}" class="w-full mx-[auto] my-7 max-w-sm">
    @csrf
    @method("DELETE")
    {{ $slot }}
    <input type="submit" class="{{$btnClass ?? "bg-slate-400"}} py-2 px-4 text-gray-100 block w-full" value="{{$btnValue}}"/>
</form>