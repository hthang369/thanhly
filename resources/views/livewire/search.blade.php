<div>
    <input wire:model="number" type="text" />
    <button wire:click="increment">++</button>

    <ul wire:loading.delay.longest>
        @for ($i = 1; $i <= $number; $i++)
            <li>{{$i}}</li>
        @endfor
    </ul>
</div>
