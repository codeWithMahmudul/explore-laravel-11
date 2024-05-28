@props(['name'])
@error($name)
<p class="mt-5 text-red-500">{{ $message }}</p>
@enderror
