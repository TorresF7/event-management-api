@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqoK9kdvZ8l7Q6W8EyNtSKqJJrYEjhBYzpoA&s" class="logo" alt="Laravel Logo">
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>
