@props(['url'])

<tr>
    <td class="header">
        <a href="http://test.hammamboulaaba.com/home" style="display: inline-block;">
            @if (trim($slot) === 'Hammam Boulaaba')
            <img src="/logo.png" />

            @else
            {{ $slot }}
            @endif
        </a>
    </td>
</tr>