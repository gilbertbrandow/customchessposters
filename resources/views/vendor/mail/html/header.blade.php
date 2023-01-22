@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: flex; align-items: center; justify-content: center;">
@if (trim($slot) === 'Laravel')
<img src="http://localhost/public/images/ccp-icn.svg" class="logo" alt="Laravel Logo">
@else
<img src="http://0.0.0.0:5173/public/images/ccp-icn.svg" class="logo" alt="Custom Chess Posters Logo">
{{ $slot }}
@endif
</a>
</td>
</tr>
