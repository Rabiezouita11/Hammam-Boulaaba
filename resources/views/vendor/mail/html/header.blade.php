@props(['url'])

<tr>
    <td class="header">
        <a href="http://127.0.0.1:8000/home" style="display: inline-block;">
            @if (trim($slot) === 'Hammam Boulaaba')
            <img src="/logo.png" />

            @else
            {{ $slot }}
            @endif
        </a>
    </td>
</tr>